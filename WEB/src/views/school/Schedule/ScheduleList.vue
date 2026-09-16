<script setup>
import {
  computed,
  nextTick,
  onBeforeUnmount,
  onMounted,
  ref,
  watch,
} from "vue";
import { useI18n } from "vue-i18n";
import { useDisplay } from "vuetify";
import { useRoute } from "vue-router";
import AddEditScheduleDialog from "./AddEditScheduleDialog.vue";
import {
  getDays,
  getGrades,
  getClasses,
  getSubjectClass,
} from "@/services/dataService.js";
import { useSettingStore } from "@/stores/settingStore.js";
import { api } from "@/utils/api.js";

const route = useRoute();
const { t, locale } = useI18n();
const { smAndDown } = useDisplay();
const settingStore = useSettingStore();

const isMobile = computed(() => smAndDown.value);

// Customize here
const SCHEDULE_CONFIG = {
  pxPerHour: 60, // row height per hour
  snapMinutes: 60, // drag snap (15 / 30 / 60)
  blockGap: 4, // padding around blocks
  timeGutterWidth: 64, // px — keep in sync with CSS grid
  // fallback when class has no shift
  defaultHourStart: 7,
  defaultHourEnd: 11,
  // colors assigned to subjects that have none
  colorPresets: [
    "#4F46E5",
    "#0EA5E9",
    "#10B981",
    "#F59E0B",
    "#EF4444",
    "#8B5CF6",
    "#EC4899",
    "#64748B",
  ],
};

const {
  pxPerHour: PX_PER_HOUR,
  snapMinutes: SNAP_MINUTES,
  blockGap: BLOCK_GAP,
  timeGutterWidth: TIME_GUTTER_WIDTH,
  defaultHourStart,
  defaultHourEnd,
  colorPresets,
} = SCHEDULE_CONFIG;

// ─────────────────────────────────────────────
// State
// ─────────────────────────────────────────────
const formSearch = ref({
  grade_id: null,
  class_id: null,
});

const days = ref([]);
const grades = ref([]);
const allClasses = ref([]);
const subjects = ref([]);
const schedules = ref([]); // periods for selected class (from API)

const viewMode = ref("week");
const isDialogVisible = ref(false);
const isLoading = ref(false);
const formData = ref({});
const dragState = ref(null); // { dayId, startMin, endMin, columnEl, anchorMin }
const selectedMobileDayId = ref(null); // mobile day-pill selection

// ─────────────────────────────────────────────
// Derived
// ─────────────────────────────────────────────
const filteredClasses = computed(() => {
  if (!formSearch.value.grade_id) return allClasses.value;
  return allClasses.value.filter(
    (item) => item.grade_id == formSearch.value.grade_id,
  );
});

const selectedClass = computed(() =>
  allClasses.value.find((c) => c.id == formSearch.value.class_id),
);

const classLabel = computed(() => {
  const c = selectedClass.value;
  if (!c) return "";
  return locale.value === "km"
    ? c.name_kh || c.name_en || ""
    : c.name_en || c.name_kh || "";
});

/** Shift from class.shift (AM / PM / Full Day) */
const shift = computed(() => selectedClass.value?.shift ?? null);

const shiftLabel = computed(() => {
  const s = shift.value;
  if (!s) return "";
  return locale.value === "km"
    ? s.name_kh || s.name_en || s.code || ""
    : s.name_en || s.name_kh || s.code || "";
});

/** "07:00:00" | 7 → 7 */
function parseHour(time) {
  if (time == null || time === "") return null;
  if (typeof time === "number") return time;
  const hour = Number(String(time).split(":")[0]);
  return Number.isFinite(hour) ? hour : null;
}

const hourStart = computed(
  () => parseHour(shift.value?.hour_start) ?? defaultHourStart,
);
const hourEnd = computed(
  () => parseHour(shift.value?.hour_end) ?? defaultHourEnd,
);

/** Lunch / break window from shift (null for AM/PM) */
const breakRange = computed(() => {
  const s = shift.value;
  if (!s?.break_start || !s?.break_end) return null;
  const startMin = toMinutes(s.break_start);
  const endMin = toMinutes(s.break_end);
  if (endMin <= startMin) return null;
  return { startMin, endMin };
});

const breakBandStyle = computed(() => {
  if (!breakRange.value) return null;
  const gridStart = hourStart.value * 60;
  const { startMin, endMin } = breakRange.value;
  return {
    top: `${((startMin - gridStart) / 60) * PX_PER_HOUR}px`,
    height: `${((endMin - startMin) / 60) * PX_PER_HOUR}px`,
    left: `${TIME_GUTTER_WIDTH}px`,
  };
});

