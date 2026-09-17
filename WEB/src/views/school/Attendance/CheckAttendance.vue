<script setup>
import { ref, computed, watch, onMounted, nextTick } from "vue";
import { useRoute } from "vue-router";
import { useI18n } from "vue-i18n";
import { useDisplay } from "vuetify";
import axios from "axios";
import { api } from "@/utils/api";
import { getGrades, getClasses } from "@/services/dataService";
import { useSettingStore } from "@/stores/settingStore.js";
import formatGender from "@/utils/formater/formatGender";

const CONFIG = {
  apiLoad: "attendance-list",
  apiSave: "attendance-store",
  requireGradeBeforeClass: true,
  defaultPresent: true,
  colors: {
    present: "#4caf50",
    absent: "#ef5350",
    late: "#ffeb3b",
    permission: "#ff9800",
    approve: "#2196f3",
    empty: "#f5f5f5",
  },
};

const reasons = computed(() => [
  { title: t("Trip"), value: "Trip" },
  { title: t("Busy"), value: "Busy" },
  { title: t("Sick"), value: "Sick" },
]);

const route = useRoute();
const settingStore = useSettingStore();
const { t, locale } = useI18n();
const { smAndDown } = useDisplay();

const isLoading = ref(false);
const isSaving = ref(false);

const grades = ref([]);
const allClasses = ref([]);
const subjectsForDay = ref([]);
const subjects = computed(() => subjectsForDay.value);
const allPeriods = ref([]);

const formSearch = ref({
  grade_id: null,
  class_id: null,
  date: new Date(),
  day_id: null,
  subject_id: null,
});

const activeTabSubjectId = ref(null);
const sheetStudents = ref([]);
const editableRows = ref([]);
const rowCache = ref({});

let applyingFromRoute = false;
let syncingFromApi = false;

/** Unsaved changes: snapshot after load / tab switch */
const rowSnapshot = ref(null);

function rowsForCompare(rows) {
  return rows.map((r) => ({
    student_id: r.student_id,
    is_present: r.is_present,
    is_late: r.is_late,
    is_permission: r.is_permission,
    is_approved: r.is_approved,
    reason: r.reason ?? null,
  }));
}

function takeSnapshot() {
  rowSnapshot.value = JSON.stringify(rowsForCompare(editableRows.value));
}

const isDirty = computed(() => {
  if (!rowSnapshot.value || !editableRows.value.length) return false;
  return (
    JSON.stringify(rowsForCompare(editableRows.value)) !== rowSnapshot.value
  );
});

function isoWeekday(date) {
  if (!date) return null;
  const d = new Date(date);
  const w = d.getDay();
  return w === 0 ? 7 : w;
}

function formatDateApi(date) {
  if (!date) return null;
  const d = new Date(date);
  const y = d.getFullYear();
  const m = String(d.getMonth() + 1).padStart(2, "0");
  const day = String(d.getDate()).padStart(2, "0");
  return `${y}-${m}-${day}`;
}

