<script setup>
import { ref, watch, nextTick, onMounted } from "vue";
import { debounce } from "lodash";
import { requiredValidator } from "@/@core/utils/validators";
import AppTextarea from "@/@core/components/app-form-elements/AppTextarea.vue";
import { useI18n } from "vue-i18n";
import { usePartStore } from "@/stores/partStore";
import { useSettingStore } from "@/stores/settingStore";
import { useDisplay } from "vuetify";
import AppAddEditDrawer from "@/components/AppAddEditDrawer.vue";
import AppAutocomplete from "@/@core/components/app-form-elements/AppAutocomplete.vue";
import { getEducationLevels, getCurriculums } from "@/services/dataService";
const { xs } = useDisplay();

const curId = ref(useSettingStore().curriculum_id);

const educationLevels = ref([]);

const curriculums = ref([]);

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
    skipCheck: true,
    default: undefined,
  },
});

const gradeLevels = ref([
  { id: 1, name: "Grade 1" },
  { id: 2, name: "Grade 2" },
  { id: 3, name: "Grade 3" },
  { id: 4, name: "Grade 4" },
  { id: 5, name: "Grade 5" },
  { id: 6, name: "Grade 6" },
  { id: 7, name: "Grade 7" },
  { id: 8, name: "Grade 8" },
  { id: 9, name: "Grade 9" },
  { id: 10, name: "Grade 10" },
  { id: 11, name: "Grade 11" },
  { id: 12, name: "Grade 12" },
]);

const emit = defineEmits(["onCreate", "onUpdate", "update:isDialogVisible"]);

const itemData = ref({
  name_kh: null,
  name_en: null,
  grade_level: null,
  edu_id: null,
  cur_id: curId.value,
  description: null,
  description: null,
  ...props.itemData,
});

watch(
  () => props.itemData,
  (newData) => {
    itemData.value = {
      name_kh: newData?.name_kh ?? "",
      name_en: newData?.name_en ?? null,
      grade_level: newData?.grade_level ?? null,
      edu_id: newData?.edu_id ?? null,
      cur_id: newData?.cur_id ?? null,
      description: newData?.description ?? null,
      id: newData?.id ?? null,
    };
  },
  { deep: true },
);

const resetData = () => {
  itemData.value = {
    name_kh: null,
    name_en: null,
    grade_level: null,
    edu_id: null,
    cur_id: null,
    description: null,
    description: null,
    description: null,
  };
};

const onFormSubmit = debounce(async (refForm) => {
  const { valid } = await refForm;
  if (valid) {
    const itemId = itemData.value.id || null;
    if (itemId) {
      emit("onUpdate", itemData.value, (res) => {
        if (res) {
          resetData();
        }
      });
    } else {
      emit("onCreate", itemData.value, (res) => {
        if (res) {
          resetData();
        }
      });
    }
  }
}, 500);

const onCloseDialog = () => {
  resetData();
  emit("update:isDialogVisible", false);
};

const dialogModelValueUpdate = (newVal) => {
  emit("update:isDialogVisible", newVal);
  isDialogVisible.value = newVal;
};

watch(
  () => props.isDialogVisible,
  async (open) => {
    if (!open) return;
    educationLevels.value = await getEducationLevels();
    curriculums.value = await getCurriculums();
    itemData.value.cur_id = curId.value;
  },
);
</script>

<template>
  <AppAddEditDialog
    v-if="!xs"
    max-width="700"
    :title="itemData.id == null ? t('Create Grades') : t('Update Grades')"
    :is-dialog-visible="isDialogVisible"
    :is-update="itemData.id != null ? true : false"
    :loading="loading"
    @on-close-dialog="onCloseDialog"
    @on-submit="onFormSubmit"
  >
    <VRow>
      <VCol cols="12" sm="4" md="4">
        <AppTextField v-model="itemData.name_kh" :label="t('Name Kh')" />
      </VCol>
      <VCol cols="12" sm="4" md="4">
        <AppTextField v-model="itemData.name_en" :label="t('Name En')" />
      </VCol>
      <VCol cols="12" sm="4" md="4">
        <AppAutocomplete
          v-model="itemData.grade_level"
          :label="t('Grade Level')"
          :items="gradeLevels"
          item-title="name"
          item-value="id"
        />
      </VCol>
      <VCol cols="12" sm="6" md="6">
        <AppAutocomplete
          v-model="itemData.cur_id"
          :label="t('Curriculum')"
          :items="curriculums"
          :item-title="locale === 'km' ? 'name_kh' : 'name_en'"
          item-value="id"
        />
      </VCol>
      <VCol cols="12" sm="6" md="6">
        <AppAutocomplete
          v-model="itemData.edu_id"
          :label="t('Education Level')"
          :items="educationLevels"
          :item-title="locale === 'km' ? 'name_kh' : 'name_en'"
          item-value="id"
        />
      </VCol>

      <VCol cols="12" sm="12" md="12">
        <AppTextarea
          v-model="itemData.description"
          :label="t('Description')"
          rows="2"
        >
        </AppTextarea>
      </VCol>
    </VRow>
  </AppAddEditDialog>

  <AppAddEditDrawer
    :title="itemData.id == null ? t('Create Grades') : t('Update Grades')"
    :is-dialog-visible="isDialogVisible"
    :is-update="itemData.id != null ? true : false"
    :loading="loading"
    @on-close-dialog="onCloseDialog"
    @on-submit="onFormSubmit"
    v-else
  >
    <VRow>
      <VCol cols="12" sm="4" md="4">
        <AppTextField
          v-model="itemData.name_kh"
          :label="t('Name Kh')"
          :rules="[requiredValidator]"
        />
      </VCol>
      <VCol cols="12" sm="4" md="4">
        <AppTextField
          v-model="itemData.name_en"
          :label="t('Name En')"
          :rules="[requiredValidator]"
        />
      </VCol>

      <VCol cols="12" sm="12" md="12">
        <AppTextarea
          v-model="itemData.description"
          :label="t('Description')"
          rows="2"
        >
        </AppTextarea>
      </VCol>
    </VRow>
  </AppAddEditDrawer>
</template>