const breakTimeLabel = computed(() => {
  if (!breakRange.value) return "";
  const { startMin, endMin } = breakRange.value;
  return `${minutesToTime(startMin)} – ${minutesToTime(endMin)}`;
});

const hours = computed(() => {
  const list = [];
  for (let h = hourStart.value; h < hourEnd.value; h++) {
    list.push(`${String(h).padStart(2, "0")}:00`);
  }
  return list;
});

const gridHeight = computed(
  () => (hourEnd.value - hourStart.value) * PX_PER_HOUR,
);
const hourHeightCss = computed(() => `${PX_PER_HOUR}px`);
const dayColumnsCss = computed(
  () =>
    `${TIME_GUTTER_WIDTH}px repeat(${days.value.length || 6}, minmax(120px, 1fr))`,
);

const filteredSchedules = computed(() => schedules.value);

const listRows = computed(() =>
  [...filteredSchedules.value]
    .map((s) => ({
      ...s,
      subject: subjects.value.find((x) => x.id == s.subject_id) || s.subject,
      day: days.value.find((d) => d.id == s.day_id) || s.day,
    }))
    .sort((a, b) => a.day_id - b.day_id || a.start.localeCompare(b.start)),
);

const dialogHasConflict = computed(() => {
  if (!formData.value?.day_id || !formData.value?.start || !formData.value?.end)
    return false;
  return hasOverlap({
    ...formData.value,
    class_id: formSearch.value.class_id,
  });
});

