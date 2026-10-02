<script setup>
/**
 * Khmer score sheet — no subject dropdown.
 * loadScores()     → POST score-list (class + month)
 * saveScores()     → POST score-store (flatten cells, then reload)
 * columns          → child subjects, or parent if no children
 * cell()           → students[].by_subject[subjectId]
 * onScoreInput()   → parse score (digits only; allow over max)
 * isOverMax()      → red border when score > max_score
 * applyClassFromRoute() → fill Grade/Class from Teacher Action URL
 */
import { ref, reactive, computed, watch, onMounted, nextTick } from "vue";
import { useRoute } from "vue-router";
import { useI18n } from "vue-i18n";
import { useDisplay } from "vuetify";
import { debounce } from "lodash";
import { dragAndDrop } from "@formkit/drag-and-drop/vue";
import { tearDown } from "@formkit/drag-and-drop";
import { api } from "@/utils/api";
import { getGrades, getClasses, getMonths } from "@/services/dataService";
import { useSettingStore } from "@/stores/settingStore.js";
import formatGender from "@/utils/formater/formatGender";
import hasPermission from "@/utils/hasPermission";

const props = defineProps({
  classId: { type: [Number, String], default: null },
  lockClass: { type: Boolean, default: false },
});

const CONFIG = { requireGradeBeforeClass: true };

const route = useRoute();
const settingStore = useSettingStore();
const { t, locale } = useI18n();
const { smAndDown } = useDisplay();

const isLoading = ref(false);
const isSaving = ref(false);
const isSavingDivisor = ref(false);
const skipDivisorSave = ref(false);
const canEdit = ref(true);
const windowInfo = ref({
  locked: false,
  cutoff_day: null,
  close_date: null,
  can_override: false,
});
const grades = ref([]);
const allClasses = ref([]);
const months = ref([]);
const subjects = ref([]);
const students = ref([]);
const divisor = ref(null);
const showReorderDialog = ref(false);
const parentListEl = ref(null);

/** Child drag lists — rebound every time the dialog opens. */
const childDnDReady = new Set();
const childListEls = new Map();
const childLists = reactive({});

const PARENT_DND = { dragHandle: ".reorder-parent-handle" };
const CHILD_DND = { dragHandle: ".reorder-child-handle" };

function ensureChildList(parentId) {
  const id = String(parentId);
  if (!childLists[id]) {
    const parent = subjects.value.find((s) => String(s.id) === id);
    childLists[id] = (parent?.children || []).slice();
  }
  return childLists[id];
}

function syncChildValuesFromSubjects(parentId) {
  const id = String(parentId);
  const parent = subjects.value.find((s) => String(s.id) === id);
  childLists[id] = (parent?.children || []).slice();
}

function childListRef(parentId) {
  const id = String(parentId);
  ensureChildList(id);
  return computed({
    get: () => childLists[id] || [],
    set: (kids) => {
      childLists[id] = kids;
      applyChildrenOrderToSubjects(id, kids);
    },
  });
}

function applyChildrenOrderToSubjects(parentId, kids) {
  const idx = subjects.value.findIndex(
    (s) => String(s.id) === String(parentId),
  );
  if (idx < 0) return;
  const current = (subjects.value[idx].children || [])
    .map((c) => c.id)
    .join(",");
  const next = (kids || []).map((c) => c.id).join(",");
  if (current === next) return;
  const list = subjects.value.slice();
  list[idx] = { ...list[idx], children: kids };
  subjects.value = list;
}

function bindParentDnD() {
  const el = parentListEl.value;
  if (!el) return;
  tearDown(el);
  dragAndDrop({
    parent: parentListEl,
    values: subjects,
    ...PARENT_DND,
  });
}

function teardownAllDnD() {
  if (parentListEl.value) {
    try {
      tearDown(parentListEl.value);
    } catch {
      /* already gone */
    }
  }
  for (const el of childListEls.values()) {
    try {
      tearDown(el);
    } catch {
      /* already gone */
    }
  }
  childListEls.clear();
  childDnDReady.clear();
  Object.keys(childLists).forEach((key) => delete childLists[key]);
}

