<script setup>
/**
 * English score sheet — select TERM (not month) + subject.
 *
 * loadSheet()  → POST score-english-list
 * saveScores() → POST score-english-store
 *
 * Table layout (like quarter report):
 *   sections from grading_rules (Attendance / Homework / Work / Exam…)
 *   input columns = assessments (H1…H10) or one cell per rule
 *   Total + % are calculated in the UI (not saved)
 */
import { ref, computed, watch, onMounted, nextTick } from "vue";
import { useRoute } from "vue-router";
import { useI18n } from "vue-i18n";
import { useDisplay } from "vuetify";
import { api } from "@/utils/api";
import { getGrades, getClasses, getTerms } from "@/services/dataService";
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
const grades = ref([]);
const allClasses = ref([]);
const terms = ref([]);
const subjectOptions = ref([]);
const sections = ref([]);
const students = ref([]);

const formSearch = ref({
  grade_id: null,
  class_id: null,
  term_id: null,
  subject_id: null,
});

let applyingFromRoute = false;

const routeClassId = computed(() => props.classId ?? route.params.id);
const hasClassFromRoute = computed(() => {
  if (props.lockClass) return true;
  const id = Number(routeClassId.value);
  return Number.isFinite(id) && id > 0;
});

const filteredClasses = computed(() => {
  if (!formSearch.value.grade_id) return allClasses.value;
  return allClasses.value.filter((c) => c.grade_id == formSearch.value.grade_id);
});

const classTitle = computed(() =>
  locale.value === "km" ? "name_kh" : "name_en",
);

const selectedClass = computed(() =>
  allClasses.value.find((c) => c.id == formSearch.value.class_id),
);

const selectedTerm = computed(() =>
  terms.value.find((t) => t.id == formSearch.value.term_id),
);

const className = computed(() => {
  const cls = selectedClass.value;
  if (!cls) return "";
  return locale.value === "km"
    ? cls.name_kh || cls.name_en || ""
    : cls.name_en || cls.name_kh || "";
});

const termName = computed(() => {
  const term = selectedTerm.value;
  if (!term) return "";
  return locale.value === "km"
    ? term.name_kh || term.name_en || ""
    : term.name_en || term.name_kh || "";
});

const pageTitle = computed(() => {
  const base = t("Score Entry");
  const parts = [base, className.value, termName.value].filter(Boolean);
  return parts.join(" — ");
});

const canLoadOptions = computed(
  () => formSearch.value.class_id && formSearch.value.term_id,
);

const canLoadSheet = computed(
  () => canLoadOptions.value && formSearch.value.subject_id,
);

/** Top header groups: PERFORMANCE wraps H+W+P style sections. */
const topGroups = computed(() => {
  const list = sections.value;
  if (!list.length) return [];

  const isPerf = (s) => ["H", "W", "P", "PART"].includes(String(s.symbol || "").toUpperCase());
  const groups = [];
  let i = 0;

  while (i < list.length) {
    const s = list[i];
    const sym = String(s.symbol || "").toUpperCase();

    if (["ATT", "A"].includes(sym)) {
      groups.push({
        key: "att-" + s.grading_rule_id,
        label: sectionLabel(s) || t("Attendance"),
        colspan: sectionColspan(s),
      });
      i += 1;
      continue;
    }

    if (isPerf(s)) {
      let colspan = 0;
      const start = i;
      while (i < list.length && isPerf(list[i])) {
        colspan += sectionColspan(list[i]);
        i += 1;
      }
      groups.push({
        key: "perf-" + start,
        label: t("Performance"),
        colspan,
      });
      continue;
    }

    if (["E", "EXAM"].includes(sym)) {
      groups.push({
        key: "exam-" + s.grading_rule_id,
        label: sectionLabel(s) || t("Exam"),
        colspan: sectionColspan(s),
      });
      i += 1;
      continue;
    }

    groups.push({
      key: "sec-" + s.grading_rule_id,
      label: sectionLabel(s),
      colspan: sectionColspan(s),
    });
    i += 1;
  }

  // Average grade column
  groups.push({ key: "avg", label: t("Average Grade"), colspan: 1 });
  return groups;
});

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

function termLabel(item) {
  if (!item) return "";
  return locale.value === "km"
    ? item.name_kh || item.name_en || ""
    : item.name_en || item.name_kh || "";
}

function sectionLabel(section) {
  if (!section) return "";
  return locale.value === "km"
    ? section.name_kh || section.name_en || section.symbol || ""
    : section.name_en || section.name_kh || section.symbol || "";
}