const dialogHasBreakConflict = computed(() => {
  if (!formData.value?.start || !formData.value?.end) return false;
  return overlapsBreak(
    toMinutes(formData.value.start),
    toMinutes(formData.value.end),
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
  return locale.value === "km"
    ? item?.name_kh || item?.name_en
    : item?.name_en || item?.name_kh;
};

const dayLabel = (day) => {
  if (!day) return "-";
  return locale.value === "km"
    ? day.name_kh || day.short || day.name_en
    : day.short || day.name_en || day.name_kh;
};

const dayFullLabel = (day) => {
  if (!day) return "";
  return locale.value === "km"
    ? day.name_kh || day.name_en
    : day.name_en || day.name_kh;
};

/** Match seeded short (Mon, Tue…) to JS weekday */
function findTodayDayId() {
  const shorts = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
  const todayShort = shorts[new Date().getDay()];
  const found = days.value.find(
    (d) =>
      d.short === todayShort ||
      d.name_en?.toLowerCase().startsWith(todayShort.toLowerCase()),
  );
  return found?.id ?? null;
}

function isTodayDay(day) {
  if (!day) return false;
  return day.id == findTodayDayId();
}

const selectedMobileDay = computed(() =>
  days.value.find((d) => d.id == selectedMobileDayId.value),
);

const mobileDaySchedules = computed(() =>
  [...schedulesForDay(selectedMobileDayId.value)].sort((a, b) =>
    a.start.localeCompare(b.start),
  ),
);

function countForDay(dayId) {
  return schedules.value.filter((s) => s.day_id == dayId).length;
}

function ensureMobileDaySelected() {
  if (!days.value.length) {
    selectedMobileDayId.value = null;
    return;
  }
  const stillValid = days.value.some((d) => d.id == selectedMobileDayId.value);
  if (!stillValid) {
    selectedMobileDayId.value = findTodayDayId() ?? days.value[0].id;
  }
}

/** 07:00 → 7:00 AM */
function formatTimeAmPm(time) {
  const normalized = normalizeTime(time);
  if (!normalized) return "";
  const [h, m] = normalized.split(":").map(Number);
  const ampm = h >= 12 ? "PM" : "AM";
  const hour12 = h % 12 || 12;
  return `${hour12}:${String(m).padStart(2, "0")} ${ampm}`;
}

function formatRangeAmPm(start, end) {
  return `${formatTimeAmPm(start)} – ${formatTimeAmPm(end)}`;
}

/** Soft card fill from subject color */
function mobileCardStyle(item) {
  const color = item.color || "#2F5D50";
  return {
    backgroundColor: `${color}18`,
    "--card-accent": color,
  };
}

// ─────────────────────────────────────────────
// API helpers (schedules CRUD)
// ─────────────────────────────────────────────

/** "07:00:00" → "07:00" for <input type="time"> */
function normalizeTime(time) {
  if (!time) return time;
  return String(time).slice(0, 5);
}

function mapScheduleRow(row) {
  return {
    ...row,
    start: normalizeTime(row.start),
    end: normalizeTime(row.end),
  };
}

function buildSchedulePayload(data, { withId = false } = {}) {
  const payload = {
    class_id: formSearch.value.class_id,
    subject_id: data.subject_id,
    day_id: data.day_id,
    start: normalizeTime(data.start),
    end: normalizeTime(data.end),
    color: data.color || null,
  };
  if (withId) payload.id = data.id;
  return payload;
}

async function fetchSchedules(classId = formSearch.value.class_id) {
  if (!classId) {
    schedules.value = [];
    return;
  }
  try {
    const res = await api.post("schedules-list", { class_id: classId });
    if (res.data?.status) {
      schedules.value = (res.data.data || []).map(mapScheduleRow);
    } else {
      schedules.value = [];
      console.error("schedules-list failed:", res.data);
    }
  } catch (error) {
    schedules.value = [];
    console.error("Failed to fetch schedules:", error);
  }
}

async function loadSubjectsForClass(classId) {
  if (!classId) {
    subjects.value = [];
    return;
  }
  const rows = await getSubjectClass(classId);
  subjects.value = (rows || []).map((s, i) => ({
    ...s,
    color: s.color || colorPresets[i % colorPresets.length],
  }));
}

/** Load subjects + schedule board when class changes */
async function onClassSelected(classId) {
  if (!classId) {
    subjects.value = [];
    schedules.value = [];
    return;
  }
  isLoading.value = true;
  try {
    await Promise.all([loadSubjectsForClass(classId), fetchSchedules(classId)]);
  } finally {
    isLoading.value = false;
  }
}

watch(
  () => settingStore.curriculum_id,
  async (newVal) => {
    if (!newVal) return;
    formSearch.value.grade_id = null;
    formSearch.value.class_id = null;
    subjects.value = [];
    schedules.value = [];
    grades.value = (await getGrades()) || [];
    allClasses.value = (await getClasses()) || [];
  },
);

/** Skip clearing class when we set grade from route param */
let applyingFromRoute = false;

watch(
  () => formSearch.value.grade_id,
  () => {
    if (applyingFromRoute) return;
    formSearch.value.class_id = null;
    subjects.value = [];
    schedules.value = [];
  },
);

watch(
  () => formSearch.value.class_id,
  (classId) => {
    onClassSelected(classId);
  },
);

/** Prefill grade + class when opened as /schedule/:id (from Class list) */
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
  () => route.params.id,
  (id) => {
    applyClassFromRoute(id);
  },
);

onMounted(async () => {
  isLoading.value = true;
  try {
    days.value = (await getDays()) || [];
    grades.value = (await getGrades()) || [];
    allClasses.value = (await getClasses()) || [];
    ensureMobileDaySelected();
    // after classes loaded — apply /schedule/:id if present
    await applyClassFromRoute(route.params.id);
  } finally {
    isLoading.value = false;
  }
});

// ─────────────────────────────────────────────
// Time helpers
// ─────────────────────────────────────────────
function padTime(hour) {
  return `${String(hour).padStart(2, "0")}:00`;
}

function subjectName(subjectId) {
  const s = subjects.value.find((x) => x.id == subjectId);
  if (!s) return "-";
  return locale.value === "km"
    ? s.name_kh || s.name_en
    : s.name_en || s.name_kh;
}

function toMinutes(time) {
  if (!time) return 0;
  const [h, m] = String(time).split(":").map(Number);
  return h * 60 + (m || 0);
}

function minutesToTime(totalMin) {
  const h = Math.floor(totalMin / 60);
  const m = totalMin % 60;
  return `${String(h).padStart(2, "0")}:${String(m).padStart(2, "0")}`;
}

function overlapsBreak(startMin, endMin) {
  if (!breakRange.value) return false;
  return (
    startMin < breakRange.value.endMin && endMin > breakRange.value.startMin
  );
}

function isInsideBreak(mins) {
  if (!breakRange.value) return false;
  return mins >= breakRange.value.startMin && mins < breakRange.value.endMin;
}

function snapMinutes(mins, mode = "floor") {
  const snapped =
    mode === "ceil"
      ? Math.ceil(mins / SNAP_MINUTES) * SNAP_MINUTES
      : Math.floor(mins / SNAP_MINUTES) * SNAP_MINUTES;
  const minBound = hourStart.value * 60;
  const maxBound = hourEnd.value * 60;
  return Math.min(maxBound, Math.max(minBound, snapped));
}

function yToMinutes(y, columnHeight) {
  const ratio = Math.min(1, Math.max(0, y / columnHeight));
  const totalSpan = (hourEnd.value - hourStart.value) * 60;
  return hourStart.value * 60 + ratio * totalSpan;
}

function blockStyle(item) {
  const startMin = toMinutes(item.start);
  const endMin = toMinutes(item.end);
  const gridStart = hourStart.value * 60;
  const top = ((startMin - gridStart) / 60) * PX_PER_HOUR + BLOCK_GAP;
  const rawHeight = ((endMin - startMin) / 60) * PX_PER_HOUR;
  const height = Math.max(rawHeight - BLOCK_GAP * 2, 24);
  return {
    top: `${top}px`,
    height: `${height}px`,
    backgroundColor: item.color || colorPresets[0],
  };
}

function selectionStyle() {
  if (!dragState.value) return null;
  const { startMin, endMin } = dragState.value;
  const from = Math.min(startMin, endMin);
  const to = Math.max(startMin, endMin);
  const gridStart = hourStart.value * 60;
  const top = ((from - gridStart) / 60) * PX_PER_HOUR + BLOCK_GAP;
  const height = Math.max(((to - from) / 60) * PX_PER_HOUR - BLOCK_GAP * 2, 20);
  return { top: `${top}px`, height: `${height}px` };
}

function selectionLabel() {
  if (!dragState.value) return "";
  const from = Math.min(dragState.value.startMin, dragState.value.endMin);
  const to = Math.max(dragState.value.startMin, dragState.value.endMin);
  return `${minutesToTime(from)} – ${minutesToTime(to)}`;
}

function schedulesForDay(dayId) {
  return filteredSchedules.value.filter((s) => s.day_id == dayId);
}

function hasOverlap(candidate) {
  const start = toMinutes(candidate.start);
  const end = toMinutes(candidate.end);
  return schedules.value.some((s) => {
    if (s.class_id != candidate.class_id) return false;
    if (s.day_id != candidate.day_id) return false;
    if (candidate.id && s.id === candidate.id) return false;
    const sStart = toMinutes(s.start);
    const sEnd = toMinutes(s.end);
    return start < sEnd && end > sStart;
  });
}

// ─────────────────────────────────────────────
// Dialog / CRUD (API)
// ─────────────────────────────────────────────
function openCreate(dayId, start, end) {
  if (!formSearch.value.class_id) return;

  const subject = subjects.value[0];
  const defaultStart = padTime(hourStart.value);
  const defaultEnd = minutesToTime(
    Math.min(hourStart.value * 60 + 60, hourEnd.value * 60),
  );

  formData.value = {
    id: null,
    class_id: formSearch.value.class_id,
    subject_id: subject?.id ?? null,
    day_id: dayId ?? days.value[0]?.id ?? null,
    start: start || defaultStart,
    end: end || defaultEnd,
    color: subject?.color || colorPresets[0],
  };
  isDialogVisible.value = true;
}

function openEdit(item) {
  formData.value = {
    ...item,
    start: normalizeTime(item.start),
    end: normalizeTime(item.end),
  };
  isDialogVisible.value = true;
}

const onCreate = async (data, callback) => {
  isLoading.value = true;
  try {
    const res = await api.post("schedules-store", buildSchedulePayload(data));
    if (res.data?.status) {
      await fetchSchedules();
      isDialogVisible.value = false;
      callback?.(true);
    } else {
      console.error("schedules-store failed:", res.data);
      callback?.(false);
    }
  } catch (error) {
    console.error("Failed to create schedule:", error);
    callback?.(false);
  } finally {
    isLoading.value = false;
  }
};

const onUpdate = async (data, callback) => {
  isLoading.value = true;
  try {
    const res = await api.post(
      "schedules-update",
      buildSchedulePayload(data, { withId: true }),
    );
    if (res.data?.status) {
      await fetchSchedules();
      isDialogVisible.value = false;
      callback?.(true);
    } else {
      console.error("schedules-update failed:", res.data);
      callback?.(false);
    }
  } catch (error) {
    console.error("Failed to update schedule:", error);
    callback?.(false);
  } finally {
    isLoading.value = false;
  }
};

const onDelete = async (data, callback) => {
  isLoading.value = true;
  try {
    const res = await api.post("schedules-delete", { id: data.id });
    if (res.data?.status) {
      await fetchSchedules();
      isDialogVisible.value = false;
      callback?.(true);
    } else {
      console.error("schedules-delete failed:", res.data);
      callback?.(false);
    }
  } catch (error) {
    console.error("Failed to delete schedule:", error);
    callback?.(false);
  } finally {
    isLoading.value = false;
  }
};

/** Quick delete from mobile card trash icon */
async function deletePeriod(item) {
  if (!item?.id) return;
  if (!confirm(t("Are you sure you want to delete this period?"))) return;
  await onDelete(item);
}

// Drag-to-create

function onPointerDown(dayId, event) {
  if (event.button !== 0) return;
  if (event.target.closest(".schedule-block")) return;
  if (event.target.closest(".break-band")) return;

  const column = event.currentTarget;
  const rect = column.getBoundingClientRect();
  const y = event.clientY - rect.top;
  const mins = snapMinutes(yToMinutes(y, rect.height), "floor");
  if (isInsideBreak(mins)) return;

  const maxBound = hourEnd.value * 60;

  dragState.value = {
    dayId,
    anchorMin: mins,
    startMin: mins,
    endMin: Math.min(mins + SNAP_MINUTES, maxBound),
    columnEl: column,
  };

  window.addEventListener("pointermove", onPointerMove);
  window.addEventListener("pointerup", onPointerUp);
  event.preventDefault();
}

function onPointerMove(event) {
  if (!dragState.value?.columnEl) return;
  const rect = dragState.value.columnEl.getBoundingClientRect();
  const y = event.clientY - rect.top;
  const cursorMin = snapMinutes(yToMinutes(y, rect.height), "floor");
  const anchor = dragState.value.anchorMin;
  const maxBound = hourEnd.value * 60;

  const from = Math.min(anchor, cursorMin);
  let to = Math.max(anchor, cursorMin) + SNAP_MINUTES;
  to = Math.min(to, maxBound);
  if (to <= from) to = Math.min(from + SNAP_MINUTES, maxBound);

  dragState.value = {
    ...dragState.value,
    startMin: from,
    endMin: to,
  };
}

function onPointerUp() {
  window.removeEventListener("pointermove", onPointerMove);
  window.removeEventListener("pointerup", onPointerUp);

  if (!dragState.value) return;

  const { dayId, startMin, endMin } = dragState.value;
  const from = Math.min(startMin, endMin);
  const to = Math.max(startMin, endMin);
  dragState.value = null;

  // Don't create periods that land on lunch / break
  if (overlapsBreak(from, to)) return;

  if (to - from < SNAP_MINUTES) {
    openCreate(dayId, minutesToTime(from), minutesToTime(from + SNAP_MINUTES));
    return;
  }

  openCreate(dayId, minutesToTime(from), minutesToTime(to));
}

function teacherName(subjectId) {
  const s = subjects.value.find((x) => x.id == subjectId);
  if (!s) return "-";
  return locale.value === "km"
    ? s.teacher_name_kh || s.teacher_name_en || "-"
    : s.teacher_name_en || s.teacher_name_kh || "-";
}

onBeforeUnmount(() => {
  window.removeEventListener("pointermove", onPointerMove);
  window.removeEventListener("pointerup", onPointerUp);
});
</script>

<template>
  <AddEditScheduleDialog
    v-model:isDialogVisible="isDialogVisible"
    :item-data="formData"
    :loading="isLoading"
    :subjects="subjects"
    :days="days"
    :class-label="classLabel"
    :has-conflict="dialogHasConflict"
    :has-break-conflict="dialogHasBreakConflict"
    :color-presets="colorPresets"
    @on-create="onCreate"
    @on-update="onUpdate"
    @on-delete="onDelete"
  />
  <AppCard
    :title="t('Class Schedule')"
    title-icon="tabler-calendar-time"
    :is-back="false"
    :is-filter="true"
    :show-filters="true"
    :loading="isLoading"
  >
    <template #filter>
      <VRow class="align-end">
        <VCol cols="6" sm="3" md="3" lg="3">
          <AppAutocomplete
            v-model="formSearch.grade_id"
            :items="grades"
            :item-title="gradeTitle"
            item-value="id"
            :placeholder="t('Grade')"
            autocomplete="off"
            clearable
            hide-details
          />
        </VCol>

        <VCol cols="6" sm="3" md="3" lg="3">
          <AppAutocomplete
            v-model="formSearch.class_id"
            :items="filteredClasses"
            :item-title="classTitle"
            item-value="id"
            :placeholder="t('Class')"
            autocomplete="off"
            clearable
            hide-details
            :disabled="!formSearch.grade_id"
          />
        </VCol>
      </VRow>
    </template>

    <VRow class="d-flex justify-end">
      <VCol
        v-if="formSearch.class_id"
        cols="12"
        md="12"
        sm="12"
        lg="12"
        class="d-flex justify-space-between"
        :class="{ 'ms-auto': isMobile }"
      >
        <VBtnToggle
          v-model="viewMode"
          mandatory
          rounded="xl"
          density="compact"
          color="primary"
          divided
          class="view-toggle ma-0 gap-1"
        >
          <VBtn value="week" rounded="xl">
            {{ t("Week") }}
          </VBtn>
          <VBtn value="list" rounded="xl">
            {{ t("List") }}
          </VBtn>
        </VBtnToggle>
        <VBtn
          color="primary"
          variant="tonal"
          prepend-icon="tabler-plus"
          :disabled="!formSearch.class_id"
          @click="openCreate(selectedMobileDayId)"
        >
          {{ t("Add Period") }}
        </VBtn>
      </VCol>
    </VRow>

    <div
      v-if="!formSearch.class_id"
      class="pa-8 text-center text-medium-emphasis"
    >
      <VIcon icon="tabler-calendar-off" size="40" class="mb-2" />
      <div>{{ t("Select a class to view its weekly schedule.") }}</div>
    </div>

    <div v-else class="pa-1">
      <!-- ── Mobile: day pills + cards (like screenshot) ── -->
      <div v-if="isMobile" class="mobile-schedule">
        <div class="mobile-day-tabs">
          <button
            v-for="day in days"
            :key="day.id"
            type="button"
            class="mobile-day-tab"
            :class="{ active: day.id == selectedMobileDayId }"
            @click="selectedMobileDayId = day.id"
          >
            <span>{{ day.short || dayLabel(day) }}</span>
            <span v-if="countForDay(day.id)" class="mobile-day-tab__badge">
              {{ countForDay(day.id) }}
            </span>
          </button>
        </div>

        <div class="mobile-day-heading">
          <h3 class="mobile-day-heading__title">
            <!-- {{ dayFullLabel(selectedMobileDay) }} -->
          </h3>
          <span
            v-if="isTodayDay(selectedMobileDay)"
            class="mobile-day-heading__today"
          >
            {{ t("Today") }}
          </span>
        </div>

        <div v-if="!mobileDaySchedules.length" class="mobile-empty">
          <VIcon icon="tabler-calendar-off" size="36" class="mb-2" />
          <div>{{ t("No periods yet. Add the first one.") }}</div>
        </div>

        <div v-else class="mobile-cards">
          <div
            v-for="item in mobileDaySchedules"
            :key="item.id"
            class="mobile-card"
            :style="mobileCardStyle(item)"
            @click="openEdit(item)"
          >
            <div class="mobile-card__body">
              <div class="mobile-card__title">
                {{ subjectName(item.subject_id) }}
              </div>
              <div class="mobile-card__time">
                {{ teacherName(item.subject_id) }}
              </div>
            </div>
            <IconBtn
              size="small"
              class="mobile-card__delete"
              @click.stop="onDelete(item)"
            >
              <VIcon icon="tabler-trash" />
            </IconBtn>
          </div>
        </div>
      </div>

      <!-- ── Desktop: week board / table ── -->
      <template v-else>
        <!-- Weekly board -->
        <div v-if="viewMode === 'week'" class="schedule-board">
          <div class="schedule-header">
            <div class="time-gutter header-cell" />
            <div
              v-for="day in days"
              :key="day.id"
              class="day-header header-cell"
            >
              <div class="day-name">{{ dayLabel(day) }}</div>
            </div>
          </div>

          <div class="schedule-body">
            <div class="time-gutter" :style="{ height: `${gridHeight}px` }">
              <div
                v-for="hour in hours"
                :key="hour"
                class="hour-label"
                :style="{ height: `${PX_PER_HOUR}px` }"
              >
                {{ hour }}
              </div>
            </div>

            <div
              v-for="day in days"
              :key="day.id"
              class="day-column"
              :class="{ dragging: dragState?.dayId === day.id }"
              :style="{ height: `${gridHeight}px` }"
              @pointerdown="onPointerDown(day.id, $event)"
            >
              <div
                v-for="hour in hours"
                :key="`${day.id}-${hour}`"
                class="hour-line"
                :style="{ height: `${PX_PER_HOUR}px` }"
              />

              <div
                v-if="dragState?.dayId === day.id"
                class="selection-preview"
                :style="selectionStyle()"
              >
                <span>{{ selectionLabel() }}</span>
              </div>

              <button
                v-for="item in schedulesForDay(day.id)"
                :key="item.id"
                type="button"
                class="schedule-block"
                :style="blockStyle(item)"
                @pointerdown.stop
                @click.stop="openEdit(item)"
              >
                <div class="block-title">
                  {{ subjectName(item.subject_id) }}
                </div>
                <div class="block-time">
                  ({{ teacherName(item.subject_id) }})
                </div>
              </button>
            </div>

            <div
              v-if="breakBandStyle"
              class="break-band"
              :style="breakBandStyle"
            >
              <div class="break-band__label">
                <VIcon icon="tabler-coffee" size="18" class="me-1" />
                <span>{{ t("Break") }}</span>
                <span class="break-band__time">{{ breakTimeLabel }}</span>
              </div>
            </div>
          </div>

          <div class="text-caption text-medium-emphasis mt-3 px-1">
            {{
              t(
                "Tip: drag down on a day column to select time (e.g. 7:00–9:00), then fill subject.",
              )
            }}
          </div>
        </div>

        <!-- List view -->
        <div v-else>
          <VTable density="comfortable" class="schedule-table">
            <thead>
              <tr>
                <th>{{ t("Day") }}</th>
                <th>{{ t("Time") }}</th>
                <th>{{ t("Subject") }}</th>
                <th class="text-end">{{ t("Action") }}</th>
              </tr>
            </thead>
            <tbody>
              <tr v-if="!listRows.length">
                <td colspan="4" class="text-center text-medium-emphasis py-8">
                  {{ t("No periods yet. Add the first one.") }}
                </td>
              </tr>
              <tr
                v-for="row in listRows"
                :key="row.id"
                class="list-row"
                @click="openEdit(row)"
              >
                <td>{{ dayLabel(row.day) }}</td>
                <td>
                  <span class="font-weight-medium">{{ row.start }}</span>
                  –
                  {{ row.end }}
                </td>
                <td>
                  <div class="d-flex align-center ga-2">
                    <span
                      class="color-dot"
                      :style="{ backgroundColor: row.color }"
                    />
                    {{ subjectName(row.subject_id) }}
                  </div>
                </td>
                <td class="text-end">
                  <IconBtn size="small" @click.stop="openEdit(row)">
                    <VIcon icon="tabler-edit" />
                  </IconBtn>
                </td>
              </tr>
            </tbody>
          </VTable>
        </div>
      </template>
    </div>
  </AppCard>
</template>

<style scoped>
.view-toggle {
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 8px;
  overflow: hidden;
}

.schedule-board {
  overflow-x: auto;
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 5px;
  background: rgb(var(--v-theme-surface));
  user-select: none;
}

.schedule-header,
.schedule-body {
  display: grid;
  grid-template-columns: v-bind(dayColumnsCss);
  min-width: 820px;
}

.schedule-body {
  position: relative;
}

.header-cell {
  padding: 10px 8px;
  border-bottom: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  text-align: center;
}

.day-name {
  font-weight: 600;
  font-size: 0.875rem;
}

.time-gutter {
  border-right: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
}

.hour-label {
  padding: 4px 8px 0;
  font-size: 0.75rem;
  color: rgba(var(--v-theme-on-surface), 0.55);
  border-bottom: 1px dashed rgba(var(--v-border-color), 0.5);
}

.day-column {
  position: relative;
  border-right: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  cursor: crosshair;
  touch-action: none;
  background-image: linear-gradient(
    to bottom,
    transparent calc(100% - 1px),
    rgba(var(--v-border-color), 0.35) calc(100% - 1px)
  );
  background-size: 100% v-bind(hourHeightCss);
}

.day-column:last-child {
  border-right: none;
}

.day-column:hover,
.day-column.dragging {
  background-color: rgba(var(--v-theme-primary), 0.03);
}

.hour-line {
  pointer-events: none;
  border-bottom: 1px dashed rgba(var(--v-border-color), 0.35);
}

/* Merged break across Mon–Sat */
.break-band {
  position: absolute;
  right: 0;
  z-index: 3;
  display: flex;
  align-items: center;
  justify-content: center;
  pointer-events: auto;
  cursor: not-allowed;
  background: repeating-linear-gradient(
    -45deg,
    rgba(var(--v-theme-on-surface), 0.06),
    rgba(var(--v-theme-on-surface), 0.06) 8px,
    rgba(var(--v-theme-on-surface), 0.1) 8px,
    rgba(var(--v-theme-on-surface), 0.1) 16px
  );
  border-top: 1px dashed rgba(var(--v-theme-on-surface), 0.25);
  border-bottom: 1px dashed rgba(var(--v-theme-on-surface), 0.25);
}

.break-band__label {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  padding: 4px 12px;
  border-radius: 999px;
  font-size: 0.8rem;
  font-weight: 600;
  color: rgba(var(--v-theme-on-surface), 0.7);
  background: rgb(var(--v-theme-surface));
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.08);
}