const formSearch = ref({
  grade_id: null,
  class_id: null,
  month_id: null,
});

let applyingFromRoute = false;

/** Hide Grade/Class when opened from Teacher Action (class already known). */
const routeClassId = computed(() => props.classId ?? route.params.id);
const hasClassFromRoute = computed(() => {
  if (props.lockClass) return true;
  const id = Number(routeClassId.value);
  return Number.isFinite(id) && id > 0;
});

const filteredClasses = computed(() => {
  if (!formSearch.value.grade_id) return allClasses.value;
  return allClasses.value.filter(
    (c) => c.grade_id == formSearch.value.grade_id,
  );
});

const classTitle = computed(() =>
  locale.value === "km" ? "name_kh" : "name_en",
);

const canLoad = computed(
  () => formSearch.value.class_id && formSearch.value.month_id,
);

const selectedClass = computed(() =>
  allClasses.value.find((c) => c.id == formSearch.value.class_id),
);

const className = computed(() => {
  const cls = selectedClass.value;
  if (!cls) return "";
  return locale.value === "km"
    ? cls.name_kh || cls.name_en || ""
    : cls.name_en || cls.name_kh || "";
});

/** Title: Score Entry + class name (e.g. Score Entry 11កិ). */
const pageTitle = computed(() => {
  const base = t("Score Entry");
  return className.value ? `${base} ${className.value}` : base;
});

/** Input columns: children if the parent has them, else the parent (Math). */
const columns = computed(() =>
  subjects.value.flatMap((s) => (s.children?.length ? s.children : [s])),
);

const canReorderSubjects = computed(
  () =>
    subjects.value.length > 1 ||
    subjects.value.some((s) => (s.children?.length || 0) > 1),
);

const isSavingOrder = ref(false);

/** Save column order for this grade (all classes in the grade share it). */
async function persistSubjectOrder() {
  const gradeId = selectedClass.value?.grade_id ?? formSearch.value.grade_id;
  if (!gradeId || !subjects.value.length) return false;

  const children = {};
  for (const s of subjects.value) {
    if (s.children?.length) {
      children[String(s.id)] = s.children.map((c) => c.id);
    }
  }

  isSavingOrder.value = true;
  try {
    const res = await api.post("grade-subject-order-store", {
      grade_id: gradeId,
      parents: subjects.value.map((s) => s.id),
      children,
    });
    return Boolean(res.data?.status);
  } catch (e) {
    console.error("persistSubjectOrder:", e);
    return false;
  } finally {
    isSavingOrder.value = false;
  }
}

function moveParent(index, delta) {
  const next = index + delta;
  if (next < 0 || next >= subjects.value.length) return;
  const list = subjects.value.slice();
  const [item] = list.splice(index, 1);
  list.splice(next, 0, item);
  subjects.value = list;
}

function moveChild(parentId, index, delta) {
  const id = String(parentId);
  const kids = ensureChildList(id).slice();
  const next = index + delta;
  if (next < 0 || next >= kids.length) return;
  const [item] = kids.splice(index, 1);
  kids.splice(next, 0, item);
  childLists[id] = kids;
  applyChildrenOrderToSubjects(id, kids);
}

function getChildList(parentId) {
  return ensureChildList(parentId);
}

function setChildListEl(parentId, el) {
  const id = String(parentId);
  const prev = childListEls.get(id);

  if (!el) {
    if (prev) {
      try {
        tearDown(prev);
      } catch {
        /* already gone */
      }
    }
    childListEls.delete(id);
    childDnDReady.delete(id);
    return;
  }

  if (prev && prev !== el) {
    try {
      tearDown(prev);
    } catch {
      /* already gone */
    }
    childDnDReady.delete(id);
  }

  childListEls.set(id, el);
  if (childDnDReady.has(id)) return;

  syncChildValuesFromSubjects(parentId);
  dragAndDrop({
    parent: el,
    values: childListRef(parentId),
    ...CHILD_DND,
  });
  childDnDReady.add(id);
}

