<script setup>
/**
 * Khmer score sheet — no subject dropdown.
 * loadScores()     → POST score-list (class + month)
 * saveScores()     → POST score-store (flatten cells, then reload)
 * columns          → child subjects, or parent if no children
 * cell()           → students[].by_subject[subjectId]
 * onScoreInput()   → parse score (allow over max)
 * isOverMax()      → red border when score > max_score
 * applyClassFromRoute() → fill Grade/Class from Teacher Action URL
 */
import { ref, computed, watch, onMounted, nextTick } from "vue";
import { useRoute } from "vue-router";
import { useI18n } from "vue-i18n";
import { useDisplay } from "vuetify";
import { debounce } from "lodash";
import { api } from "@/utils/api";
import { getGrades, getClasses, getMonths } from "@/services/dataService";
import { useSettingStore } from "@/stores/settingStore.js";
import formatGender from "@/utils/formater/formatGender";

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
const grades = ref([]);
const allClasses = ref([]);
const months = ref([]);
const subjects = ref([]);
const students = ref([]);
const divisor = ref(null);

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

/** Parse typed score. Over max is allowed — cell turns red. */
function onScoreInput(row, col, value) {
  const item = cell(row, col);
  if (value === "" || value == null) {
    item.score = null;
    return;
  }
  const n = Number(value);
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
      skipDivisorSave.value = true;
      divisor.value = null;
      await nextTick();
      skipDivisorSave.value = false;
      return;
    }
    subjects.value = res.data.data.subjects || [];
    students.value = res.data.data.students || [];
    skipDivisorSave.value = true;
    divisor.value =
      res.data.data.divisor != null ? Number(res.data.data.divisor) : null;
    await nextTick();
    skipDivisorSave.value = false;
  } catch (e) {
    console.error("loadScores:", e);
    subjects.value = [];
    students.value = [];
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
  if (!canLoad.value || !students.value.length) return;

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
    }
  } catch (e) {
    console.error("saveScores:", e);
  } finally {
    isSaving.value = false;
  }
}

/** Save Khmer monthly avg divisor for selected class + month. */
const saveDivisor = debounce(async () => {
  if (!canLoad.value || skipDivisorSave.value) return;

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
  () => loadScores(),
);

watch(routeClassId, (id) => applyClassFromRoute(id));

onMounted(async () => {
  try {
    grades.value = (await getGrades()) || [];
    allClasses.value = (await getClasses()) || [];
    months.value = (await getMonths()) || [];
    await applyClassFromRoute(routeClassId.value);
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
            <VBtn @click="loadScores" color="primary" variant="tonal">
              <VIcon icon="tabler-search" />
              {{ t("Search") }}
            </VBtn>
          </VCol>
        </VRow>
      </template>

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
                :color="isOverMax(row, col) ? 'error' : 'primary'"
                :min="0"
                @update:model-value="onScoreInput(row, col, $event)"
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
            :disabled="isSavingDivisor"
          />
        </VCol>
        <VCol cols="4" sm="2" md="2" v-if="formSearch.month_id">
          <VBtn
            @click="saveScores"
            color="primary"
            block
            variant="tonal"
            :loading="isSaving"
            :disabled="!students.length || isSaving"
          >
            <VIcon icon="tabler-device-floppy" />
            {{ t("Submit") }}
          </VBtn>
        </VCol>
      </VRow>
    </AppCard>
  </div>
</template>

<style scoped>
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