function studentName(row) {
  return locale.value === "km"
    ? row.name_kh || row.name_en
    : row.name_en || row.name_kh;
}

function sectionColspan(section) {
  let n = (section.columns || []).length;
  if (section.show_total) n += 1;
  if (section.show_percent) n += 1;
  return Math.max(n, 1);
}

/** One editable cell from student.by_cell */
function cell(row, col) {
  if (!row.by_cell) row.by_cell = {};
  const key = col.cell_key;
  let item = row.by_cell[key];
  if (!item) {
    item = {
      score_id: null,
      score: null,
      is_approved: false,
      max_score: col.max_score,
      grading_rule_id: col.grading_rule_id,
      assessment_id: col.assessment_id,
    };
    row.by_cell[key] = item;
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

function isOverMax(row, col) {
  const item = cell(row, col);
  const max = Number(item.max_score ?? col.max_score);
  if (item.score == null || item.score === "" || !Number.isFinite(max)) {
    return false;
  }
  return Number(item.score) > max;
}

/** Sum of input scores in a section */
function sectionTotal(row, section) {
  let sum = 0;
  let has = false;
  for (const col of section.columns || []) {
    const v = cell(row, col).score;
    if (v != null && v !== "" && Number.isFinite(Number(v))) {
      sum += Number(v);
      has = true;
    }
  }
  return has ? Math.round(sum * 100) / 100 : null;
}

/** Weighted % for a section: (total / max) * percentage */
function sectionPercent(row, section) {
  const total = sectionTotal(row, section);
  if (total == null) return null;
  const max =
    Number(section.max_score) ||
    (section.columns || []).reduce((s, c) => s + (Number(c.max_score) || 0), 0);
  const weight = Number(section.percentage);
  if (!max || !Number.isFinite(weight)) return null;
  return Math.round((total / max) * weight * 100) / 100;
}

/** Final average = sum of section % */
function averageGrade(row) {
  let sum = 0;
  let has = false;
  for (const section of sections.value) {
    const p = sectionPercent(row, section);
    if (p != null) {
      sum += p;
      has = true;
    }
  }
  return has ? Math.round(sum * 100) / 100 : null;
}

/** Editable input columns only (exclude Total / %). */
const inputColumns = computed(() =>
  sections.value.flatMap((s) => s.columns || []),
);

/** Like attendance: saved cell = score_id present after store/reload. */
function cellIsSaved(row, col) {
  return cell(row, col).score_id != null;
}

const submitStatus = computed(() => {
  const cols = inputColumns.value;
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
  const cols = inputColumns.value;
  if (!cols.length) return [];
  return students.value.filter((row) =>
    cols.some((col) => !cellIsSaved(row, col)),
  );
});

const notSubmittedNamesText = computed(() =>
  studentsNotYetSubmitted.value.map((r) => studentName(r)).join(", "),
);

function formatNum(v) {
  if (v == null || v === "") return "";
  return Number.isFinite(Number(v)) ? Number(v) : "";
}

/** Load subject options and/or full sheet */
async function loadSheet() {
  if (!canLoadOptions.value) {
    subjectOptions.value = [];
    sections.value = [];
    students.value = [];
    return;
  }

  isLoading.value = true;
  try {
    const payload = {
      class_id: formSearch.value.class_id,
      term_id: formSearch.value.term_id,
    };
    if (formSearch.value.subject_id) {
      payload.subject_id = formSearch.value.subject_id;
    }

    const res = await api.post("score-english-list", payload);
    if (!res.data?.status) {
      subjectOptions.value = [];
      sections.value = [];
      students.value = [];
      return;
    }

    const data = res.data.data;
    subjectOptions.value = data.subject_options || [];
    sections.value = data.sections || [];
    students.value = data.students || [];
  } catch (e) {
    console.error("loadSheet:", e);
    subjectOptions.value = [];
    sections.value = [];
    students.value = [];
  } finally {
    isLoading.value = false;
  }
}

/** Flatten all input cells and save */
async function saveScores() {
  if (!canLoadSheet.value || !students.value.length) return;

  const rows = [];
  for (const student of students.value) {
    for (const section of sections.value) {
      for (const col of section.columns || []) {
        const item = cell(student, col);
        rows.push({
          student_id: student.student_id,
          grading_rule_id: col.grading_rule_id,
          assessment_id: col.assessment_id,
          score_id: item.score_id,
          score: item.score,
          is_approved: item.is_approved ?? false,
        });
      }
    }
  }

  isSaving.value = true;
  try {
    const res = await api.post("score-english-store", {
      class_id: formSearch.value.class_id,
      term_id: formSearch.value.term_id,
      subject_id: formSearch.value.subject_id,
      rows,
    });
    if (res.data?.status) {
      await loadSheet();
    } else {
      console.error(res.data?.message || "Save failed");
    }
  } catch (e) {
    console.error("saveScores:", e);
  } finally {
    isSaving.value = false;
  }
}

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
    terms.value = (await getTerms()) || [];
    formSearch.value.subject_id = null;
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
    formSearch.value.subject_id = null;
    subjectOptions.value = [];
    sections.value = [];
    students.value = [];
  },
);

