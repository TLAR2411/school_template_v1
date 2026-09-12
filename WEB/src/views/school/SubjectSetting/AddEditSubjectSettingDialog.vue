<script setup>
import { computed, ref, watch } from "vue";
import { debounce } from "lodash";
import { requiredValidator } from "@/@core/utils/validators";
import { useI18n } from "vue-i18n";
import { useSettingStore } from "@/stores/settingStore";
import AppAutocomplete from "@/@core/components/app-form-elements/AppAutocomplete.vue";
import AppAddEditDialog from "@/components/AppAddEditDialog.vue";
import {
  getClassType,
  getSubjectActivity,
  getSubjects,
} from "@/services/dataService";

const settingStore = useSettingStore();

const { t, locale } = useI18n();

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
  subjectOptions: {
    type: Array,
    default: () => [],
  },
  /** Parent subjects with children + grading_rules from list API */
  subjectTree: {
    type: Array,
    default: () => [],
  },
});

const isEditMode = computed(
  () => !!props.itemData?.is_edit || !!itemData.value.rules?.[0]?.id,
);

const emit = defineEmits(["onCreate", "onUpdate", "update:isDialogVisible"]);

const subjects = ref([]);
const subjectActivity = ref([]);
const classtype = ref([]);

const emptyRule = () => ({
  subject_activity_type_id: null,
  class_type_id: null,
  percentage: null,
  max_score: null,
  assessment_count: 1,
});

const itemData = ref({
  id: null,
  grade_id: null,
  year_id: null,
  subject_id: null,
  rules: [emptyRule()],
});

const subjectItems = computed(() =>
  props.subjectOptions?.length ? props.subjectOptions : subjects.value,
);

const currentSubject = computed(() =>
  subjectItems.value.find((s) => s.id === itemData.value.subject_id),
);

const isChildSubject = computed(() => !!currentSubject.value?.parent_id);

const parentSubject = computed(() => {
  const parentId = currentSubject.value?.parent_id;
  if (!parentId) return null;
  return (
    props.subjectTree.find((s) => Number(s.id) === Number(parentId)) || null
  );
});

const examActivityId = computed(() => {
  const exam = (subjectActivity.value || []).find(
    (a) => String(a.symbol || "").toUpperCase() === "E",
  );
  return exam?.id ?? null;
});

const normalizeId = (id) => (id == null || id === "" ? null : Number(id));

const isExamActivity = (rule) => {
  const actId = rule?.activity?.id ?? rule?.subject_activity_type_id;
  return (
    examActivityId.value != null &&
    Number(actId) === Number(examActivityId.value)
  );
};

const ruleClassTypeId = (rule) =>
  normalizeId(rule?.class_type_id ?? rule?.class_type?.id);

/** Parent Exam max for a class_type (fallback to shared/null parent Exam) */
const getParentExamMax = (classTypeId) => {
  const rules = parentSubject.value?.grading_rules || [];
  const exact = rules.find(
    (r) => isExamActivity(r) && ruleClassTypeId(r) === normalizeId(classTypeId),
  );
  if (exact) return Number(exact.max_score);

  const shared = rules.find(
    (r) => isExamActivity(r) && ruleClassTypeId(r) == null,
  );
  return shared ? Number(shared.max_score) : null;
};

/** Sum Exam max of all siblings (current child uses form values) */
const getChildrenExamSum = (classTypeId) => {
  if (!parentSubject.value || !examActivityId.value) return 0;

  const children = parentSubject.value.children || [];
  const currentId = normalizeId(itemData.value.subject_id);
  const targetClassType = normalizeId(classTypeId);

  return children.reduce((sum, child) => {
    if (normalizeId(child.id) === currentId) {
      const formTotal = itemData.value.rules.reduce((s, rule) => {
        if (!isExamActivity(rule)) return s;
        if (normalizeId(rule.class_type_id) !== targetClassType) return s;
        const ms = Number(rule.max_score);
        return s + (Number.isFinite(ms) ? ms : 0);
      }, 0);
      return sum + formTotal;
    }

    const siblingTotal = (child.grading_rules || []).reduce((s, rule) => {
      if (!isExamActivity(rule)) return s;
      if (ruleClassTypeId(rule) !== targetClassType) return s;
      const ms = Number(rule.max_score);
      return s + (Number.isFinite(ms) ? ms : 0);
    }, 0);

    return sum + siblingTotal;
  }, 0);
};

const formExamClassTypes = computed(() => {
  if (!examActivityId.value) return [];
  const ids = itemData.value.rules
    .filter((r) => isExamActivity(r))
    .map((r) => normalizeId(r.class_type_id));
  return [...new Set(ids)];
});

