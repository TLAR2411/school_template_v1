<script setup>
/**
 * Drop-in attendance report
 * -------------------------
 * Report page (month only, required filters):
 *   <AttendanceReport variant="report" />
 *
 * Dashboard (summary only — grade/class + today, changeable):
 *   <AttendanceReport variant="dashboard" :is-back="false" :auto-load="true" />
 *
 * Parent can call:  reportRef.value?.search()
 */
import { computed, onMounted, ref, watch } from "vue";
import { useI18n } from "vue-i18n";
import { useDisplay } from "vuetify";
import AppCard from "@/components/AppCard.vue";
import { useAttendanceReport } from "@/composables/useAttendanceReport";
import {
  getClasses,
  getGrades,
  getMonths,
  getSubjectsFromSchedule,
} from "@/services/dataService";
import { useSettingStore } from "@/stores/settingStore";
import formatGender from "@/utils/formater/formatGender";

const props = defineProps({
  /** report = month detail; dashboard = today summary (grade/class + date) */
  variant: {
    type: String,
    default: "report",
    validator: (v) => ["report", "dashboard"].includes(v),
  },
  classId: { type: [Number, String], default: null },
  lockClass: { type: Boolean, default: false },
  period: { type: String, default: null }, // date | range | month
  date: { type: String, default: null },
  dateFrom: { type: String, default: null },
  dateTo: { type: String, default: null },
  monthId: { type: [Number, String], default: null },
  session: { type: String, default: null },
  subjectId: { type: [Number, String], default: null },
  hideFilters: { type: Boolean, default: false },
  autoLoad: { type: Boolean, default: false },
  isBack: { type: Boolean, default: true },
});

const isReportMode = computed(() => props.variant === "report");
const isDashboardMode = computed(() => props.variant === "dashboard");

/** Periods allowed for this page variant */
const allowedPeriods = computed(() =>
  isReportMode.value ? ["month"] : ["date"],
);

function defaultPeriod() {
  if (props.period && allowedPeriods.value.includes(props.period)) {
    return props.period;
  }
  return isReportMode.value ? "month" : "date";
}

const STATS = [
  {
    key: "present",
    label: "Present",
    color: "success",
    icon: "tabler-circle-check",
  },
  { key: "late", label: "Late", color: "warning", icon: "tabler-clock" },
  {
    key: "permission",
    label: "Ask Permission",
    color: "orange",
    icon: "tabler-file-text",
  },
  { key: "absent", label: "Absent", color: "error", icon: "tabler-circle-x" },
  { key: "total", label: "Total", color: "primary", icon: "tabler-sum" },
];

const COUNT_CELLS = [
  { key: "present", label: "Present", color: "success", pill: "success" },
  { key: "late", label: "Late", color: "warning", pill: "warning" },
  {
    key: "permission",
    label: "Ask Permission",
    color: "#ef6c00",
    pill: "orange",
  },
  { key: "absent", label: "Absent", color: "error", pill: "error" },
];

const { t, locale } = useI18n();
const { smAndDown } = useDisplay();
const settingStore = useSettingStore();
const {
  isLoading,
  error,
  dateFrom,
  dateTo,
  summary,
  students,
  studentsAbsent,
  studentsPermission,
  load,
} = useAttendanceReport();

const grades = ref([]);
const allClasses = ref([]);
const months = ref([]);
const subjects = ref([]);
/** Avoid filter watchers firing search/subject load before first mount finishes. */
const ready = ref(false);
/** Snapshot of last searched payload — used to show “click Search” when dirty. */
const lastSearchedKey = ref("");

const filters = ref({
  grade_id: null,
  class_id: props.classId ? Number(props.classId) : null,
  period: defaultPeriod(),
  date: props.date || today(),
  date_from: props.dateFrom || null,
  date_to: props.dateTo || null,
  month_id: props.monthId ? Number(props.monthId) : null,
  session: props.session || null,
  subject_id: props.subjectId ? Number(props.subjectId) : null,
});

const sessions = computed(() => [
  { title: t("All sessions"), value: "" },
  { title: t("Morning"), value: "AM" },
  { title: t("Afternoon"), value: "PM" },
]);

const classTitle = computed(() =>
  locale.value === "km" ? "name_kh" : "name_en",
);

const filteredClasses = computed(() => {
  if (!filters.value.grade_id) {
    // Report: force grade first; dashboard: show all classes
    return isReportMode.value ? [] : allClasses.value;
  }
  return allClasses.value.filter((c) => c.grade_id == filters.value.grade_id);
});

const selectedClass = computed(() =>
  allClasses.value.find((c) => c.id == filters.value.class_id),
);

const pageTitle = computed(() => {
  const base = isDashboardMode.value ? t("Attendance") : t("Attendance Report");
  const name = className(selectedClass.value);
  return name ? `${base} — ${name}` : base;
});

const rangeLabel = computed(() => {
  if (!dateFrom.value) return "";
  return dateFrom.value === dateTo.value
    ? dateFrom.value
    : `${dateFrom.value} → ${dateTo.value}`;
});

const showClassColumn = computed(
  () => !props.lockClass && !filters.value.class_id,
);

const studentCount = computed(() => filteredStudents.value.length);

/** Dashboard / report: filter student list by status */
const statusFilter = ref("all");

const STATUS_FILTERS = computed(() => [
  { value: "all", label: t("All"), color: "primary" },
  { value: "present", label: t("Present"), color: "success" },
  { value: "permission", label: t("Ask Permission"), color: "orange" },
  { value: "absent", label: t("Absent"), color: "error" },
]);

