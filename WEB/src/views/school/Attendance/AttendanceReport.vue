<script setup>
/**
 * Drop-in attendance report
 * -------------------------
 * <AttendanceReport />
 * <AttendanceReport :class-id="12" lock-class :is-back="false" />
 * <AttendanceReport period="month" :month-id="9" />
 *
 * Parent can call:  reportRef.value?.search()
 */
import { computed, onMounted, ref, watch } from "vue";
import { useI18n } from "vue-i18n";
import { useDisplay } from "vuetify";
import AppCard from "@/components/AppCard.vue";
import { useAttendanceReport } from "@/composables/useAttendanceReport";
import { getClasses, getGrades, getMonths } from "@/services/dataService";
import { useSettingStore } from "@/stores/settingStore";
import formatGender from "@/utils/formater/formatGender";

const props = defineProps({
  classId: { type: [Number, String], default: null },
  lockClass: { type: Boolean, default: false },
  period: { type: String, default: "date" }, // date | range | month
  date: { type: String, default: null },
  dateFrom: { type: String, default: null },
  dateTo: { type: String, default: null },
  monthId: { type: [Number, String], default: null },
  session: { type: String, default: null },
  hideFilters: { type: Boolean, default: false },
  autoLoad: { type: Boolean, default: true },
  isBack: { type: Boolean, default: true },
});

const PERIODS = ["date", "range", "month"];

const STATS = [
  { key: "present", label: "Present", color: "success", icon: "tabler-circle-check" },
  { key: "late", label: "Late", color: "warning", icon: "tabler-clock" },
  { key: "permission", label: "Ask Permission", color: "orange", icon: "tabler-file-text" },
  { key: "absent", label: "Absent", color: "error", icon: "tabler-circle-x" },
  { key: "total", label: "Total", color: "primary", icon: "tabler-sum" },
];

const COUNT_CELLS = [
  { key: "present", label: "Present", color: "success" },
  { key: "late", label: "Late", color: "warning" },
  { key: "permission", label: "Ask Permission", color: "orange" },
  { key: "absent", label: "Absent", color: "error" },
];

const { t, locale } = useI18n();
const { smAndDown } = useDisplay();
const settingStore = useSettingStore();
const { isLoading, error, dateFrom, dateTo, summary, students, studentsAbsent, studentsPermission, load } =
  useAttendanceReport();

const grades = ref([]);
const allClasses = ref([]);
const months = ref([]);

const filters = ref({
  grade_id: null,
  class_id: props.classId ? Number(props.classId) : null,
  period: PERIODS.includes(props.period) ? props.period : "date",
  date: props.date || today(),
  date_from: props.dateFrom || null,
  date_to: props.dateTo || null,
  month_id: props.monthId ? Number(props.monthId) : null,
  session: props.session || null,
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
  if (!filters.value.grade_id) return allClasses.value;
  return allClasses.value.filter((c) => c.grade_id == filters.value.grade_id);
});

const selectedClass = computed(() =>
  allClasses.value.find((c) => c.id == filters.value.class_id),
);