const childExamLimitErrors = computed(() => {
  if (!isChildSubject.value || !parentSubject.value || !examActivityId.value) {
    return [];
  }

  return formExamClassTypes.value
    .map((classTypeId) => {
      const parentMax = getParentExamMax(classTypeId);
      if (parentMax == null || !Number.isFinite(parentMax)) return null;

      const sum = getChildrenExamSum(classTypeId);
      if (sum <= parentMax) return null;

      return { classTypeId, sum, parentMax };
    })
    .filter(Boolean);
});

const isChildExamOverLimit = computed(
  () => childExamLimitErrors.value.length > 0,
);

const childExamSumDisplay = computed(() => {
  if (!formExamClassTypes.value.length) return 0;
  // show first group / shared for the info chip
  return getChildrenExamSum(formExamClassTypes.value[0]);
});

const parentExamMaxDisplay = computed(() => {
  if (!formExamClassTypes.value.length) return null;
  return getParentExamMax(formExamClassTypes.value[0]);
});

const classTypeLabelById = (classTypeId) => {
  if (classTypeId == null) return t("All streams");
  const ct = (classtype.value || []).find(
    (c) => Number(c.id) === Number(classTypeId),
  );
  if (!ct) return `#${classTypeId}`;
  return locale.value === "km"
    ? ct.name_kh || ct.name_en
    : ct.name_en || ct.name_kh;
};

const isSharedRule = (rule) => normalizeId(rule?.class_type_id) == null;

/**
 * No class_type on a row → that activity is fully taken (show once).
 * With class_type → same activity can be used again for another class type.
 */
const isActivityBlockedByOthers = (activityId, exceptIndex = -1) => {
  const id = normalizeId(activityId);
  if (id == null) return false;

  return itemData.value.rules.some((rule, index) => {
    if (index === exceptIndex) return false;
    if (normalizeId(rule.subject_activity_type_id) !== id) return false;
    return isSharedRule(rule);
  });
};

const isActivityClassTypeUsed = (activityId, classTypeId, exceptIndex = -1) => {
  const aId = normalizeId(activityId);
  const cId = normalizeId(classTypeId);
  if (aId == null) return false;

  return itemData.value.rules.some((rule, index) => {
    if (index === exceptIndex) return false;
    if (normalizeId(rule.subject_activity_type_id) !== aId) return false;
    return normalizeId(rule.class_type_id) === cId;
  });
};

const hasFreeClassTypeSlot = (activityId, exceptIndex = -1) => {
  const id = normalizeId(activityId);
  if (id == null) return false;
  if (isActivityBlockedByOthers(id, exceptIndex)) return false;

  const usedAnywhere = itemData.value.rules.some((rule, index) => {
    if (index === exceptIndex) return false;
    return normalizeId(rule.subject_activity_type_id) === id;
  });

  // not used yet → can pick once (shared or with a class type)
  if (!usedAnywhere) return true;

  // already used with stream(s) → only remaining streams are free
  return (classtype.value || []).some(
    (ct) => !isActivityClassTypeUsed(id, ct.id, exceptIndex),
  );
};

const availableActivities = (index) => {
  const currentId = normalizeId(
    itemData.value.rules[index]?.subject_activity_type_id,
  );

  return (subjectActivity.value || []).filter((activity) => {
    const id = normalizeId(activity.id);
    if (id === currentId) return true;
    if (isActivityBlockedByOthers(id, index)) return false;
    return hasFreeClassTypeSlot(id, index);
  });
};

const availableClassTypes = (index) => {
  const rule = itemData.value.rules[index];
  const activityId = normalizeId(rule?.subject_activity_type_id);
  const currentClassTypeId = normalizeId(rule?.class_type_id);

  if (activityId == null) return classtype.value || [];

  return (classtype.value || []).filter((ct) => {
    const id = normalizeId(ct.id);
    if (id === currentClassTypeId) return true;
    return !isActivityClassTypeUsed(activityId, id, index);
  });
};

const canAddMoreRules = computed(() =>
  (subjectActivity.value || []).some((activity) =>
    hasFreeClassTypeSlot(activity.id),
  ),
);

/** Shared rules only (no class_type) — Social/Science % do not sum together */
const sharedRules = computed(() =>
  itemData.value.rules.filter((rule) => isSharedRule(rule)),
);

const totalPercentage = computed(() =>
  sharedRules.value.reduce((sum, rule) => {
    const value = Number(rule.percentage);
    return sum + (Number.isFinite(value) ? value : 0);
  }, 0),
);

const remainingPercentage = computed(() =>
  Math.max(0, 100 - totalPercentage.value),
);

const isPercentageOverLimit = computed(() => totalPercentage.value > 100);

/**
 * Shared rows: sum ≤ 100 with other shared rows.
 * Class-type rows: only validate number; each stream is its own grading_rule.
 */
