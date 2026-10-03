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
import {
  SCORE_ENTRY_TELEGRAM_CONFIG,
  buildScoreEntryTelegramMessage,
} from "@/config/scoreEntryTelegramReminder.js";

const { t, locale } = useI18n();
const router = useRouter();
const { mdAndUp } = useDisplay();
const settingStore = useSettingStore();

const canEditDeadline = computed(() =>
  hasPermission(["approve-score-entry", "edit-score-entry"]),
);

const canSendTelegram = computed(() =>
  hasPermission(["approve-score-entry", "view-score-entry"]),
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
const selectedRowKeys = ref([]);
const summary = ref({ missing: 0, partial: 0, done: 0, total: 0 });
const windowInfo = ref({ locked: false, cutoff_day: null, close_date: null });

const showSendDialog = ref(false);
const sendCancelled = ref(false);
const isSendingTelegram = ref(false);
const sendProgress = ref({
  current: 0,
  total: 0,
  currentTeacherName: "",
  steps: [],
});

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

const tableRows = computed(() =>
  rows.value.map((r) => ({
    ...r,
    row_key: `${r.class_id}_${r.subject_id}`,
  })),
);

const selectedTeacherCount = computed(() => {
  const keys = new Set(selectedRowKeys.value);
  const ids = new Set();
  for (const r of tableRows.value) {
    if (keys.has(r.row_key) && r.teacher_id) ids.add(r.teacher_id);
  }
  return ids.size;
});

const headers = computed(() => {
  const base = [
    { title: t("Class"), key: "class", sortable: true },
    { title: t("Subject"), key: "subject", sortable: true },
    { title: t("Teacher"), key: "teacher", sortable: true },
    { title: t("Progress"), key: "progress", sortable: false },
    { title: t("Status"), key: "status", sortable: true },
    { title: t("Action"), key: "actions", sortable: false, align: "center" },
  ];
  return base;
});

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

function isIncompleteStatus(status) {
  return status === "missing" || status === "partial";
}

function isRowSelectable(item) {
  return Boolean(item.teacher_id);
}

function teacherDisplayName(item) {
  return label(item?.teacher_name_en, item?.teacher_name_kh) || "—";
}

function monthDisplayName() {
  const m = months.value.find((x) => x.id === filters.value.month_id);
  if (!m) return "";
  return label(m.name_en, m.name_kh);
}

function incompleteRowsForTeacher(teacherId) {
  return rows.value.filter(
    (r) => r.teacher_id === teacherId && isIncompleteStatus(r.status),
  );
}

function buildTelegramMessage(teacherId) {
  const cutoff =
    cutoffDay.value ??
    (windowInfo.value.cutoff_day != null
      ? Number(windowInfo.value.cutoff_day)
      : null);

  return buildScoreEntryTelegramMessage({
    t,
    label,
    statusLabel,
    incompleteRows: incompleteRowsForTeacher(teacherId),
    monthName: monthDisplayName(),
    cutoffDay: cutoff,
    closeDate: windowInfo.value.close_date || null,
  });
}

function uniqueTeacherIdsFromRowKeys(keys) {
  const keySet = new Set(keys);
  const ordered = [];
  const seen = new Set();
  for (const r of tableRows.value) {
    if (!keySet.has(r.row_key) || !r.teacher_id) continue;
    if (seen.has(r.teacher_id)) continue;
    seen.add(r.teacher_id);
    ordered.push(r.teacher_id);
  }
  return ordered;
}

function teacherNameById(teacherId) {
  const row = rows.value.find((r) => r.teacher_id === teacherId);
  return row ? teacherDisplayName(row) : String(teacherId);
}

function resetSendProgress() {
  sendProgress.value = {
    current: 0,
    total: 0,
    currentTeacherName: "",
    steps: [],
  };
}

function openSendDialog(teacherIds) {
  const ids = [...new Set(teacherIds.filter(Boolean))];
  if (!ids.length) return;
  sendCancelled.value = false;
  resetSendProgress();
  sendProgress.value.total = ids.length;
  showSendDialog.value = true;
  void runSendQueue(ids);
}

function requestCancelSend() {
  sendCancelled.value = true;
}

function delay(ms) {
  return new Promise((resolve) => setTimeout(resolve, ms));
}

async function runSendQueue(teacherIds) {
  isSendingTelegram.value = true;
  try {
    for (let i = 0; i < teacherIds.length; i++) {
      if (sendCancelled.value) break;

      const teacherId = teacherIds[i];
      const name = teacherNameById(teacherId);
      sendProgress.value.current = i + 1;
      sendProgress.value.currentTeacherName = name;

      const incomplete = incompleteRowsForTeacher(teacherId);
      if (!incomplete.length) {
        sendProgress.value.steps.push({
          teacherId,
          name,
          outcome: "skipped",
          detail: t("No incomplete assignments in current list"),
        });
        continue;
      }

      try {
        const res = await api.post("telegram-connection/send-message", {
          teacher_id: teacherId,
          message: buildTelegramMessage(teacherId),
        });
        if (res.data?.success) {
          sendProgress.value.steps.push({
            teacherId,
            name,
            outcome: "sent",
            detail: res.data?.message || t("Message sent"),
          });
        } else {
          sendProgress.value.steps.push({
            teacherId,
            name,
            outcome: "failed",
            detail: res.data?.message || t("Failed to send Telegram message"),
          });
        }
      } catch (e) {
        sendProgress.value.steps.push({
          teacherId,
          name,
          outcome: "failed",
          detail:
            e?.response?.data?.message ||
            e.message ||
            t("Failed to send Telegram message"),
        });
      }

      if (i < teacherIds.length - 1 && !sendCancelled.value) {
        await delay(SCORE_ENTRY_TELEGRAM_CONFIG.sendDelayMs);
      }
    }
  } finally {
    isSendingTelegram.value = false;
    sendProgress.value.currentTeacherName = "";
  }
}

function sendTelegramForRow(item) {
  if (!canSendTelegram.value || !item?.teacher_id) return;
  openSendDialog([item.teacher_id]);
}

function sendTelegramBulk() {
  if (!canSendTelegram.value || !selectedRowKeys.value.length) return;
  openSendDialog(uniqueTeacherIdsFromRowKeys(selectedRowKeys.value));
}

function closeSendDialog() {
  if (isSendingTelegram.value) {
    requestCancelSend();
    return;
  }
  showSendDialog.value = false;
  resetSendProgress();
}

function sendStepIcon(outcome) {
  if (outcome === "sent") return "tabler-circle-check";
  if (outcome === "skipped") return "tabler-circle-minus";
  return "tabler-circle-x";
}

function sendStepColor(outcome) {
  if (outcome === "sent") return "success";
  if (outcome === "skipped") return "warning";
  return "error";
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
    selectedRowKeys.value = [];
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

      <div
        v-if="canSendTelegram && selectedRowKeys.length"
        class="d-flex flex-wrap align-center ga-2 mb-3"
      >
        <VBtn
          color="info"
          variant="tonal"
          :disabled="!selectedTeacherCount || isSendingTelegram"
          @click="sendTelegramBulk"
        >
          <VIcon start icon="tabler-brand-telegram" />
          {{ t("Send Telegram") }}
          <span v-if="selectedTeacherCount" class="ms-1">
            ({{ selectedTeacherCount }})
          </span>
        </VBtn>
      </div>

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
        v-model="selectedRowKeys"
        :headers="headers"
        :items="tableRows"
        item-value="row_key"
        :show-select="canSendTelegram"
        :item-selectable="isRowSelectable"
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
          <span v-if="item.teacher_id" class="d-inline-flex align-center ga-1">
            {{ label(item.teacher_name_en, item.teacher_name_kh) }}
            <VIcon
              v-if="canSendTelegram"
              icon="tabler-brand-telegram"
              :color="item.telegram_connected ? 'info' : 'disabled'"
              size="16"
            />
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
          <div class="d-flex flex-wrap justify-center ga-1">
            <VBtn
              size="small"
              variant="tonal"
              color="primary"
              @click="openScoreEntry(item)"
            >
              {{ t("Open Score") }}
            </VBtn>
            <VTooltip
              v-if="canSendTelegram && item.teacher_id"
              :text="
                item.telegram_connected
                  ? t('Send Telegram reminder')
                  : t('Telegram not connected')
              "
            >
              <template #activator="{ props: tipProps }">
                <VBtn
                  v-bind="tipProps"
                  size="small"
                  variant="tonal"
                  color="info"
                  icon="tabler-brand-telegram"
                  :disabled="isSendingTelegram"
                  @click="sendTelegramForRow(item)"
                />
              </template>
            </VTooltip>
          </div>
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

    <VDialog
      v-model="showSendDialog"
      max-width="520"
      :persistent="isSendingTelegram"
    >
      <VCard>
        <VCardTitle class="d-flex align-center justify-space-between">
          <span>{{ t("Send Telegram reminders") }}</span>
          <VBtn
            icon
            variant="text"
            size="small"
            :disabled="isSendingTelegram && !sendCancelled"
            @click="closeSendDialog"
          >
            <VIcon icon="tabler-x" />
          </VBtn>
        </VCardTitle>
        <VDivider />
        <VCardText>
          <p v-if="isSendingTelegram" class="text-body-2 mb-3">
            {{
              t("Sending {current} of {total}", {
                current: sendProgress.current,
                total: sendProgress.total,
              })
            }}
            <template v-if="sendProgress.currentTeacherName">
              — {{ sendProgress.currentTeacherName }}
            </template>
          </p>
          <VProgressLinear
            v-if="sendProgress.total"
            :model-value="(sendProgress.current / sendProgress.total) * 100"
            color="info"
            class="mb-4"
            rounded
          />
          <div
            v-if="sendProgress.steps.length"
            class="send-steps-list text-body-2"
          >
            <div
              v-for="(step, idx) in sendProgress.steps"
              :key="`${step.teacherId}-${idx}`"
              class="d-flex align-start ga-2 mb-2"
            >
              <VIcon
                :icon="sendStepIcon(step.outcome)"
                :color="sendStepColor(step.outcome)"
                size="18"
                class="mt-1"
              />
              <div>
                <strong>{{ step.name }}</strong>
                <div class="text-medium-emphasis">{{ step.detail }}</div>
              </div>
            </div>
          </div>
          <p
            v-else-if="!isSendingTelegram"
            class="text-medium-emphasis text-body-2 mb-0"
          >
            {{ t("No sends yet") }}
          </p>
        </VCardText>
        <VDivider />
        <VCardActions class="pa-4">
          <VSpacer />
          <VBtn
            v-if="isSendingTelegram"
            color="warning"
            variant="tonal"
            @click="requestCancelSend"
          >
            {{ sendCancelled ? t("Cancelling…") : t("Cancel") }}
          </VBtn>
          <VBtn
            v-else
            color="primary"
            variant="tonal"
            @click="closeSendDialog"
          >
            {{ t("Close") }}
          </VBtn>
        </VCardActions>
      </VCard>
    </VDialog>

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