/** Snapshot so X / Esc can discard reorder without saving. */
const subjectsOrderSnapshot = ref(null);

function cloneSubjectsOrder(list) {
  return (list || []).map((s) => ({
    ...s,
    children: (s.children || []).map((c) => ({ ...c })),
  }));
}

function openReorderDialog() {
  subjectsOrderSnapshot.value = cloneSubjectsOrder(subjects.value);
  showReorderDialog.value = true;
}

/** X / Esc — close and restore; no API save. */
function cancelReorderDialog() {
  if (subjectsOrderSnapshot.value) {
    subjects.value = cloneSubjectsOrder(subjectsOrderSnapshot.value);
  }
  subjectsOrderSnapshot.value = null;
  showReorderDialog.value = false;
}

/** Done — save grade order, then close. */
async function saveReorderDialog() {
  await persistSubjectOrder();
  subjectsOrderSnapshot.value = null;
  showReorderDialog.value = false;
}

watch(showReorderDialog, async (open) => {
  if (!open) {
    teardownAllDnD();
    // Overlay / Esc: treat as cancel if we still have a snapshot
    if (subjectsOrderSnapshot.value) {
      subjects.value = cloneSubjectsOrder(subjectsOrderSnapshot.value);
      subjectsOrderSnapshot.value = null;
    }
    return;
  }

  // Wait for VDialog content (and child list refs) to mount
  await nextTick();
  for (const s of subjects.value) {
    if ((s.children?.length || 0) > 1) syncChildValuesFromSubjects(s.id);
  }
  await nextTick();

  if (!parentListEl.value) {
    await new Promise((resolve) => requestAnimationFrame(resolve));
  }
  bindParentDnD();
});

/** Like attendance: saved cell = score_id present after store/reload. */
function cellIsSaved(row, col) {
  return cell(row, col).score_id != null;
}

const submitStatus = computed(() => {
  const cols = columns.value;
  const rows = students.value;
  if (!rows.length || !cols.length) return "empty";

  let saved = 0;
  const total = rows.length * cols.length;
  for (const row of rows) {
    for (const col of cols) {
      if (cellIsSaved(row, col)) saved += 1;
    }
  }
  if (saved === 0) return "not_submitted";
  if (saved === total) return "submitted";
  return "partial";
});

const studentsNotYetSubmitted = computed(() => {
  const cols = columns.value;
  if (!cols.length) return [];
  return students.value.filter((row) =>
    cols.some((col) => !cellIsSaved(row, col)),
  );
});

const notSubmittedNamesText = computed(() =>
  studentsNotYetSubmitted.value.map((r) => studentName(r)).join(", "),
);

const gradeTitle = (item) => {
  if (item?.grade_level != null) {
    return locale.value === "km"
      ? `កម្រិត ${item.grade_level}`
      : `Level ${item.grade_level}`;
  }
  return subjectLabel(item);
};

function subjectLabel(item) {
  if (!item) return "";
  return locale.value === "km"
    ? item.name_kh || item.name_en || ""
    : item.name_en || item.name_kh || "";
}

function monthLabel(item) {
  if (!item) return "";
  return locale.value === "km"
    ? item.name_kh || item.name_en || ""
    : item.name_en || item.name_kh || "";
}

function studentName(row) {
  return locale.value === "km"
    ? row.name_kh || row.name_en
    : row.name_en || row.name_kh;
}

function colspan(subject) {
  return subject.children?.length ? subject.children.length : 1;
}

/** One score cell. Creates a blank cell if API has no scores row yet. */
function cell(row, col) {
  if (!row.by_subject) row.by_subject = {};
  const key = String(col.id);
  let item = row.by_subject[col.id] ?? row.by_subject[key];
  if (!item) {
    item = {
      score_id: null,
      score: null,
      is_approved: false,
      max_score: col.max_score,
      grading_rule_id: col.grading_rule_id,
    };
    row.by_subject[key] = item;
  }
  return item;
}

