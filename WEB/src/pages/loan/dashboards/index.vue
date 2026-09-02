<script setup>
definePage({
  meta: {
    title: "Dashboards",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
  },
});

import { api } from "@/utils/api";
import { useSettingStore } from "@/stores/settingStore";
import DailyResult from "@/views/loan/dashboards/DailyResult.vue";
// import ResultAndDailyPlan from "@/views/loan/dashboards/ResultAndDailyPlan.vue";
import LoanOverview from "@/views/loan/dashboards/LoanOverview.vue";
import MonthlyCollectedAndDisburse from "@/views/loan/dashboards/MonthlyCollectedAndDisburse.vue";
import LoanLateAndOverdueRepaymentStatus from "@/views/loan/dashboards/LoanLateAndOverdueRepaymentStatus.vue";
import ShowCard from "@/views/loan/dashboards/ShowCard.vue";
import { auth } from "@/utils/auth";

const items = ref({});
const settingStore = useSettingStore();
const isLoading = ref(false);

onMounted(async () => {
  getData();
});

const getData = async () => {
  isLoading.value = true;
  const res = await api.post("loans-dashboard-daily-result");
  if (res.data.status) {
    items.value = res.data.data;
  }
  isLoading.value = false;
};

watch(
  () => settingStore?.branch_id,
  (n, o) => {
    console.log(n);

    getData();
  },
);
const dataReports = computed(() => [
  [
    {
      icon: "tabler-file-plus",
      color: "primary",
      title: "Total Disburse",
      value: items?.value?.total_disburse,
      isHover: false,
    },
    {
      icon: "tabler-cash",
      color: "success",
      title: "Total Collected",
      value: items?.value?.total_receive,
      isHover: false,
    },
  ],
  [
    {
      icon: "tabler-file-plus",
      color: "primary",
      title: "Last Total Disburse",
      value: items?.value?.last_total_disburse,
      isHover: false,
    },
    {
      icon: "tabler-cash",
      color: "success",
      title: "Last Total Collected",
      value: items?.value?.last_total_receive,
      isHover: false,
    },
  ],
  [
    {
      icon: "tabler-file-dislike",
      color: "warning",
      title: "Number to be late tomorrow",
      value: items?.value?.number_to_be_late,
      isHover: false,
    },
    {
      icon: "tabler-file-dislike",
      color: "warning",
      title: "Amount to be late tomorrow",
      value: items?.value?.amount_to_be_late,
      isHover: false,
    },
  ],
  [
    {
      icon: "tabler-file-unknown",
      color: "error",
      title: "Number to be overdue tomorrow",
      value: items?.value?.number_to_be_overdue,
      isHover: false,
    },
    {
      icon: "tabler-file-unknown",
      color: "error",
      title: "Amount to be overdue tomorrow",
      value: items?.value?.amount_to_be_overdue,
      isHover: false,
    },
  ],
  // [
  //   {
  //     icon: "tabler-cash",
  //     color: "success",
  //     title: "Total Collected",
  //     value: items?.value?.total_receive,
  //     isHover: false,
  //   },
  //   {
  //     icon: "tabler-cash-banknote-plus",
  //     color: "success",
  //     title: "Total Prepaid",
  //     value: items?.value?.prepaid_receive,
  //     isHover: false,
  //   },
  // ],
  // [
  //   {
  //     icon: "tabler-cash-banknote-move-back",
  //     color: "error",
  //     title: "Total Penalty",
  //     value: items?.value?.total_penalty,
  //     isHover: false,
  //   },
  //   {
  //     icon: "tabler-cash-banknote-minus",
  //     color: "info",
  //     title: "Total Deduct",
  //     value: items?.value?.deduct_receive,
  //     isHover: false,
  //   },
  // ],
  // [
  //   {
  //     icon: "tabler-file-plus",
  //     color: "primary",
  //     title: "Total Disburse",
  //     value: items?.value?.total_disburse,
  //     isHover: false,
  //   },
  //   {
  //     icon: "tabler-file-dollar",
  //     color: "primary",
  //     title: "Total Loan Fee",
  //     value: items?.value?.total_loan_fee_amount,
  //     isHover: false,
  //   },
  // ],
]);
</script>

<template>
  <div>
    <VRow>
      <VCol cols="12">
        <DailyResult v-model:item-data="items" :loading="isLoading" />
      </VCol>
    </VRow>
    <VRow>
      <VCol cols="12" sm="12" md="12" lg="6">
        <VRow>
          <template v-for="item in dataReports">
            <VCol cols="12" sm="12">
              <ShowCard :item-data="item" :loading="isLoading" />
            </VCol>
          </template>
        </VRow>
      </VCol>
      <VCol cols="12" sm="12" md="12" lg="6">
        <LoanOverview />
      </VCol>

      <!-- <VCol cols="12" sm="12" md="6">
        <DailyCollectedAndDisburse v-model:item-data="items" />
      </VCol> -->
    </VRow>
    <VRow>
      <VCol>
        <LoanLateAndOverdueRepaymentStatus />
      </VCol>
    </VRow>

    <VRow class="match-height">
      <VCol cols="12" sm="12" md="12">
        <MonthlyCollectedAndDisburse />
      </VCol>
    </VRow>
  </div>
</template>
