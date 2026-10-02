<script setup>
/**
 * One page: set monthly cutoff day + track which teacher/subject still missing scores.
 */
import { computed, onMounted, ref, watch } from "vue";
import { useI18n } from "vue-i18n";
import { useRouter } from "vue-router";
import { useDisplay } from "vuetify";
import AppCard from "@/components/AppCard.vue";
import { api } from "@/utils/api";
import { getClasses, getGrades, getMonths } from "@/services/dataService";
import { useSettingStore } from "@/stores/settingStore.js";
import hasPermission from "@/utils/hasPermission";

const { t, locale } = useI18n();
const router = useRouter();
const { mdAndUp } = useDisplay();
const settingStore = useSettingStore();

const canEditDeadline = computed(() =>
  hasPermission(["approve-score-entry", "edit-score-entry"]),
);

const isLoadingSetting = ref(false);
const isSavingSetting = ref(false);
const isLoadingStatus = ref(false);
const settingError = ref("");
const statusError = ref("");
const dialogError = ref("");

const cutoffDay = ref(null);
const draftCutoffDay = ref(null);
const showDeadlineDialog = ref(false);
const grades = ref([]);
const allClasses = ref([]);
const months = ref([]);
const rows = ref([]);
const summary = ref({ missing: 0, partial: 0, done: 0, total: 0 });
const windowInfo = ref({ locked: false, cutoff_day: null, close_date: null });

const filters = ref({
  month_id: null,
  grade_id: null,
  class_id: null,
  status: "all",
});

const hasYear = computed(() => {
  const id = settingStore.year_id;
  return id != null && id !== "" && id !== "*";
});

const statusOptions = computed(() => [
  { title: t("All"), value: "all" },
  { title: t("Missing"), value: "missing" },
  { title: t("Partial"), value: "partial" },
  { title: t("Done"), value: "done" },
]);

const filteredClasses = computed(() => {
  if (!filters.value.grade_id) return allClasses.value;
  return allClasses.value.filter((c) => c.grade_id == filters.value.grade_id);
});

const headers = computed(() => [
  { title: t("Class"), key: "class", sortable: true },
  { title: t("Subject"), key: "subject", sortable: true },
  { title: t("Teacher"), key: "teacher", sortable: true },
  { title: t("Progress"), key: "progress", sortable: false },
  { title: t("Status"), key: "status", sortable: true },
  { title: t("Action"), key: "actions", sortable: false, align: "center" },
]);

function label(en, kh) {
  return locale.value === "km" ? kh || en || "—" : en || kh || "—";
}

function statusColor(status) {
  if (status === "done") return "success";
  if (status === "partial") return "warning";
  return "error";
}

function statusLabel(status) {
  if (status === "done") return t("Done");
  if (status === "partial") return t("Partial");
  return t("Missing");
}

async function loadLookups() {
  grades.value = (await getGrades()) || [];
  allClasses.value = (await getClasses()) || [];
  months.value = (await getMonths()) || [];
}

async function loadSetting() {
  if (!hasYear.value) {
    cutoffDay.value = null;
    return;
  }

  isLoadingSetting.value = true;
  settingError.value = "";
  try {
    const res = await api.post("score-entry-setting-show");
    if (!res.data?.status) {
      settingError.value = res.data?.message || t("Failed to load deadline");
      return;
    }
    const day = res.data.data?.cutoff_day;
    cutoffDay.value = day != null ? Number(day) : null;
  } catch (e) {
    // Ignore abort from duplicate requests
    if (e?.code === "ERR_CANCELED" || e?.name === "CanceledError") return;
    settingError.value =
      e?.response?.data?.message || e.message || t("Failed to load deadline");
  } finally {
    isLoadingSetting.value = false;
  }
}

function openDeadlineDialog() {
  draftCutoffDay.value = cutoffDay.value != null ? Number(cutoffDay.value) : 26;
  dialogError.value = "";
  showDeadlineDialog.value = true;
}

