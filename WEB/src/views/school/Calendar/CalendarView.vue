<script setup>
import { computed, ref, onMounted } from "vue";
import { useI18n } from "vue-i18n";
import { useDisplay } from "vuetify";
import ImportHolidaysDialog from "./ImportHolidaysDialog.vue";
import { loadHolidays, saveHolidays, mergeHolidays } from "./calendarStorage";

const { t, locale } = useI18n();
const { mdAndUp } = useDisplay();

const today = new Date();
const viewYear = ref(today.getFullYear());
const viewMonth = ref(today.getMonth()); // 0-indexed
const holidays = ref([]);
const schoolEvents = ref([]); // frontend-only placeholder
const isImportDialogVisible = ref(false);

const WEEKDAY_KEYS = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

const pad2 = (n) => String(n).padStart(2, "0");

const toDateKey = (year, month, day) =>
  `${year}-${pad2(month + 1)}-${pad2(day)}`;

const isSameDay = (a, b) =>
  a.getFullYear() === b.getFullYear() &&
  a.getMonth() === b.getMonth() &&
  a.getDate() === b.getDate();

const monthLabel = computed(() => {
  const d = new Date(viewYear.value, viewMonth.value, 1);
  return d.toLocaleDateString(locale.value === "km" ? "km-KH" : "en-US", {
    month: "long",
  });
});

const monthTitleUpper = computed(() => monthLabel.value.toUpperCase());

const daysInMonth = computed(() =>
  new Date(viewYear.value, viewMonth.value + 1, 0).getDate(),
);

const holidayMap = computed(() => {
  const map = new Map();
  for (const h of holidays.value) {
    if (h?.date) map.set(h.date, h);
  }
  return map;
});

const eventMap = computed(() => {
  const map = new Map();
  for (const e of schoolEvents.value) {
    if (e?.date) map.set(e.date, e);
  }
  return map;
});

const monthHolidays = computed(() => {
  const prefix = `${viewYear.value}-${pad2(viewMonth.value + 1)}`;
  return holidays.value
    .filter((h) => h.date?.startsWith(prefix))
    .sort((a, b) => a.date.localeCompare(b.date));
});

const monthEvents = computed(() => {
  const prefix = `${viewYear.value}-${pad2(viewMonth.value + 1)}`;
  return schoolEvents.value.filter((e) => e.date?.startsWith(prefix));
});

const stats = computed(() => {
  const total = daysInMonth.value;
  const publicCount = monthHolidays.value.length;
  const eventCount = monthEvents.value.length;

  let weekdayHolidayCount = 0;
  for (const h of monthHolidays.value) {
    const d = new Date(`${h.date}T00:00:00`);
    const day = d.getDay();
    if (day !== 0 && day !== 6) weekdayHolidayCount += 1;
  }

  return {
    total,
    publicHolidays: publicCount,
    schoolEvents: eventCount,
    schoolDays: total - weekdayHolidayCount,
  };
});

const calendarCells = computed(() => {
  const year = viewYear.value;
  const month = viewMonth.value;
  const firstDay = new Date(year, month, 1).getDay();
  const total = daysInMonth.value;
  const cells = [];

  for (let i = 0; i < firstDay; i++) {
    cells.push({ empty: true, key: `e-${i}` });
  }

  for (let day = 1; day <= total; day++) {
    const dateKey = toDateKey(year, month, day);
    const dateObj = new Date(year, month, day);
    const weekday = dateObj.getDay();
    const holiday = holidayMap.value.get(dateKey) || null;
    const event = eventMap.value.get(dateKey) || null;

    cells.push({
      empty: false,
      key: dateKey,
      day,
      dateKey,
      weekday,
      isWeekend: weekday === 0 || weekday === 6,
      isToday: isSameDay(dateObj, today),
      holiday,
      event,
    });
  }

  return cells;
});

const existingDates = computed(() => holidays.value.map((h) => h.date));

const shortHolidayLabel = (localName) => {
  if (!localName) return "";
  return localName.length > 14 ? `${localName.slice(0, 13)}…` : localName;
};

const weekdayShort = (dateStr) => {
  const d = new Date(`${dateStr}T00:00:00`);
  return t(WEEKDAY_KEYS[d.getDay()]);
};

const dayNumber = (dateStr) => Number(dateStr.slice(-2));

const goPrev = () => {
  if (viewMonth.value === 0) {
    viewMonth.value = 11;
    viewYear.value -= 1;
  } else {
    viewMonth.value -= 1;
  }
};

