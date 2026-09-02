<script setup>
import formatDate from "@/utils/formater/formatDate";
import { useI18n } from "vue-i18n";
import AppSelect from "@core/components/app-form-elements/AppSelect.vue";
import { onMounted, ref } from "vue";
import { getCurrencies } from "@/services/dataService";
import formatNoneZero from "@/utils/formater/formatNoneZero";
import formatCurrency from "@/utils/formater/formatCurrency";

const props = defineProps({
  itemId: {
    type: Number,
    required: false,
    default: () => null,
  },
  loading: {
    type: Boolean,
    required: false,
    skipCheck: true,
    default: undefined,
  },
});

const { t } = useI18n();

function addBalance(data) {
  let balance = 0;
  return data.map((item, index) => {
    const deposit = item.deposit_amount || 0;
    const withdraw = item.withdraw_amount || 0;
    balance += deposit - withdraw;
    return { ...item, balance_amount: balance, index: index + 1 }; // Add index starting from 1
  });
}

const currencies = ref([]);
const response = ref({});
const filter = ref({
  currency_id: 1,
});

const headers = [
  { title: t("No"), key: "index", align: "center" }, // New column for running number
  // { title: t("Code"), key: "code" },
  { title: t("Branch"), key: "branch.name_kh" },
  {
    title: t("Date"),
    key: "Transaction Date",
    value: (item) => {
      return formatDate(item.transaction_date);
    },
    align: "center",
  },
  { title: t("Description"), key: "description" },
  {
    title: t("Deposit Amount"),
    key: "deposit_amount",
    value: (item) => {
      return formatNoneZero(item.deposit_amount);
    },
    align: "end",
  },
  {
    title: t("Withdraw Amount"),
    key: "withdraw_amount",
    value: (item) => {
      return formatNoneZero(item.withdraw_amount);
    },
    align: "end",
  },
  {
    title: t("Balance Amount"),
    key: "balance_amount",
    value: (item) =>
      `${formatCurrency(item.balance_amount)} ${item.currency?.currency_code}`,
    align: "end",
  },
  // { title: t("Action"), key: "actions", align: "center" },
];

// onMounted(async () => {
//   const dataCurrencies = await getCurrencies();

//   currencies.value = dataCurrencies;
// });
</script>

<template>
  <AppCardTable
    title="Deposit History"
    title-icon="tabler-pig-money"
    :is-back="false"
    api-url="deposit-transactions-client-list"
    :api-data="{ client_id: itemId }"
    :transform-data="addBalance"
    v-model:response="response"
    :headers="headers"
    :isPagination="false"
    :isMoreAction="false"
    :isFullHeight="false"
    :isToggleColumn="false"
    is-schedule
    btn-schedule
    :limit="-1"
  >
    <!-- <template #card-header>
      <VCol cols="12" lg="3" md="3" sm="4">
        <AppSelect
          v-model="filter.currency_id"
          :items="currencies"
          item-title="currency_code"
          item-value="id"
        />
      </VCol>
    </template> -->

    <!-- <template #footer>
      <VDivider />
      <div class="p-10 mx-4 my-4 d-flex flex-column">
        <div class="d-flex flex-row align-center justify-end">
          <h4>សរុបបានតម្គល់</h4>

          &nbsp;&nbsp;
          <h3
            :class="
              response.total_balance > 0
                ? 'text-success'
                : response.total_balance < 0
                  ? 'text-error'
                  : 'text-secondary'
            "
          >
            {{ formatNoneZero(response.total_balance) }}
          </h3>
        </div>
      </div>
    </template> -->
  </AppCardTable>
</template>