const percentageRuleValidator = (index) => (value) => {
  if (isChildSubject.value) return true;

  const rule = itemData.value.rules[index];

  if (!isSharedRule(rule)) {
    if (value === null || value === undefined || value === "") return true;
    const num = Number(value);
    if (!Number.isFinite(num) || num < 0) {
      return t("Percentage must be 0 or more");
    }
    return true;
  }

  if (value === null || value === undefined || value === "") {
    return requiredValidator(value);
  }

  const num = Number(value);
  if (!Number.isFinite(num) || num < 0) {
    return t("Percentage must be 0 or more");
  }

  const others = itemData.value.rules.reduce((sum, r, i) => {
    if (i === index || !isSharedRule(r)) return sum;
    const other = Number(r.percentage);
    return sum + (Number.isFinite(other) ? other : 0);
  }, 0);

  if (others + num > 100) {
    return t("Total percentage cannot exceed 100%");
  }

  return true;
};

const syncItemData = (newData = {}) => {
  itemData.value = {
    id: newData?.id ?? null,
    grade_id: newData?.grade_id ?? null,
    year_id: newData?.year_id ?? null,
    subject_id: newData?.subject_id ?? null,
    rules:
      Array.isArray(newData?.rules) && newData.rules.length
        ? newData.rules.map((rule) => ({
            id: rule.id ?? null,
            subject_activity_type_id: rule.subject_activity_type_id ?? null,
            class_type_id: rule.class_type_id ?? null,
            percentage: rule.percentage ?? null,
            max_score: rule.max_score ?? null,
            assessment_count: rule.assessment_count ?? 1,
          }))
        : [emptyRule()],
  };
};

watch(
  () => props.itemData,
  (newData) => {
    syncItemData(newData);
  },
  { deep: true, immediate: true },
);

watch(
  () => props.isDialogVisible,
  async (open) => {
    if (!open) return;
    subjects.value = (await getSubjects()) || [];
    subjectActivity.value = (await getSubjectActivity()) || [];
    classtype.value = (await getClassType()) || [];
  },
);

const resetData = () => {
  itemData.value = {
    id: null,
    grade_id: null,
    year_id: null,
    subject_id: null,
    rules: [emptyRule()],
  };
};

const addRule = () => {
  if (!canAddMoreRules.value) return;
  itemData.value.rules.push(emptyRule());
};

const removeRule = (index) => {
  if (itemData.value.rules.length <= 1) return;
  itemData.value.rules.splice(index, 1);
};

const clearActivityConflicts = (index) => {
  const current = itemData.value.rules[index];
  const activityId = normalizeId(current?.subject_activity_type_id);
  if (activityId == null) return;

  const classTypeId = normalizeId(current?.class_type_id);

  itemData.value.rules.forEach((rule, i) => {
    if (i === index) return;
    if (normalizeId(rule.subject_activity_type_id) !== activityId) return;

    const otherClassTypeId = normalizeId(rule.class_type_id);

    // current shared → clear other same activities
    if (classTypeId == null) {
      rule.subject_activity_type_id = null;
      rule.class_type_id = null;
      return;
    }

    // other shared → clear other
    if (otherClassTypeId == null) {
      rule.subject_activity_type_id = null;
      rule.class_type_id = null;
      return;
    }

    // same stream twice → clear other
    if (otherClassTypeId === classTypeId) {
      rule.subject_activity_type_id = null;
      rule.class_type_id = null;
    }
  });
};

const onActivityChange = (index) => {
  clearActivityConflicts(index);
};

const onClassTypeChange = (index) => {
  clearActivityConflicts(index);
};

