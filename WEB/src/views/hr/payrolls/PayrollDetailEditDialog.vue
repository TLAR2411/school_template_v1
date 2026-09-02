<script setup>
import { ref, watch, onMounted, defineProps, defineEmits } from "vue";
import { debounce } from "lodash";
import AppAddEditDialog from "@/components/AppAddEditDialog.vue";
import { api } from "@/utils/api.js";
import avatar1 from "@images/avatars/my-avatar-1.jpg";
import AppTextField from "@core/components/app-form-elements/AppTextField.vue";
import getImageUrl from "@/utils/image/getImageUrl.js";
import { useDialog } from "@/composables/useDialog.js";
import { useI18n } from "vue-i18n";
import CustomCheckboxes from "@/@core/components/app-form-elements/CustomCheckboxes.vue";

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

const { t } = useI18n();
const { showDialog } = useDialog();
const isLoading = ref(false);
const loanInfo = ref({});

const selectedCheckbox = ref([]);

const initFormData = () => ({
  base_salary: 0,
  gasoline_fee: 0,
  phone_card_fee: 0,
  position_fee: 0,
  work_days: 0,
  insurance_amount: 0,
  pension_fund_amount: 0,
  open_salary_amount: 0,
  net_salary: 0,
});

const formData = ref(initFormData());
const itemData = ref({ ...props.itemData });

const emit = defineEmits([
  "onCreate",
  "onUpdate",
  "onReload",
  "update:isDialogVisible",
]);

// Watch for changes in props.itemData
watch(
  () => props.itemData,
  (newData) => {
    itemData.value = { ...newData };
    initData(); // Re-initialize data when props change
  },
  { deep: true },
);

const resetData = () => {
  formData.value = initFormData(); // Reset form data
};

const initData = async () => {
  formData.value.payroll_detail_id = itemData.value.payroll_detail_id;
  const res = await api.post("payroll-details-show", {
    id: itemData.value.payroll_detail_id,
  });
  if (res.data.status) {
    formData.value = res.data.data;
  }
};

onMounted(async () => {
  isLoading.value = true;
  await initData();
  isLoading.value = false;
});

// Debounced form submission handler
const onFormSubmit = debounce(async (refForm) => {
  const { valid } = await refForm;
  if (valid) {
    let result = await showDialog({
      title: t("Do you want to store this record?"),
      icon: "warning",
      confirmColor: "error",
    });

    if (result) {
      try {
        isLoading.value = true;
        const res = await api.post("payroll-details-update", {
          ...formData.value,
          id: itemData.value.payroll_detail_id,
        });

        if (res.data.status) {
          resetData();
          initData();
          emit("onReload");
          onCloseDialog();
        } else {
          console.error("Error with the response:", res.data);
        }
      } catch (error) {
        console.error("Failed to fetch data:", error);
      } finally {
        isLoading.value = false;
      }
    }
  }
}, 500);

const onCloseDialog = () => {
  resetData();
  emit("update:isDialogVisible", false);
};

const calculateSalary = () => {
  const baseSalary = formData.value.base_salary ?? 0;
  const gasolineFee = formData.value.gasoline_fee ?? 0;
  const phoneCardFee = formData.value.phone_card_fee ?? 0;
  const positionFee = formData.value.position_fee ?? 0;

  const netSalary = baseSalary + gasolineFee + phoneCardFee + positionFee;
  formData.value.net_salary = netSalary;

  const actualWorkDays = formData.value.actual_work_days ?? 0;
  const workDays = formData.value.work_days ?? 0;

  const totalToByPay = (netSalary * workDays) / actualWorkDays;
  formData.value.total_to_be_pay = totalToByPay;

  const insurance = formData.value.insurance_amount;
  const pension = formData.value.pension_fund_amount;

  formData.value.open_salary_amount = totalToByPay - (insurance + pension);
};

watch(
  () => [
    formData.value.base_salary,
    formData.value.gasoline_fee,
    formData.value.phone_card_fee,
    formData.value.position_fee,
    formData.value.work_days,
    formData.value.insurance_amount,
    formData.value.pension_fund_amount,
  ],
  (newVal, oldVal) => {
    calculateSalary(); // Trigger when base_salary changes
  },
);
</script>

<template>
  <AppAddEditDialog
    title="Update Payroll"
    icon="tabler-cash"
    :is-dialog-visible="isDialogVisible"
    :is-update="true"
    :loading="isLoading"
    @on-close-dialog="onCloseDialog"
    @on-submit="onFormSubmit"
  >
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
        />
      </VCol>

      <VCol cols="12" sm="6">
        <AppTextField
          v-model="formData.net_salary"
          label="Net Salary"
          format-currency
          disabled
        />
      </VCol>
      <VCol cols="12" sm="6">
        <AppTextField
          v-model="formData.work_days"
          label="#Day"
          format-currency
        />
      </VCol>

      <VCol cols="12" sm="6">
        <AppTextField
          v-model="formData.insurance_amount"
          label="Insurance"
          format-currency
        />
      </VCol>
      <VCol cols="12" sm="6">
        <AppTextField
          v-model="formData.pension_fund_amount"
          label="Pension"
          format-currency
        />
      </VCol>

      <VCol cols="12" sm="12">
        <AppTextField
          v-model="formData.open_salary_amount"
          label="Open Salary"
          format-currency
          disabled
        />
      </VCol>
    </VRow>
  </AppAddEditDialog>
</template>
