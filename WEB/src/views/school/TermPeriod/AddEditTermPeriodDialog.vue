<script setup>
import { ref, watch } from "vue";
import { debounce } from "lodash";
import { requiredValidator } from "@/@core/utils/validators";
import { useI18n } from "vue-i18n";
import { useSettingStore } from "@/stores/settingStore";
import { useDisplay } from "vuetify";
import AppAddEditDialog from "@/components/AppAddEditDialog.vue";
import AppAddEditDrawer from "@/components/AppAddEditDrawer.vue";
import AppDateTimePicker from "@/@core/components/app-form-elements/AppDateTimePicker.vue";
import {
  getCurriculums,
  getYears,
  getCurrentYearId,
} from "@/services/dataService";

const { xs } = useDisplay();
const { t, locale } = useI18n();
const settingStore = useSettingStore();

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
    skipCheck: true,
    default: undefined,
  },
});

const emit = defineEmits(["onCreate", "onUpdate", "update:isDialogVisible"]);

const years = ref([]);
const curriculums = ref([]);

const datePickerConfig = {
  enableTime: false,
  dateFormat: "Y-m-d",
  altInput: true,
  altFormat: "d-m-Y",
};

const toNum = (v) => (v != null && v !== "" ? Number(v) : null);

const emptyForm = () => ({
  id: null,
  name_kh: "",
  name_en: "",
  year_id: toNum(getCurrentYearId()) ?? toNum(settingStore.year_id),
  cur_id: toNum(settingStore.curriculum_id),
  start_date: null,
  end_date: null,
});

const itemData = ref(emptyForm());

const normalizeRaw = (raw = {}) => {
  const d = raw?.term_period ?? raw ?? {};
  return {
    id: d.id ?? null,
    name_kh: d.name_kh ?? "",
    name_en: d.name_en ?? "",
    year_id: toNum(d.year_id) ?? toNum(getCurrentYearId()),
    cur_id: toNum(d.cur_id) ?? toNum(settingStore.curriculum_id),
    start_date: d.start_date ?? null,
    end_date: d.end_date ?? null,
  };
};

const applyFormData = (raw = {}) => {
  itemData.value = {
    ...emptyForm(),
    ...normalizeRaw(raw),
  };
};

const syncFromStore = () => {
  if (itemData.value.id) return;
  itemData.value.year_id =
    toNum(getCurrentYearId()) ?? toNum(settingStore.year_id);
  itemData.value.cur_id = toNum(settingStore.curriculum_id);
};

watch(
  () => props.itemData,
  (newData) => {
    if (!props.isDialogVisible) return;
    applyFormData(newData);
  },
  { deep: true },
);

watch(
  () => props.isDialogVisible,
  async (open) => {
    if (!open) return;

    const [yearsData, curriculumsData] = await Promise.all([
      getYears(),
      getCurriculums(),
    ]);

    years.value = yearsData || [];
    curriculums.value = curriculumsData || [];

    if (props.itemData?.id || props.itemData?.term_period?.id) {
      applyFormData(props.itemData);
    } else {
      applyFormData({});
      syncFromStore();
    }
  },
);

const endDateValidator = (value) => {
  if (!value || !itemData.value.start_date) return true;
  return (
    new Date(value) >= new Date(itemData.value.start_date) ||
    t("End date must be after or equal to start date")
  );
};

const resetData = () => {
  itemData.value = emptyForm();
};

const onFormSubmit = debounce(async (refForm) => {
  const { valid } = await refForm;
  if (!valid) return;

  const payload = {
    id: itemData.value.id,
    name_kh: itemData.value.name_kh || null,
    name_en: itemData.value.name_en || null,
    start_date: itemData.value.start_date,
    end_date: itemData.value.end_date,
  };

  if (!itemData.value.id) {
    payload.year_id = itemData.value.year_id;
    payload.cur_id = itemData.value.cur_id;
  }

  const isUpdate = !!itemData.value.id;

  emit(isUpdate ? "onUpdate" : "onCreate", payload, (ok) => {
    if (ok) resetData();
  });
}, 500);