function closeDeadlineDialog() {
  showDeadlineDialog.value = false;
  dialogError.value = "";
}

async function saveSetting() {
  if (!canEditDeadline.value) return;
  const day = Number(draftCutoffDay.value);
  if (!Number.isInteger(day) || day < 1 || day > 31) {
    dialogError.value = t("Cutoff day must be between 1 and 31");
    return;
  }

  isSavingSetting.value = true;
  dialogError.value = "";
  settingError.value = "";
  try {
    const res = await api.post("score-entry-setting-store", {
      cutoff_day: day,
      is_active: true,
    });
    if (!res.data?.status) {
      dialogError.value = res.data?.message || t("Failed to save deadline");
      return;
    }
    cutoffDay.value = res.data.data?.cutoff_day ?? day;
    showDeadlineDialog.value = false;
    if (filters.value.month_id) await loadStatus();
  } catch (e) {
    if (e?.code === "ERR_CANCELED" || e?.name === "CanceledError") return;
    dialogError.value =
      e?.response?.data?.message || e.message || t("Failed to save deadline");
  } finally {
    isSavingSetting.value = false;
  }
}

async function loadStatus() {
  if (!filters.value.month_id) {
    rows.value = [];
    summary.value = { missing: 0, partial: 0, done: 0, total: 0 };
    return;
  }

  isLoadingStatus.value = true;
  statusError.value = "";
  try {
    const res = await api.post("score-entry-status-list", {
      month_id: filters.value.month_id,
      grade_id: filters.value.grade_id || undefined,
      class_id: filters.value.class_id || undefined,
      status: filters.value.status || "all",
    });
    if (!res.data?.status) {
      statusError.value = res.data?.message || t("Failed to load status");
      rows.value = [];
      return;
    }
    rows.value = res.data.data?.rows || [];
    summary.value = res.data.data?.summary || {
      missing: 0,
      partial: 0,
      done: 0,
      total: 0,
    };
    windowInfo.value = res.data.data?.window || {
      locked: false,
      cutoff_day: null,
      close_date: null,
    };
    // Backup: keep textfield/chip in sync from status window too
    if (windowInfo.value.cutoff_day != null && cutoffDay.value == null) {
      cutoffDay.value = Number(windowInfo.value.cutoff_day);
    }
  } catch (e) {
    if (e?.code === "ERR_CANCELED" || e?.name === "CanceledError") return;
    statusError.value =
      e?.response?.data?.message || e.message || t("Failed to load status");
    rows.value = [];
  } finally {
    isLoadingStatus.value = false;
  }
}

function openScoreEntry(item) {
  router.push({
    name: "school-score-entry",
    query: {
      class_id: item.class_id,
      month_id: filters.value.month_id,
    },
  });
}

watch(
  () => [
    settingStore.year_id,
    settingStore.curriculum_id,
    settingStore.branch_id,
  ],
  async () => {
    await loadLookups();
    await loadSetting();
    filters.value.grade_id = null;
    filters.value.class_id = null;
    await loadStatus();
  },
);

watch(
  () => filters.value.grade_id,
  () => {
    filters.value.class_id = null;
  },
);

function gradeTitle(item) {
  if (!item) return "";
  const name =
    locale.value === "km"
      ? item.name_kh || item.name_en
      : item.name_en || item.name_kh;
  if (name) return name;
  if (item.grade_level != null) {
    return locale.value === "km"
      ? `កម្រិត ${item.grade_level}`
      : `Level ${item.grade_level}`;
  }
  return "";
}

onMounted(async () => {
  await loadLookups();
  await loadSetting();
  const nowMonth = new Date().getMonth() + 1;
  const match = months.value.find((m) => {
    const name = (m.name_en || "").toLowerCase();
    const map = [
      "january",
      "february",
      "march",
      "april",
      "may",
      "june",
      "july",
      "august",
      "september",
      "october",
      "november",
      "december",
    ];
    return map.indexOf(name) + 1 === nowMonth;
  });
  if (match) filters.value.month_id = match.id;
  await loadStatus();
});
</script>

