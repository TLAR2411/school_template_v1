<script setup>
import { nextTick, ref, watch } from "vue";
import { debounce } from "lodash";
import { requiredValidator } from "@/@core/utils/validators";
import AppTextarea from "@/@core/components/app-form-elements/AppTextarea.vue";
import { useI18n } from "vue-i18n";
import { useSettingStore } from "@/stores/settingStore";
import {
  getGrades,
  getYears,
  getRooms,
  getClassType,
  getCurrentYearId,
  getShifts,
} from "@/services/dataService";
import AppAddEditDrawer from "@/components/AppAddEditDrawer.vue";
import { useDisplay } from "vuetify";

const { xs } = useDisplay();
const { t, locale } = useI18n();
const settingStore = useSettingStore();
const curId = ref(settingStore.curriculum_id);

const symbols = ref([
  { name: "ក", value: "ក" },
  { name: "ខ", value: "ខ" },
  { name: "គ", value: "គ" },
  { name: "ឃ", value: "ឃ" },
  { name: "ង", value: "ង" },
  { name: "ច", value: "ច" },
  { name: "A", value: "A" },
  { name: "B", value: "B" },
  { name: "C", value: "C" },
  { name: "D", value: "D" },
  { name: "E", value: "E" },
]);

const shifts = ref([]);

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

const grades = ref([]);
const years = ref([]);
const rooms = ref([]);
const classTypes = ref([]);
// Skip auto name sync while loading form (keeps customised names on edit open)
const isHydrating = ref(false);

const emit = defineEmits(["onCreate", "onUpdate", "update:isDialogVisible"]);

const emptyForm = () => ({
  name_kh: "",
  name_en: null,
  name_cn: null,
  description: null,
  grade_id: null,
  year_id: getCurrentYearId(),
  symbol: null,
  room_id: null,
  shift_id: null,
  class_type_id: null,
});

const itemData = ref({
  ...emptyForm(),
  ...props.itemData,
});

const gradeLabel = (item) => {
  if (item?.grade_level != null) return String(item.grade_level);
  return locale.value === "km" ? item.name_kh : item.name_en;
};

const selectedGrade = () =>
  grades.value.find((g) => g.id == itemData.value.grade_id) || null;

const buildClassNames = (grade, symbol) => {
  if (!grade || !symbol) {
    return { name_kh: "", name_en: null };
  }

  // Grade level (1, 2, 3...) → only name_kh: "1 ក"
  if (grade.grade_level != null) {
    return {
      name_kh: `${grade.grade_level} ${symbol}`,
      name_en: null,
    };
  }

  // Named grade → "Nursery A"
  return {
    name_en: grade.name_en ? `${grade.name_en} ${symbol}` : null,
    name_kh: grade.name_kh ? `${grade.name_kh} ${symbol}` : "",
  };
};

const syncClassNames = () => {
  const names = buildClassNames(selectedGrade(), itemData.value.symbol);
  itemData.value.name_kh = names.name_kh;
  itemData.value.name_en = names.name_en;
};

const applyFormData = async (raw = {}) => {
  isHydrating.value = true;
  itemData.value = {
    ...emptyForm(),
    name_kh: raw.name_kh ?? "",
    name_en: raw.name_en ?? null,
    name_cn: raw.name_cn ?? null,
    description: raw.description ?? null,
    symbol: raw.symbol ?? null,
    id: raw.id ?? null,

    class_type_id: raw.class_type_id != null ? Number(raw.class_type_id) : null,
    grade_id: raw.grade_id != null ? Number(raw.grade_id) : null,
    year_id: raw.year_id != null ? Number(raw.year_id) : getCurrentYearId(),
    room_id: raw.room_id != null ? Number(raw.room_id) : null,
    shift_id: raw.shift_id != null ? Number(raw.shift_id) : null,
  };
  await nextTick();
  isHydrating.value = false;
};

watch(
  () => props.itemData,
  (newData) => {
    if (!props.isDialogVisible) return;
    applyFormData(newData);
  },
  { deep: true },
);

// Auto-fill names when grade/symbol change; user can still edit name fields after
watch(
  () => [itemData.value.grade_id, itemData.value.symbol],
  () => {
    if (isHydrating.value) return;
    if (!itemData.value.grade_id || !itemData.value.symbol) return;
    syncClassNames();
  },
);

const resetData = () => {
  itemData.value = emptyForm();
};

const onFormSubmit = debounce(async (refForm) => {
  const { valid } = await refForm;
  if (!valid) return;

  const itemId = itemData.value.id || null;
  if (itemId) {
    emit("onUpdate", itemData.value, (res) => {
      if (res) resetData();
    });
  } else {
    emit("onCreate", itemData.value, (res) => {
      if (res) resetData();
    });
  }
}, 500);

const onCloseDialog = () => {
  resetData();
  emit("update:isDialogVisible", false);
};

watch(
  () => props.isDialogVisible,
  async (open) => {
    if (!open) return;

    const [gradesData, yearsData, roomsData, classTypeData, shiftData] =
      await Promise.all([
        getGrades(),
        getYears(),
        getRooms(),
        getClassType(),
        getShifts(),
      ]);

    grades.value = gradesData || [];
    years.value = yearsData || [];
    rooms.value = roomsData || [];
    classTypes.value = classTypeData || [];
    shifts.value = shiftData || [];

    await applyFormData(props.itemData || {});
  },
);
</script>

