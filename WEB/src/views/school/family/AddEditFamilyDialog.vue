<script setup>
import { computed, ref, watch } from "vue";
import { debounce } from "lodash";
import { requiredValidator } from "@/@core/utils/validators";
import AppTextarea from "@/@core/components/app-form-elements/AppTextarea.vue";
import { useI18n } from "vue-i18n";
import { useDisplay } from "vuetify";
import AppAddEditDrawer from "@/components/AppAddEditDrawer.vue";
import FamilyStudentSelect from "./FamilyStudentSelect.vue";

const { xs } = useDisplay();
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

const studentSelectRef = ref(null);

const guardianTypes = [
  { value: "father", name: t("Father") },
  { value: "mother", name: t("Mother") },
  { value: "grandparent", name: t("Grandparent") },
  { value: "sibling", name: t("Sibling") },
  { value: "legal_guardian", name: t("Legal Guardian") },
  { value: "other", name: t("Other") },
];

const emptyGuardian = () => ({
  id: null,
  name_en: "",
  name_kh: "",
  phone: "",
  email: "",
  type: "father",
  description: "",
});

const mapGuardians = (data) => {
  const list = data?.guardians || data?.member || [];
  if (Array.isArray(list) && list.length) {
    return list.map((g) => ({
      id: g.id ?? null,
      name_en: g.name_en || g.user_name || g.name || "",
      name_kh: g.name_kh || "",
      phone: g.phone || "",
      email: g.email || "",
      type: g.type || "other",
      description: g.description || "",
    }));
  }
  return [emptyGuardian(), { ...emptyGuardian(), type: "mother" }];
};

const mapStudents = (data) => {
  const list = data?.students || data?.student || [];
  return Array.isArray(list) ? list : [];
};

const itemData = ref({
  id: null,
  name_en: null,
  name_kh: null,
  description: null,
  student_ids: [],
  students: [],
  guardians: [emptyGuardian(), { ...emptyGuardian(), type: "mother" }],
});

const isUpdate = computed(() => !!itemData.value.id);

const fillForm = (newData = {}) => {
  const students = mapStudents(newData);
  itemData.value = {
    id: newData?.id ?? null,
    name_en: newData?.name_en ?? null,
    name_kh: newData?.name_kh ?? null,
    description: newData?.description ?? null,
    guardians: mapGuardians(newData),
    students,
    student_ids:
      newData?.student_ids ??
      students.map((s) => s.student_id || s.id).filter(Boolean),
  };
};

watch(
  () => props.itemData,
  (newData) => {
    if (newData && Object.keys(newData).length) {
      fillForm(newData);
    }
  },
  { deep: true, immediate: true },
);

const resetData = () => {
  itemData.value = {
    id: null,
    name_en: "",
    name_kh: "",
    description: "",
    guardians: [emptyGuardian(), { ...emptyGuardian(), type: "mother" }],
    students: [],
    student_ids: [],
  };
  studentSelectRef.value?.reset();
};

const addGuardian = () => {
  if (isUpdate.value) return;
  itemData.value.guardians.push(emptyGuardian());
};

const removeGuardian = (index) => {
  if (isUpdate.value) return;
  if (itemData.value.guardians.length <= 1) return;
  itemData.value.guardians.splice(index, 1);
};

const onFormSubmit = debounce(async (refForm) => {
  const { valid } = await refForm;
  if (!valid) return;

  if (isUpdate.value) {
    emit(
      "onUpdate",
      {
        id: itemData.value.id,
        name_en: itemData.value.name_en,
        name_kh: itemData.value.name_kh,
        description: itemData.value.description,
      },
      (res) => {
        if (res) resetData();
      },
    );
    return;
  }

  const payload = {
    ...itemData.value,
    guardians: (itemData.value.guardians || []).filter(
      (g) => g.name_en || g.name_kh,
    ),
  };

  emit("onCreate", payload, (res) => {
    if (res) resetData();
  });
}, 500);