/** Keep digits + one decimal only (block letters). Over max is allowed — cell turns red. */
function sanitizeScoreInput(value) {
  let s = String(value).replace(/[^\d.]/g, "");
  const dot = s.indexOf(".");
  if (dot !== -1) {
    s = s.slice(0, dot + 1) + s.slice(dot + 1).replace(/\./g, "");
  }
  return s;
}

/** Block letter keys; allow digits, decimal, and navigation/edit keys. */
function onScoreKeydown(e) {
  if (e.ctrlKey || e.metaKey || e.altKey) return;
  const allowed = [
    "Backspace",
    "Delete",
    "Tab",
    "Escape",
    "Enter",
    "ArrowLeft",
    "ArrowRight",
    "ArrowUp",
    "ArrowDown",
    "Home",
    "End",
  ];
  if (allowed.includes(e.key)) return;
  if (e.key.length === 1 && !/[0-9.]/.test(e.key)) {
    e.preventDefault();
  }
}

function onScoreInput(row, col, value) {
  const item = cell(row, col);
  if (value === "" || value == null) {
    item.score = null;
    return;
  }
  const cleaned = sanitizeScoreInput(value);
  if (cleaned === "" || cleaned === ".") {
    item.score = null;
    return;
  }
  const n = Number(cleaned);
  item.score = Number.isNaN(n) ? null : n;
}

/** True when the typed score is bigger than grading_rules.max_score. */
function isOverMax(row, col) {
  const item = cell(row, col);
  const max = Number(item.max_score ?? col.max_score);
  if (item.score == null || item.score === "" || !Number.isFinite(max)) {
    return false;
  }
  return Number(item.score) > max;
}

/** POST score-list — students from student_class, numbers from scores. */
async function loadScores() {
  if (!canLoad.value) {
    subjects.value = [];
    students.value = [];
    skipDivisorSave.value = true;
    divisor.value = null;
    await nextTick();
    skipDivisorSave.value = false;
    return;
  }

  isLoading.value = true;
  try {
    const res = await api.post("score-list", {
      class_id: formSearch.value.class_id,
      month_id: formSearch.value.month_id,
    });
    if (!res.data?.status) {
      subjects.value = [];
      students.value = [];
      canEdit.value = true;
      windowInfo.value = {
        locked: false,
        cutoff_day: null,
        close_date: null,
        can_override: false,
      };
      skipDivisorSave.value = true;
      divisor.value = null;
      await nextTick();
      skipDivisorSave.value = false;
      return;
    }
    subjects.value = res.data.data.subjects || [];
    students.value = res.data.data.students || [];
    canEdit.value = res.data.data.can_edit !== false;
    windowInfo.value = res.data.data.window || {
      locked: false,
      cutoff_day: null,
      close_date: null,
      can_override: false,
    };
    skipDivisorSave.value = true;
    divisor.value =
      res.data.data.divisor != null ? Number(res.data.data.divisor) : null;
    await nextTick();
    skipDivisorSave.value = false;
  } catch (e) {
    console.error("loadScores:", e);
    subjects.value = [];
    students.value = [];
    canEdit.value = true;
    skipDivisorSave.value = true;
    divisor.value = null;
    await nextTick();
    skipDivisorSave.value = false;
  } finally {
    isLoading.value = false;
  }
}

/** POST score-store — flatten cells and save (same idea as attendance). */
async function saveScores() {
  if (!canLoad.value || !students.value.length || !canEdit.value) return;

  const rows = [];
  for (const student of students.value) {
    for (const col of columns.value) {
      const item = cell(student, col);
      rows.push({
        student_id: student.student_id,
        subject_id: col.id,
        score_id: item.score_id,
        score: item.score,
        grading_rule_id: item.grading_rule_id ?? col.grading_rule_id,
        is_approved: item.is_approved ?? false,
      });
    }
  }

  isSaving.value = true;
  try {
    const res = await api.post("score-store", {
      class_id: formSearch.value.class_id,
      month_id: formSearch.value.month_id,
      rows,
    });

    if (res.data?.status) {
      await loadScores();
    } else {
      console.error(res.data?.message || "Save failed");
      if (res.data?.window) {
        windowInfo.value = res.data.window;
        canEdit.value = false;
      }
    }
  } catch (e) {
    console.error("saveScores:", e);
    const msg = e?.response?.data?.message;
    if (msg) console.error(msg);
    if (e?.response?.data?.window) {
      windowInfo.value = e.response.data.window;
      canEdit.value = false;
    }
  } finally {
    isSaving.value = false;
  }
}