/** Come = present or late; permission; stop/absent */
const filteredStudents = computed(() => {
  const list = students.value;
  const f = statusFilter.value;
  if (f === "all") return list;
  if (f === "present") {
    return list.filter((r) => Number(r.present) > 0 || Number(r.late) > 0);
  }
  if (f === "permission") {
    return list.filter((r) => Number(r.permission) > 0);
  }
  if (f === "absent") {
    return list.filter((r) => Number(r.absent) > 0);
  }
  return list;
});

function setStatusFilter(value) {
  statusFilter.value = statusFilter.value === value ? "all" : value;
}

/** Dashboard cards: present / permission / absent (same layout as design) */
const dashboardPresent = computed(() => {
  const date = dateFrom.value || filters.value.date;
  return students.value
    .filter((r) => Number(r.present) > 0 || Number(r.late) > 0)
    .map((r) => ({
      ...r,
      date,
      session: filters.value.session || null,
    }));
});

const dashboardPanels = computed(() => [
  {
    key: "present",
    title: t("Present students"),
    icon: "tabler-circle-check",
    tone: "present",
    items: dashboardPresent.value,
  },
  {
    key: "permission",
    title: t("Permission students"),
    icon: "tabler-file-text",
    tone: "permission",
    items: studentsPermission.value,
  },
  {
    key: "absent",
    title: t("Absent students"),
    icon: "tabler-circle-x",
    tone: "absent",
    items: studentsAbsent.value,
  },
]);

/** All = 3 cards; Present/Permission/Absent = that card only */
const visibleDashboardPanels = computed(() => {
  if (statusFilter.value === "all") return dashboardPanels.value;
  return dashboardPanels.value.filter((p) => p.key === statusFilter.value);
});

const dashboardPanelCols = computed(() =>
  statusFilter.value === "all" ? 4 : 12,
);

/** Mutually exclusive day status → percentages (class or whole school). */
const dashboardRate = computed(() => {
  let come = 0;
  let permission = 0;
  let absent = 0;

  for (const row of students.value) {
    if (Number(row.present) > 0 || Number(row.late) > 0) come++;
    else if (Number(row.permission) > 0) permission++;
    else if (Number(row.absent) > 0) absent++;
  }

  const total = come + permission + absent;
  const pct = (n) => (total > 0 ? Math.round((n / total) * 1000) / 10 : 0);

  return {
    come,
    permission,
    absent,
    total,
    comePct: pct(come),
    permissionPct: pct(permission),
    absentPct: pct(absent),
  };
});

const dashboardScopeLabel = computed(() => {
  if (filters.value.class_id && selectedClass.value) {
    return className(selectedClass.value);
  }
  return t("Whole school");
});

const dashboardChartSeries = computed(() => {
  const r = dashboardRate.value;
  return [r.come, r.permission, r.absent];
});

const dashboardChartOptions = computed(() => ({
  labels: [t("Present"), t("Ask Permission"), t("Absent")],
  colors: ["#28C76F", "#EF6C00", "#EA5455"],
  chart: {
    type: "donut",
    fontFamily: "inherit",
  },
  legend: {
    position: "bottom",
    fontSize: "13px",
    fontWeight: 600,
  },
  dataLabels: {
    enabled: true,
    formatter: (val) => `${Math.round(val)}%`,
    style: { fontSize: "12px", fontWeight: 700 },
    dropShadow: { enabled: false },
  },
  plotOptions: {
    pie: {
      donut: {
        size: "62%",
        labels: {
          show: true,
          name: {
            show: true,
            fontSize: "13px",
            fontWeight: 600,
            offsetY: -4,
          },
          value: {
            show: true,
            fontSize: "22px",
            fontWeight: 800,
            offsetY: 4,
            formatter: () => String(dashboardRate.value.total),
          },
          total: {
            show: true,
            label: t("Students"),
            fontSize: "12px",
            fontWeight: 600,
            formatter: () => String(dashboardRate.value.total),
          },
        },
      },
    },
  },
  stroke: { width: 2 },
  tooltip: {
    y: {
      formatter: (val, opts) => {
        const total = dashboardRate.value.total || 1;
        const p = Math.round((Number(val) / total) * 1000) / 10;
        return `${val} (${p}%)`;
      },
    },
  },
  responsive: [
    {
      breakpoint: 600,
      options: {
        chart: { height: 260 },
        legend: { position: "bottom" },
      },
    },
  ],
}));

const dashboardRateCards = computed(() => {
  const r = dashboardRate.value;
  return [
    {
      key: "present",
      label: t("Present"),
      count: r.come,
      pct: r.comePct,
      tone: "present",
      icon: "tabler-circle-check",
    },
    {
      key: "permission",
      label: t("Ask Permission"),
      count: r.permission,
      pct: r.permissionPct,
      tone: "permission",
      icon: "tabler-file-text",
    },
    {
      key: "absent",
      label: t("Absent"),
      count: r.absent,
      pct: r.absentPct,
      tone: "absent",
      icon: "tabler-circle-x",
    },
  ];
});

function sessionLabel(session) {
  if (session === "AM") return t("Morning");
  if (session === "PM") return t("Afternoon");
  return "";
}

function today() {
  const d = new Date();
  const m = String(d.getMonth() + 1).padStart(2, "0");
  const day = String(d.getDate()).padStart(2, "0");
  return `${d.getFullYear()}-${m}-${day}`;
}