const onFormSubmit = debounce(async (refForm) => {
  const { valid } = await refForm;
  if (!valid) return;

  if (!isChildSubject.value && isPercentageOverLimit.value) {
    console.warn("Total percentage cannot exceed 100%");
    return;
  }

  if (isChildExamOverLimit.value) {
    console.warn("Child Exam total exceeds parent Exam max");
    return;
  }

  const payload = {
    id: itemData.value.id,
    grade_id: itemData.value.grade_id,
    year_id: itemData.value.year_id,
    subject_id: itemData.value.subject_id,
    rules: itemData.value.rules.map((rule) => ({
      id: rule.id,
      subject_activity_type_id: rule.subject_activity_type_id,
      class_type_id: normalizeId(rule.class_type_id),
      percentage: rule.percentage,
      max_score: rule.max_score,
      assessment_count: rule.assessment_count ?? 1,
    })),
  };

  console.log("dialog submit", payload);

  const itemId = itemData.value.id || null;
  if (itemId) {
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

const subjectTitle = (item) =>
  locale.value === "km"
    ? item?.name_kh || item?.name_en
    : item?.name_en || item?.name_kh;

const activityTitle = (item) =>
  locale.value === "km"
    ? item?.name_kh || item?.name_en
    : item?.name_en || item?.name_kh;
</script>

<template>
  <AppAddEditDialog
    :title="
      itemData.id == null
        ? t('Create Subject Setting')
        : t('Update Subject Setting')
    "
    :is-dialog-visible="isDialogVisible"
    :is-update="itemData.id != null"
    :loading="loading"
    @on-close-dialog="onCloseDialog"
    @on-submit="onFormSubmit"
  >
    <VRow>
      <VCol cols="12" sm="6" md="6">
        <AppAutocomplete
          v-model="itemData.subject_id"
          :items="subjectItems"
          :item-title="subjectTitle"
          item-value="id"
          :label="t('Subject')"
          :rules="[requiredValidator]"
          autocomplete="off"
          clearable
        />
      </VCol>
    </VRow>

    <VAlert
      v-if="!isChildSubject && isPercentageOverLimit"
      type="error"
      variant="tonal"
      density="compact"
      class="mb-3"
    >
      {{ t("Total percentage cannot exceed 100%") }}
    </VAlert>

    <VAlert
      v-if="
        isChildSubject &&
        parentExamMaxDisplay != null &&
        formExamClassTypes.length
      "
      :type="isChildExamOverLimit ? 'error' : 'info'"
      variant="tonal"
      density="compact"
      class="mb-3"
    >
      <div>
        {{ t("Child Exam total") }}:
        <strong>{{ childExamSumDisplay }}</strong>
        /
        <strong>{{ parentExamMaxDisplay }}</strong>
        ({{ t("parent max") }})
      </div>
      <div v-if="isChildExamOverLimit" class="mt-1">
        {{
          t("Sum of child Exam max score cannot exceed parent Exam max score")
        }}
      </div>
      <div
        v-for="(err, i) in childExamLimitErrors"
        :key="i"
        class="mt-1 text-caption"
      >
        {{ classTypeLabelById(err.classTypeId) }}: {{ err.sum }} /
        {{ err.parentMax }}
      </div>
    </VAlert>

    <VAlert
      v-else-if="
        isChildSubject &&
        formExamClassTypes.length &&
        parentExamMaxDisplay == null
      "
      type="warning"
      variant="tonal"
      density="compact"
      class="mb-3"
    >
      {{
        t("Parent subject has no Exam max score yet. Create parent Exam first.")
      }}
    </VAlert>

    <VRow
      v-for="(rule, index) in itemData.rules"
      :key="index"
      align="center"
      dense
    >
      <VCol cols="6" sm="3" md="3" v-if="settingStore.curriculum_id == 2">
        <AppAutocomplete
          v-model="rule.class_type_id"
          :items="availableClassTypes(index)"
          :item-title="
            (item) => (locale === 'km' ? item.name_kh : item.name_en)
          "
          item-value="id"
          :label="t('Class Type')"
          clearable
          autocomplete="off"
          persistent-hint
          @update:model-value="onClassTypeChange(index)"
        />
      </VCol>
      <VCol cols="12" sm="3" md="3">
        <AppAutocomplete
          v-model="rule.subject_activity_type_id"
          :items="availableActivities(index)"
          :item-title="activityTitle"
          item-value="id"
          :label="t('Category')"
          :rules="[requiredValidator]"
          autocomplete="off"
          clearable
          @update:model-value="onActivityChange(index)"
        />
      </VCol>

      <VCol cols="6" sm="2" md="2">
        <AppTextField
          v-model="rule.percentage"
          type="number"
          :label="t('%')"
          :disabled="isChildSubject"
          :rules="isChildSubject ? [] : [percentageRuleValidator(index)]"
          persistent-hint
        />
      </VCol>

      <VCol cols="6" sm="2" md="2">
        <AppTextField
          v-model="rule.max_score"
          type="number"
          :label="t('MS')"
          :rules="[requiredValidator]"
        />
      </VCol>

      <VCol
        cols="12"
        sm="2"
        md="2"
        class="d-flex ga-1 align-center justify-end"
      >
        <VBtn
          v-if="itemData.rules.length > 1"
          icon
          size="small"
          color="error"
          variant="text"
          @click="removeRule(index)"
        >
          <VIcon icon="tabler-circle-minus" />
        </VBtn>

        <VBtn
          v-if="index === itemData.rules.length - 1 && canAddMoreRules"
          icon
          size="small"
          color="success"
          variant="text"
          @click="addRule"
        >
          <VIcon icon="tabler-circle-plus" />
        </VBtn>
      </VCol>
    </VRow>
  </AppAddEditDialog>
</template>
