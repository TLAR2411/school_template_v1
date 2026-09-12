<script setup>
import { computed, ref, watch } from "vue";
import { debounce } from "lodash";
import { requiredValidator } from "@/@core/utils/validators";
import { useI18n } from "vue-i18n";
import AppAddEditDialog from "@/components/AppAddEditDialog.vue";

const { t } = useI18n();

const props = defineProps({
  itemData: {
    type: Object,
    required: false,
    default: () => ({}),
  },
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
  loading: {
    type: Boolean,
    required: false,
    default: undefined,
  },
});

const emit = defineEmits(["onCreate", "onUpdate", "update:isDialogVisible"]);

const quantity = ref(1);
const defaultMaxScore = ref(null);
const assessments = ref([]);
const isSyncing = ref(false);

const ruleMaxScore = computed(() => {
  const max = Number(props.itemData?.max_score);
  return Number.isFinite(max) ? max : null;
});

const activitySymbol = computed(
  () => props.itemData?.activity?.symbol || props.itemData?.symbol || "A",
);

const activityLabel = computed(() => {
  const activity = props.itemData?.activity;
  if (!activity) return t("Assessments");
  return activity.name_en || activity.name_kh || activitySymbol.value;
});

const isEditMode = computed(
  () =>
    !!props.itemData?.is_edit ||
    (Array.isArray(props.itemData?.assessments) &&
      props.itemData.assessments.length > 0),
);

/** Sum of all assessment max_scores must be ≤ grading rule max_score */
const totalAssessmentMax = computed(() =>
  assessments.value.reduce((sum, row) => {
    const num = Number(row.max_score);
    return sum + (Number.isFinite(num) ? num : 0);
  }, 0),
);

const remainingScore = computed(() => {
  if (ruleMaxScore.value == null) return null;
  return ruleMaxScore.value - totalAssessmentMax.value;
});

const isOverLimit = computed(
  () => ruleMaxScore.value != null && totalAssessmentMax.value > ruleMaxScore.value,
);

/** Split rule max evenly across quantity (e.g. 100 / 10 = 10) */
const suggestedPerItem = (count) => {
  const n = Math.max(1, Number(count) || 1);
  if (ruleMaxScore.value == null) return 10;
  // keep up to 2 decimals for uneven splits
  return Math.round((ruleMaxScore.value / n) * 100) / 100;
};

const toScore = (value) => {
  const num = Number(value);
  if (!Number.isFinite(num) || num < 0) return 0;
  return num;
};

const buildName = (index) => `${activitySymbol.value}${index + 1}`;

const makeRow = (index, existing = null) => ({
  id: existing?.id ?? null,
  ass_name: existing?.ass_name || buildName(index),
  max_score:
    existing?.max_score != null
      ? toScore(existing.max_score)
      : toScore(defaultMaxScore.value),
});

const syncFromQuantity = (count, preferExisting = false, redistribute = false) => {
  const n = Math.max(0, Math.min(100, Number(count) || 0));
  isSyncing.value = true;
  quantity.value = n;

  if (redistribute || !preferExisting) {
    defaultMaxScore.value = suggestedPerItem(n || 1);
  }

  const prev = assessments.value;
  const next = [];
  const perItem = toScore(defaultMaxScore.value);

  for (let i = 0; i < n; i++) {
    const existing = preferExisting
      ? props.itemData?.assessments?.[i]
      : null;
    const prevRow = prev[i];

    if (preferExisting && existing) {
      next.push(makeRow(i, existing));
      continue;
    }

    if (!preferExisting && prevRow && !redistribute) {
      // keep existing row data when growing/shrinking without full redistribute
      next.push({
        id: prevRow.id ?? null,
        ass_name: prevRow.ass_name || buildName(i),
        max_score: toScore(prevRow.max_score),
      });
      continue;
    }

    next.push({
      id: null,
      ass_name: buildName(i),
      max_score: perItem,
    });
  }

  // When quantity grows, fill new slots with current default
  if (!preferExisting && !redistribute && prev.length < n) {
    for (let i = prev.length; i < n; i++) {
      next[i] = {
        id: null,
        ass_name: buildName(i),
        max_score: perItem,
      };
    }
  }

  assessments.value = next;
  isSyncing.value = false;
};