/** Parse Y-m-d / d-m-Y / d/m/Y without UTC shift. */
function parseLocalDate(value) {
  if (!value) return null;
  const raw = String(value).trim();
  let m = raw.match(/^(\d{4})[-/](\d{1,2})[-/](\d{1,2})/);
  if (m) return new Date(Number(m[1]), Number(m[2]) - 1, Number(m[3]));
  m = raw.match(/^(\d{1,2})[-/](\d{1,2})[-/](\d{4})/);
  if (m) return new Date(Number(m[3]), Number(m[2]) - 1, Number(m[1]));
  const d = new Date(raw);
  return Number.isNaN(d.getTime()) ? null : d;
}

/** ISO weekday: 1=Mon … 7=Sun (matches schedules.day_id). */
function isoWeekday(date) {
  const d = parseLocalDate(date);
  if (!d) return null;
  const w = d.getDay();
  return w === 0 ? 7 : w;
}

/** Subject needs class; single date also needs a date (day schedule). */
const canSelectSubject = computed(() => {
  if (!filters.value.class_id) return false;
  if (filters.value.period === "date") return !!filters.value.date;
  return true;
});

/** Filters changed since last Search — remind user to click Search. */
const filtersDirty = computed(() => {
  if (!lastSearchedKey.value || !canSearch()) return false;
  return searchKey(payload()) !== lastSearchedKey.value;
});

function searchKey(body) {
  return JSON.stringify(body);
}

function pickLabel(item, enKey = "name_en", khKey = "name_kh") {
  if (!item) return "";
  return locale.value === "km"
    ? item[khKey] || item[enKey] || ""
    : item[enKey] || item[khKey] || "";
}

function gradeTitle(item) {
  if (item?.grade_level != null) {
    return locale.value === "km"
      ? `កម្រិត ${item.grade_level}`
      : `Level ${item.grade_level}`;
  }
  return pickLabel(item);
}

function className(cls) {
  return pickLabel(cls);
}

function studentName(row) {
  return pickLabel(row);
}

function rowClassName(row) {
  return pickLabel(row, "class_name_en", "class_name_kh");
}

function studentInitial(row) {
  const name = studentName(row) || "?";
  return name.trim().charAt(0).toUpperCase();
}

/** 0 → blank, any count → truthy mark for status button */
function markCell(n) {
  return Number(n) > 0;
}

function countOrEmpty(n) {
  const v = Number(n);
  return v > 0 ? v : "";
}

function periodLabel(period) {
  if (period === "date") return t("Date");
  if (period === "range") return t("Date range");
  return t("Month");
}

function payload() {
  const f = filters.value;
  const body = {
    class_id: f.class_id || null,
    session: f.session || null,
    subject_id: f.subject_id || null,
  };

  if (f.period === "date") body.date = f.date;
  if (f.period === "range") {
    body.date_from = f.date_from;
    body.date_to = f.date_to;
  }
  if (f.period === "month") body.month_id = f.month_id;

  return body;
}

function canSearch() {
  const f = filters.value;

  // Report page: grade + class + month + subject required
  if (isReportMode.value) {
    return !!(f.grade_id && f.class_id && f.month_id && f.subject_id);
  }

  // Dashboard: today (or chosen day) — class optional
  return !!f.date;
}

/**
 * Search rule:
 * - Report: click Search after filters
 * - Dashboard: auto on open / when date·class·grade change
 */
async function search() {
  if (!canSearch()) return;
  const body = payload();
  // Dashboard summary: never filter by subject
  if (isDashboardMode.value) body.subject_id = null;
  await load(body);
  lastSearchedKey.value = searchKey(body);
  statusFilter.value = "all";
}

async function loadOptions() {
  grades.value = (await getGrades()) || [];
  allClasses.value = (await getClasses()) || [];
  months.value = (await getMonths()) || [];
}

/**
 * Date → subjects for that weekday only (like Check Attendance).
 * Range / month → all subjects on the class schedule.
 */
async function loadScheduleSubjects() {
  const classId = filters.value.class_id;
  if (!classId) {
    subjects.value = [];
    if (!props.subjectId) filters.value.subject_id = null;
    return;
  }

  let dayId = null;
  if (filters.value.period === "date") {
    dayId = isoWeekday(filters.value.date);
    if (!dayId) {
      subjects.value = [];
      if (!props.subjectId) filters.value.subject_id = null;
      return;
    }
  }

  subjects.value = (await getSubjectsFromSchedule(classId, dayId)) || [];

  const selected = filters.value.subject_id;
  if (
    selected &&
    !subjects.value.some((s) => Number(s.id) === Number(selected))
  ) {
    filters.value.subject_id = null;
  }

  // Single-date + exactly one subject → auto-select
  if (
    filters.value.period === "date" &&
    !filters.value.subject_id &&
    subjects.value.length === 1
  ) {
    filters.value.subject_id = Number(subjects.value[0].id);
  }
}

watch(
  () => [
    settingStore.year_id,
    settingStore.branch_id,
    settingStore.curriculum_id,
  ],
  async () => {
    if (!ready.value) return;
    await loadOptions();
    if (props.lockClass && props.classId) {
      filters.value.class_id = Number(props.classId);
    }
    await loadScheduleSubjects();
    // Context changed → refresh once
    if ((props.autoLoad || isDashboardMode.value) && canSearch())
      await search();
  },
);

watch(
  () => filters.value.grade_id,
  async () => {
    if (props.lockClass) return;
    filters.value.class_id = null;
    filters.value.subject_id = null;
    if (isDashboardMode.value && ready.value && canSearch()) await search();
  },
);

watch(
  () => filters.value.class_id,
  async () => {
    if (!ready.value) return;
    if (!props.subjectId) filters.value.subject_id = null;
    if (isReportMode.value) await loadScheduleSubjects();
    if (isDashboardMode.value && canSearch()) await search();
  },
);