const pageTitle = computed(() => {
  const base = t("Attendance Report");
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

const studentCount = computed(() => students.value.length);

function today() {
  const d = new Date();
  const m = String(d.getMonth() + 1).padStart(2, "0");
  const day = String(d.getDate()).padStart(2, "0");
  return `${d.getFullYear()}-${m}-${day}`;
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
  if (f.period === "date") return !!f.date;
  if (f.period === "range") return !!(f.date_from && f.date_to);
  if (f.period === "month") return !!f.month_id;
  return false;
}

async function search() {
  if (!canSearch()) return;
  await load(payload());
}

async function loadOptions() {
  grades.value = (await getGrades()) || [];
  allClasses.value = (await getClasses()) || [];
  months.value = (await getMonths()) || [];
}

watch(
  () => [
    settingStore.year_id,
    settingStore.branch_id,
    settingStore.curriculum_id,
  ],
  async () => {
    await loadOptions();
    if (props.lockClass && props.classId) {
      filters.value.class_id = Number(props.classId);
    }
    if (props.autoLoad && canSearch()) await search();
  },
);

watch(
  () => filters.value.grade_id,
  () => {
    if (props.lockClass) return;
    filters.value.class_id = null;
  },
);

onMounted(async () => {
  await loadOptions();
  if (props.classId) filters.value.class_id = Number(props.classId);
  if (props.autoLoad && canSearch()) await search();
});

defineExpose({ search, filters, summary, students, studentsAbsent, studentsPermission });
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
              clearable
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
              clearable
              hide-details
            />
          </VCol>

          <VCol cols="6" sm="4" md="2">
            <AppAutocomplete
              v-model="filters.session"
              :items="sessions"
              item-title="title"
              item-value="value"
              :placeholder="t('Session')"
              clearable
              hide-details
            />
          </VCol>

          <VCol cols="12" sm="12" md="3">
            <div class="period-toggle">
              <button
                v-for="item in PERIODS"
                :key="item"
                type="button"
                class="period-toggle__btn"
                :class="{ 'period-toggle__btn--active': filters.period === item }"
                @click="filters.period = item"
              >
                {{ periodLabel(item) }}
              </button>
            </div>
          </VCol>

          <VCol v-if="filters.period === 'date'" cols="12" sm="6" md="2">
            <AppDateTimePicker
              v-model="filters.date"
              :placeholder="t('Date')"
            />
          </VCol>

          <template v-if="filters.period === 'range'">
            <VCol cols="6" sm="3" md="2">
              <AppDateTimePicker
                v-model="filters.date_from"
                :placeholder="t('From date')"
              />
            </VCol>
            <VCol cols="6" sm="3" md="2">
              <AppDateTimePicker
                v-model="filters.date_to"
                :placeholder="t('To date')"
              />
            </VCol>
          </template>

          <VCol v-if="filters.period === 'month'" cols="12" sm="6" md="2">
            <AppAutocomplete
              v-model="filters.month_id"
              :items="months"
              :item-title="(m) => pickLabel(m)"
              item-value="id"
              :placeholder="t('Month')"
              clearable
              hide-details
            />
          </VCol>

          <VCol cols="12" sm="6" md="2">
            <VBtn
              color="primary"
              class="search-btn"
              :block="smAndDown"
              :disabled="!canSearch()"
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
      <!-- Date + result hint -->
      <div v-if="rangeLabel || studentCount" class="report-meta">
        <div v-if="rangeLabel" class="report-meta__date">
          <VIcon icon="tabler-calendar" size="18" />
          <span>{{ rangeLabel }}</span>
        </div>
        <div v-if="studentCount" class="report-meta__count text-medium-emphasis">
          {{ studentCount }} {{ t("Students") }}
        </div>
      </div>

      <VAlert v-if="error" type="error" variant="tonal" class="mb-3">
        {{ error }}
      </VAlert>

      <!-- Summary cards -->
      <div class="stat-grid mb-4">
        <div
          v-for="stat in STATS"
          :key="stat.key"
          class="stat-card"
          :class="`stat-card--${stat.color}`"
        >
          <div class="stat-card__text">
            <div class="stat-card__label">{{ t(stat.label) }}</div>
            <div class="stat-card__value">{{ summary[stat.key] }}</div>
          </div>
          <VIcon :icon="stat.icon" class="stat-card__icon" size="26" />
        </div>
      </div>

      <!-- Quick lists: who was absent / had permission -->
      <VRow
        v-if="studentsAbsent.length || studentsPermission.length"
        class="mb-4"
        dense
      >
        <VCol v-if="studentsAbsent.length" cols="12" md="6">
          <div class="event-panel event-panel--absent">
            <div class="event-panel__title">
              <VIcon icon="tabler-circle-x" size="18" />
              {{ t("Absent students") }}
              <span class="event-panel__badge">{{ studentsAbsent.length }}</span>
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
                  <span v-if="item.session">· {{ item.session === 'AM' ? t('Morning') : t('Afternoon') }}</span>
                  <span v-if="showClassColumn || rowClassName(item)">· {{ rowClassName(item) }}</span>
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
              <span class="event-panel__badge">{{ studentsPermission.length }}</span>
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
                  <span v-if="item.session">· {{ item.session === 'AM' ? t('Morning') : t('Afternoon') }}</span>
                  <span v-if="showClassColumn || rowClassName(item)">· {{ rowClassName(item) }}</span>
                </div>
              </div>
            </div>
          </div>
        </VCol>
      </VRow>

      <VAlert
        v-if="!isLoading && !students.length"
        type="info"
        variant="tonal"
      >
        {{ t("No attendance data") }}
      </VAlert>

      <!-- Desktop table -->
      <div v-if="students.length && !smAndDown" class="table-wrap">
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
              <th class="text-center">{{ t("Total") }}</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(row, index) in students" :key="row.student_id">
              <td class="text-center text-medium-emphasis">
                {{ row.sort || index + 1 }}
              </td>
              <td class="font-weight-medium">{{ studentName(row) }}</td>
              <td v-if="showClassColumn">{{ rowClassName(row) }}</td>
              <td>{{ formatGender(row.gender) }}</td>
              <td class="text-center text-success font-weight-medium">
                {{ row.present }}
              </td>
              <td class="text-center text-warning font-weight-medium">
                {{ row.late }}
              </td>
              <td class="text-center font-weight-medium">
                {{ row.permission }}
              </td>
              <td class="text-center text-error font-weight-medium">
                {{ row.absent }}
              </td>
              <td class="text-center font-weight-bold">{{ row.total }}</td>
            </tr>
          </tbody>
        </VTable>
      </div>

      <!-- Phone cards -->
      <div v-if="students.length && smAndDown" class="mobile-list">
        <div
          v-for="(row, index) in students"
          :key="row.student_id"
          class="mobile-card"
        >
          <div class="mobile-card__head">
            <div class="mobile-card__avatar">
              {{ studentInitial(row) }}
            </div>
            <div class="mobile-card__who">
              <div class="mobile-card__name">
                <span class="mobile-card__index">{{ row.sort || index + 1 }}.</span>
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
              <span class="mobile-card__total-num">{{ row.total }}</span>
              <span class="mobile-card__total-label">{{ t("Total") }}</span>
            </div>
          </div>

          <div class="mobile-card__counts">
            <div
              v-for="cell in COUNT_CELLS"
              :key="cell.key"
              class="count-pill"
              :class="`count-pill--${cell.color}`"
            >
              <span class="count-pill__num">{{ row[cell.key] }}</span>
              <span class="count-pill__label">{{ t(cell.label) }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppCard>
</template>

<style scoped>
.report-body {
  padding-block: 4px;
}

.report-meta {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
  margin-bottom: 12px;
  flex-wrap: wrap;
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
  border-radius: 12px;
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
  border-radius: 12px;
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
