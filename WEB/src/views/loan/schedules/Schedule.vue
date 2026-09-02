<script setup>
import { api } from "@/utils/api";
import { useVueToPrint } from "vue-to-print";
import { onMounted } from "vue";
import { useRoute } from "vue-router";
import Schedule from "@/views/loan/schedules/SchduleShow.vue";
import SchedulePrint from "@/views/loan/schedules/SchdulePrint.vue";
import LoanInfo from "@/views/loan/schedules/LoanInfo.vue";
import ReceiveHistory from "@/views/loan/schedules/ReceiveHistory.vue";

const route = useRoute();
const schedules = ref([]);
const loanInfo = ref({});
const isLoading = ref(false);
const showPrintDiv = ref(false);
const printAreaRef = ref(null);
const printData = ref([]);
const totalAmount = ref(0);
const isReceiveDialogVisible = ref(false);

const { handlePrint } = useVueToPrint({
  content: () => {
    isLoading.value = true;
    showPrintDiv.value = true;
    return printAreaRef.value;
  },
  onAfterPrint: () => {
    isLoading.value = false;
    showPrintDiv.value = false;
  },
});

const initData = async () => {
  try {
    isLoading.value = true;
    const res = await api.post("schedules-show", {
      loan_id: route?.query?.id,
    });

    if (res.data.status) {
      schedules.value = {
        totalPenalty: res.data.data.total_penalty,
        schedules: {
          ...res.data.data.schedules,
          ...addBalance(
            res.data.data.schedules,
            res.data.data.total_amount,
            res.data.data.total_penalty,
          ),
        },
        loanDuration: res.data.data.loan_info.loan_duration,
      };
      loanInfo.value = res.data.data.loan_info;
      totalAmount.value = res.data.data.total_amount;

      printData.value = {
        current_date: res.data.data.current_date,
        loan_info: { ...res.data.data.loan_info },
        total_amount: { ...res.data.data.total_amount },
        totalPenalty: res.data.data.total_penalty,
        schedules: {
          ...res.data.data.schedules,
          ...addBalance(
            res.data.data.schedules,
            res.data.data.total_amount,
            res.data.data.total_penalty,
          ),
        },
      };
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

onMounted(async () => {
  initData();
});

function addBalance(data, totalAmount, totalPenalty) {
  let totalPaid = 0;
  let balance = 0;
  let penalty = totalPenalty;
  return data.map((item, index) => {
    const incomeAmount = parseFloat(item.income_amount) || 0;

    if (totalAmount > 0 && item.status == 1) {
      totalPaid += incomeAmount + penalty;
      penalty = 0;
      balance = totalAmount - totalPaid > 0 ? totalAmount - totalPaid : 0;
    } else {
      balance = 0;
    }
    return { ...item, balance_amount: balance, index: index + 1 }; // Add index starting from 1
  });
}

const onReceiveHistory = (item) => {
  isReceiveDialogVisible.value = true;
};
</script>

<template>
  <ReceiveHistory
    v-if="isReceiveDialogVisible"
    v-model:is-dialog-visible="isReceiveDialogVisible"
    :item-data="{ loan_id: loanInfo.id }"
    v-model:loading="isLoading"
  />
  <AppCard
    title="Loan Schedule"
    title-icon="tabler-calendar-due"
    :loading="isLoading"
  >
    <VRow>
      <VCol cols="12">
        <div class="d-flex flex-row mb-2 justify-end">
          <VBtn
            color="warning"
            class="mr-2"
            @click="onReceiveHistory"
            :loading="isLoading"
          >
            <VIcon start icon="tabler-history" />
            {{ $t("Receive History") }}
          </VBtn>
          <VBtn @click="handlePrint" :loading="isLoading">
            <VIcon start icon="tabler-printer" />
            {{ $t("Print") }}
          </VBtn>
        </div>
        <VDivider class="mb-4" />
        <LoanInfo v-model:item-data="loanInfo" />
      </VCol>
      <VDivider vertical></VDivider>
      <VCol cols="12">
        <Schedule
          v-model:item-data="schedules"
          v-model:total-amount="totalAmount"
          @onReload="initData"
        />
      </VCol>
    </VRow>
  </AppCard>

  <div class="printDiv">
    <div ref="printAreaRef">
      <SchedulePrint v-model:item-data="printData" />
    </div>
  </div>
</template>

<style scoped>
@media print {
  .printDiv {
    display: block !important;
  }
}

@page {
  size: A4 portrait !important;
  margin: 0.5cm 0.5cm 0.5cm 0.5cm !important;
}

.printDiv {
  display: none;
}
</style>