watch(
  () => [filters.value.date, filters.value.period],
  async ([date, period], [prevDate, prevPeriod]) => {
    if (!ready.value) return;
    if (isReportMode.value) {
      if (!props.subjectId && (date !== prevDate || period !== prevPeriod)) {
        filters.value.subject_id = null;
      }
      await loadScheduleSubjects();
      return;
    }
    // Dashboard: changing day refreshes summary
    if (isDashboardMode.value && canSearch()) await search();
  },
);

onMounted(async () => {
  await loadOptions();
  if (props.classId) filters.value.class_id = Number(props.classId);
  if (isReportMode.value) await loadScheduleSubjects();
  ready.value = true;
  if (props.autoLoad && canSearch()) await search();
});

defineExpose({
  search,
  filters,
  summary,
  students,
  studentsAbsent,
  studentsPermission,
});
</script>

<template>
  <AppCard
    :title="pageTitle"
    title-icon="tabler-report-analytics"
    :is-back="isBack"
    :is-filter="!hideFilters"
    :show-filters="!hideFilters && !smAndDown"
    :loading="isLoading"
  >
    <!-- Filters -->
    <template v-if="!hideFilters" #filter>
      <div class="report-filters">
        <VRow dense class="align-end">
          <VCol v-if="!lockClass" cols="6" sm="4" md="2">
            <AppAutocomplete
              v-model="filters.grade_id"
              :items="grades"
              :item-title="gradeTitle"
              item-value="id"
              :placeholder="t('Grade')"
              :clearable="!isReportMode"
              hide-details
            />
          </VCol>

          <VCol v-if="!lockClass" cols="6" sm="4" md="2">
            <AppAutocomplete
              v-model="filters.class_id"
              :items="filteredClasses"
              :item-title="classTitle"
              item-value="id"
              :placeholder="t('Class')"
              :clearable="!isReportMode"
              hide-details
              :disabled="isReportMode && !filters.grade_id"
            />
          </VCol>

          <!-- Report: month + subject required in filter bar -->
          <VCol v-if="isReportMode" cols="6" sm="4" md="2">
            <AppAutocomplete
              v-model="filters.month_id"
              :items="months"
              :item-title="(m) => pickLabel(m)"
              item-value="id"
              :placeholder="t('Month')"
              hide-details
            />
          </VCol>

          <VCol v-if="isReportMode" cols="6" sm="4" md="2">
            <AppAutocomplete
              v-model="filters.subject_id"
              :items="subjects"
              :item-title="(s) => pickLabel(s)"
              item-value="id"
              :placeholder="t('Subject')"
              hide-details
              :disabled="!canSelectSubject || !subjects.length"
            />
          </VCol>

          <VCol v-if="isDashboardMode" cols="6" sm="4" md="2">
            <AppDateTimePicker
              v-model="filters.date"
              :placeholder="t('Date')"
            />
          </VCol>

          <VCol v-if="isReportMode" cols="12" sm="4" md="2">
            <VBtn
              color="primary"
              :variant="filtersDirty ? 'flat' : 'tonal'"
              class="search-btn"
              :block="smAndDown"
              :disabled="!canSearch() || isLoading"
              :loading="isLoading"
              @click="search"
            >
              <VIcon icon="tabler-search" start />
              {{ t("Search") }}
            </VBtn>
          </VCol>
        </VRow>
      </div>
    </template>

    <div class="report-body">
      <!-- Dashboard: date footer + status cards (no table) -->
      <div v-if="isDashboardMode" class="report-meta">
        <div class="report-meta__footer">
          <div v-if="rangeLabel" class="report-meta__date">
            <VIcon icon="tabler-calendar" size="18" />
            <span>{{ rangeLabel }}</span>
          </div>
        </div>
      </div>

      <VAlert v-if="error" type="error" variant="tonal" class="mb-3">
        {{ error }}
      </VAlert>

      <template v-if="isDashboardMode">
        <VAlert
          v-if="!isLoading && lastSearchedKey && !students.length"
          type="info"
          variant="tonal"
          class="mb-3"
        >
          {{ t("No attendance data") }}
        </VAlert>

        <template
          v-else-if="
            students.length ||
            studentsAbsent.length ||
            studentsPermission.length
          "
        >
          <!-- Percentages + donut (class or whole school) -->
          <div class="dashboard-rate mb-4">
            <div class="dashboard-rate__head">
              <div>
                <!-- <div class="dashboard-rate__title">
                  {{ t("Attendance rate") }}
                </div> -->
                <!-- <div class="dashboard-rate__scope text-medium-emphasis">
                  {{ dashboardScopeLabel }}
                  <span v-if="rangeLabel"> · {{ rangeLabel }}</span>
                </div> -->
              </div>
            </div>

            <VRow dense class="align-center">
              <VCol cols="12" md="9">
                <div class="status-filters mb-3">
                  <button
                    v-for="item in STATUS_FILTERS"
                    :key="item.value"
                    type="button"
                    class="status-chip"
                    :class="[
                      `status-chip--${item.color}`,
                      { 'status-chip--active': statusFilter === item.value },
                    ]"
                    @click="statusFilter = item.value"
                  >
                    {{ item.label }}
                  </button>
                </div>

                <VRow dense class="dashboard-attendance d-flex justify-end">
                  <VCol
                    v-for="panel in visibleDashboardPanels"
                    :key="panel.key"
                    cols="12"
                    :md="dashboardPanelCols"
                  >
                    <div
                      class="event-panel"
                      :class="`event-panel--${panel.tone}`"
                    >
                      <div class="event-panel__title">
                        <VIcon :icon="panel.icon" size="18" />
                        {{ panel.title }}
                        <span class="event-panel__badge">{{
                          panel.items.length
                        }}</span>
                      </div>
                      <div class="event-panel__list">
                        <div
                          v-if="!panel.items.length"
                          class="event-row event-row--empty text-medium-emphasis"
                        >
                          {{ t("No students") }}
                        </div>
                        <div
                          v-for="(item, i) in panel.items"
                          :key="`${panel.key}-${item.student_id}-${item.date}-${item.session}-${i}`"
                          class="event-row"
                        >
                          <div class="event-row__name">
                            {{ studentName(item) }}
                          </div>
                          <div class="event-row__meta">
                            <span v-if="item.date">{{ item.date }}</span>
                            <span v-if="sessionLabel(item.session)">
                              · {{ sessionLabel(item.session) }}
                            </span>
                            <span v-if="rowClassName(item)">
                              · {{ rowClassName(item) }}
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </VCol>
                </VRow>
              </VCol>

              <VCol cols="12" md="3" class="d-flex justify-center">
                <VueApexCharts
                  type="donut"
                  height="280"
                  :options="dashboardChartOptions"
                  :series="dashboardChartSeries"
                />
              </VCol>

              <!-- <VCol cols="12" md="7">
                <div class="dashboard-rate__cards">
                  <button
                    v-for="card in dashboardRateCards"
                    :key="card.key"
                    type="button"
                    class="rate-card"
                    :class="[
                      `rate-card--${card.tone}`,
                      { 'rate-card--active': statusFilter === card.key },
                    ]"
                    @click="statusFilter = card.key"
                  >
                    <div class="rate-card__top">
                      <VIcon :icon="card.icon" size="18" />
                      <span>{{ card.label }}</span>
                    </div>
                    <div class="rate-card__pct">{{ card.pct }}%</div>
                    <div class="rate-card__count">
                      {{ card.count }} / {{ dashboardRate.total }}
                      {{ t("Students") }}
                    </div>
                  </button>
                </div>
              </VCol> -->
            </VRow>
          </div>
        </template>
      </template>

      <!-- Report page: stats + table detail -->
      <template v-if="isReportMode">
        <!-- Report: hint when required filters missing -->
        <div class="report-meta">
          <div v-if="filtersDirty" class="report-meta__hint text-warning">
            <VIcon icon="tabler-info-circle" size="16" />
            <span>{{ t("Filters changed — click Search") }}</span>
          </div>
          <VAlert
            v-else-if="!canSearch()"
            type="info"
            variant="tonal"
            density="compact"
            class="mb-0"
          >
            {{ t("Select grade, class, month and subject") }}
          </VAlert>
          <div class="report-meta__footer">
            <div v-if="rangeLabel" class="report-meta__date">
              <VIcon icon="tabler-calendar" size="18" />
              <span>{{ rangeLabel }}</span>
            </div>
            <div
              v-if="studentCount"
              class="report-meta__count text-medium-emphasis"
            >
              {{ studentCount }} {{ t("Students") }}
            </div>
          </div>
        </div>

        <!-- Summary cards (click to filter students) -->
        <div class="stat-grid mb-4">
          <div
            v-for="stat in STATS"
            :key="stat.key"
            class="stat-card"
            :class="[
              `stat-card--${stat.color}`,
              {
                'stat-card--clickable': [
                  'present',
                  'permission',
                  'absent',
                  'total',
                ].includes(stat.key),
                'stat-card--active':
                  (stat.key === 'total' && statusFilter === 'all') ||
                  statusFilter === stat.key,
              },
            ]"
            @click="
              stat.key === 'total'
                ? (statusFilter = 'all')
                : ['present', 'permission', 'absent'].includes(stat.key)
                  ? setStatusFilter(stat.key)
                  : null
            "
          >
            <div class="stat-card__text">
              <div class="stat-card__label">{{ t(stat.label) }}</div>
              <div class="stat-card__value">{{ summary[stat.key] }}</div>
            </div>
            <VIcon :icon="stat.icon" class="stat-card__icon" size="26" />
          </div>
        </div>

        <!-- Status filter chips -->
        <div v-if="students.length" class="status-filters mb-3">
          <button
            v-for="item in STATUS_FILTERS"
            :key="item.value"
            type="button"
            class="status-chip"
            :class="[
              `status-chip--${item.color}`,
              { 'status-chip--active': statusFilter === item.value },
            ]"
            @click="statusFilter = item.value"
          >
            {{ item.label }}
          </button>
        </div>

        <!-- Quick lists: who was absent / had permission -->
        <!-- <VRow
        v-if="studentsAbsent.length || studentsPermission.length"
        class="mb-4"
        dense
      >
        <VCol v-if="studentsAbsent.length" cols="12" md="6">
          <div class="event-panel event-panel--absent">
            <div class="event-panel__title">
              <VIcon icon="tabler-circle-x" size="18" />
              {{ t("Absent students") }}
              <span class="event-panel__badge">{{
                studentsAbsent.length
              }}</span>
            </div>
            <div class="event-panel__list">
              <div
                v-for="(item, i) in studentsAbsent"
                :key="`abs-${item.student_id}-${item.date}-${item.session}-${i}`"
                class="event-row"
              >
                <div class="event-row__name">{{ studentName(item) }}</div>
                <div class="event-row__meta">
                  <span>{{ item.date }}</span>
                  <span v-if="item.session"
                    >·
                    {{
                      item.session === "AM" ? t("Morning") : t("Afternoon")
                    }}</span
                  >
                  <span v-if="showClassColumn || rowClassName(item)"
                    >· {{ rowClassName(item) }}</span
                  >
                </div>
              </div>
            </div>
          </div>
        </VCol>

        <VCol v-if="studentsPermission.length" cols="12" md="6">
          <div class="event-panel event-panel--permission">
            <div class="event-panel__title">
              <VIcon icon="tabler-file-text" size="18" />
              {{ t("Permission students") }}
              <span class="event-panel__badge">{{
                studentsPermission.length
              }}</span>
            </div>
            <div class="event-panel__list">
              <div
                v-for="(item, i) in studentsPermission"
                :key="`per-${item.student_id}-${item.date}-${item.session}-${i}`"
                class="event-row"
              >
                <div class="event-row__name">{{ studentName(item) }}</div>
                <div class="event-row__meta">
                  <span>{{ item.date }}</span>
                  <span v-if="item.session"
                    >·
                    {{
                      item.session === "AM" ? t("Morning") : t("Afternoon")
                    }}</span
                  >
                  <span v-if="showClassColumn || rowClassName(item)"
                    >· {{ rowClassName(item) }}</span
                  >
                </div>
              </div>
            </div>
          </div>
        </VCol>
      </VRow> -->

        <VAlert
          v-if="!isLoading && lastSearchedKey && !students.length"
          type="info"
          variant="tonal"
        >
          {{ t("No attendance data") }}
        </VAlert>

        <VAlert
          v-else-if="!isLoading && students.length && !filteredStudents.length"
          type="info"
          variant="tonal"
        >
          {{ t("No students match this filter") }}
        </VAlert>

        <!-- Desktop table -->
        <div v-if="filteredStudents.length && !smAndDown" class="table-wrap">
          <VTable
            fixed-header
            height="calc(100dvh - 380px)"
            density="comfortable"
            class="report-table"
          >
            <thead>
              <tr>
                <th class="text-center" style="width: 48px">#</th>
                <th>{{ t("Name") }}</th>
                <th v-if="showClassColumn">{{ t("Class") }}</th>
                <th>{{ t("Gender") }}</th>
                <th class="text-center">{{ t("Present") }}</th>
                <th class="text-center">{{ t("Late") }}</th>
                <th class="text-center">{{ t("Ask Permission") }}</th>
                <th class="text-center">{{ t("Absent") }}</th>
              </tr>
            </thead>
            <tbody>
              <tr
                v-for="(row, index) in filteredStudents"
                :key="`${row.student_id}-${row.class_id}`"
              >
                <td class="text-center text-medium-emphasis">
                  {{ row.sort || index + 1 }}
                </td>
                <td class="font-weight-medium">{{ studentName(row) }}</td>
                <td v-if="showClassColumn">{{ rowClassName(row) }}</td>
                <td>{{ formatGender(row.gender) }}</td>
                <td class="text-center">
                  <VBtn
                    v-if="markCell(row.present)"
                    color="success"
                    size="x-small"
                    variant="flat"
                    class="status-dot"
                  />
                </td>
                <td class="text-center">
                  <VBtn
                    v-if="markCell(row.late)"
                    color="warning"
                    size="x-small"
                    variant="flat"
                    class="status-dot"
                  />
                </td>
                <td class="text-center">
                  <VBtn
                    v-if="markCell(row.permission)"
                    color="#ef6c00"
                    size="x-small"
                    variant="flat"
                    class="status-dot"
                  />
                </td>
                <td class="text-center">
                  <VBtn
                    v-if="markCell(row.absent)"
                    color="error"
                    size="x-small"
                    variant="flat"
                    class="status-dot"
                  />
                </td>
              </tr>
            </tbody>
          </VTable>
        </div>

        <!-- Phone cards -->
        <div v-if="filteredStudents.length && smAndDown" class="mobile-list">
          <div
            v-for="(row, index) in filteredStudents"
            :key="`${row.student_id}-${row.class_id}`"
            class="mobile-card"
          >
            <div class="mobile-card__head">
              <div class="mobile-card__avatar">
                {{ studentInitial(row) }}
              </div>
              <div class="mobile-card__who">
                <div class="mobile-card__name">
                  <span class="mobile-card__index"
                    >{{ row.sort || index + 1 }}.</span
                  >
                  {{ studentName(row) }}
                </div>
                <div class="mobile-card__sub">
                  <span>{{ formatGender(row.gender) }}</span>
                  <span v-if="showClassColumn || rowClassName(row)">
                    · {{ rowClassName(row) }}
                  </span>
                </div>
              </div>
              <div class="mobile-card__total">
                <span class="mobile-card__total-num">{{
                  countOrEmpty(row.total)
                }}</span>
                <span class="mobile-card__total-label">{{ t("Total") }}</span>
              </div>
            </div>

            <div class="mobile-card__counts">
              <div
                v-for="cell in COUNT_CELLS"
                :key="cell.key"
                class="count-pill"
                :class="`count-pill--${cell.pill}`"
              >
                <VBtn
                  v-if="markCell(row[cell.key])"
                  :color="cell.color"
                  size="x-small"
                  icon
                  variant="flat"
                  class="status-dot"
                />
                <span v-else class="count-pill__num">&nbsp;</span>
                <span class="count-pill__label">{{ t(cell.label) }}</span>
              </div>
            </div>
          </div>
        </div>
      </template>
    </div>
  </AppCard>