/** Save Khmer monthly avg divisor for selected class + month. */
const saveDivisor = debounce(async () => {
  if (!canLoad.value || skipDivisorSave.value || !canEdit.value) return;

  isSavingDivisor.value = true;
  try {
    const value =
      divisor.value === "" || divisor.value == null
        ? null
        : Number(divisor.value);

    await api.post("score-month-header-store", {
      class_id: formSearch.value.class_id,
      month_id: formSearch.value.month_id,
      divisor: Number.isFinite(value) ? value : null,
    });
  } catch (e) {
    console.error("saveDivisor:", e);
  } finally {
    isSavingDivisor.value = false;
  }
}, 500);

watch(divisor, () => {
  if (skipDivisorSave.value || isLoading.value || !canLoad.value) return;
  saveDivisor();
});

/** Opened from Teacher Action / class grid — preselect that class. */
async function applyClassFromRoute(rawId) {
  if (!rawId) return;
  const classId = Number(rawId);
  if (!Number.isFinite(classId)) return;
  if (!allClasses.value.length) {
    allClasses.value = (await getClasses()) || [];
  }
  const cls = allClasses.value.find((c) => c.id == classId);
  if (!cls) return;
  applyingFromRoute = true;
  formSearch.value.grade_id = cls.grade_id;
  formSearch.value.class_id = classId;
  await nextTick();
  applyingFromRoute = false;
}

/** Opened from Score Entry Status — query class_id + month_id. */
async function applyQueryFilters() {
  const qClass = Number(route.query.class_id);
  const qMonth = Number(route.query.month_id);
  if (Number.isFinite(qClass) && qClass > 0) {
    await applyClassFromRoute(qClass);
  }
  if (Number.isFinite(qMonth) && qMonth > 0) {
    formSearch.value.month_id = qMonth;
  }
}

watch(
  () => settingStore.curriculum_id,
  async (id) => {
    if (!id) return;
    grades.value = (await getGrades()) || [];
    allClasses.value = (await getClasses()) || [];
    if (hasClassFromRoute.value) {
      await applyClassFromRoute(routeClassId.value);
      return;
    }
    formSearch.value.grade_id = null;
    formSearch.value.class_id = null;
  },
);

watch(
  () => formSearch.value.grade_id,
  () => {
    if (applyingFromRoute) return;
    formSearch.value.class_id = null;
    subjects.value = [];
    students.value = [];
    divisor.value = null;
  },
);

watch(
  () => [formSearch.value.class_id, formSearch.value.month_id],
  () => {
    showReorderDialog.value = false;
    loadScores();
  },
);

watch(routeClassId, (id) => applyClassFromRoute(id));

onMounted(async () => {
  try {
    grades.value = (await getGrades()) || [];
    allClasses.value = (await getClasses()) || [];
    months.value = (await getMonths()) || [];
    await applyClassFromRoute(routeClassId.value);
    await applyQueryFilters();
    if (canLoad.value) await loadScores();
  } catch (e) {
    console.error(e);
  }
});
</script>

