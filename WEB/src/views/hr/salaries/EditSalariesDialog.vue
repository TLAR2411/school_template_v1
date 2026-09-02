<script setup>
import AppDateTimePicker from "@/@core/components/app-form-elements/AppDateTimePicker.vue";
import AppTextField from "@/@core/components/app-form-elements/AppTextField.vue";
import { api } from "@/utils/api";
import formatDate from "@/utils/formater/formatDate";
import { onMounted, ref } from "vue";
import { useI18n } from "vue-i18n";
import { debounce } from "lodash";

const { t } = useI18n();
const props = defineProps({
  itemData: {
    type: Object,
    required: false,
    default: () => ({}),
  },
  isDialogVisible: {
    type: Boolean,
    required: false,
  },
  loading: {
    type: Boolean,
    required: false,
    skipCheck: true,
    default: undefined,
  },
});

const isLoading = ref(false);
const emit = defineEmits([
  "update:isDialogVisible",
  "update:loading",
  "onSubmit",
]);
const onCloseDialog = () => {
  emit("update:isDialogVisible", false);
};

const formData = ref({
  employee_id: props.itemData.employee_id ?? null,
  salary_id: props.itemData.salary_id ?? null,
  base_salary: 0,
  gasoline_fee: 0,
  phone_card_fee: 0,
  position_fee: 0,
  net_salary: 0,
  work_days: 0,
});

onMounted(async () => {
  try {
    isLoading.value = true;
    if (props?.itemData?.salary_id ?? null) {
      const res = await api.post("salaries-show", {
        id: props.itemData.salary_id ?? null,
      });
      if (res.data.status) {
        formData.value = { ...formData.value, ...res.data.data };
      }
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
});

const onSubmit = async () => {
  emit("onSubmit", formData.value);
  onCloseDialog();
};

watch(
  () => [
    formData?.value?.base_salary,
    formData?.value?.gasoline_fee,
    formData?.value?.phone_card_fee,
    formData?.value?.position_fee,
  ],
  debounce((newVal) => {
    console.log(newVal);

    const baseSalary = newVal[0] || 0;
    const gasolineFee = newVal[1] || 0;
    const phoneCardFee = newVal[2] || 0;
    const positionFee = newVal[3] || 0;
    const netSalary = baseSalary + gasolineFee + phoneCardFee + positionFee;

    formData.value.net_salary = netSalary;
  }, 100),
);
</script>

<template>
  <VDialog
    :model-value="isDialogVisible"
    persistent
    class="v-dialog-xl"
    max-width="800px"
  >
    <!-- Dialog close btn -->
    <DialogCloseBtn @click="onCloseDialog" />

    <!-- Dialog Content -->
    <VCard>
      <VCardItem
        style="
          padding-top: 12px;
          padding-bottom: 12px;
          background-color: rgba(211, 211, 211, 0.2);
        "
      >
        <span style="font-size: 18px">
          <VIcon icon="tabler-edit" start></VIcon>
          {{ $t("Edit Salary") }}
        </span>
      </VCardItem>
      <VDivider />
      <VCardText>
        <VRow>
          <VCol cols="12" sm="6">
            <AppTextField
              v-model="formData.base_salary"
              label="Base Salary"
              format-currency
            />
          </VCol>
          <VCol cols="12" sm="6">
            <AppTextField
              v-model="formData.gasoline_fee"
              label="Gasoline Fee"
              format-currency
            />
          </VCol>
          <VCol cols="12" sm="6">
            <AppTextField
              v-model="formData.phone_card_fee"
              label="Phone Card Fee"
              format-currency
            />
          </VCol>
          <VCol cols="12" sm="6">
            <AppTextField
              v-model="formData.position_fee"
              label="Position Fee"
              format-currency
              readonly
            />
          </VCol>
          <VCol cols="12" sm="6">
            <AppTextField
              v-model="formData.net_salary"
              label="Net Salary"
              format-currency
              readonly
            />
          </VCol>
          <VCol cols="12" sm="6">
            <AppTextField
              v-model="formData.work_days"
              label="Total Work Days"
              format-currency
            />
          </VCol>
        </VRow>
      </VCardText>

      <VDivider />
      <VCardText
        class="d-flex justify-space-between gap-3 flex-wrap"
        style="padding-top: 12px; padding-bottom: 12px"
      >
        <VBtn color="secondary" variant="tonal" @click="onCloseDialog">
          <VIcon start icon="tabler-arrow-left" />
          {{ $t("Close") }}
        </VBtn>
        <VBtn @click="onSubmit">
          <VIcon start icon="tabler-check" />
          {{ $t("Update") }}
        </VBtn>
      </VCardText>
    </VCard>
  </VDialog>
</template>