</template>

<style scoped>
.report-body {
  padding-block: 4px;
}

.report-meta {
  display: flex;
  flex-direction: column;
  gap: 8px;
  margin-bottom: 12px;
}

.report-meta__footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
  flex-wrap: wrap;
}

.report-meta__hint {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-size: 0.82rem;
  font-weight: 600;
}

.report-meta__date {
  display: inline-flex;
  align-items: center;
  gap: 6px;
  font-weight: 600;
  font-size: 0.95rem;
}

.period-toggle {
  display: flex;
  width: 100%;
  padding: 3px;
  border-radius: 10px;
  background: rgba(var(--v-theme-on-surface), 0.06);
  gap: 2px;
}

.period-toggle__btn {
  flex: 1;
  border: 0;
  background: transparent;
  border-radius: 8px;
  padding: 8px 6px;
  font-size: 0.8rem;
  font-weight: 600;
  cursor: pointer;
  color: rgba(var(--v-theme-on-surface), 0.7);
  white-space: nowrap;
}

.period-toggle__btn--active {
  background: rgb(var(--v-theme-surface));
  color: rgb(var(--v-theme-primary));
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
}

.search-btn {
  min-height: 40px;
  width: 100%;
}

.status-dot {
  pointer-events: none;
  width: 18px !important;
  height: 18px !important;
  min-width: 18px !important;
}

