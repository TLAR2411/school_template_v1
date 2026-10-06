<script setup>
/**
 * Score entry status: one cutoff day per month + tracking of teachers who still miss scores.
 * Rows are grouped by teacher; selection is per teacher (one Telegram message each).
 */
import { computed, onMounted, ref, watch } from "vue";
import { useI18n } from "vue-i18n";
import { useRouter } from "vue-router";
import AppCard from "@/components/AppCard.vue";
import { api } from "@/utils/api";
import { getClasses, getGrades, getMonths } from "@/services/dataService";
import { useSettingStore } from "@/stores/settingStore.js";
import hasPermission from "@/utils/hasPermission";
import {
  SCORE_ENTRY_TELEGRAM_CONFIG,
  buildScoreEntryTelegramMessage,
  buildScoreEntryTelegramButton,
} from "@/config/scoreEntryTelegramReminder.js";

const { t, locale } = useI18n();
const router = useRouter();
const settingStore = useSettingStore();

// App logo (same pattern used by the login/layout components)
const logos = import.meta.glob("@images/logo/*/logo.png", {
  eager: true,
  import: "default",
});
const company = import.meta.env.VITE_BASE_COMPANY;
const MainLogo = logos[`/src/assets/images/logo/${company}/logo.png`];

// Full-page loading overlay shown while the first load (setting + status) runs.
const isInitializing = ref(true);

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
const summary = ref({ missing: 0, partial: 0, done: 0, total: 0 });
const windowInfo = ref({ locked: false, cutoff_day: null, close_date: null });

// Selection is by teacher id, not by row
const selectedTeacherIds = ref([]);
const expanded = ref([]);

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
  status: "missing",
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

const filteredClasses = computed(() =>
  filters.value.grade_id
    ? allClasses.value.filter((c) => c.grade_id == filters.value.grade_id)
    : allClasses.value,
);

function label(en, kh) {
  return locale.value === "km" ? kh || en || "—" : en || kh || "—";
}
function statusLabel(s) {
  return s === "done"
    ? t("Done")
    : s === "partial"
      ? t("Partial")
      : t("Missing");
}
function statusColor(s) {
  return s === "done" ? "success" : s === "partial" ? "warning" : "error";
}
function isIncompleteStatus(s) {
  return s === "missing" || s === "partial";
}
function teacherDisplayName(item) {
  return label(item?.teacher_name_en, item?.teacher_name_kh) || "—";
}
function monthDisplayName() {
  const m = months.value.find((x) => x.id === filters.value.month_id);
  return m ? label(m.name_en, m.name_kh) : "";
}

/* ---------- Group rows by teacher ---------- */
const teacherGroups = computed(() => {
  const map = new Map();
  for (const r of rows.value) {
    const key = r.teacher_id || "none";
    if (!map.has(key)) {
      map.set(key, {
        key,
        teacherId: r.teacher_id || null,
        name: r.teacher_id ? teacherDisplayName(r) : t("No teacher"),
        connected: Boolean(r.telegram_connected),
        items: [],
      });
    }
    map.get(key).items.push({ ...r, row_key: `${r.class_id}_${r.subject_id}` });
  }
  return [...map.values()].map((g) => ({
    ...g,
    pending: g.items.filter((i) => isIncompleteStatus(i.status)).length,
  }));
});

const selectableIds = computed(() =>
  teacherGroups.value
    .filter((g) => g.teacherId && g.pending)
    .map((g) => g.teacherId),
);
const allSelected = computed(
  () =>
    selectableIds.value.length > 0 &&
    selectableIds.value.every((id) => selectedTeacherIds.value.includes(id)),
);
const someSelected = computed(
  () => selectedTeacherIds.value.length > 0 && !allSelected.value,
);
function toggleAll(v) {
  selectedTeacherIds.value = v ? [...selectableIds.value] : [];
}
function toggleExpand(key) {
  const i = expanded.value.indexOf(key);
  if (i === -1) expanded.value.push(key);
  else expanded.value.splice(i, 1);
}
function toggleExpandAll() {
  expanded.value = expanded.value.length
    ? []
    : teacherGroups.value.map((g) => g.key);
}

/* ---------- Telegram ---------- */
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

// const text = buildScoreEntryTelegramMessage({ t, label, statusLabel, incompleteRows, monthName, cutoffDay, closeDate });
const reply_markup = buildScoreEntryTelegramButton({ t });