const onCloseDialog = () => {
  resetData();
  emit("update:isDialogVisible", false);
};

const dialogTitle = () =>
  itemData.value.id == null
    ? t("Create Term Period")
    : t("Update Term Period");
</script>

<template>
  <AppAddEditDialog
    v-if="!xs"
    max-width="720"
    :title="dialogTitle()"
    :is-dialog-visible="isDialogVisible"
    :is-update="itemData.id != null"
    :loading="loading"
    @on-close-dialog="onCloseDialog"
    @on-submit="onFormSubmit"
  >
    <VRow>
      <VCol cols="12" sm="6">
        <AppTextField v-model="itemData.name_kh" :label="t('Name Kh')" />
      </VCol>

      <VCol cols="12" sm="6">
        <AppTextField
          v-model="itemData.name_en"
          :label="t('Name En')"
          :rules="[requiredValidator]"
        />
      </VCol>

      <VCol cols="12" sm="6">
        <AppDateTimePicker
          v-model="itemData.start_date"
          :label="t('Start Date')"
          :config="datePickerConfig"
          :rules="[requiredValidator]"
        />
      </VCol>

      <VCol cols="12" sm="6">
        <AppDateTimePicker
          v-model="itemData.end_date"
          :label="t('End Date')"
          :config="datePickerConfig"
          :rules="[requiredValidator, endDateValidator]"
        />
      </VCol>
      <VCol cols="12" sm="6">
        <AppAutocomplete
          v-model="itemData.year_id"
          :items="years"
          item-title="name"
          item-value="id"
          :label="t('Year')"
          autocomplete="off"
          persistent-hint
          :disabled="!!itemData.id"
          :rules="[requiredValidator]"
        />
      </VCol>

      <VCol cols="12" sm="6">
        <AppAutocomplete
          v-model="itemData.cur_id"
          :items="curriculums"
          :item-title="locale === 'km' ? 'name_kh' : 'name_en'"
          item-value="id"
          :label="t('Curriculum')"
          autocomplete="off"
          persistent-hint
          :disabled="!!itemData.id"
          :rules="[requiredValidator]"
        />
      </VCol>

      

    </VRow>
  </AppAddEditDialog>

  <AppAddEditDrawer
    v-else
    :title="dialogTitle()"
    :is-dialog-visible="isDialogVisible"
    :is-update="itemData.id != null"
    :loading="loading"
    @on-close-dialog="onCloseDialog"
    @on-submit="onFormSubmit"
  >
    <VRow>
      

      <VCol cols="12">
        <AppTextField v-model="itemData.name_kh" :label="t('Name Kh')" />
      </VCol>

      <VCol cols="12">
        <AppTextField
          v-model="itemData.name_en"
          :label="t('Name En')"
          :rules="[requiredValidator]"
        />
      </VCol>

      <VCol cols="12">
        <AppDateTimePicker
          v-model="itemData.start_date"
          :label="t('Start Date')"
          :config="datePickerConfig"
          :rules="[requiredValidator]"
        />
      </VCol>

      <VCol cols="12">
        <AppDateTimePicker
          v-model="itemData.end_date"
          :label="t('End Date')"
          :config="datePickerConfig"
          :rules="[requiredValidator, endDateValidator]"
        />
      </VCol>
      <VCol cols="12">
        <AppAutocomplete
          v-model="itemData.year_id"
          :items="years"
          item-title="name"
          item-value="id"
          :label="t('Year')"
          autocomplete="off"
          persistent-hint
          :disabled="!!itemData.id"
          :rules="[requiredValidator]"
        />
      </VCol>

      <VCol cols="12">
        <AppAutocomplete
          v-model="itemData.cur_id"
          :items="curriculums"
          :item-title="locale === 'km' ? 'name_kh' : 'name_en'"
          item-value="id"
          :label="t('Curriculum')"
          autocomplete="off"
          persistent-hint
          :disabled="!!itemData.id"
          :rules="[requiredValidator]"
        />
      </VCol>
    </VRow>
  </AppAddEditDrawer>
</template>