const onCloseDialog = () => {
  resetData();
  emit("update:isDialogVisible", false);
};

const dialogModelValueUpdate = (newVal) => {
  emit("update:isDialogVisible", newVal);
};
</script>

<template>
  <div>
    <AppAddEditDialog
      v-if="!xs"
      :title="isUpdate ? t('Update Family') : t('Create Family')"
      :is-dialog-visible="isDialogVisible"
      :is-update="isUpdate"
      :loading="loading"
      max-width="900px"
      @on-submit="onFormSubmit"
      @on-close-dialog="onCloseDialog"
      @update:is-dialog-visible="dialogModelValueUpdate"
    >
      <VRow>
        <!-- Create: select students. Edit: read-only chips -->
        <VCol v-if="!isUpdate" cols="12">
          <FamilyStudentSelect
            ref="studentSelectRef"
            v-model="itemData.student_ids"
            :active="isDialogVisible"
          />
        </VCol>
        <VCol v-else cols="12">
          <div class="text-subtitle-2 mb-2">{{ t("Students") }}</div>
          <div v-if="itemData.students?.length" class="d-flex flex-wrap ga-1">
            <VChip
              v-for="s in itemData.students"
              :key="s.student_id || s.id"
              size="small"
              variant="tonal"
            >
              {{ s.name_en || s.name_kh || s.student_id || s.id }}
            </VChip>
          </div>
          <div v-else class="text-body-2 text-medium-emphasis">
            {{ t("No students") }}
          </div>
        </VCol>

        <VCol cols="12" md="6">
          <AppTextField
            v-model="itemData.name_en"
            :label="t('Name English')"
            :rules="[requiredValidator]"
            autocomplete="off"
          />
        </VCol>
        <VCol cols="12" md="6">
          <AppTextField
            v-model="itemData.name_kh"
            :label="t('Name Khmer')"
            :rules="[requiredValidator]"
            autocomplete="off"
          />
        </VCol>
        <VCol cols="12">
          <AppTextarea
            v-model="itemData.description"
            :label="t('Description')"
            rows="2"
          />
        </VCol>

        <VCol cols="12" class="d-flex align-center justify-space-between">
          <div class="text-subtitle-1">{{ t("Guardians") }}</div>
          <VBtn
            v-if="!isUpdate"
            size="small"
            variant="tonal"
            @click="addGuardian"
          >
            {{ t("Add Guardian") }}
          </VBtn>
        </VCol>

        <VCol
          v-for="(g, index) in itemData.guardians"
          :key="g.id || index"
          cols="12"
        >
          <VCard variant="outlined" class="pa-3">
            <VRow>
              <VCol cols="12" md="3">
                <AppSelect
                  v-model="g.type"
                  :label="t('Type')"
                  :items="guardianTypes"
                  item-title="name"
                  item-value="value"
                  :disabled="isUpdate"
                  :rules="isUpdate ? [] : [requiredValidator]"
                />
              </VCol>
              <VCol cols="12" md="3">
                <AppTextField
                  v-model="g.name_en"
                  :label="t('Name English')"
                  autocomplete="off"
                  :disabled="isUpdate"
                  :rules="isUpdate ? [] : [requiredValidator]"
                />
              </VCol>
              <VCol cols="12" md="3">
                <AppTextField
                  v-model="g.name_kh"
                  :label="t('Name Khmer')"
                  autocomplete="off"
                  :disabled="isUpdate"
                  :rules="isUpdate ? [] : [requiredValidator]"
                />
              </VCol>
              <VCol cols="12" md="3">
                <AppTextField
                  v-model="g.phone"
                  :label="t('Phone')"
                  autocomplete="off"
                  :disabled="isUpdate"
                  :rules="isUpdate ? [] : [requiredValidator]"
                />
              </VCol>
              <VCol v-if="!isUpdate" cols="12" class="d-flex justify-end">
                <VBtn
                  size="small"
                  color="error"
                  variant="text"
                  :disabled="itemData.guardians.length <= 1"
                  @click="removeGuardian(index)"
                >
                  {{ t("Remove") }}
                </VBtn>
              </VCol>
            </VRow>
          </VCard>
        </VCol>
      </VRow>
    </AppAddEditDialog>

    <AppAddEditDrawer
      v-else
      :title="isUpdate ? t('Update Family') : t('Create Family')"
      :is-dialog-visible="isDialogVisible"
      :is-update="isUpdate"
      :loading="loading"
      @on-submit="onFormSubmit"
      @on-close-dialog="onCloseDialog"
      @update:is-dialog-visible="dialogModelValueUpdate"
    >
      <VRow>
        <VCol v-if="!isUpdate" cols="12">
          <FamilyStudentSelect
            ref="studentSelectRef"
            v-model="itemData.student_ids"
            :active="isDialogVisible"
          />
        </VCol>
        <VCol v-else cols="12">
          <div class="text-subtitle-2 mb-2">{{ t("Students") }}</div>
          <div v-if="itemData.students?.length" class="d-flex flex-wrap ga-1">
            <VChip
              v-for="s in itemData.students"
              :key="s.student_id || s.id"
              size="small"
              variant="tonal"
            >
              {{ s.name_en || s.name_kh || s.student_id || s.id }}
            </VChip>
          </div>
          <div v-else class="text-body-2 text-medium-emphasis">
            {{ t("No students") }}
          </div>
        </VCol>

        <VCol cols="12">
          <AppTextField
            v-model="itemData.name_en"
            :label="t('Name English')"
            :rules="[requiredValidator]"
            autocomplete="off"
          />
        </VCol>
        <VCol cols="12">
          <AppTextField
            v-model="itemData.name_kh"
            :label="t('Name Khmer')"
            :rules="[requiredValidator]"
            autocomplete="off"
          />
        </VCol>
        <VCol cols="12">
          <AppTextarea
            v-model="itemData.description"
            :label="t('Description')"
            rows="2"
          />
        </VCol>

        <VCol cols="12" class="d-flex align-center justify-space-between">
          <div class="text-subtitle-1">{{ t("Guardians") }}</div>
          <VBtn
            v-if="!isUpdate"
            size="small"
            variant="tonal"
            @click="addGuardian"
          >
            {{ t("Add Guardian") }}
          </VBtn>
        </VCol>

        <VCol
          v-for="(g, index) in itemData.guardians"
          :key="g.id || index"
          cols="12"
        >
          <VCard variant="outlined" class="pa-3">
            <VRow>
              <VCol cols="12">
                <AppSelect
                  v-model="g.type"
                  :label="t('Type')"
                  :items="guardianTypes"
                  item-title="name"
                  item-value="value"
                  :disabled="isUpdate"
                  :rules="isUpdate ? [] : [requiredValidator]"
                />
              </VCol>
              <VCol cols="12">
                <AppTextField
                  v-model="g.name_en"
                  :label="t('Name English')"
                  :disabled="isUpdate"
                  :rules="isUpdate ? [] : [requiredValidator]"
                />
              </VCol>
              <VCol cols="12">
                <AppTextField
                  v-model="g.phone"
                  :label="t('Phone')"
                  :disabled="isUpdate"
                />
              </VCol>
              <VCol v-if="!isUpdate" cols="12" class="d-flex justify-end">
                <VBtn
                  size="small"
                  color="error"
                  variant="text"
                  :disabled="itemData.guardians.length <= 1"
                  @click="removeGuardian(index)"
                >
                  {{ t("Remove") }}
                </VBtn>
              </VCol>
            </VRow>
          </VCard>
        </VCol>
      </VRow>
    </AppAddEditDrawer>
  </div>
</template>
