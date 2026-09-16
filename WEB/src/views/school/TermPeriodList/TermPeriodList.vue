<script setup>
import { computed, onMounted, ref, watch } from "vue";
import { useI18n } from "vue-i18n";
import { api } from "@/utils/api";
import { useDisplay } from "vuetify";
import { storeToRefs } from "pinia";
import { useAppStore } from "@/stores/appStore";
import { useSettingStore } from "@/stores/settingStore";
import AddEditTermPeriodListDialog from "./AddEditTermPeriodListDialog.vue";

const props = defineProps({
  termPeriodId: {
    type: [Number, String],
    required: true,
  },
  termPeriod: {
    type: Object,
    default: () => ({}),
  },
  listsByGrade: {
    type: Array,
    default: () => [],
  },
  loading: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(["refresh"]);

const { mdAndUp } = useDisplay();
const { t, locale } = useI18n();
const appStore = useAppStore();
const settingStore = useSettingStore();
const { years } = storeToRefs(appStore);

onMounted(() => {
  if (!years.value?.length) appStore.getYears();
});

const yearLabel = computed(() => {
  const yearId = props.termPeriod?.year_id;
  if (!yearId) return "";

  const fromList = years.value?.find((y) => y.id == yearId)?.name;
  if (fromList) return fromList;

  if (settingStore.year_id == yearId && settingStore.year_name) {
    return settingStore.year_name;
  }

  return String(yearId);
});

const tableTitle = computed(() => {
  const tp = props.termPeriod || {};
  const name =
    locale.value === "km" ? tp.name_kh || tp.name_en : tp.name_en || tp.name_kh;
  const year = yearLabel.value;

  if (name && year) return `${name} - ${year}`;
  if (name) return name;
  return t("Score months by grade");
});

const formData = ref({});
const isBulkDialogVisible = ref(false);
const isGradeDialogVisible = ref(false);
const isSaving = ref(false);
const dataTableRef = ref(null);

const filter = ref({
  search: null,
});

const tableItems = computed(() => {
  const isKm = locale.value === "km";
  return (props.listsByGrade || []).map((row) => ({
    ...row,
    id: row.id ?? row.grade_id,
    study_months_label: isKm
      ? row.study_months_label_kh || row.study_months_label
      : row.study_months_label || row.study_months_label_kh,
    exam_month_label: isKm
      ? row.exam_month_label_kh || row.exam_month_label
      : row.exam_month_label || row.exam_month_label_kh,
  }));
});

const gradeLabel = (item) => {
  if (item?.grade_level != null) return String(item.grade_level);
  return locale.value === "km"
    ? item.grade_name_kh || item.grade_name_en
    : item.grade_name_en || item.grade_name_kh;
};

const headers = [
  { title: t("Grade"), key: "grade_label", visible: true },
  { title: t("Three Months"), key: "study_months_label", visible: true },
  { title: t("Exam month"), key: "exam_month_label", visible: true },
  {
    title: t("Action"),
    key: "actions",
    align: "center",
    visible: true,
    fixed: mdAndUp.value,
  },
];

watch(
  () => props.listsByGrade,
  () => {
    dataTableRef.value?.reload();
  },
  { deep: true },
);

const onBulkCreate = async (data, callback) => {
  try {
    isSaving.value = true;
    const res = await api.post("term-period-lists-store", data);
    if (res.data.status) {
      emit("refresh");
      callback(true);
      return;
    }
    console.error("Error with the response:", res.data);
    callback(false);
  } catch (error) {
    console.error("Failed to create term period list:", error);
    callback(false);
  } finally {
    isSaving.value = false;
  }
};

const onEdit = (item) => {
  formData.value = {
    grade_id: item.grade_id,
    study_months: [...(item.study_months || [])],
    exam_month: item.exam_month,
    grade_label: gradeLabel(item),
  };
  isGradeDialogVisible.value = true;
};

const onUpdateGrade = async (data, callback) => {
  try {
    isSaving.value = true;
    const res = await api.post("term-period-lists-update", data);
    if (res.data.status) {
      emit("refresh");
      callback(true);
      return;
    }
    console.error("Error with the response:", res.data);
    callback(false);
  } catch (error) {
    console.error("Failed to update term period list:", error);
    callback(false);
  } finally {
    isSaving.value = false;
  }
};
</script>

<template>
  <AddEditTermPeriodListDialog
    v-model:isDialogVisible="isBulkDialogVisible"
    :term-period="termPeriod"
    :loading="isSaving"
    mode="bulk"
    @on-create="onBulkCreate"
  />

  <AddEditTermPeriodListDialog
    v-model:isDialogVisible="isGradeDialogVisible"
    :term-period="termPeriod"
    :item-data="formData"
    :loading="isSaving"
    mode="grade"
    @on-update="onUpdateGrade"
  />

  <AppCardTable
    ref="dataTableRef"
    :title="tableTitle"
    title-icon="tabler-calendar-month"
    saveHeaderName="header-term-period-lists"
    saveStateName="save-state-term-period-lists"
    :loading="loading || isSaving"
    v-model:filters="filter"
    :items="tableItems"
    :headers="headers"
    is-filter
    is-back
    is-edit
    save-state
    :is-back="false"
    @on-edit="onEdit"
  >
    <template #card-header>
      <VBtn
        color="primary"
        size="small"
        class="mr-2"
        prepend-icon="tabler-plus"
        variant="tonal"
        @click="isBulkDialogVisible = true"
      >
        {{ t("Setup") }}
      </VBtn>
    </template>

    <template #filter>
      <VRow class="justify-end">
        <VCol cols="12" sm="6" md="4" lg="3">
          <VTextField
            v-model="filter.search"
            :label="t('Search')"
            prepend-inner-icon="tabler-search"
            clearable
            hide-details
            autocomplete="off"
            clear-icon="tabler-x"
          />
        </VCol>
      </VRow>
    </template>

    <template #item.grade_label="{ item }">
      {{ gradeLabel(item) }}
    </template>
  </AppCardTable>
</template>