/* Summary cards */
.stat-grid {
  display: grid;
  grid-template-columns: repeat(5, minmax(0, 1fr));
  gap: 10px;
}

.stat-card {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
  padding: 12px 14px;
  border-radius: 5px;
  min-height: 72px;
}

.stat-card__label {
  font-size: 0.75rem;
  font-weight: 500;
  opacity: 0.85;
  line-height: 1.2;
}

.stat-card__value {
  font-size: 1.45rem;
  font-weight: 700;
  line-height: 1.2;
  margin-top: 2px;
}

.stat-card__icon {
  opacity: 0.85;
  flex: none;
}

.stat-card--clickable {
  cursor: pointer;
  transition:
    outline 0.15s ease,
    transform 0.15s ease;
}

.stat-card--clickable:hover {
  transform: translateY(-1px);
}

.stat-card--active {
  outline: 2px solid currentColor;
  outline-offset: 1px;
}

.status-filters {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
}

.status-chip {
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  background: transparent;
  border-radius: 999px;
  padding: 6px 14px;
  font-size: 0.8rem;
  font-weight: 600;
  cursor: pointer;
  color: rgba(var(--v-theme-on-surface), 0.7);
}

.status-chip--active.status-chip--primary {
  background: rgba(var(--v-theme-primary), 0.16);
  color: rgb(var(--v-theme-primary));
  border-color: rgba(var(--v-theme-primary), 0.35);
}