const applyDefaultMaxScore = () => {
  const perItem = toScore(defaultMaxScore.value);
  defaultMaxScore.value = perItem;
  assessments.value = assessments.value.map((row) => ({
    ...row,
    max_score: perItem,
  }));
};

const removeAssessment = (index) => {
  assessments.value.splice(index, 1);
  isSyncing.value = true;
  quantity.value = assessments.value.length;
  isSyncing.value = false;
};

const maxScoreValidator = (value) => {
  if (value === null || value === undefined || value === "") {
    return requiredValidator(value);
  }
  const num = Number(value);
  if (!Number.isFinite(num) || num < 0) {
    return t("Max score must be 0 or more");
  }
  return true;
};

/** Default × quantity cannot exceed rule max */
const defaultMaxScoreValidator = (value) => {
  const base = maxScoreValidator(value);
  if (base !== true) return base;

  if (ruleMaxScore.value == null) return true;

  const perItem = Number(value);
  const total = perItem * (Number(quantity.value) || 0);
  if (total > ruleMaxScore.value) {
    return (
      t("Total assessment max cannot exceed grading rule max") +
      ` (${total} / ${ruleMaxScore.value})`
    );
  }
  return true;
};

const quantityValidator = (value) => {
  if (value === null || value === undefined || value === "") {
    return requiredValidator(value);
  }
  const num = Number(value);
  if (!Number.isFinite(num) || num < 1) {
    return t("Quantity must be at least 1");
  }
  if (num > 100) {
    return t("Quantity cannot exceed 100");
  }
  return true;
};

const syncItemData = (data = {}) => {
  const existing = Array.isArray(data?.assessments) ? data.assessments : [];
  const count = existing.length > 0 ? existing.length : 1;

  if (existing.length > 0) {
    defaultMaxScore.value = toScore(
      existing[0]?.max_score ?? suggestedPerItem(count),
    );
    syncFromQuantity(count, true, false);
  } else {
    defaultMaxScore.value = suggestedPerItem(count);
    syncFromQuantity(count, false, true);
  }
};

watch(
  () => props.itemData,
  (newData) => {
    if (props.isDialogVisible) syncItemData(newData);
  },
  { deep: true },
);

watch(
  () => props.isDialogVisible,
  (open) => {
    if (open) syncItemData(props.itemData);
  },
);

watch(quantity, (val, oldVal) => {
  if (!props.isDialogVisible || isSyncing.value) return;
  if (Number(val) === Number(oldVal)) return;
  // Changing quantity redistributes: ruleMax / quantity (100/10 → 10 each)
  syncFromQuantity(val, false, true);
});

const resetData = () => {
  quantity.value = 1;
  defaultMaxScore.value = null;
  assessments.value = [];
};

const onFormSubmit = debounce(async (refForm) => {
  const { valid } = await refForm;
  if (!valid) return;

  if (!assessments.value.length) return;
  if (isOverLimit.value) return;

  const payload = {
    grading_rule_id: props.itemData?.id,
    subject_id: props.itemData?.subject_id,
    assessments: assessments.value.map((row) => ({
      id: row.id,
      ass_name: row.ass_name,
      max_score: toScore(row.max_score),
    })),
  };

  if (isEditMode.value) {
    emit("onUpdate", payload, (res) => {
      if (res) resetData();
    });
  } else {
    emit("onCreate", payload, (res) => {
      if (res) resetData();
    });
  }
}, 500);

const onCloseDialog = () => {
  resetData();
  emit("update:isDialogVisible", false);
};
</script>