<template>
  <AppAddEditDialog
    v-if="!xs"
    max-width="700"
    :title="itemData.id == null ? t('Create Classes') : t('Update Classes')"
    :is-dialog-visible="isDialogVisible"
    :is-update="itemData.id != null"
    :loading="loading"
    @on-close-dialog="onCloseDialog"
    @on-submit="onFormSubmit"
  >
    <VRow>
      <VCol cols="12">
        <VRow>
          <VCol cols="5" sm="5" md="5">
            <AppAutocomplete
              v-model="itemData.grade_id"
              :items="grades"
              :item-title="gradeLabel"
              item-value="id"
              :label="t('Grade')"
              autocomplete="off"
              :rules="[requiredValidator]"
              persistent-hint
            />
          </VCol>

          <VCol cols="3" sm="3" md="3">
            <AppAutocomplete
              v-model="itemData.symbol"
              :items="symbols"
              item-title="name"
              item-value="value"
              :label="t('Symbol')"
              autocomplete="off"
              persistent-hint
              :rules="[requiredValidator]"
            />
          </VCol>

          <VCol cols="4" sm="4" md="4">
            <AppAutocomplete
              v-model="itemData.class_type_id"
              :items="classTypes"
              :item-title="
                (item) => (locale === 'km' ? item.name_kh : item.name_en)
              "
              item-value="id"
              :label="t('Class Type')"
              autocomplete="off"
              persistent-hint
            />
          </VCol>

          <VCol cols="4" sm="4" md="4">
            <AppAutocomplete
              v-model="itemData.room_id"
              :items="rooms"
              item-title="room_number"
              item-value="id"
              :label="t('Room')"
              autocomplete="off"
              persistent-hint
            />
          </VCol>

          <VCol cols="4" sm="4" md="4">
            <AppAutocomplete
              v-model="itemData.year_id"
              :items="years"
              item-title="name"
              item-value="id"
              :label="t('Year')"
              autocomplete="off"
              persistent-hint
              :rules="[requiredValidator]"
            />
          </VCol>

          <VCol cols="4" sm="4" md="4">
            <AppAutocomplete
              v-model="itemData.shift_id"
              :items="shifts"
              :item-title="
                (item) => (locale === 'km' ? item.name_kh : item.name_en)
              "
              item-value="id"
              :label="t('Shift')"
              autocomplete="off"
              persistent-hint
            />
          </VCol>
        </VRow>
      </VCol>

      <VCol cols="12">
        <VRow>
          <VCol cols="12" sm="4" md="4">
            <AppTextField v-model="itemData.name_kh" :label="t('Name Kh')" />
          </VCol>
          <VCol cols="12" sm="4" md="4">
            <AppTextField v-model="itemData.name_en" :label="t('Name En')" />
          </VCol>
          <VCol cols="12" sm="4" md="4">
            <AppTextField
              v-model="itemData.name_cn"
              :label="t('Name Cn')"
              :disabled="Number(curId) !== 3"
            />
          </VCol>
        </VRow>
      </VCol>

      <VCol cols="12">
        <AppTextarea
          v-model="itemData.description"
          :label="t('Description')"
          rows="2"
        />
      </VCol>
    </VRow>
  </AppAddEditDialog>

  <AppAddEditDrawer
    v-else
    :title="itemData.id == null ? t('Create Classes') : t('Update Classes')"
    :is-dialog-visible="isDialogVisible"
    :is-update="itemData.id != null"
    :loading="loading"
    @on-close-dialog="onCloseDialog"
    @on-submit="onFormSubmit"
  >
    <VRow>
      <VCol cols="12">
        <VRow>
          <VCol cols="8" sm="8" md="8">
            <AppAutocomplete
              v-model="itemData.grade_id"
              :items="grades"
              :item-title="gradeLabel"
              item-value="id"
              :label="t('Grade')"
              autocomplete="off"
              persistent-hint
              :rules="[requiredValidator]"
            />
          </VCol>

          <VCol cols="4" sm="4" md="4">
            <AppAutocomplete
              v-model="itemData.symbol"
              :items="symbols"
              item-title="name"
              item-value="value"
              :label="t('Symbol')"
              autocomplete="off"
              persistent-hint
              :rules="[requiredValidator]"
            />
          </VCol>

          <VCol cols="4" sm="4" md="4">
            <AppAutocomplete
              v-model="itemData.room_id"
              :items="rooms"
              item-title="room_number"
              item-value="id"
              :label="t('Room')"
              autocomplete="off"
              persistent-hint
            />
          </VCol>

          <VCol cols="8" sm="8" md="8">
            <AppAutocomplete
              v-model="itemData.year_id"
              :items="years"
              item-title="name"
              item-value="id"
              :label="t('Year')"
              autocomplete="off"
              persistent-hint
              :rules="[requiredValidator]"
            />
          </VCol>
        </VRow>
      </VCol>

      <VCol cols="12">
        <VRow>
          <VCol cols="12" sm="4" md="4">
            <AppTextField v-model="itemData.name_kh" :label="t('Name Kh')" />
          </VCol>
          <VCol cols="12" sm="4" md="4">
            <AppTextField
              v-model="itemData.name_en"
              :label="t('Name En')"
              :rules="[requiredValidator]"
            />
          </VCol>
          <VCol cols="12" sm="4" md="4">
            <AppTextField
              v-model="itemData.name_cn"
              :label="t('Name Cn')"
              :disabled="Number(curId) !== 3"
            />
          </VCol>
        </VRow>
      </VCol>

      <VCol cols="12">
        <AppTextarea
          v-model="itemData.description"
          :label="t('Description')"
          rows="2"
        />
      </VCol>
    </VRow>
  </AppAddEditDrawer>
</template>
