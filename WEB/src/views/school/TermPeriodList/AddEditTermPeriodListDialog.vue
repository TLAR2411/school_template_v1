<script setup>
import { ref, watch, computed } from "vue";
import { debounce } from "lodash";
import { requiredValidator } from "@/@core/utils/validators";
import { useI18n } from "vue-i18n";
import { useDisplay } from "vuetify";
import AppAddEditDialog from "@/components/AppAddEditDialog.vue";
import AppAddEditDrawer from "@/components/AppAddEditDrawer.vue";
import { getEducationLevels, getMonths } from "@/services/dataService";

const { xs } = useDisplay();
const { t, locale } = useI18n();

const props = defineProps({
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
  loading: {
    type: Boolean,
    default: false,
  },
  /** Row from term-periods-list (must include id) */
  termPeriod: {
    type: Object,
    default: () => ({}),
  },
  /** bulk = create by edu_id | grade = edit one grade (later) */
  mode: {
    type: String,
    default: "bulk",
  },
  /** For mode=grade: { grade_id, study_months, exam_month } */
  itemData: {
    type: Object,
    default: () => ({}),
  },
});

const emit = defineEmits([
  "onCreate",
  "onUpdate",
  "update:isDialogVisible",
]);

const educationLevels = ref([]);
const months = ref([]);

const itemData = ref({
  term_period_id: null,
  edu_id: null,
  grade_id: null,
  study_months: [],
  exam_month: null,
});

const monthTitle = (m) =>
  locale.value === "km" ? m.name_kh : m.name_en;

const termLabel = computed(() => {
  const tp = props.termPeriod || {};
  if (locale.value === "km" && tp.name_kh) return tp.name_kh;
  return tp.name_en || tp.name_kh || `#${tp.id ?? ""}`;
});

const isBulk = computed(() => props.mode === "bulk");
const isUpdate = computed(() => props.mode === "grade" && !!itemData.value.grade_id);

const dialogTitle = computed(() => {
  if (isBulk.value) return t("Setup score months");
  return isUpdate.value ? t("Edit score months by grade") : t("Setup score months");
});

const studyMonthOptions = computed(() =>
  months.value.filter((m) => m.id !== itemData.value.exam_month),
);

const examMonthOptions = computed(() =>
  months.value.filter((m) => !itemData.value.study_months?.includes(m.id)),
);

const studyMonthsValidator = (v) =>
  (Array.isArray(v) && v.length > 0) || t("Select at least one study month");

const examNotInStudyValidator = (v) => {
  if (!v) return t("Exam month is required");
  if (itemData.value.study_months?.includes(v)) {
    return t("Exam month cannot be in study months");
  }
  return true;
};

const resetForm = () => {
  itemData.value = {
    term_period_id: props.termPeriod?.id ?? null,
    edu_id: null,
    grade_id: null,
    study_months: [],
    exam_month: null,
  };
};

const applyGradeEdit = (raw = {}) => {
  itemData.value = {
    term_period_id: props.termPeriod?.id ?? null,
    edu_id: null,
    grade_id: raw.grade_id ?? null,
    study_months: Array.isArray(raw.study_months)
      ? [...raw.study_months]
      : [],
    exam_month: raw.exam_month ?? null,
  };
};

watch(
  () => props.isDialogVisible,
  async (open) => {
    if (!open) return;

    const [eduData, monthData] = await Promise.all([
      getEducationLevels(),
      getMonths(),
    ]);
    educationLevels.value = eduData || [];
    months.value = monthData || [];

    if (props.mode === "grade") {
      applyGradeEdit(props.itemData);
    } else {
      resetForm();
      itemData.value.term_period_id = props.termPeriod?.id ?? null;
    }
  },
);

watch(
  () => props.itemData,
  (raw) => {
    if (!props.isDialogVisible || props.mode !== "grade") return;
    applyGradeEdit(raw);
  },
  { deep: true },
);

const onCloseDialog = () => {
  resetForm();
  emit("update:isDialogVisible", false);
};