const goNext = () => {
  if (viewMonth.value === 11) {
    viewMonth.value = 0;
    viewYear.value += 1;
  } else {
    viewMonth.value += 1;
  }
};

const goToday = () => {
  viewYear.value = today.getFullYear();
  viewMonth.value = today.getMonth();
};

const openImport = () => {
  isImportDialogVisible.value = true;
};

const onImported = (incoming) => {
  holidays.value = mergeHolidays(holidays.value, incoming);
  saveHolidays(holidays.value);
};

onMounted(() => {
  holidays.value = loadHolidays();
});
</script>

<template>
  <div class="calendar-page">
    <!-- Header -->
    <div class="calendar-page__header">
      <div>
        <h1 class="calendar-page__month">{{ monthLabel }}</h1>
        <div class="calendar-page__year">{{ viewYear }}</div>
      </div>

      <div class="calendar-page__actions">
        <VBtn
          variant="outlined"
          color="secondary"
          class="calendar-page__btn"
          prepend-icon="tabler-download"
          @click="openImport"
        >
          {{ t("Import") }}
        </VBtn>
        <VBtn
          variant="outlined"
          color="secondary"
          class="calendar-page__btn"
          @click="goToday"
        >
          {{ t("Today") }}
        </VBtn>
        <div class="calendar-page__nav">
          <VBtn
            icon
            variant="text"
            size="small"
            class="calendar-page__nav-btn"
            @click="goPrev"
          >
            <VIcon icon="tabler-chevron-left" />
          </VBtn>
          <VBtn
            icon
            size="small"
            color="primary"
            class="calendar-page__nav-btn calendar-page__nav-btn--next"
            @click="goNext"
          >
            <VIcon icon="tabler-chevron-right" />
          </VBtn>
        </div>
      </div>
    </div>

    <!-- Stats -->
    <div class="calendar-page__stats">
      <div class="stat-card">
        <div class="stat-card__value">{{ stats.total }}</div>
        <div class="stat-card__label">{{ t("Total days") }}</div>
      </div>
      <div class="stat-card stat-card--holiday">
        <div class="stat-card__value">{{ stats.publicHolidays }}</div>
        <div class="stat-card__label">{{ t("Public holidays") }}</div>
      </div>
      <div class="stat-card stat-card--event">
        <div class="stat-card__value">{{ stats.schoolEvents }}</div>
        <div class="stat-card__label">{{ t("School events") }}</div>
      </div>
      <div class="stat-card stat-card--school">
        <div class="stat-card__value">{{ stats.schoolDays }}</div>
        <div class="stat-card__label">{{ t("School days") }}</div>
      </div>
    </div>

    <div
      class="calendar-page__body"
      :class="{ 'calendar-page__body--stacked': !mdAndUp }"
    >
      <!-- Calendar grid -->
      <div class="calendar-grid-wrap">
        <div class="calendar-grid">
          <div
            v-for="key in WEEKDAY_KEYS"
            :key="key"
            class="calendar-grid__weekday"
            :class="{
              'calendar-grid__weekday--weekend': key === 'Sun' || key === 'Sat',
            }"
          >
            {{ t(key) }}
          </div>

          <div
            v-for="cell in calendarCells"
            :key="cell.key"
            class="calendar-grid__cell"
            :class="{
              'calendar-grid__cell--empty': cell.empty,
              'calendar-grid__cell--holiday': cell.holiday,
              'calendar-grid__cell--today': cell.isToday && !cell.holiday,
              'calendar-grid__cell--weekend': cell.isWeekend && !cell.holiday,
            }"
          >
            <template v-if="!cell.empty">
              <div
                class="calendar-grid__day"
                :class="{
                  'calendar-grid__day--today-ring':
                    cell.isToday && !cell.holiday,
                }"
              >
                {{ cell.day }}
              </div>
              <div v-if="cell.holiday" class="calendar-grid__holiday-label">
                {{
                  shortHolidayLabel(cell.holiday.localName || cell.holiday.name)
                }}
              </div>
            </template>
          </div>
        </div>

        <div class="calendar-legend">
          <div class="calendar-legend__item">
            <span
              class="calendar-legend__swatch calendar-legend__swatch--holiday"
            />
            {{ t("Public holiday") }}
          </div>
          <div class="calendar-legend__item">
            <span
              class="calendar-legend__swatch calendar-legend__swatch--event"
            />
            {{ t("School event") }}
          </div>
          <div class="calendar-legend__item">
            <span
              class="calendar-legend__swatch calendar-legend__swatch--today"
            />
            {{ t("Today") }}
          </div>
        </div>
      </div>

      <!-- Sidebar list -->
      <aside class="holiday-sidebar">
        <div class="holiday-sidebar__title">
          {{ monthTitleUpper }} — {{ t("Holidays & Events") }}
        </div>

        <div
          v-if="!monthHolidays.length && !monthEvents.length"
          class="holiday-sidebar__empty"
        >
          {{ t("No holidays or events this month") }}
        </div>

        <div
          v-for="item in monthHolidays"
          :key="item.date"
          class="holiday-sidebar__item"
        >
          <div class="holiday-sidebar__date">
            <span class="holiday-sidebar__day">{{ dayNumber(item.date) }}</span>
            <span class="holiday-sidebar__weekday">{{
              weekdayShort(item.date)
            }}</span>
          </div>
          <div class="holiday-sidebar__content">
            <div class="holiday-sidebar__name-kh">
              {{ item.localName || item.name }}
            </div>
            <div class="holiday-sidebar__name-en">{{ item.name }}</div>
            <div class="holiday-sidebar__type">{{ t("Public holiday") }}</div>
          </div>
          <VChip
            size="small"
            class="holiday-sidebar__badge"
            variant="tonal"
            color="error"
          >
            {{ t("Holiday") }}
          </VChip>
        </div>
      </aside>
    </div>

    <ImportHolidaysDialog
      v-model:is-dialog-visible="isImportDialogVisible"
      :existing-dates="existingDates"
      @imported="onImported"
    />
  </div>
