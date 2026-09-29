<script setup>
import { computed, ref, watch } from "vue";
import { useI18n } from "vue-i18n";

const props = defineProps({
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
  existingDates: {
    type: Array,
    default: () => [],
  },
});

const emit = defineEmits(["update:isDialogVisible", "imported"]);

const { t, locale } = useI18n();

const currentYear = new Date().getFullYear();
const importYear = ref(currentYear);
const publicHoliday = ref([]);
const selectedDates = ref([]);
const importFetchLoading = ref(false);
const importLoading = ref(false);

const yearOptions = computed(() => {
  const years = [];
  for (let y = currentYear - 2; y <= currentYear + 3; y++) {
    years.push(y);
  }
  return years;
});

const existingSet = computed(() => new Set(props.existingDates));

const selectableHolidays = computed(() =>
  publicHoliday.value.filter((h) => !existingSet.value.has(h.date)),
);

const allSelected = computed({
  get() {
    return (
      selectableHolidays.value.length > 0 &&
      selectableHolidays.value.every((h) => selectedDates.value.includes(h.date))
    );
  },
  set(val) {
    if (val) {
      selectedDates.value = selectableHolidays.value.map((h) => h.date);
    } else {
      selectedDates.value = [];
    }
  },
});

const selectedCount = computed(() => selectedDates.value.length);

const formatHolidayDate = (dateStr) => {
  if (!dateStr) return "";
  const d = new Date(`${dateStr}T00:00:00`);
  return d.toLocaleDateString(locale.value === "km" ? "en-GB" : "en-GB", {
    day: "2-digit",
    month: "short",
    year: "numeric",
  });
};

const fetchHolidaysForYear = async (year) => {
  const targetYear = Number(year) || currentYear;
  importYear.value = targetYear;
  importFetchLoading.value = true;
  publicHoliday.value = [];
  selectedDates.value = [];

  try {
    const res = await fetch(
      `https://date.nager.at/api/v3/publicholidays/${targetYear}/KH`,
    );
    if (!res.ok) throw new Error(`Failed to load holidays for ${targetYear}`);
    const data = await res.json();
    publicHoliday.value = Array.isArray(data) ? data : [];
  } catch (error) {
    console.log("error", error);
    publicHoliday.value = [];
  } finally {
    importFetchLoading.value = false;
  }
};

const close = () => {
  emit("update:isDialogVisible", false);
};

const onImport = () => {
  if (!selectedDates.value.length) return;
  importLoading.value = true;
  try {
    const selected = publicHoliday.value.filter((h) =>
      selectedDates.value.includes(h.date),
    );
    emit("imported", selected);
    close();
  } finally {
    importLoading.value = false;
  }
};

watch(
  () => props.isDialogVisible,
  (visible) => {
    if (!visible) return;
    selectedDates.value = [];
    if (!publicHoliday.value.length || importYear.value !== currentYear) {
      fetchHolidaysForYear(currentYear);
    }
  },
);
</script>