const onFormSubmit = debounce(async (refForm) => {
  const { valid } = await refForm;
  if (!valid) return;

  const payload = {
    term_period_id: itemData.value.term_period_id,
    study_months: itemData.value.study_months,
    exam_month: itemData.value.exam_month,
  };

  if (isBulk.value) {
    payload.edu_id = itemData.value.edu_id;
    emit("onCreate", payload, (ok) => {
      if (ok) onCloseDialog();
    });
    return;
  }

  payload.grade_id = itemData.value.grade_id;
  emit("onUpdate", payload, (ok) => {
    if (ok) onCloseDialog();
  });
}, 500);
</script>

<template>
  <AppAddEditDialog
    v-if="!xs"
    max-width="640"
    :title="dialogTitle"
    :is-dialog-visible="isDialogVisible"
    :is-update="isUpdate"
    :loading="loading"
    @on-close-dialog="onCloseDialog"
    @on-submit="onFormSubmit"
  >
    <VAlert type="info" variant="tonal" class="mb-4" density="compact">
      {{ t("Term Period") }}: <strong>{{ termLabel }}</strong>
    </VAlert>

    <VRow>
      <VCol v-if="isBulk" cols="12">
        <AppAutocomplete
          v-model="itemData.edu_id"
          :items="educationLevels"
          :item-title="locale === 'km' ? 'name_kh' : 'name_en'"
          item-value="id"
          :label="t('Education Level')"
          autocomplete="off"
          :rules="[requiredValidator]"
        />
      </VCol>

      <VCol v-else cols="12">
        <AppTextField
          :model-value="props.itemData?.grade_label ?? itemData.grade_id"
          :label="t('Grade')"
          disabled
        />
      </VCol>

      <VCol cols="12">
        <AppAutocomplete
          v-model="itemData.study_months"
          :items="studyMonthOptions"
          :item-title="monthTitle"
          item-value="id"
          :label="t('Study months')"
          multiple
          chips
          closable-chips
          autocomplete="off"
          :rules="[studyMonthsValidator]"
        />
      </VCol>

      <VCol cols="12">
        <AppAutocomplete
          v-model="itemData.exam_month"
          :items="examMonthOptions"
          :item-title="monthTitle"
          item-value="id"
          :label="t('Exam / semester month')"
          autocomplete="off"
          :rules="[requiredValidator, examNotInStudyValidator]"
        />
      </VCol>
    </VRow>
  </AppAddEditDialog>

  <AppAddEditDrawer
    v-else
    :title="dialogTitle"
    :is-dialog-visible="isDialogVisible"
    :is-update="isUpdate"
    :loading="loading"
    @on-close-dialog="onCloseDialog"
    @on-submit="onFormSubmit"
  >
    <VAlert type="info" variant="tonal" class="mb-4" density="compact">
      {{ t("Term Period") }}: <strong>{{ termLabel }}</strong>
    </VAlert>

    <VRow>
      <VCol v-if="isBulk" cols="12">
        <AppAutocomplete
          v-model="itemData.edu_id"
          :items="educationLevels"
          :item-title="locale === 'km' ? 'name_kh' : 'name_en'"
          item-value="id"
          :label="t('Education Level')"
          autocomplete="off"
          :rules="[requiredValidator]"
        />
      </VCol>

      <VCol v-else cols="12">
        <AppTextField
          :model-value="props.itemData?.grade_label ?? itemData.grade_id"
          :label="t('Grade')"
          disabled
        />
      </VCol>

      <VCol cols="12">
        <AppAutocomplete
          v-model="itemData.study_months"
          :items="studyMonthOptions"
          :item-title="monthTitle"
          item-value="id"
          :label="t('Study months')"
          multiple
          chips
          closable-chips
          autocomplete="off"
          :rules="[studyMonthsValidator]"
        />
      </VCol>

      <VCol cols="12">
        <AppAutocomplete
          v-model="itemData.exam_month"
          :items="examMonthOptions"
          :item-title="monthTitle"
          item-value="id"
          :label="t('Exam / semester month')"
          autocomplete="off"
          :rules="[requiredValidator, examNotInStudyValidator]"
        />
      </VCol>
    </VRow>
  </AppAddEditDrawer>
</template>