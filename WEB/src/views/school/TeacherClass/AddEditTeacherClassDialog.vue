<script setup>
import { ref, watch, nextTick, onMounted } from "vue";
import { debounce } from "lodash";
import { requiredValidator } from "@/@core/utils/validators";
import AppTextarea from "@/@core/components/app-form-elements/AppTextarea.vue";
import { useI18n } from "vue-i18n";
import { getTeachers } from "@/services/dataService";
import { useSettingStore } from "@/stores/settingStore";
import { api } from "@/utils/api";

const store = useSettingStore();

const teachers = ref([]);

const subjects = ref([]);

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
  class_id: {
    type: Number,
  },
});

// watch(
//   () => store.branch_id,
//   async (newVal) => {
//     if (newVal) {
//       teachers.value = await getTeacher();
//       subjects.value = await getSubjects();
//     }
//   },
// );

console.log("itemProps", props.itemData);

const emit = defineEmits(["onCreate", "onUpdate", "update:isDialogVisible"]);

const itemData = ref({
  teacher_id: "",
  subject_ids: [],
  is_assisstant: null,
  is_classload: null,
  description: "",
  isEdit: false,
  old_teacher_id: null,
  ...props.itemData,
});

watch(
  () => props.itemData,
  (newData) => {
    itemData.value = {
      teacher_id: newData?.teacher_id ?? "",
      subject_ids: newData?.subject_ids ?? [],
      is_assisstant: newData?.is_assisstant ?? "",
      is_classload: newData?.is_classload ?? "",
      description: newData?.description ?? "",
      isEdit: newData?.isEdit ?? false,
      old_teacher_id: newData?.teacher_id ?? null,
      id: newData?.id ?? null,
    };
  },
  { deep: true },
);

const resetData = () => {
  itemData.value = {
    teacher_id: "",
    subject_ids: [],
    is_assisstant: null,
    is_classload: null,
    description: "",
    isEdit: false,
  };
};

const onFormSubmit = debounce(async (refForm) => {
  const { valid } = await refForm;
  if (valid) {
    const itemId = itemData.value.id || null;
    if (itemData.value.isEdit) {
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

// onMounted(async () => {
//   if (store.branch_id != "*") {
//     // teachers.value = await getTeacher();
//     // subjects.value = await getSubjects();
//   }
// });

watch(
  () => props.isDialogVisible,
  async (open) => {
    if (!open) return;
    getGradingRuleSubjects();
    teachers.value = await getTeachers();

    if (props.itemData?.id) return;
  },
);

const getGradingRuleSubjects = async () => {
  try {
    const res = await api.post("grading-rules-subjects", {
      classId: props.class_id,
    });
    subjects.value = res.data.data;
    console.log("getSubject", res.data);
  } catch (error) {
    console.log("getSubject", error);
  }
};
</script>

<template>
  <AppAddEditDialog
    max-width="600"
    :title="
      itemData.isEdit ? t('Update Teacher Class') : t('Add Teacher Class')
    "
    :is-dialog-visible="isDialogVisible"
    :is-update="itemData.id != null ? true : false"
    :loading="loading"
    :show-tour-help="!itemData.id"
    @on-tour-help="startAddTeacherDialogTour({ force: true })"
    @on-close-dialog="onCloseDialog"
    @on-submit="onFormSubmit"
  >
    <VRow id="page-tour-class-teacher-form">
      <VCol cols="12" sm="6" md="6">
        <AppAutocomplete
          v-model="itemData.teacher_id"
          :items="teachers"
          :item-title="(item) => (locale == 'km' ? item.name_kh : item.name_en)"
          item-value="id"
          :label="t('Teachers')"
          autocomplete="off"
          persistent-hint
        />
      </VCol>
      <VCol cols="12" sm="6" md="6" class="d-flex ga-5">
        <VCheckbox v-model="itemData.is_assisstant" :label="t('Assistance')" />
        <VCheckbox v-model="itemData.is_classload" :label="t('Classload')" />
      </VCol>

      <VCol cols="12" sm="12" md="12">
        <AppAutocomplete
          :disabled="itemData.isEdit"
          v-model="itemData.subject_ids"
          :items="subjects"
          :item-title="(item) => (locale == 'km' ? item.name_kh : item.name_en)"
          item-value="id"
          :label="t('Subject')"
          autocomplete="off"
          multiple
          persistent-hint
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
</template>