<template>
  <div>
    <AppCard
      :title="t('Score Entry Status')"
      title-icon="tabler-clipboard-list"
      :is-back="true"
      :loading="isLoadingSetting || isLoadingStatus"
    >
      <!-- Deadline summary + edit dialog -->
      <div class="d-flex flex-wrap align-center ga-3 mb-4">
        <VChip
          :color="cutoffDay ? 'primary' : 'default'"
          variant="tonal"
          size="large"
          prepend-icon="tabler-calendar-due"
        >
          <template v-if="cutoffDay">
            {{ t("Current cutoff day") }}:
            <strong class="ms-1">{{ cutoffDay }}</strong>
          </template>
          <template v-else>
            {{ t("No deadline set") }}
          </template>
        </VChip>

        <VBtn
          v-if="canEditDeadline"
          color="primary"
          variant="tonal"
          :loading="isLoadingSetting"
          @click="openDeadlineDialog"
        >
          <VIcon start icon="tabler-edit" />
          {{ cutoffDay ? t("Edit deadline") : t("Set deadline") }}
        </VBtn>
      </div>

      <!-- <VAlert type="info" variant="tonal" class="mb-4" density="comfortable">
        {{
          t(
            "Set one cutoff day for every month. After that day, teachers cannot insert scores for that month anymore (including later months).",
          )
        }}
      </VAlert> -->

      <VAlert
        v-if="settingError"
        type="error"
        variant="tonal"
        density="compact"
        class="mb-4"
      >
        {{ settingError }}
      </VAlert>

      <VDivider class="my-4" />

      <!-- Filters -->
      <VRow dense class="mb-3">
        <VCol cols="6" sm="6" md="3">
          <VSelect
            v-model="filters.month_id"
            :items="months"
            :item-title="locale === 'km' ? 'name_kh' : 'name_en'"
            item-value="id"
            :placeholder="t('Month')"
            hide-details
            clearable
          />
        </VCol>
        <VCol cols="6" sm="6" md="3">
          <VSelect
            v-model="filters.grade_id"
            :items="grades"
            :item-title="gradeTitle"
            item-value="id"
            :placeholder="t('Grade')"
            hide-details
            clearable
          />
        </VCol>
        <VCol cols="6" sm="6" md="3">
          <VSelect
            v-model="filters.class_id"
            :items="filteredClasses"
            :item-title="locale === 'km' ? 'name_kh' : 'name_en'"
            item-value="id"
            :placeholder="t('Class')"
            hide-details
            clearable
          />
        </VCol>
        <VCol cols="6" sm="6" md="2">
          <VSelect
            v-model="filters.status"
            :items="statusOptions"
            item-title="title"
            item-value="value"
            :placeholder="t('Status')"
            hide-details
          />
        </VCol>
        <VCol cols="12" sm="6" md="1">
          <VBtn
            block
            color="primary"
            variant="tonal"
            :disabled="!filters.month_id"
            :loading="isLoadingStatus"
            @click="loadStatus"
          >
            <VIcon icon="tabler-search" />
          </VBtn>
        </VCol>
      </VRow>

      <!-- <VAlert
        v-if="windowInfo.close_date"
        :type="windowInfo.locked ? 'warning' : 'success'"
        variant="tonal"
        density="comfortable"
        class="mb-3"
      >
        <template v-if="windowInfo.locked">
          {{ t("This month is locked") }}
          ({{ t("closed after") }} {{ windowInfo.close_date }}).
        </template>
        <template v-else>
          {{ t("This month is open until") }} {{ windowInfo.close_date }}.
        </template>
      </VAlert> -->

      <VAlert v-if="statusError" type="error" variant="tonal" class="mb-3">
        {{ statusError }}
      </VAlert>

      <!-- Summary -->
      <div class="d-flex flex-wrap-4 ga-1 mb-4">
        <VChip color="error" variant="tonal">
          {{ t("Missing") }}: {{ summary.missing }}
        </VChip>
        <VChip color="warning" variant="tonal">
          {{ t("Partial") }}: {{ summary.partial }}
        </VChip>
        <VChip color="success" variant="tonal">
          {{ t("Done") }}: {{ summary.done }}
        </VChip>
        <VChip variant="outlined">
          {{ t("Total") }}: {{ summary.total }}
        </VChip>
      </div>

      <VDataTable
        :headers="headers"
        :items="rows"
        :loading="isLoadingStatus"
        :items-per-page="mdAndUp ? 25 : 10"
        class="text-no-wrap"
        hover
      >
        <!-- <template #item.grade="{ item }">
          {{
            (label(item.grade_name_en, item.grade_name_kh), item.grade_level)
          }}
        </template> -->
        <template #item.class="{ item }">
          {{ label(item.class_name_en, item.class_name_kh) }}
        </template>
        <template #item.subject="{ item }">
          {{ label(item.subject_name_en, item.subject_name_kh) }}
        </template>
        <template #item.teacher="{ item }">
          <span v-if="item.teacher_id">
            {{ label(item.teacher_name_en, item.teacher_name_kh) }}
          </span>
          <span v-else class="text-medium-emphasis">—</span>
        </template>
        <template #item.progress="{ item }">
          {{ item.scored_students }}/{{ item.total_students }}
        </template>
        <template #item.status="{ item }">
          <VChip size="small" :color="statusColor(item.status)" variant="tonal">
            {{ statusLabel(item.status) }}
          </VChip>
        </template>
        <template #item.actions="{ item }">
          <VBtn
            size="small"
            variant="tonal"
            color="primary"
            @click="openScoreEntry(item)"
          >
            {{ t("Open Score") }}
          </VBtn>
        </template>
        <template #no-data>
          <div class="text-center py-6 text-medium-emphasis">
            {{
              filters.month_id
                ? t("No subjects match this filter")
                : t("Select a month to track score entry")
            }}
          </div>
        </template>
      </VDataTable>
    </AppCard>

    <VDialog v-model="showDeadlineDialog" max-width="420" persistent>
      <VCard>
        <VCardTitle class="d-flex align-center justify-space-between">
          <span>{{ cutoffDay ? t("Edit deadline") : t("Set deadline") }}</span>
          <VBtn icon variant="text" size="small" @click="closeDeadlineDialog">
            <VIcon icon="tabler-x" />
          </VBtn>
        </VCardTitle>
        <VDivider />
        <VCardText>
          <!-- <p class="text-body-2 text-medium-emphasis mb-4">
            {{ t("Example: 26 means locked from day 27") }}
          </p> -->
          <VTextField
            v-model.number="draftCutoffDay"
            type="number"
            :min="1"
            :max="31"
            :label="t('Cutoff day')"
            :hint="t('Example: 26 means locked from day 27')"
            persistent-hint
            autofocus
            :disabled="isSavingSetting"
          />
          <VAlert
            v-if="dialogError"
            type="error"
            variant="tonal"
            density="compact"
            class="mt-3"
          >
            {{ dialogError }}
          </VAlert>
        </VCardText>
        <VDivider />
        <VCardActions class="pa-4">
          <VSpacer />
          <VBtn
            color="error"
            variant="tonal"
            :disabled="isSavingSetting"
            @click="closeDeadlineDialog"
          >
            {{ t("Cancel") }}
          </VBtn>
          <VBtn
            variant="tonal"
            color="primary"
            :loading="isSavingSetting"
            :disabled="isSavingSetting"
            @click="saveSetting"
          >
            {{ t("Save") }}
          </VBtn>
        </VCardActions>
      </VCard>
    </VDialog>
  </div>
</template>