<template>
  <div>
    <AppCard
      :title="pageTitle"
      title-icon="tabler-file-check"
      :is-back="true"
      :is-filter="true"
      :show-filters="true"
      :loading="isLoading"
    >
      <template #filter>
        <VRow class="align-end">
          <VCol v-if="!hasClassFromRoute" cols="6" sm="4" md="2">
            <AppAutocomplete
              v-model="formSearch.grade_id"
              :items="grades"
              :item-title="gradeTitle"
              item-value="id"
              :placeholder="t('Grade')"
              clearable
              hide-details
            />
          </VCol>
          <VCol v-if="!hasClassFromRoute" cols="6" sm="4" md="2">
            <AppAutocomplete
              v-model="formSearch.class_id"
              :items="filteredClasses"
              :item-title="classTitle"
              item-value="id"
              :placeholder="t('Class')"
              clearable
              hide-details
              :disabled="CONFIG.requireGradeBeforeClass && !formSearch.grade_id"
            />
          </VCol>
          <VCol
            :cols="hasClassFromRoute ? 12 : 6"
            :sm="hasClassFromRoute ? 3 : 2"
            :md="hasClassFromRoute ? 3 : 2"
          >
            <AppAutocomplete
              v-model="formSearch.month_id"
              :items="months"
              :item-title="monthLabel"
              item-value="id"
              :placeholder="t('Month')"
              clearable
              hide-details
            />
          </VCol>

          <VCol cols="6" sm="4" md="2">
            <VBtn @click="loadScores" color="primary" variant="tonal" block>
              <VIcon icon="tabler-search" />
              {{ t("Search") }}
            </VBtn>
          </VCol>
          <VCol
            v-if="canReorderSubjects && hasPermission('view-order-subject')"
            cols="6"
            sm="4"
            md="2"
          >
            <VBtn
              color="secondary"
              variant="tonal"
              block
              @click="openReorderDialog"
            >
              <VIcon icon="tabler-arrows-sort" />
              {{ t("Reorder subjects") }}
            </VBtn>
          </VCol>
        </VRow>
      </template>

      <VAlert
        v-if="canLoad && windowInfo.locked && !canEdit"
        type="warning"
        variant="tonal"
        class="mb-3"
        density="comfortable"
      >
        {{ t("Score entry closed for this month") }}
        <template v-if="windowInfo.close_date">
          ({{ t("closed after") }} {{ windowInfo.close_date }}).
        </template>
        {{ t("Teachers cannot insert scores anymore") }}.
      </VAlert>

      <VAlert
        v-else-if="canLoad && windowInfo.close_date && canEdit"
        type="info"
        variant="tonal"
        class="mb-3"
        density="comfortable"
      >
        {{ t("Score entry open until") }} {{ windowInfo.close_date }}.
      </VAlert>

      <VAlert
        v-if="canLoad && !isLoading && !students.length"
        type="info"
        variant="tonal"
        class="mb-3"
      >
        {{ t("No students") }}
      </VAlert>

      <VAlert
        v-else-if="
          submitStatus === 'not_submitted' && students.length && columns.length
        "
        type="warning"
        variant="outlined"
        density="compact"
        class="mb-3"
      >
        {{ t("Score not yet submitted") }}
      </VAlert>
      <VAlert
        v-else-if="submitStatus === 'submitted'"
        type="success"
        variant="outlined"
        density="compact"
        class="mb-3"
      >
        {{ t("Score already submitted") }}
      </VAlert>
      <VAlert
        v-else-if="submitStatus === 'partial'"
        type="warning"
        variant="outlined"
        density="compact"
        class="mb-3"
      >
        <div class="font-weight-medium mb-1">
          {{ t("Score not yet submitted for") }}:
        </div>
        <div>{{ notSubmittedNamesText }}</div>
      </VAlert>

      <!-- height="calc(100dvh - 280px)" -->
      <VTable
        v-if="students.length"
        fixed-header
        density="compact"
        class="border rounded score-table"
      >
        <thead>
          <tr>
            <th
              style="width: 200px; min-width: 170px"
              rowspan="3"
              class="sticky-header"
            >
              {{ t("Name") }}
            </th>
            <!-- <th rowspan="3">{{ t("Gender") }}</th> -->
            <th
              v-for="subject in subjects"
              :key="'p-' + subject.id"
              class="text-center"
              :colspan="colspan(subject)"
              :rowspan="subject.children?.length ? 1 : 2"
            >
              {{ subjectLabel(subject) }}
            </th>
          </tr>
          <tr>
            <template v-for="subject in subjects" :key="'c-' + subject.id">
              <th
                v-for="child in subject.children"
                :key="child.id"
                class="text-center"
              >
                {{ subjectLabel(child) }}
              </th>
            </template>
          </tr>
          <tr>
            <th
              v-for="col in columns"
              :key="'m-' + col.id"
              class="text-center text-medium-emphasis"
            >
              {{ col.max_score }}
            </th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="row in students" :key="row.student_id">
            <td class="sticky-col font-weight-medium">
              {{ studentName(row) }}
            </td>
            <!-- <td class="sticky-col">{{ formatGender(row.gender) }}</td> -->
            <td v-for="col in columns" :key="col.id" class="score-td">
              <AppTextField
                :model-value="cell(row, col).score"
                class="score-input"
                :class="{ 'score-input--over': isOverMax(row, col) }"
                density="compact"
                hide-details
                variant="outlined"
                inputmode="decimal"
                :color="isOverMax(row, col) ? 'error' : 'primary'"
                :min="0"
                :disabled="!canEdit"
                @update:model-value="onScoreInput(row, col, $event)"
                @keydown="onScoreKeydown"
              />
            </td>
          </tr>
        </tbody>
      </VTable>

      <VRow class="mt-1 justify-end">
        <VCol v-if="canLoad" cols="6" sm="3" md="2">
          <AppTextField
            v-model="divisor"
            type="number"
            :min="0"
            step="1"
            :placeholder="t('Divisor')"
            hide-details
            :disabled="isSavingDivisor || !canEdit"
          />
        </VCol>
        <VCol cols="4" sm="2" md="2" v-if="formSearch.month_id">
          <VBtn
            @click="saveScores"
            color="primary"
            block
            variant="tonal"
            :loading="isSaving"
            :disabled="!students.length || isSaving || !canEdit"
          >
            <VIcon icon="tabler-device-floppy" />
            {{ t("Submit") }}
          </VBtn>
        </VCol>
      </VRow>
    </AppCard>

    <VDialog
      v-model="showReorderDialog"
      :fullscreen="smAndDown"
      max-width="480"
      scrollable
    >
      <VCard>
        <VCardTitle class="d-flex align-center justify-space-between ga-2">
          <span>{{ t("Reorder subjects") }}</span>
          <VBtn icon variant="text" size="small" @click="cancelReorderDialog">
            <VIcon icon="tabler-x" />
          </VBtn>
        </VCardTitle>
        <VDivider />
        <VCardText class="pa-3">
          <p class="text-caption text-medium-emphasis mb-3">
            {{ t("Drag or use arrows to reorder subjects") }}.
            {{ t("Order applies to all classes in this grade") }}
          </p>
          <div ref="parentListEl" class="reorder-list">
            <div
              v-for="(s, index) in subjects"
              :key="s.id"
              class="reorder-block"
            >
              <div class="reorder-row">
                <div class="reorder-parent-handle reorder-row__drag">
                  <VIcon icon="tabler-grip-vertical" size="18" />
                  <span class="reorder-row__label font-weight-medium">
                    {{ subjectLabel(s) }}
                  </span>
                </div>
                <div class="reorder-row__actions">
                  <VBtn
                    icon
                    size="small"
                    variant="tonal"
                    :disabled="index === 0"
                    @click="moveParent(index, -1)"
                  >
                    <VIcon icon="tabler-arrow-up" />
                  </VBtn>
                  <VBtn
                    icon
                    size="small"
                    variant="tonal"
                    :disabled="index === subjects.length - 1"
                    @click="moveParent(index, 1)"
                  >
                    <VIcon icon="tabler-arrow-down" />
                  </VBtn>
                </div>
              </div>

              <div
                v-if="(s.children?.length || 0) > 1"
                :ref="(el) => setChildListEl(s.id, el)"
                class="reorder-children"
              >
                <div
                  v-for="(c, ci) in getChildList(s.id)"
                  :key="c.id"
                  class="reorder-row reorder-row--child"
                >
                  <div class="reorder-child-handle reorder-row__drag">
                    <VIcon icon="tabler-grip-vertical" size="16" />
                    <span class="reorder-row__label">
                      {{ subjectLabel(c) }}
                    </span>
                  </div>
                  <div class="reorder-row__actions">
                    <VBtn
                      icon
                      size="small"
                      variant="text"
                      :disabled="ci === 0"
                      @click="moveChild(s.id, ci, -1)"
                    >
                      <VIcon icon="tabler-arrow-up" />
                    </VBtn>
                    <VBtn
                      icon
                      size="small"
                      variant="text"
                      :disabled="ci === getChildList(s.id).length - 1"
                      @click="moveChild(s.id, ci, 1)"
                    >
                      <VIcon icon="tabler-arrow-down" />
                    </VBtn>
                  </div>
                </div>
              </div>
              <div
                v-else-if="s.children?.length === 1"
                class="reorder-children"
              >
                <div class="reorder-row reorder-row--child">
                  <span class="reorder-row__label ps-6">
                    {{ subjectLabel(s.children[0]) }}
                  </span>
                </div>
              </div>
            </div>
          </div>
        </VCardText>
        <VDivider />
        <VCardActions class="pa-3">
          <VBtn
            color="primary"
            variant="tonal"
            block
            :loading="isSavingOrder"
            :disabled="isSavingOrder"
            @click="saveReorderDialog"
          >
            {{ t("Done") }}
          </VBtn>
        </VCardActions>
      </VCard>
    </VDialog>
  </div>