<template>
  <AppAddEditDialog
    :title="
      isEditMode
        ? t('Update Assessments') + ` — ${activityLabel}`
        : t('Create Assessments') + ` — ${activityLabel}`
    "
    :is-dialog-visible="isDialogVisible"
    :is-update="isEditMode"
    :loading="loading"
    max-width="640px"
    @on-close-dialog="onCloseDialog"
    @on-submit="onFormSubmit"
  >
    <VAlert
      v-if="ruleMaxScore != null"
      :type="isOverLimit ? 'error' : 'info'"
      variant="tonal"
      density="compact"
      class="mb-4"
    >
      <div>
        {{ t("Total") }}:
        <strong>{{ totalAssessmentMax }}</strong>
        /
        <strong>{{ ruleMaxScore }}</strong>
        <span v-if="!isOverLimit" class="ms-1">
          ({{ t("remaining") }}: {{ remainingScore }})
        </span>
      </div>
      <div v-if="isOverLimit" class="mt-1">
        {{ t("Sum of assessment max scores cannot exceed grading rule max") }}
      </div>
      <div class="text-caption mt-1">
        {{ t("Symbol") }}: <strong>{{ activitySymbol }}</strong>
      </div>
    </VAlert>

    <VRow dense class="mb-2">
      <VCol cols="12" sm="6">
        <AppTextField
          v-model.number="quantity"
          type="number"
          :label="t('Quantity')"
          :rules="[quantityValidator]"
          :min="1"
          :max="100"
        />
      </VCol>
      <VCol cols="12" sm="6">
        <AppTextField
          v-model.number="defaultMaxScore"
          type="number"
          :label="t('Default Max Score')"
          :rules="[defaultMaxScoreValidator]"
          :min="0"
          @update:model-value="applyDefaultMaxScore"
        />
      </VCol>
    </VRow>

    <div v-if="assessments.length" class="assessment-list">
      <div
        v-for="(row, index) in assessments"
        :key="row.id ?? `new-${index}`"
        class="assessment-row"
      >
        <div class="assessment-row__index">{{ index + 1 }}</div>

        <div class="assessment-row__fields">
          <AppTextField
            v-model="row.ass_name"
            :label="t('Assessment Name')"
            :rules="[requiredValidator]"
            autocomplete="off"
          />
          <AppTextField
            v-model.number="row.max_score"
            type="number"
            :label="t('Max Score')"
            :rules="[maxScoreValidator]"
            :min="0"
          />
        </div>

        <VBtn
          icon
          size="small"
          color="error"
          variant="text"
          class="assessment-row__remove"
          :disabled="assessments.length <= 1"
          @click="removeAssessment(index)"
        >
          <VIcon icon="tabler-minus" />
        </VBtn>
      </div>
    </div>
  </AppAddEditDialog>
</template>

<style scoped>
.assessment-list {
  display: flex;
  flex-direction: column;
  gap: 10px;
  max-height: 420px;
  overflow-y: auto;
  padding-right: 4px;
}

.assessment-row {
  display: flex;
  align-items: flex-start;
  gap: 10px;
  padding: 12px;
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 10px;
  background: rgba(var(--v-theme-on-surface), 0.02);
}

.assessment-row__index {
  width: 28px;
  height: 28px;
  margin-top: 28px;
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  font-size: 12px;
  font-weight: 600;
  background: rgba(var(--v-theme-on-surface), 0.08);
  color: rgba(var(--v-theme-on-surface), 0.7);
}

.assessment-row__fields {
  flex: 1;
  min-width: 0;
  display: grid;
  grid-template-columns: 1fr 120px;
  gap: 10px;
}

.assessment-row__remove {
  margin-top: 24px;
  flex-shrink: 0;
}

@media (max-width: 600px) {
  .assessment-row__fields {
    grid-template-columns: 1fr;
  }
}
</style>