</template>

<style scoped>
.calendar-page {
  padding: 4px 0 24px;
}

.calendar-page__header {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  gap: 16px;
  flex-wrap: wrap;
  margin-bottom: 20px;
}

.calendar-page__month {
  margin: 0;
  font-size: 2rem;
  font-weight: 700;
  line-height: 1.15;
  letter-spacing: -0.02em;
  color: rgb(var(--v-theme-on-surface));
}

.calendar-page__year {
  margin-top: 2px;
  font-size: 1.05rem;
  font-weight: 500;
  color: rgba(var(--v-theme-on-surface), 0.45);
}

.calendar-page__actions {
  display: flex;
  align-items: center;
  gap: 8px;
  flex-wrap: wrap;
}

.calendar-page__btn {
  text-transform: none;
  letter-spacing: 0;
  border-radius: 10px !important;
  font-weight: 500;
}

.calendar-page__nav {
  display: flex;
  align-items: center;
  gap: 4px;
  margin-left: 4px;
}

.calendar-page__nav-btn {
  border-radius: 50% !important;
}

.calendar-page__nav-btn--next {
  color: #fff !important;
}

/* Stats */
.calendar-page__stats {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 12px;
  margin-bottom: 20px;
}

.stat-card {
  background: #fff;
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 10px;
  padding: 14px 16px;
}

.stat-card__value {
  font-size: 1.5rem;
  font-weight: 700;
  line-height: 1.2;
  color: rgba(var(--v-theme-on-surface), 0.75);
}

.stat-card__label {
  margin-top: 2px;
  font-size: 0.8125rem;
  color: rgba(var(--v-theme-on-surface), 0.5);
}

.stat-card--holiday .stat-card__value,
.stat-card--holiday .stat-card__label {
  color: #e53935;
}

.stat-card--event .stat-card__value,
.stat-card--event .stat-card__label {
  color: #26a69a;
}

.stat-card--school .stat-card__value,
.stat-card--school .stat-card__label {
  color: #1e88e5;
}

/* Body layout */
.calendar-page__body {
  display: grid;
  grid-template-columns: 1fr 320px;
  gap: 20px;
  align-items: start;
}

.calendar-page__body--stacked {
  grid-template-columns: 1fr;
}

.calendar-grid-wrap {
  background: #fff;
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 5px;
  padding: 16px;
}

.calendar-grid {
  display: grid;
  grid-template-columns: repeat(7, 1fr);
  gap: 8px;
}

.calendar-grid__weekday {
  text-align: center;
  font-size: 0.8125rem;
  font-weight: 600;
  color: rgba(var(--v-theme-on-surface), 0.45);
  padding-bottom: 6px;
}

.calendar-grid__weekday--weekend {
  color: #e53935;
}

.calendar-grid__cell {
  aspect-ratio: 1 / 1;
  border: 1px solid rgba(var(--v-border-color), 0.55);
  border-radius: 12px;
  padding: 8px;
  display: flex;
  flex-direction: column;
  min-height: 0;
  background: #fff;
  overflow: hidden;
}

.calendar-grid__cell--empty {
  border-color: transparent;
  background: transparent;
}

