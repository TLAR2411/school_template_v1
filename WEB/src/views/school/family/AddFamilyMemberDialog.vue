<script setup>
import { computed, ref, watch } from "vue";
import { debounce } from "lodash";
import { useI18n } from "vue-i18n";
import { useDisplay } from "vuetify";
import { requiredValidator } from "@/@core/utils/validators";
import AppAddEditDrawer from "@/components/AppAddEditDrawer.vue";
import AppTextarea from "@/@core/components/app-form-elements/AppTextarea.vue";

const { xs } = useDisplay();
const { t } = useI18n();

const props = defineProps({
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
  loading: {
    type: Boolean,
    default: false,
  },
  itemData: {
    type: Object,
    default: () => ({}),
  },
});

const emit = defineEmits(["onCreate", "onUpdate", "update:isDialogVisible"]);

const guardianTypes = [
  { value: "father", name: t("Father") },
  { value: "mother", name: t("Mother") },
  { value: "grandparent", name: t("Grandparent") },
  { value: "sibling", name: t("Sibling") },
  { value: "legal_guardian", name: t("Legal Guardian") },
  { value: "other", name: t("Other") },
];

const emptyForm = () => ({
  id: null,
  type: "father",
  name_en: "",
  name_kh: "",
  phone: "",
  description: "",
});

const form = ref(emptyForm());

const isUpdate = computed(() => !!form.value.id);

const dialogTitle = computed(() =>
  isUpdate.value ? t("Update Member") : t("Add Member"),
);

const fillForm = (data = {}) => {
  form.value = {
    id: data.id ?? null,
    type: data.type || "father",
    name_en: data.name_en || "",
    name_kh: data.name_kh || "",
    phone: data.phone || "",
    description: data.description || "",
  };
};

const resetData = () => {
  form.value = emptyForm();
};

const onFormSubmit = debounce(async (refForm) => {
  const { valid } = await refForm;
  if (!valid) return;

  const payload = { ...form.value };

  if (isUpdate.value) {
    emit("onUpdate", payload, (ok) => {
      if (ok) resetData();
    });
  } else {
    emit("onCreate", payload, (ok) => {
      if (ok) resetData();
    });
  }
}, 500);

const onCloseDialog = () => {
  resetData();
  emit("update:isDialogVisible", false);
};

watch(
  () => props.itemData,
  (data) => {
    if (data && Object.keys(data).length) {
      fillForm(data);
    }
  },
  { deep: true, immediate: true },
);

watch(
  () => props.isDialogVisible,
  (open) => {
    if (!open) {
      resetData();
      return;
    }
    if (props.itemData && Object.keys(props.itemData).length) {
      fillForm(props.itemData);
    }
  },
);
</script>

<template>
  <div>
    <AppAddEditDialog
      v-if="!xs"
      :title="dialogTitle"
      :is-dialog-visible="isDialogVisible"
      :is-update="isUpdate"
      :loading="loading"
      max-width="600px"
      @on-submit="onFormSubmit"
      @on-close-dialog="onCloseDialog"
      @update:is-dialog-visible="emit('update:isDialogVisible', $event)"
    >
      <VRow>
        <VCol cols="12" md="6">
          <AppTextField
            v-model="form.name_en"
            :label="t('Name English')"
            :rules="[requiredValidator]"
            autocomplete="off"
          />
        </VCol>
        <VCol cols="12" md="6">
          <AppTextField
            v-model="form.name_kh"
            :label="t('Name Khmer')"
            :rules="[requiredValidator]"
            autocomplete="off"
          />
        </VCol>
        <VCol cols="12" md="6">
          <AppSelect
            v-model="form.type"
            :label="t('Type')"
            :items="guardianTypes"
            item-title="name"
            item-value="value"
            :rules="[requiredValidator]"
          />
        </VCol>
        <VCol cols="12" md="6">
          <AppTextField
            v-model="form.phone"
            :label="t('Phone')"
            :rules="[requiredValidator]"
            autocomplete="off"
          />
        </VCol>

        <!-- <VCol cols="12">
          <AppTextField
            v-model="form.email"
            :label="t('Email')"
            autocomplete="off"
          />
        </VCol> -->
        <VCol cols="12">
          <AppTextarea
            v-model="form.description"
            :label="t('Description')"
            rows="2"
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
      @on-submit="onFormSubmit"
      @on-close-dialog="onCloseDialog"
      @update:is-dialog-visible="emit('update:isDialogVisible', $event)"
    >
      <VRow>
        <VCol cols="12" md="3">
          <AppSelect
            v-model="form.type"
            :label="t('Type')"
            :items="guardianTypes"
            item-title="name"
            item-value="value"
            :rules="[requiredValidator]"
          />
        </VCol>
        <VCol cols="12" md="3">
          <AppTextField
            v-model="form.name_en"
            :label="t('Name English')"
            :rules="[requiredValidator]"
            autocomplete="off"
          />
        </VCol>
        <VCol cols="12" md="3">
          <AppTextField
            v-model="form.name_kh"
            :label="t('Name Khmer')"
            :rules="[requiredValidator]"
            autocomplete="off"
          />
        </VCol>
        <VCol cols="12" md="3">
          <AppTextField
            v-model="form.phone"
            :label="t('Phone')"
            :rules="[requiredValidator]"
            autocomplete="off"
          />
        </VCol>
        <!-- <VCol cols="12">
          <AppTextField
            v-model="form.email"
            :label="t('Email')"
            autocomplete="off"
          />
        </VCol> -->
        <VCol cols="12">
          <AppTextarea
            v-model="form.description"
            :label="t('Description')"
            rows="2"
          />
        </VCol>
      </VRow>
    </AppAddEditDrawer>
  </div>
</template>