.status-chip--active.status-chip--success {
  background: rgba(var(--v-theme-success), 0.16);
  color: rgb(var(--v-theme-success));
  border-color: rgba(var(--v-theme-success), 0.35);
}

.status-chip--active.status-chip--orange {
  background: rgba(255, 152, 0, 0.16);
  color: #ef6c00;
  border-color: rgba(239, 108, 0, 0.35);
}

.status-chip--active.status-chip--error {
  background: rgba(var(--v-theme-error), 0.14);
  color: rgb(var(--v-theme-error));
  border-color: rgba(var(--v-theme-error), 0.35);
}

.stat-card--success {
  background: rgba(var(--v-theme-success), 0.14);
  color: rgb(var(--v-theme-success));
}
.stat-card--warning {
  background: rgba(var(--v-theme-warning), 0.16);
  color: rgb(var(--v-theme-warning));
}
.stat-card--orange {
  background: rgba(255, 152, 0, 0.14);
  color: #ef6c00;
}
.stat-card--error {
  background: rgba(var(--v-theme-error), 0.12);
  color: rgb(var(--v-theme-error));
}
.stat-card--primary {
  background: rgba(var(--v-theme-primary), 0.12);
  color: rgb(var(--v-theme-primary));
}

/* Desktop table */
.table-wrap {
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 5px;
  overflow: hidden;
}

.report-table :deep(th) {
  font-weight: 600 !important;
  white-space: nowrap;
  background: rgba(var(--v-theme-on-surface), 0.03) !important;
}

.report-table :deep(td),
.report-table :deep(th) {
  padding-block: 10px !important;
}

/* Phone student cards */
.mobile-list {
  display: flex;
  flex-direction: column;
  gap: 10px;
  padding-bottom: 8px;
}

.mobile-card {
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 14px;
  padding: 12px;
  background: rgb(var(--v-theme-surface));
}

.mobile-card__head {
  display: flex;
  align-items: center;
  gap: 10px;
  margin-bottom: 10px;
}

.mobile-card__avatar {
  width: 40px;
  height: 40px;
  border-radius: 50%;
  flex: none;
  display: flex;
  align-items: center;
  justify-content: center;
  font-weight: 700;
  font-size: 14px;
  background: rgba(var(--v-theme-primary), 0.12);
  color: rgb(var(--v-theme-primary));
}

.mobile-card__who {
  min-width: 0;
  flex: 1;
}