function teacherNameById(id) {
  return (
    teacherGroups.value.find((g) => g.teacherId === id)?.name || String(id)
  );
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

const requestCancelSend = () => (sendCancelled.value = true);
const delay = (ms) => new Promise((r) => setTimeout(r, ms));

async function runSendQueue(teacherIds) {
  isSendingTelegram.value = true;
  try {
    for (let i = 0; i < teacherIds.length; i++) {
      if (sendCancelled.value) break;
      const teacherId = teacherIds[i];
      const name = teacherNameById(teacherId);
      sendProgress.value.current = i + 1;
      sendProgress.value.currentTeacherName = name;

      if (!incompleteRowsForTeacher(teacherId).length) {
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
          reply_markup: buildScoreEntryTelegramButton({ t }), // NEW
        });
        sendProgress.value.steps.push({
          teacherId,
          name,
          outcome: res.data?.success ? "sent" : "failed",
          detail:
            res.data?.message ||
            (res.data?.success
              ? t("Message sent")
              : t("Failed to send Telegram message")),
        });
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

const sendTelegramForGroup = (g) =>
  canSendTelegram.value && g.teacherId && openSendDialog([g.teacherId]);
const sendTelegramBulk = () =>
  canSendTelegram.value && openSendDialog(selectedTeacherIds.value);

function closeSendDialog() {
  if (isSendingTelegram.value) return requestCancelSend();
  showSendDialog.value = false;
  resetSendProgress();
}

const sendStepIcon = (o) =>
  o === "sent"
    ? "tabler-circle-check"
    : o === "skipped"
      ? "tabler-circle-minus"
      : "tabler-circle-x";
const sendStepColor = (o) =>
  o === "sent" ? "success" : o === "skipped" ? "warning" : "error";

/* ---------- Data ---------- */
async function loadLookups() {
  grades.value = (await getGrades()) || [];
  allClasses.value = (await getClasses()) || [];
  months.value = (await getMonths()) || [];
}

const isAbort = (e) =>
  e?.code === "ERR_CANCELED" || e?.name === "CanceledError";

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
    if (isAbort(e)) return;
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
    if (isAbort(e)) return;
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
    selectedTeacherIds.value = [];
    expanded.value = [];
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
    if (windowInfo.value.cutoff_day != null && cutoffDay.value == null) {
      cutoffDay.value = Number(windowInfo.value.cutoff_day);
    }
  } catch (e) {
    if (isAbort(e)) return;
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
    query: { class_id: item.class_id, month_id: filters.value.month_id },
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
  () => (filters.value.class_id = null),
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
  isInitializing.value = true;
  try {
    await loadLookups();
    await loadSetting();
    const names = [
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
    const nowMonth = new Date().getMonth() + 1;
    const match = months.value.find(
      (m) => names.indexOf((m.name_en || "").toLowerCase()) + 1 === nowMonth,
    );
    if (match) filters.value.month_id = match.id;
    await loadStatus();
  } finally {
    isInitializing.value = false;
  }
});
</script>

<template>
  <div>
    <!-- First-load overlay: shown until setting + status APIs finish -->
    <div
      v-if="isInitializing"
      class="d-flex align-center justify-center"
      style="min-height: 80vh"
    >
      <div class="d-flex flex-column align-center ga-4">
        <img v-if="MainLogo" :src="MainLogo" alt="logo" class="loading-logo" />

        <VProgressCircular indeterminate color="primary" size="40" width="4" />

        <div class="text-body-2 text-medium-emphasis">
          {{ t("Loading…") }}
        </div>
      </div>
    </div>

    <AppCard
      v-else
      :title="t('Score Entry Status')"
      title-icon="tabler-clipboard-list"
      :is-back="true"
    >
      <!-- Deadline: one quiet line -->
      <div class="d-flex align-center ga-2 mb-4 text-body-1">
        <VChip v-if="cutoffDay" color="primary" class="text-white">
          <VIcon icon="tabler-calendar-due" size="20" />
          <span>
            {{ t("Current cutoff day") }}: <strong>{{ cutoffDay }}</strong>
          </span>
        </VChip>
        <VChip v-else color="error">
          <VIcon icon="tabler-calendar-due" size="20" />
          <span class="">{{ t("No deadline set") }}</span>
        </VChip>

        <VBtn
          v-if="canEditDeadline"
          variant="tonal"
          size="small"
          :loading="isLoadingSetting"
          @click="openDeadlineDialog"
          color="warning"
        >
          <VIcon> tabler-edit </VIcon>
          {{ cutoffDay ? t("Edit deadline") : t("Set deadline") }}
        </VBtn>
      </div>

      <VAlert
        v-if="settingError"
        type="error"
        variant="tonal"
        density="compact"
        class="mb-4"
      >
        {{ settingError }}
      </VAlert>

      <!-- Filters -->
      <VRow dense class="mb-4">
        <VCol cols="6" md="3">
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
        <VCol cols="6" md="3">
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
        <VCol cols="6" md="3">
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
        <VCol cols="6" md="2">
          <VSelect
            v-model="filters.status"
            :items="statusOptions"
            item-title="title"
            item-value="value"
            :placeholder="t('Status')"
            hide-details
          />
        </VCol>
        <VCol cols="12" md="1">
          <VBtn
            block
            variant="tonal"
            :disabled="!filters.month_id"
            :loading="isLoadingStatus"
            @click="loadStatus"
          >
            <VIcon icon="tabler-search" />
          </VBtn>
        </VCol>
      </VRow>

      <VAlert v-if="statusError" type="error" variant="tonal" class="mb-3">
        {{ statusError }}
      </VAlert>

      <!-- Summary: plain text with small dots, no chips -->
      <div class="d-flex justify-center flex-wrap ga-4 mb-4 text-body-2">
        <VChip color="error">
          <span class="summary-item"
            >{{ t("Missing") }} {{ summary.missing }}</span
          >
        </VChip>
        <VChip color="warning">
          <span class="summary-item"
            >{{ t("Partial") }} {{ summary.partial }}</span
          >
        </VChip>
        <VChip color="success">
          <span class="summary-item">{{ t("Done") }} {{ summary.done }}</span>
        </VChip>
        <VChip color="primary">
          <span class="summary-item">{{ t("Total") }} {{ summary.total }}</span>
        </VChip>
      </div>

      <!-- Toolbar: select all teachers / action bar -->
      <div
        v-if="teacherGroups.length"
        class="toolbar d-flex align-center ga-3 px-3 py-2 mb-3"
      >
        <VCheckbox
          v-if="canSendTelegram"
          :model-value="allSelected"
          :indeterminate="someSelected"
          :label="
            selectedTeacherIds.length
              ? `${selectedTeacherIds.length} ${t('selected')}`
              : t('Select all teachers')
          "
          hide-details
          density="compact"
          :disabled="!selectableIds.length"
          @update:model-value="toggleAll"
        />
        <VSpacer />
        <template v-if="selectedTeacherIds.length">
          <VBtn variant="text" size="small" @click="selectedTeacherIds = []">{{
            t("Clear")
          }}</VBtn>
          <VBtn
            color="primary"
            :disabled="isSendingTelegram"
            @click="sendTelegramBulk"
          >
            <VIcon start icon="tabler-brand-telegram" />
            {{ t("Send Telegram") }} ({{ selectedTeacherIds.length }})
          </VBtn>
        </template>
        <VBtn v-else variant="text" size="small" @click="toggleExpandAll">
          {{ expanded.length ? t("Collapse all") : t("Expand all") }}
        </VBtn>
      </div>

      <!-- Teacher groups -->
      <div v-for="g in teacherGroups" :key="g.key" class="teacher-card mb-3">
        <div
          class="teacher-head d-flex align-center ga-3 px-3 py-2"
          @click="toggleExpand(g.key)"
        >
          <VCheckbox
            v-if="canSendTelegram && g.teacherId"
            v-model="selectedTeacherIds"
            :value="g.teacherId"
            :disabled="!g.pending"
            hide-details
            density="compact"
            class="flex-grow-0"
            @click.stop
          />
          <VAvatar size="34" color="primary" variant="tonal">
            {{ (g.name || "?").charAt(0) }}
          </VAvatar>
          <div class="flex-grow-1 min-w-0">
            <div class="font-weight-medium text-truncate">{{ g.name }}</div>
            <div class="text-caption text-medium-emphasis">
              <template v-if="g.pending"
                >{{ g.pending }} {{ t("subjects pending") }}</template
              >
              <template v-else>{{ t("All done") }}</template>
              · {{ g.items.length }} {{ t("subjects") }}
            </div>
          </div>
          <VTooltip
            v-if="canSendTelegram && g.teacherId"
            :text="
              g.connected
                ? t('Send Telegram reminder')
                : t('Telegram not connected')
            "
          >
            <template #activator="{ props: tip }">
              <VBtn
                v-bind="tip"
                icon="tabler-brand-telegram"
                variant="text"
                size="small"
                :color="g.connected ? 'primary' : undefined"
                :disabled="isSendingTelegram || !g.pending"
                @click.stop="sendTelegramForGroup(g)"
              />
            </template>
          </VTooltip>
          <VIcon
            icon="tabler-chevron-down"
            class="chev text-medium-emphasis"
            :class="{ 'chev--open': expanded.includes(g.key) }"
          />
        </div>

        <div v-show="expanded.includes(g.key)" class="subject-list mx-5">
          <div
            v-for="item in g.items"
            :key="item.row_key"
            class="subject-row px-5 py-2"
          >
            <span class="text-medium-emphasis">{{
              label(item.class_name_en, item.class_name_kh)
            }}</span>
            <span class="subject-name">{{
              label(item.subject_name_en, item.subject_name_kh)
            }}</span>
            <span class="text-medium-emphasis"
              >{{ item.scored_students }}/{{ item.total_students }}</span
            >
            <span class="summary-item text-no-wrap">
              <i class="dot" :class="`bg-${statusColor(item.status)}`" />{{
                statusLabel(item.status)
              }}
            </span>
            <VBtn
              size="small"
              variant="text"
              color="primary"
              @click="openScoreEntry(item)"
            >
              {{ t("Open Score") }}
            </VBtn>
          </div>
        </div>
      </div>

      <div
        v-if="!teacherGroups.length && !isLoadingStatus"
        class="text-center py-8 text-medium-emphasis"
      >
        {{
          filters.month_id
            ? t("No subjects match this filter")
            : t("Select a month to track score entry")
        }}
      </div>
    </AppCard>

    <!-- Send progress dialog -->
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
              — {{ sendProgress.currentTeacherName }}</template
            >
          </p>
          <VProgressLinear
            v-if="sendProgress.total"
            :model-value="(sendProgress.current / sendProgress.total) * 100"
            color="primary"
            class="mb-4"
            rounded
          />
          <div v-if="sendProgress.steps.length" class="text-body-2">
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
            variant="tonal"
            @click="requestCancelSend"
          >
            {{ sendCancelled ? t("Cancelling…") : t("Cancel") }}
          </VBtn>
          <VBtn
            v-else
            variant="tonal"
            color="primary"
            @click="closeSendDialog"
            >{{ t("Close") }}</VBtn
          >
        </VCardActions>
      </VCard>
    </VDialog>

    <!-- Deadline dialog -->
    <VDialog v-model="showDeadlineDialog" max-width="420" persistent>
      <VCard>
        <VCardTitle class="d-flex align-center justify-space-between">
          <span>{{ cutoffDay ? t("Edit deadline") : t("Set deadline") }}</span>
          <VBtn icon variant="text" size="small" @click="closeDeadlineDialog"
            ><VIcon icon="tabler-x"
          /></VBtn>
        </VCardTitle>
        <VDivider />
        <VCardText>
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
            variant="text"
            :disabled="isSavingSetting"
            @click="closeDeadlineDialog"
            >{{ t("Cancel") }}</VBtn
          >
          <VBtn
            variant="tonal"
            color="primary"
            :loading="isSavingSetting"
            @click="saveSetting"
            >{{ t("Save") }}</VBtn
          >
        </VCardActions>
      </VCard>
    </VDialog>
  </div>
</template>

<style scoped>
.loading-logo {
  height: 64px;
  width: auto;
  object-fit: contain;
}
.toolbar,
.teacher-card {
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 10px;
}
.teacher-card {
  overflow: hidden;
}
.teacher-head {
  cursor: pointer;
}
.teacher-head:hover {
  background: rgba(var(--v-theme-on-surface), 0.04);
}
.chev {
  transition: transform 0.2s;
}
.chev--open {
  transform: rotate(180deg);
}
.subject-row {
  display: grid;
  grid-template-columns: 90px 1fr 70px 110px auto;
  align-items: center;
  gap: 12px;
  border-top: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
}
.subject-name {
  font-weight: 500;
}
.summary-item {
  display: inline-flex;
  align-items: center;
  gap: 6px;
}
.dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  display: inline-block;
}
@media (max-width: 600px) {
  .subject-row {
    grid-template-columns: 1fr auto;
  }
}
</style>