watch(
  () => formSearch.value.class_id,
  () => {
    if (applyingFromRoute) return;
    formSearch.value.subject_id = null;
  },
);

watch(
  () => [formSearch.value.class_id, formSearch.value.term_id],
  () => {
    formSearch.value.subject_id = null;
    loadSheet();
  },
);

watch(
  () => formSearch.value.subject_id,
  () => {
    if (formSearch.value.subject_id) loadSheet();
    else {
      sections.value = [];
      students.value = [];
    }
  },
);

watch(routeClassId, (id) => applyClassFromRoute(id));

onMounted(async () => {
  try {
    grades.value = (await getGrades()) || [];
    allClasses.value = (await getClasses()) || [];
    terms.value = (await getTerms()) || [];
    await applyClassFromRoute(routeClassId.value);
    if (canLoadOptions.value) await loadSheet();
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
      :show-filters="!smAndDown"
      :loading="isLoading"
    >
      <template #filter>
        <VRow class="align-end">
          <VCol v-if="!hasClassFromRoute" cols="6" sm="3" md="2">
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
          <VCol v-if="!hasClassFromRoute" cols="6" sm="3" md="2">
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
            cols="6"
            :sm="hasClassFromRoute ? 4 : 3"
            :md="hasClassFromRoute ? 3 : 2"
          >
            <AppAutocomplete
              v-model="formSearch.term_id"
              :items="terms"
              :item-title="termLabel"
              item-value="id"
              :placeholder="t('Term')"
              clearable
              hide-details
            />
          </VCol>
          <VCol
            cols="6"
            :sm="hasClassFromRoute ? 4 : 3"
            :md="hasClassFromRoute ? 3 : 2"
          >
            <AppAutocomplete
              v-model="formSearch.subject_id"
              :items="subjectOptions"
              :item-title="subjectLabel"
              item-value="id"
              :placeholder="t('Subject')"
              clearable
              hide-details
              :disabled="!canLoadOptions || !subjectOptions.length"
            />
          </VCol>
          <VCol cols="6" sm="3" md="2">
            <VBtn
              color="primary"
              variant="tonal"
              block
              :loading="isSaving"
              :disabled="!students.length || isSaving"
              @click="saveScores"
            >
              <VIcon icon="tabler-device-floppy" start />
              {{ t("Submit") }}
            </VBtn>
          </VCol>
        </VRow>
      </template>

      <VAlert
        v-if="canLoadOptions && !formSearch.subject_id"
        type="info"
        variant="tonal"
        class="mb-3"
      >
        {{ t("Subject") }}
      </VAlert>

      <VAlert
        v-else-if="canLoadSheet && !isLoading && !students.length"
        type="info"
        variant="tonal"
        class="mb-3"
      >
        {{ t("No students") }}
      </VAlert>

      <VAlert
        v-else-if="canLoadSheet && !isLoading && students.length && !sections.length"
        type="warning"
        variant="tonal"
        class="mb-3"
      >
        {{ t("No rule yet") }}
      </VAlert>

      <VAlert
        v-else-if="
          submitStatus === 'not_submitted' &&
          students.length &&
          inputColumns.length
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

      <div v-if="students.length && sections.length" class="score-wrap">
        <VTable fixed-header density="compact" class="border rounded score-table">
          <thead>
            <!-- Row 1: top groups (Attendance / Performance / Exam / Average) -->
            <tr>
              <th rowspan="4" class="sticky-col sticky-name">{{ t("No.") }}</th>
              <th rowspan="4" class="sticky-col sticky-name2">{{ t("Name") }}</th>
              <th rowspan="4">{{ t("Gender") }}</th>
              <th
                v-for="g in topGroups.filter((x) => x.key !== 'avg')"
                :key="g.key"
                class="text-center text-uppercase header-group"
                :colspan="g.colspan"
              >
                {{ g.label }}
              </th>
              <th rowspan="2" class="text-center text-uppercase header-group">
                {{ t("Average Grade") }}
              </th>
            </tr>

            <!-- Row 2: activity / section names -->
            <tr>
              <template v-for="section in sections" :key="'s2-' + section.grading_rule_id">
                <th
                  class="text-center text-uppercase"
                  :colspan="sectionColspan(section)"
                >
                  {{ sectionLabel(section) }}
                  <span v-if="section.percentage != null" class="text-medium-emphasis">
                    ({{ section.percentage }}%)
                  </span>
                </th>
              </template>
            </tr>

            <!-- Row 3: column labels (H1, Total, %, …) -->
            <tr>
              <template v-for="section in sections" :key="'s3-' + section.grading_rule_id">
                <th
                  v-for="col in section.columns"
                  :key="col.cell_key"
                  class="text-center col-label"
                >
                  {{ col.label }}
                </th>
                <th v-if="section.show_total" class="text-center col-label">
                  {{ t("Total") }}
                </th>
                <th v-if="section.show_percent" class="text-center col-label">%</th>
              </template>
              <th class="text-center col-label">%</th>
            </tr>

            <!-- Row 4: highest possible score -->
            <tr>
              <template v-for="section in sections" :key="'s4-' + section.grading_rule_id">
                <th
                  v-for="col in section.columns"
                  :key="'m-' + col.cell_key"
                  class="text-center text-medium-emphasis max-row"
                >
                  {{ col.max_score }}
                </th>
                <th v-if="section.show_total" class="text-center text-medium-emphasis max-row">
                  {{
                    section.max_score ||
                    section.columns.reduce((s, c) => s + (Number(c.max_score) || 0), 0)
                  }}
                </th>
                <th v-if="section.show_percent" class="text-center text-medium-emphasis max-row">
                  {{ section.percentage }}
                </th>
              </template>
              <th class="text-center text-medium-emphasis max-row">100</th>
            </tr>
          </thead>

          <tbody>
            <tr v-for="(row, index) in students" :key="row.student_id">
              <td class="sticky-col sticky-name text-center">{{ index + 1 }}</td>
              <td class="sticky-col sticky-name2 font-weight-medium">
                {{ studentName(row) }}
              </td>
              <td>{{ formatGender(row.gender) }}</td>

              <template v-for="section in sections" :key="'b-' + section.grading_rule_id + '-' + row.student_id">
                <td
                  v-for="col in section.columns"
                  :key="col.cell_key"
                  class="score-td"
                >
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
                    @update:model-value="onScoreInput(row, col, $event)"
                    @keydown="onScoreKeydown"
                  />
                </td>
                <td v-if="section.show_total" class="text-center computed-cell">
                  {{ formatNum(sectionTotal(row, section)) }}
                </td>
                <td v-if="section.show_percent" class="text-center computed-cell">
                  {{ formatNum(sectionPercent(row, section)) }}
                </td>
              </template>

              <td class="text-center computed-cell font-weight-bold">
                {{ formatNum(averageGrade(row)) }}
              </td>
            </tr>
          </tbody>
        </VTable>
      </div>
    </AppCard>
  </div>
</template>

<style scoped>
.score-wrap {
  overflow-x: auto;
}
.score-table {
  min-width: 100%;
}
.score-table :deep(table) {
  border-collapse: collapse;
}
.score-table :deep(th),
.score-table :deep(td) {
  border: 1px solid rgba(var(--v-theme-on-surface), 0.22);
  white-space: nowrap;
}
.header-group {
  background: rgba(var(--v-theme-primary), 0.08);
  font-weight: 700;
}
.col-label {
  font-size: 0.75rem;
}
.max-row {
  font-size: 0.7rem;
}
.sticky-col {
  position: sticky;
  z-index: 2;
  background: rgb(var(--v-theme-surface));
}
.sticky-name {
  left: 0;
  min-width: 48px;
}
.sticky-name2 {
  left: 48px;
  min-width: 160px;
}
.score-td {
  padding: 4px !important;
  min-width: 72px;
  text-align: center;
  vertical-align: middle;
}
.score-input {
  width: 68px;
  margin-inline: auto;
}
.score-input :deep(input) {
  text-align: center;
}
.score-input--over :deep(.v-field__outline) {
  color: rgb(var(--v-theme-error)) !important;
}
.computed-cell {
  background: rgba(var(--v-theme-on-surface), 0.03);
  min-width: 56px;
}
</style>