.break-band__time {
  font-weight: 500;
  opacity: 0.75;
}

.selection-preview {
  position: absolute;
  left: 4px;
  right: 4px;
  border-radius: 5px;
  background: rgba(var(--v-theme-primary), 0.22);
  border: 1.5px dashed rgb(var(--v-theme-primary));
  z-index: 2;
  pointer-events: none;
  display: flex;
  align-items: flex-start;
  justify-content: center;
  padding-top: 6px;
}

.selection-preview span {
  font-size: 0.75rem;
  font-weight: 600;
  color: rgb(var(--v-theme-primary));
  background: rgb(var(--v-theme-surface));
  padding: 2px 8px;
  border-radius: 999px;
}

.schedule-block {
  position: absolute;
  left: 4px;
  right: 4px;
  border: none;
  border-radius: 5px;
  padding: 3px 4px;
  color: #fff;
  text-align: left;
  cursor: pointer;
  overflow: hidden;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.18);
  z-index: 1;
}

.block-title {
  font-size: 0.8rem;
  font-weight: 600;
  line-height: 1.2;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.block-time {
  font-size: 0.7rem;
  opacity: 0.9;
  margin-top: 2px;
}

.schedule-table {
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 5px;
  overflow: hidden;
}

.list-row {
  cursor: pointer;
}

.list-row:hover {
  background: rgba(var(--v-theme-primary), 0.04);
}

.color-dot {
  width: 10px;
  height: 10px;
  border-radius: 50%;
  flex-shrink: 0;
}

/* ── Mobile day schedule (small screens) ── */
.mobile-schedule {
  max-width: 560px;
  margin: 0 auto;
}

.mobile-day-tabs {
  display: flex;
  align-items: center;
  gap: 4px;
  overflow-x: auto;
  padding-bottom: 12px;
  margin-bottom: 16px;
  border-bottom: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  -webkit-overflow-scrolling: touch;
  scrollbar-width: none;
}

.mobile-day-tabs::-webkit-scrollbar {
  display: none;
}

.mobile-day-tab {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  flex-shrink: 0;
  border: none;
  background: transparent;
  padding: 8px 14px;
  border-radius: 999px;
  font-size: 0.9rem;
  font-weight: 500;
  color: rgba(var(--v-theme-on-surface), 0.45);
  cursor: pointer;
}

.mobile-day-tab.active {
  background: rgb(var(--v-theme-primary));
  color: rgb(var(--v-theme-on-primary));
  font-weight: 600;
}

.mobile-day-tab__badge {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  min-width: 18px;
  height: 18px;
  padding: 0 5px;
  border-radius: 999px;
  font-size: 0.7rem;
  font-weight: 700;
  background: rgba(var(--v-theme-on-surface), 0.08);
  color: rgba(var(--v-theme-on-surface), 0.7);
}

.mobile-day-tab.active .mobile-day-tab__badge {
  background: rgba(255, 255, 255, 0.92);
  color: rgba(0, 0, 0, 0.75);
}

.mobile-day-heading {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 16px;
}

.mobile-day-heading__title {
  margin: 0;
  font-size: 1.35rem;
  font-weight: 700;
  color: rgba(var(--v-theme-on-surface), 0.85);
}

.mobile-day-heading__today {
  display: inline-flex;
  padding: 2px 10px;
  border-radius: 999px;
  font-size: 0.75rem;
  font-weight: 600;
  background: rgba(var(--v-theme-on-surface), 0.08);
  color: rgba(var(--v-theme-on-surface), 0.65);
}

.mobile-empty {
  padding: 40px 16px;
  text-align: center;
  color: rgba(var(--v-theme-on-surface), 0.5);
}

.mobile-cards {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.mobile-card {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 12px;
  padding: 16px 14px;
  border-radius: 14px;
  cursor: pointer;
  transition:
    transform 0.12s ease,
    box-shadow 0.12s ease;
}

.mobile-card:active {
  transform: scale(0.99);
}

.mobile-card__title {
  font-size: 1.05rem;
  font-weight: 700;
  color: var(--card-accent, rgb(var(--v-theme-primary)));
  line-height: 1.3;
  margin-bottom: 6px;
}

.mobile-card__time {
  font-size: 0.9rem;
  font-weight: 600;
  color: #c45c3e;
}

.mobile-card__delete {
  color: var(--card-accent, rgb(var(--v-theme-primary))) !important;
  opacity: 0.85;
}
</style>
