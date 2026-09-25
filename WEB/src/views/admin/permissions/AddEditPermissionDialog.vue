<script setup>
import { debounce } from "lodash";
import AppTextField from "@core/components/app-form-elements/AppTextField.vue";
import AppCombobox from "@core/components/app-form-elements/AppCombobox.vue";
import { requiredValidator } from "@/@core/utils/validators";
import { buildPermissionName } from "@/utils/permissionName";

const emptyForm = () => ({
  id: null,
  group: "",
  display_name: "",
  name: "",
  description: "",
});

const props = defineProps({
  itemData: { type: Object, default: () => ({}) },
  groups: { type: Array, default: () => [] },
  isDialogVisible: { type: Boolean, required: true },
  loading: { type: Boolean, default: undefined },
});

const emit = defineEmits(["onCreate", "onUpdate", "update:isDialogVisible"]);

const form = ref(emptyForm());
const nameTouched = ref(false);

watch(
  () => props.itemData,
  (value) => {
    form.value = { ...emptyForm(), ...value };
    nameTouched.value = Boolean(value?.id);
  },
  { deep: true, immediate: true },
);

watch(
  () => [form.value.display_name, form.value.group],
  () => {
    if (nameTouched.value) return;

    form.value.name = buildPermissionName(
      form.value.display_name,
      form.value.group,
    );
  },
);

const resetData = () => {
  form.value = emptyForm();
  nameTouched.value = false;
};

const onFormSubmit = debounce(async (refForm) => {
  if (!refForm) return;

  const { valid } = await refForm;
  if (!valid) return;

  const event = form.value.id ? "onUpdate" : "onCreate";

  emit(event, { ...form.value }, (ok) => {
    if (ok) resetData();
  });
}, 500);

const onCloseDialog = () => {
  resetData();
  emit("update:isDialogVisible", false);
};
</script>

<template>
  <AppAddEditDialog
    :title="form.id ? $t('Update Permission') : $t('Create Permission')"
    :is-dialog-visible="isDialogVisible"
    :is-update="!!form.id"
    :loading="loading"
    max-width="640px"
    @on-close-dialog="onCloseDialog"
    @on-submit="onFormSubmit"
  >
    <VRow>
      <VCol cols="12" sm="6">
        <AppCombobox
          v-model="form.group"
          :items="groups"
          :label="$t('Group')"
          placeholder="users"
          :rules="[requiredValidator]"
        />
      </VCol>

      <VCol cols="12" sm="6">
        <AppTextField
          v-model="form.display_name"
          :label="$t('Display Name')"
          placeholder="view"
          :rules="[requiredValidator]"
        />
      </VCol>

      <VCol cols="12">
        <AppTextField
          v-model="form.name"
          :label="$t('Name')"
          placeholder="view-users"
          :rules="[requiredValidator]"
          :hint="$t('Auto from display name + group. You can edit it.')"
          persistent-hint
          @update:model-value="nameTouched = true"
        />
      </VCol>

      <VCol cols="12">
        <AppTextField
          v-model="form.description"
          :label="$t('Description')"
        />
      </VCol>
    </VRow>
  </AppAddEditDialog>
</template>
