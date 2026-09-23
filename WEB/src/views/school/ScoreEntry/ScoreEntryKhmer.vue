<script setup>
/**
 * Khmer score sheet — no subject dropdown.
 * loadScores()     → POST score-list (class + month)
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
const grades = ref([]);
const allClasses = ref([]);
const months = ref([]);
const subjects = ref([]);
const students = ref([]);

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
      return;
    }
    subjects.value = res.data.data.subjects || [];
    students.value = res.data.data.students || [];
  } catch (e) {
    console.error("loadScores:", e);
    subjects.value = [];
    students.value = [];
  } finally {
    isLoading.value = false;
  }
}

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
      :show-filters="!smAndDown"
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

      <VTable
        v-if="students.length"
        fixed-header
        
  height="calc(100dvh - 280px)"
        density="compact"
        class="border rounded score-table"
      >
        <thead>
          <tr>
            <th style="width: 300px;min-width: 170px;" rowspan="3" class="sticky-header">{{ t("Name") }}</th>
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

      <VRow class="mt-1">
        <VCol cols="4" sm="2" md="2">
          <VBtn @click="loadScores" color="primary" block variant="tonal">
            <VIcon icon="tabler-download" />
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
