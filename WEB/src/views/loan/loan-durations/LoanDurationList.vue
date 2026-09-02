<script setup lang="ts">
import formatCurrency from "@/utils/formater/formatCurrency";
import AddEditClassesDialog from "@/views/loan/loan-durations/AddEditDialog.vue";
import { useI18n } from "vue-i18n";
import { ref } from "vue";
import { api } from "@/utils/api";
import { definePage } from "vue-router/auto";

definePage({
  meta: {
    title: "Loan Durations",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});

const { t } = useI18n();
const dataTableRef = ref(null);
const isDialogVisible = ref(false);
const isLoading = ref(true);
const formData = ref({});

const headers = [
  //   { title: t("ID"), key: "id" },
  { title: t("Name"), key: "name" },
  //   { title: t("Name English"), key: "name_en" },
  { title: t("Loan Terms"), key: "loan_term.name_kh" },
  { title: t("Duration"), key: "duration", align: "center" },
  {
    title: t("Interest Rate"),
    key: "interest_rate",
    value: (item) => {
      return `${formatCurrency(item.interest_rate)} %`;
    },
    align: "center",
  },
  {
    title: t("Insurance Amount"),
    key: "insurance_amount",
    value: (item) => {
      return formatCurrency(item.insurance_amount);
    },
    align: "end",
  },
  {
    title: t("Insurance Rate"),
    key: "insurance_Rate",
    value: (item) => {
      return `${formatCurrency(item.insurance_rate)} %`;
    },
    align: "end",
  },

  {
    title: t("Loan Fee Rate"),
    key: "loan_fee_rate",
    value: (item) => {
      return `${formatCurrency(item.loan_fee_rate)} %`;
    },
    align: "center",
  },
  {
    title: t("Deposit Rate"),
    key: "deposit_rate",
    value: (item) => {
      return `${formatCurrency(item.deposit_rate)} %`;
    },
    align: "center",
  },

  {
    title: t("Penalty Amount"),
    key: "penalty_amount",
    value: (item) => {
      return formatCurrency(item.penalty_amount);
    },
    align: "end",
  },
  {
    title: t("Penalty Rate"),
    key: "penalty_rate",
    value: (item) => {
      return `${formatCurrency(item.penalty_rate)} %`;
    },
    align: "center",
  },

  {
    title: t("Operation Fee Amount"),
    key: "operation_amount",
    value: (item) => {
      return formatCurrency(item.operation_fee_amount);
    },
    align: "end",
  },
  {
    title: t("Operation Fee Rate"),
    key: "operation_rate",
    value: (item) => {
      return `${formatCurrency(item.operation_fee_rate)} %`;
    },
    align: "center",
  },
  { title: t("Round Range"), key: "round_range", align: "center" },
  { title: t("Status"), key: "is_active", align: "center" },
  { title: t("Action"), key: "actions", align: "center" },
];

const onCreate = async (data, callback) => {
  try {
    isLoading.value = true;

    const res = await api.post("loan-durations-store", data);

    if (res.data.status) {
      dataTableRef.value.reload();
      isDialogVisible.value = false;
    } else {
      console.error("Error with the response:", res.data);
    }
    callback(res.data.status);
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

const onEdit = async (item) => {
  try {
    isLoading.value = true;

    const res = await api.post("loan-durations-show", { id: item.id });

    if (res.data.status) {
      formData.value = res.data.data;
      // console.log(formData.value)
      isDialogVisible.value = true;
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

const onUpdate = async (data, callback) => {
  try {
    isLoading.value = true;

    const res = await api.post("loan-durations-update", data);

    if (res.data.status) {
      dataTableRef.value.reload();
      isDialogVisible.value = false;
    } else {
      console.error("Error with the response:", res.data);
    }
    callback(res.data.status);
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};
</script>

<template>
  <AddEditClassesDialog
    v-model:isDialogVisible="isDialogVisible"
    :item-data="formData"
    :loading="isLoading"
    @on-create="onCreate"
    @on-update="onUpdate"
  />

  <AppCardTable
    v-model:isDialogCreateVisible="isDialogVisible"
    ref="dataTableRef"
    title="Loan Durations"
    title-icon="tabler-clock"
    saveHeaderName="header-loan-durations-list"
    saveStateName="save-state-loan-durations-list"
    v-model:loading="isLoading"
    api-url="loan-durations-list"
    :headers="headers"
    is-excel
    is-edit
    create-dialog
    save-state
    @onEdit="onEdit"
  >
    <template v-slot:item.is_active="{ item }">
      <VChip color="success" size="small" v-if="item.is_active == true">
        {{ $t("Active") }}
      </VChip>
      <VChip color="error" size="small" v-if="item.is_active == false">
        {{ $t("Inactive") }}
      </VChip>
    </template>
  </AppCardTable>
</template>