<template>
  <VDialog
    :model-value="isDialogVisible"
    max-width="560px"
    persistent
    @update:model-value="emit('update:isDialogVisible', $event)"
  >
    <VCard class="import-holiday-dialog">
      <VCardItem class="import-holiday-dialog__header">
        <div class="d-flex align-center gap-3">
          <div class="import-holiday-dialog__icon">
            <VIcon icon="tabler-calendar-event" size="22" />
          </div>
          <div>
            <div class="import-holiday-dialog__title">
              {{ t("Import Public Holidays") }}
            </div>
            <div class="import-holiday-dialog__subtitle">
              {{ t("Cambodia national holidays") }}
            </div>
          </div>
        </div>
        <template #append>
          <IconBtn @click="close">
            <VIcon icon="tabler-x" />
          </IconBtn>
        </template>
      </VCardItem>

      <VCardText class="pt-2">
        <div class="text-caption text-medium-emphasis mb-1">
          {{ t("Import year") }}
        </div>
        <div class="d-flex align-center gap-3 mb-4">
          <VSelect
            v-model="importYear"
            :items="yearOptions"
            density="comfortable"
            hide-details
            class="import-holiday-dialog__year"
          />
          <VBtn
            class="import-holiday-dialog__load-btn"
            :loading="importFetchLoading"
            prepend-icon="tabler-refresh"
            @click="fetchHolidaysForYear(importYear)"
          >
            {{ t("Load") }}
          </VBtn>
        </div>

        <div class="d-flex align-center justify-space-between mb-2">
          <VCheckbox
            v-model="allSelected"
            :label="t('Select all')"
            density="compact"
            hide-details
            :disabled="!selectableHolidays.length"
          />
          <span class="text-caption text-medium-emphasis">
            {{ selectedCount }} / {{ publicHoliday.length }}
            {{ t("selected") }} · {{ importYear }}
          </span>
        </div>

        <div class="import-holiday-dialog__list">
          <div
            v-if="importFetchLoading"
            class="d-flex justify-center align-center py-10"
          >
            <VProgressCircular indeterminate color="primary" size="28" />
          </div>

          <div
            v-else-if="!publicHoliday.length"
            class="text-center text-medium-emphasis py-10"
          >
            {{ t("No holidays found") }}
          </div>

          <div
            v-for="holiday in publicHoliday"
            v-else
            :key="holiday.date"
            class="import-holiday-dialog__row"
            :class="{
              'import-holiday-dialog__row--disabled': existingSet.has(
                holiday.date,
              ),
            }"
          >
            <VCheckbox
              v-model="selectedDates"
              :value="holiday.date"
              density="compact"
              hide-details
              :disabled="existingSet.has(holiday.date)"
            />
            <div class="import-holiday-dialog__row-text">
              <div class="import-holiday-dialog__name">
                {{ holiday.name }}
              </div>
              <div class="import-holiday-dialog__local">
                {{ holiday.localName }}
              </div>
            </div>
            <div class="import-holiday-dialog__date">
              <template v-if="existingSet.has(holiday.date)">
                <VChip size="x-small" color="success" variant="tonal">
                  {{ t("Imported") }}
                </VChip>
              </template>
              <template v-else>
                {{ formatHolidayDate(holiday.date) }}
              </template>
            </div>
          </div>
        </div>
      </VCardText>

      <VDivider />

      <VCardText class="d-flex justify-end gap-3 py-3">
        <VBtn variant="tonal" color="secondary" @click="close">
          {{ t("Cancel") }}
        </VBtn>
        <VBtn
          class="import-holiday-dialog__import-btn"
          prepend-icon="tabler-download"
          :loading="importLoading"
          :disabled="!selectedCount"
          @click="onImport"
        >
          {{ t("Import") }}
        </VBtn>
      </VCardText>
    </VCard>
  </VDialog>
</template>

<style scoped>
.import-holiday-dialog {
  border-radius: 16px !important;
}

.import-holiday-dialog__header {
  padding-top: 16px;
  padding-bottom: 8px;
}

.import-holiday-dialog__icon {
  width: 40px;
  height: 40px;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: rgba(131, 224, 199, 0.35);
  color: #3d6b5c;
}

.import-holiday-dialog__title {
  font-size: 1.15rem;
  font-weight: 700;
  line-height: 1.3;
  color: rgb(var(--v-theme-on-surface));
}

.import-holiday-dialog__subtitle {
  font-size: 0.8125rem;
  color: rgba(var(--v-theme-on-surface), 0.55);
}

.import-holiday-dialog__year {
  max-width: 160px;
  flex: 1;
}

.import-holiday-dialog__load-btn {
  background: rgba(131, 224, 199, 0.45) !important;
  color: #2f5548 !important;
  box-shadow: none !important;
}

.import-holiday-dialog__list {
  max-height: 360px;
  overflow-y: auto;
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 12px;
}

.import-holiday-dialog__row {
  display: flex;
  align-items: center;
  gap: 4px;
  padding: 10px 12px;
  border-bottom: 1px solid rgba(var(--v-border-color), 0.4);
  transition: background 0.15s ease;
}

.import-holiday-dialog__row:last-child {
  border-bottom: none;
}

.import-holiday-dialog__row:hover {
  background: rgba(var(--v-theme-on-surface), 0.04);
}

.import-holiday-dialog__row--disabled {
  opacity: 0.55;
}

.import-holiday-dialog__row-text {
  flex: 1;
  min-width: 0;
}

.import-holiday-dialog__name {
  font-weight: 600;
  font-size: 0.9rem;
  line-height: 1.3;
}

.import-holiday-dialog__local {
  font-size: 0.8rem;
  color: rgba(var(--v-theme-on-surface), 0.55);
  line-height: 1.3;
}

.import-holiday-dialog__date {
  flex-shrink: 0;
  font-size: 0.8125rem;
  color: rgba(var(--v-theme-on-surface), 0.5);
  white-space: nowrap;
}

.import-holiday-dialog__import-btn {
  background: #7f9e8f !important;
  color: #fff !important;
  box-shadow: none !important;
}
</style>