</template>

<style scoped>
.reorder-list {
  display: flex;
  flex-direction: column;
  gap: 8px;
}
.reorder-block {
  border: 1px solid rgba(var(--v-theme-on-surface), 0.12);
  border-radius: 10px;
  overflow: hidden;
  background: rgba(var(--v-theme-surface), 1);
}
.reorder-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
  min-height: 48px;
  padding: 8px 10px;
}
.reorder-row--child {
  min-height: 44px;
  padding-inline-start: 20px;
  background: rgba(var(--v-theme-on-surface), 0.03);
  border-top: 1px solid rgba(var(--v-theme-on-surface), 0.08);
}
.reorder-row__label {
  flex: 1;
  line-height: 1.3;
  word-break: break-word;
}
.reorder-row__drag {
  display: flex;
  align-items: center;
  gap: 8px;
  flex: 1;
  min-width: 0;
  cursor: grab;
  touch-action: none;
  user-select: none;
}
.reorder-row__drag:active {
  cursor: grabbing;
}
.reorder-row__actions {
  display: flex;
  gap: 4px;
  flex-shrink: 0;
}
.score-table {
  overflow-x: auto;
}
.score-table :deep(table) {
  border-collapse: collapse;
}
.score-table :deep(th),
.score-table :deep(td) {
  border: 1px solid rgba(var(--v-theme-on-surface), 0.22);
}
.sticky-col {
  position: sticky;
  left: 0;
  z-index: 1;
  background-color: white;
  /* background: rgb(var(--v-theme-surface)); */
}

.sticky-header {
  position: sticky;
  left: 0;
  z-index: 10;
  background: white;
}
.score-td {
  padding: 6px !important;
  min-width: 88px;
  text-align: center;
  vertical-align: middle;
}
.score-input {
  /* width: 76px; */
  margin-inline: auto;
}
.score-input :deep(input) {
  text-align: center;
}
.score-input :deep(.v-field) {
  border-radius: 4px;
}
.score-input :deep(.v-field__outline) {
  --v-field-border-opacity: 1;
  color: rgba(var(--v-theme-on-surface), 0.25);
}
.score-input :deep(.v-field--focused .v-field__outline) {
  color: rgb(var(--v-theme-primary));
}
.score-input--over :deep(.v-field__outline) {
  color: rgb(var(--v-theme-error)) !important;
  --v-field-border-opacity: 1;
}
.score-input--over :deep(.v-field--focused .v-field__outline) {
  color: rgb(var(--v-theme-error)) !important;
}

/* 3 header rows stick at different offsets */
/* .score-table :deep(thead th) {
  position: sticky;
  z-index: 100;
  background-color: white;

  
} */

/* .score-table :deep(thead .sticky-name) {
  left: 0;
  z-index: 20;
  min-width: 170px;
  background: white;
} */
</style>