function subjectLabel(item) {
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

function studentInitial(row) {
  const name = studentName(row) || "";
  return name.trim().charAt(0).toUpperCase() || "?";
}

function defaultRowCell() {
  return {
    attendance_id: null,
    is_present: CONFIG.defaultPresent,
    is_late: false,
    is_permission: false,
    is_approved: false,
    reason: null,
  };
}

function togglePresent(row) {
  if (row.is_permission) return;
  row.is_present = !row.is_present;
  if (!row.is_present) row.is_late = false;
}

function toggleLate(row) {
  if (row.is_permission) return;
  row.is_late = !row.is_late;
  if (row.is_late) row.is_present = true;
}

function togglePermission(row) {
  row.is_permission = !row.is_permission;
  if (row.is_permission) {
    row.is_present = false;
    row.is_late = false;
  } else {
    row.is_present = CONFIG.defaultPresent;
    row.is_late = false;
  }
}

function toggleApprove(row) {
  row.is_approved = !row.is_approved;
}

function approveAllRows() {
  editableRows.value.forEach((r) => {
    r.is_approved = true;
  });
}

function presentCellStyle(row) {
  if (row.is_permission) return { background: CONFIG.colors.empty };
  if (row.is_present) return { background: CONFIG.colors.present };
  return { background: CONFIG.colors.absent };
}

function lateCellStyle(row) {
  if (row.is_permission || !row.is_present) {
    return { background: CONFIG.colors.empty };
  }
  if (row.is_late) return { background: CONFIG.colors.late };
  return { background: CONFIG.colors.empty };
}

function permissionCellStyle(row) {
  if (row.is_permission) return { background: CONFIG.colors.permission };
  return { background: CONFIG.colors.empty };
}

function approveCellStyle(row) {
  if (row.is_approved) return { background: CONFIG.colors.approve };
  return { background: CONFIG.colors.empty };
}

function canClickPresent(row) {
  return !row.is_permission;
}
function canClickLate(row) {
  return !row.is_permission && row.is_present;
}

const filteredClasses = computed(() => {
  if (!formSearch.value.grade_id) return allClasses.value;
  return allClasses.value.filter(
    (c) => c.grade_id == formSearch.value.grade_id,
  );
});

const classTitle = computed(() =>
  locale.value === "km" ? "name_kh" : "name_en",
);

const gradeTitle = (item) => {
  if (item?.grade_level != null) {
    return locale.value === "km"
      ? `កម្រិត ${item.grade_level}`
      : `Level ${item.grade_level}`;
  }
  return subjectLabel(item);
};

const periods = computed(() => {
  const sid = formSearch.value.subject_id;
  if (!sid) return allPeriods.value;
  return allPeriods.value.filter((p) => Number(p.subject_id) === Number(sid));
});

const activeSubjectId = computed(() => {
  if (formSearch.value.subject_id) {
    return Number(formSearch.value.subject_id);
  }
  return activeTabSubjectId.value != null
    ? Number(activeTabSubjectId.value)
    : null;
});

const showSubjectTabs = computed(() => allPeriods.value.length > 1);

const canLoad = computed(
  () =>
    formSearch.value.class_id &&
    formSearch.value.date &&
    formSearch.value.day_id,
);

const hasSchedule = computed(() => allPeriods.value.length > 0);

const emptyMessage = computed(() => {
  if (!formSearch.value.grade_id && CONFIG.requireGradeBeforeClass)
    return t("Grade");
  if (!formSearch.value.class_id) return t("Class");
  if (!formSearch.value.date) return t("Select date");
  if (!hasSchedule.value) return t("No schedule for this day");
  if (!editableRows.value.length) return t("No students");
  return "";
});

const submitStatus = computed(() => {
  const rows = editableRows.value;
  if (!rows.length || !activeSubjectId.value) return "empty";
  const saved = rows.filter((r) => r.attendance_id != null).length;
  if (saved === 0) return "not_submitted";
  if (saved === rows.length) return "submitted";
  return "partial";
});

const studentsNotYetSubmitted = computed(() =>
  editableRows.value.filter((r) => r.attendance_id == null),
);

const notSubmittedNamesText = computed(() =>
  studentsNotYetSubmitted.value.map((r) => studentName(r)).join(", "),
);

function getCellFromSheet(student, subjectId) {
  const sid = Number(subjectId);
  const by = student.by_subject || {};
  return by[sid] ?? by[String(sid)] ?? defaultRowCell();
}

function buildRowsForSubject(subjectId) {
  const sid = Number(subjectId);
  if (!sid) return [];
  return sheetStudents.value.map((s) => ({
    student_id: s.student_id,
    sort: s.sort,
    name_en: s.name_en,
    name_kh: s.name_kh,
    gender: s.gender,
    photo_path: s.photo_path,
    subject_id: sid,
    ...getCellFromSheet(s, sid),
  }));
}

function persistActiveTabToCache() {
  const sid = activeSubjectId.value;
  if (!sid) return;
  rowCache.value[sid] = editableRows.value.map((r) => ({ ...r }));
}

function applyEditableRowsForSubject(subjectId) {
  const sid = Number(subjectId);
  if (!sid) {
    editableRows.value = [];
    rowSnapshot.value = null;
    return;
  }
  if (rowCache.value[sid]?.length) {
    editableRows.value = rowCache.value[sid].map((r) => ({ ...r }));
  } else {
    editableRows.value = buildRowsForSubject(sid);
  }
  nextTick(() => takeSnapshot());
}

function pickDefaultActiveSubject() {
  if (formSearch.value.subject_id) {
    activeTabSubjectId.value = Number(formSearch.value.subject_id);
    return;
  }
  const list = periods.value.length ? periods.value : allPeriods.value;
  activeTabSubjectId.value = list.length ? Number(list[0].subject_id) : null;
}

async function loadAttendance() {
  const { class_id, date } = formSearch.value;
  if (!class_id || !date) {
    sheetStudents.value = [];
    allPeriods.value = [];
    subjectsForDay.value = [];
    editableRows.value = [];
    rowCache.value = {};
    rowSnapshot.value = null;
    return;
  }

  formSearch.value.day_id = isoWeekday(date);
  isLoading.value = true;

  try {
    const res = await api.post(CONFIG.apiLoad, {
      class_id,
      date: formatDateApi(date),
      day_id: formSearch.value.day_id,
      subject_id: null,
    });

    if (!res.data?.status) {
      sheetStudents.value = [];
      allPeriods.value = [];
      editableRows.value = [];
      rowSnapshot.value = null;
      return;
    }

    const data = res.data.data;
    syncingFromApi = true;

    allPeriods.value = data.periods ?? [];
    subjectsForDay.value = data.subjects ?? [];
    sheetStudents.value = data.students ?? [];
    rowCache.value = {};

    pickDefaultActiveSubject();
    applyEditableRowsForSubject(activeSubjectId.value);

    await nextTick();
    syncingFromApi = false;
  } catch (err) {
    if (axios.isCancel(err) || err?.code === "ERR_CANCELED") return;
    console.error("loadAttendance:", err);
    sheetStudents.value = [];
    editableRows.value = [];
    rowSnapshot.value = null;
  } finally {
    isLoading.value = false;
  }
}

async function saveAttendance() {
  if (!canLoad.value || !activeSubjectId.value) return;
  persistActiveTabToCache();

  const payload = {
    class_id: formSearch.value.class_id,
    date: formatDateApi(formSearch.value.date),
    subject_id: formSearch.value.subject_id,
    day_id: formSearch.value.day_id,
    rows: editableRows.value.map((r) => ({
      student_id: r.student_id,
      attendance_id: r.attendance_id,
      is_present: r.is_present,
      is_late: r.is_late,
      is_permission: r.is_permission,
      is_approved: r.is_approved,
      reason: r.reason,
    })),
  };

  isSaving.value = true;
  try {
    const res = await api.post(CONFIG.apiSave, payload);
    if (res.data?.status) {
      rowCache.value[activeSubjectId.value] = null;
      await loadAttendance();
    } else {
      console.error(res.data?.message || "Save failed");
    }
  } catch (err) {
    console.error("saveAttendance:", err);
  } finally {
    isSaving.value = false;
  }
}

async function saveAndApproveAll() {
  approveAllRows();
  await saveAttendance();
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
  () => formSearch.value.date,
  (d) => {
    if (d) formSearch.value.day_id = isoWeekday(d);
  },
);

watch(
  () => [formSearch.value.class_id, formSearch.value.date],
  () => {
    if (!formSearch.value.class_id || !formSearch.value.date) return;
    subjectsForDay.value = [];
    loadAttendance();
  },
);

watch(
  () => formSearch.value.subject_id,
  (newSub) => {
    if (newSub) {
      loadAttendance();
    }
  },
);

watch(
  () => formSearch.value.subject_id,
  (sid) => {
    if (sid != null) {
      persistActiveTabToCache();
      activeTabSubjectId.value = Number(sid);
    } else {
      pickDefaultActiveSubject();
    }
    applyEditableRowsForSubject(activeSubjectId.value);
  },
);

watch(activeTabSubjectId, (newId, oldId) => {
  if (syncingFromApi || formSearch.value.subject_id) return;
  if (oldId != null && Number(oldId) !== Number(newId)) {
    persistActiveTabToCache();
  }
  if (newId != null) {
    applyEditableRowsForSubject(Number(newId));
  }
});

watch(
  () => settingStore.curriculum_id,
  async (id) => {
    if (!id) return;
    formSearch.value.grade_id = null;
    formSearch.value.class_id = null;
    formSearch.value.subject_id = null;
    subjectsForDay.value = [];
    grades.value = (await getGrades()) || [];
    allClasses.value = (await getClasses()) || [];
  },
);

watch(
  () => formSearch.value.grade_id,
  () => {
    if (applyingFromRoute) return;
    formSearch.value.class_id = null;
    formSearch.value.subject_id = null;
    subjectsForDay.value = [];
  },
);

watch(
  () => route.params.id,
  (id) => applyClassFromRoute(id),
);

onMounted(async () => {
  try {
    grades.value = (await getGrades()) || [];
    allClasses.value = (await getClasses()) || [];
    if (formSearch.value.date) {
      formSearch.value.day_id = isoWeekday(formSearch.value.date);
    }
    await applyClassFromRoute(route.params.id);
    if (formSearch.value.class_id && formSearch.value.date) {
      await loadAttendance();
    }
  } catch (e) {
    console.error(e);
  }
});
</script>

<template>
  <div>
    <AppCard
      :title="t('Attendance')"
      title-icon="tabler-file-check"
      :is-back="false"
      :is-filter="true"
      :show-filters="!smAndDown"
      :loading="isLoading"
    >
      <template #filter>
        <VRow class="align-end">
          <VCol cols="6" sm="3" md="3">
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
          <VCol cols="6" sm="3" md="3">
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
          <VCol cols="6" sm="3" md="3">
            <AppDateTimePicker
              v-model="formSearch.date"
              :placeholder="t('Select date')"
            />
          </VCol>
          <VCol cols="6" sm="3" md="3">
            <AppAutocomplete
              v-model="formSearch.subject_id"
              :items="subjects"
              :item-title="subjectLabel"
              item-value="id"
              :placeholder="t('Subject')"
              clearable
              hide-details
              :disabled="!formSearch.class_id || !subjects.length"
            />
          </VCol>
        </VRow>
      </template>

      <!-- Priority: unsaved changes first -->
      <VAlert
        v-if="isDirty && editableRows.length"
        type="warning"
        variant="outlined"
        density="compact"
        class="mb-3"
      >
        {{ t("You have unsaved changes. Please save again.") }}
      </VAlert>
      <VAlert
        v-else-if="
          submitStatus === 'not_submitted' && hasSchedule && editableRows.length
        "
        type="warning"
        variant="outlined"
        density="compact"
        class="mb-3"
      >
        {{ t("Attendance not yet submitted") }}
      </VAlert>
      <VAlert
        v-else-if="submitStatus === 'submitted'"
        type="success"
        variant="outlined"
        density="compact"
        class="mb-3"
      >
        {{ t("Attendance already submitted") }}
      </VAlert>
      <VAlert
        v-else-if="submitStatus === 'partial'"
        type="warning"
        variant="outlined"
        density="compact"
        class="mb-3"
      >
        <div class="font-weight-medium mb-1">
          {{ t("Attendance not yet submitted for") }}:
        </div>
        <div>{{ notSubmittedNamesText }}</div>
      </VAlert>

      <VAlert
        v-if="emptyMessage && formSearch.class_id"
        type="info"
        variant="tonal"
        class="mb-3"
      >
        {{ emptyMessage }}
      </VAlert>

      <template v-if="editableRows.length">
        <VTable
          v-if="!smAndDown"
          fixed-header
          density="comfortable"
          class="border rounded attendance-table"
        >
          <thead>
            <tr>
              <th class="sticky-header" style="width: 220px">
                {{ t("Name") }}
              </th>
              <th style="width: 72px">{{ t("Gender") }}</th>
              <th class="text-center att-col">{{ t("Present") }}</th>
              <th class="text-center att-col">{{ t("Late") }}</th>
              <th class="text-center att-col">{{ t("Ask Permission") }}</th>
              <th style="min-width: 200px">{{ t("Reason") }}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="row in editableRows" :key="row.student_id">
              <td class="sticky-col font-weight-medium">
                {{ studentName(row) }}
              </td>
              <td>{{ formatGender(row.gender) }}</td>
              <td class="att-pad">
                <button
                  type="button"
                  class="att-cell"
                  :class="{ 'att-disabled': !canClickPresent(row) }"
                  :style="presentCellStyle(row)"
                  :disabled="!canClickPresent(row)"
                  @click="togglePresent(row)"
                />
              </td>
              <td class="att-pad">
                <button
                  type="button"
                  class="att-cell"
                  :class="{ 'att-disabled': !canClickLate(row) }"
                  :style="lateCellStyle(row)"
                  :disabled="!canClickLate(row)"
                  @click="toggleLate(row)"
                />
              </td>
              <td class="att-pad">
                <button
                  type="button"
                  class="att-cell"
                  :style="permissionCellStyle(row)"
                  @click="togglePermission(row)"
                />
              </td>
              <td>
                <AppCombobox
                  v-model="row.reason"
                  :items="reasons"
                  item-title="title"
                  item-value="value"
                  placeholder="—"
                  density="compact"
                  hide-details
                  :disabled="!row.is_permission && row.is_present"
                />
              </td>
            </tr>
          </tbody>
        </VTable>

        <div v-else class="mobile-attendance">
          <VCard
            v-for="row in editableRows"
            :key="row.student_id"
            variant="outlined"
            class="mobile-row mb-2"
          >
            <div class="mobile-row-top">
              <div class="mobile-avatar" :style="presentCellStyle(row)">
                {{ studentInitial(row) }}
              </div>
              <div class="mobile-name-block">
                <div class="mobile-name">{{ studentName(row) }}</div>
                <div class="mobile-gender">{{ formatGender(row.gender) }}</div>
              </div>
            </div>
            <div class="mobile-actions">
              <button
                type="button"
                class="att-chip"
                :class="{ 'att-disabled': !canClickPresent(row) }"
                :style="presentCellStyle(row)"
                :disabled="!canClickPresent(row)"
                @click="togglePresent(row)"
              >
                {{
                  !row.is_permission && !row.is_present
                    ? t("Did not come")
                    : t("Present")
                }}
              </button>
              <button
                type="button"
                class="att-chip"
                :class="{ 'att-disabled': !canClickLate(row) }"
                :style="lateCellStyle(row)"
                :disabled="!canClickLate(row)"
                @click="toggleLate(row)"
              >
                {{ t("Late") }}
              </button>
              <button
                type="button"
                class="att-chip"
                :style="permissionCellStyle(row)"
                @click="togglePermission(row)"
              >
                {{ t("Ask Permission") }}
              </button>
            </div>
            <AppCombobox
              v-if="row.is_permission || !row.is_present"
              v-model="row.reason"
              class="mt-2"
              :items="reasons"
              item-title="title"
              item-value="value"
              placeholder="—"
              density="compact"
              hide-details
            />
          </VCard>
        </div>
      </template>
    </AppCard>

    <VRow class="mt-1">
      <VCol cols="12" class="d-flex justify-end ga-2">
        <VBtn
          :class="smAndDown ? 'w-50' : 'w-auto'"
          variant="tonal"
          color="info"
          :disabled="!editableRows.length"
          @click="approveAllRows"
        >
          {{ t("Approve") }}
        </VBtn>
        <VBtn
          :class="smAndDown ? 'w-50' : 'w-auto'"
          :color="isDirty ? 'warning' : 'primary'"
          :loading="isSaving"
          :disabled="!canLoad || !hasSchedule || !editableRows.length"
          @click="saveAttendance"
        >
          {{ t("Save") }}
        </VBtn>
      </VCol>
    </VRow>
  </div>
</template>

<style scoped>
.attendance-table {
  overflow-x: auto;
}
.sticky-header {
  position: sticky;
  left: 0;
  top: 0;
  z-index: 20;
  background: rgb(var(--v-theme-surface)) !important;
}
.sticky-col {
  position: sticky;
  left: 0;
  z-index: 10;
  background: rgb(var(--v-theme-surface));
}
.att-col {
  width: 100px;
  min-width: 100px;
}
.att-pad {
  padding: 4px !important;
  vertical-align: middle;
}
.att-cell {
  display: block;
  width: 100%;
  min-height: 36px;
  border: 1px solid rgba(0, 0, 0, 0.12);
  border-radius: 4px;
  cursor: pointer;
  transition: opacity 0.15s;
}
.att-cell:hover:not(:disabled) {
  opacity: 0.85;
}
.att-cell.att-disabled,
.att-cell:disabled {
  cursor: not-allowed;
  opacity: 0.5;
}
.mobile-row {
  padding: 12px;
  border-radius: 12px;
}
.mobile-row-top {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 10px;
}
.mobile-avatar {
  width: 36px;
  height: 36px;
  border-radius: 50%;
  flex: none;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  font-size: 13px;
  color: rgba(0, 0, 0, 0.7);
}
.mobile-name-block {
  min-width: 0;
}
.mobile-name {
  font-weight: 600;
  font-size: 14px;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.mobile-gender {
  font-size: 12px;
  color: rgba(var(--v-theme-on-surface), 0.6);
}
.mobile-actions {
  display: flex;
  gap: 6px;
}
.att-chip {
  flex: 1 1 45%;
  min-height: 38px;
  border: 1px solid rgba(0, 0, 0, 0.12);
  border-radius: 8px;
  font-size: 12px;
  font-weight: 600;
  cursor: pointer;
  color: rgba(0, 0, 0, 0.72);
}
.att-chip.att-disabled,
.att-chip:disabled {
  cursor: not-allowed;
  opacity: 0.45;
}
</style>
