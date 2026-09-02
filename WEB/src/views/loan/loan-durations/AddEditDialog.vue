<script setup>
import { ref, watch, nextTick } from "vue";
import { debounce } from "lodash";
import AppSelect from "@/@core/components/app-form-elements/AppSelect.vue";

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

const itemData = ref({ loan_term_id: 1, round_range: 1, ...props.itemData });

watch(
  () => props.itemData,
  (newData) => {
    itemData.value = { ...newData };
  },
  { deep: true },
);

const resetData = () => {
  itemData.value = {
    loan_term_id: 1,
    duration: 0,

    insurance_amount: 0,
    insurance_rate: 0,

    interest_rate: 0,
    loan_fee_rate: 0,
    deposit_rate: 0,

    penalty_rate: 0,
    penalty_amount: 0,

    operation_fee_rate: 0,
    operation_fee_amount: 0,

    round_range: 1,
  };
};

const loanTerms = [
  { id: 1, name_kh: "១ ថ្ងៃម្ដង" },
  { id: 2, name_kh: "១ សប្ដាហ៍ម្ដង" },
  { id: 3, name_kh: "២ សប្ដាហ៍ម្ដង" },
  { id: 4, name_kh: "១ ខែម្ដង" },
];

const roundRange = [
  { name: "មិនបង្គត់", value: 1 },
  { name: "បង្គត់យក 10", value: 10 },
  { name: "បង្គត់យក 100", value: 100 },
  { name: "បង្គត់យក 500", value: 500 },
];

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
</script>

<template>
  <AppAddEditDialog
    :title="
      itemData.id == null ? 'Create Loan Duration' : 'Update Loan Duration'
    "
    :is-dialog-visible="isDialogVisible"
    :is-update="itemData.id != null ? true : false"
    :loading="loading"
    @on-close-dialog="onCloseDialog"
    @on-submit="onFormSubmit"
  >
    <VRow>
      <VCol cols="12" sm="6" md="6">
        <AppSelect
          v-model="itemData.loan_term_id"
          label="Loan Terms"
          :items="loanTerms"
          item-title="name_kh"
          item-value="id"
        />
      </VCol>
      <VCol cols="12" sm="6" md="6">
        <AppTextField
          v-model="itemData.duration"
          label="Duration"
          format-currency
        />
      </VCol>
      <VCol cols="12" sm="6" md="12">
        <AppTextField
          v-model="itemData.interest_rate"
          label="Interest Rate"
          format-currency
          suffix="%"
        />
      </VCol>

      <VCol cols="12" sm="6" md="6">
        <AppTextField
          v-model="itemData.insurance_amount"
          label="Insurance Amount"
          format-currency
        />
      </VCol>

      <VCol cols="12" sm="6" md="6">
        <AppTextField
          v-model="itemData.insurance_rate"
          label="Insurance Rate"
          format-currency
        />
      </VCol>

      <VCol cols="12" sm="6" md="6">
        <AppTextField
          v-model="itemData.loan_fee_rate"
          label="Loan Fee Rate"
          format-currency
          suffix="%"
        />
      </VCol>
      <VCol cols="12" sm="6" md="6">
        <AppTextField
          v-model="itemData.deposit_rate"
          label="Deposit Rate"
          format-currency
          suffix="%"
        />
      </VCol>

      <VCol cols="12" sm="6" md="6">
        <AppTextField
          v-model="itemData.penalty_amount"
          label="Penalty Amount"
          format-currency
        />
      </VCol>
      <VCol cols="12" sm="6" md="6">
        <AppTextField
          v-model="itemData.penalty_rate"
          label="Penalty Rate"
          format-currency
          suffix="%"
        />
      </VCol>

      <VCol cols="12" sm="6" md="6">
        <AppTextField
          v-model="itemData.operation_fee_amount"
          label="Operation Fee Amount"
          format-currency
        />
      </VCol>
      <VCol cols="12" sm="6" md="6">
        <AppTextField
          v-model="itemData.operation_fee_rate"
          label="Operation Fee Rate"
          format-currency
          suffix="%"
        />
      </VCol>

      <VCol cols="12" sm="12" md="12">
        <AppSelect
          v-model="itemData.round_range"
          label="Round Range"
          :items="roundRange"
          item-title="name"
          item-value="value"
        />
      </VCol>
    </VRow>
  </AppAddEditDialog>
</template>