.mobile-card__name {
  font-weight: 700;
  font-size: 0.95rem;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.mobile-card__index {
  color: rgba(var(--v-theme-on-surface), 0.45);
  font-weight: 600;
  margin-inline-end: 2px;
}

.mobile-card__sub {
  font-size: 0.78rem;
  color: rgba(var(--v-theme-on-surface), 0.55);
  margin-top: 1px;
}

.mobile-card__total {
  flex: none;
  text-align: center;
  min-width: 44px;
  padding: 4px 8px;
  border-radius: 10px;
  background: rgba(var(--v-theme-primary), 0.1);
}

.mobile-card__total-num {
  display: block;
  font-weight: 800;
  font-size: 1.1rem;
  line-height: 1.1;
  color: rgb(var(--v-theme-primary));
}

.mobile-card__total-label {
  display: block;
  font-size: 0.65rem;
  color: rgba(var(--v-theme-on-surface), 0.55);
}

.mobile-card__counts {
  display: grid;
  grid-template-columns: repeat(4, minmax(0, 1fr));
  gap: 6px;
}

.count-pill {
  text-align: center;
  border-radius: 10px;
  padding: 8px 4px;
  min-height: 52px;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.count-pill__num {
  font-size: 1.1rem;
  font-weight: 800;
  line-height: 1.1;
}

.count-pill__label {
  font-size: 0.65rem;
  font-weight: 600;
  margin-top: 2px;
  line-height: 1.15;
  opacity: 0.85;
}

.count-pill--success {
  background: rgba(var(--v-theme-success), 0.12);
  color: rgb(var(--v-theme-success));
}
.count-pill--warning {
  background: rgba(var(--v-theme-warning), 0.14);
  color: rgb(var(--v-theme-warning));
}
.count-pill--orange {
  background: rgba(255, 152, 0, 0.12);
  color: #ef6c00;
}
.count-pill--error {
  background: rgba(var(--v-theme-error), 0.1);
  color: rgb(var(--v-theme-error));
}

/* Absent / permission quick lists */
.event-panel {
  border-radius: 12px;
  padding: 12px;
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  height: 100%;
}

.event-panel--absent {
  background: rgba(var(--v-theme-error), 0.05);
  border-color: rgba(var(--v-theme-error), 0.2);
}

.event-panel--permission {
  background: rgba(255, 152, 0, 0.06);
  border-color: rgba(255, 152, 0, 0.25);
}

.event-panel--present {
  background: rgba(var(--v-theme-success), 0.06);
  border-color: rgba(var(--v-theme-success), 0.25);
}

.event-panel__title {
  display: flex;
  align-items: center;
  gap: 6px;
  font-weight: 700;
  font-size: 0.9rem;
  margin-bottom: 8px;
}

.event-panel--absent .event-panel__title {
  color: rgb(var(--v-theme-error));
}

.event-panel--permission .event-panel__title {
  color: #ef6c00;
}

.event-panel--present .event-panel__title {
  color: rgb(var(--v-theme-success));
}

.event-row--empty {
  text-align: center;
  font-size: 0.85rem;
  padding: 12px 10px;
}

.dashboard-attendance {
  margin-top: 4px;
}

.dashboard-rate {
  padding: 14px;
  border-radius: 6px;
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  /* background: rgba(var(--v-theme-on-surface), 0.01); */
}

.dashboard-rate__title {
  font-weight: 700;
  font-size: 1rem;
}

.dashboard-rate__scope {
  font-size: 0.82rem;
  margin-top: 2px;
}

.dashboard-rate__cards {
  display: grid;
  grid-template-columns: repeat(3, minmax(0, 1fr));
  gap: 10px;
}

.rate-card {
  text-align: start;
  border-radius: 6px;
  padding: 12px 14px;
  border: 1px solid transparent;
  cursor: pointer;
  background: rgb(var(--v-theme-surface));
}

.rate-card__top {
  display: flex;
  align-items: center;
  gap: 6px;
  font-weight: 700;
  font-size: 0.82rem;
}

.rate-card__pct {
  margin-top: 6px;
  font-size: 1.6rem;
  font-weight: 800;
  line-height: 1.1;
}

.rate-card__count {
  margin-top: 4px;
  font-size: 0.75rem;
  opacity: 0.7;
  font-weight: 600;
}

.rate-card--present {
  background: rgba(var(--v-theme-success), 0.08);
  color: rgb(var(--v-theme-success));
  border-color: rgba(var(--v-theme-success), 0.25);
}
.rate-card--permission {
  background: rgba(255, 152, 0, 0.1);
  color: #ef6c00;
  border-color: rgba(239, 108, 0, 0.3);
}
.rate-card--absent {
  background: rgba(var(--v-theme-error), 0.08);
  color: rgb(var(--v-theme-error));
  border-color: rgba(var(--v-theme-error), 0.25);
}

.rate-card--active {
  outline: 2px solid currentColor;
  outline-offset: 1px;
}

@media (max-width: 700px) {
  .dashboard-rate__cards {
    grid-template-columns: 1fr;
  }
}

.event-panel__badge {
  margin-inline-start: auto;
  min-width: 24px;
  height: 24px;
  padding: 0 8px;
  border-radius: 999px;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  font-size: 0.75rem;
  font-weight: 700;
  background: rgba(var(--v-theme-on-surface), 0.08);
  color: rgba(var(--v-theme-on-surface), 0.8);
}

.event-panel__list {
  max-height: 220px;
  overflow-y: auto;
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.event-row {
  padding: 8px 10px;
  border-radius: 8px;
  background: rgb(var(--v-theme-surface));
}

.event-row__name {
  font-weight: 600;
  font-size: 0.88rem;
}

.event-row__meta {
  font-size: 0.75rem;
  color: rgba(var(--v-theme-on-surface), 0.55);
  margin-top: 2px;
}

/* Phone layout tweaks */
@media (max-width: 960px) {
  .stat-grid {
    grid-template-columns: repeat(3, minmax(0, 1fr));
  }
}

@media (max-width: 600px) {
  .stat-grid {
    grid-template-columns: repeat(2, minmax(0, 1fr));
    gap: 8px;
  }

  .stat-card {
    min-height: 64px;
    padding: 10px 12px;
  }

  .stat-card__value {
    font-size: 1.25rem;
  }

  .stat-card__icon {
    width: 22px;
    height: 22px;
  }

  /* Total spans full width on last row so the 5 cards don't look uneven */
  .stat-card:last-child {
    grid-column: 1 / -1;
  }

  .count-pill__label {
    font-size: 0.62rem;
  }
}
</style>