.calendar-grid__cell--holiday {
  background: #e53935;
  border-color: #e53935;
  color: #fff;
}

.calendar-grid__cell--today {
  background: rgba(30, 136, 229, 0.1);
  border-color: rgba(30, 136, 229, 0.35);
}

.calendar-grid__day {
  font-size: 0.95rem;
  font-weight: 600;
  line-height: 1.2;
  width: fit-content;
}

.calendar-grid__cell--weekend .calendar-grid__day {
  color: #e53935;
}

.calendar-grid__day--today-ring {
  color: #1e88e5;
  border: 2px solid #1e88e5;
  border-radius: 50%;
  width: 28px;
  height: 28px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.calendar-grid__holiday-label {
  margin-top: auto;
  font-size: 0.65rem;
  line-height: 1.2;
  opacity: 0.95;
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

.calendar-legend {
  display: flex;
  flex-wrap: wrap;
  gap: 16px;
  margin-top: 16px;
  padding-top: 12px;
}

.calendar-legend__item {
  display: flex;
  align-items: center;
  gap: 8px;
  font-size: 0.8125rem;
  color: rgba(var(--v-theme-on-surface), 0.65);
}

.calendar-legend__swatch {
  width: 14px;
  height: 14px;
  border-radius: 4px;
  flex-shrink: 0;
}

.calendar-legend__swatch--holiday {
  background: #e53935;
}

.calendar-legend__swatch--event {
  border: 2px solid #66bb6a;
  background: transparent;
  border-radius: 50%;
}

.calendar-legend__swatch--today {
  border: 2px solid #64b5f6;
  background: transparent;
  border-radius: 50%;
}

/* Sidebar */
.holiday-sidebar {
  background: #fff;
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 5px;
  padding: 16px 18px;
  min-height: 200px;
}

.holiday-sidebar__title {
  font-size: 0.75rem;
  font-weight: 600;
  letter-spacing: 0.04em;
  text-transform: uppercase;
  color: rgba(var(--v-theme-on-surface), 0.45);
  margin-bottom: 12px;
}

.holiday-sidebar__empty {
  padding: 24px 0;
  text-align: center;
  font-size: 0.875rem;
  color: rgba(var(--v-theme-on-surface), 0.45);
}

.holiday-sidebar__item {
  display: flex;
  align-items: flex-start;
  gap: 12px;
  padding: 14px 0;
  border-bottom: 1px solid rgba(var(--v-border-color), 0.45);
}

.holiday-sidebar__item:last-child {
  border-bottom: none;
}

.holiday-sidebar__date {
  width: 40px;
  flex-shrink: 0;
  text-align: center;
  color: #e53935;
}

.holiday-sidebar__day {
  display: block;
  font-size: 1.15rem;
  font-weight: 700;
  line-height: 1.1;
}

.holiday-sidebar__weekday {
  display: block;
  font-size: 0.7rem;
  font-weight: 500;
  margin-top: 2px;
}

.holiday-sidebar__content {
  flex: 1;
  min-width: 0;
}

.holiday-sidebar__name-kh {
  font-weight: 600;
  font-size: 0.9rem;
  line-height: 1.35;
  color: rgb(var(--v-theme-on-surface));
}

.holiday-sidebar__name-en {
  font-size: 0.8125rem;
  color: rgba(var(--v-theme-on-surface), 0.55);
  margin-top: 1px;
}

.holiday-sidebar__type {
  font-size: 0.75rem;
  color: rgba(var(--v-theme-on-surface), 0.4);
  margin-top: 2px;
}

.holiday-sidebar__badge {
  flex-shrink: 0;
  align-self: center;
}

@media (max-width: 960px) {
  .calendar-page__stats {
    grid-template-columns: repeat(2, 1fr);
  }

  .calendar-page__month {
    font-size: 1.65rem;
  }

  .calendar-grid {
    gap: 4px;
  }

  .calendar-grid__cell {
    padding: 4px;
    border-radius: 8px;
  }

  .calendar-grid__day {
    font-size: 0.8rem;
  }

  .calendar-grid__day--today-ring {
    width: 22px;
    height: 22px;
  }

  .calendar-grid__holiday-label {
    font-size: 0.55rem;
  }
}

@media (max-width: 600px) {
  .calendar-page__stats {
    grid-template-columns: repeat(2, 1fr);
    gap: 8px;
  }

  .stat-card {
    padding: 10px 12px;
  }

  .stat-card__value {
    font-size: 1.25rem;
  }

  .calendar-grid__holiday-label {
    display: none;
  }
}
</style>
