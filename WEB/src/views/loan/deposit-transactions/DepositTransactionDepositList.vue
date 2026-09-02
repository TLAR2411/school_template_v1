<script setup>
import { useI18n } from "vue-i18n";
import { api } from "@/utils/api";
import getImageUrl from "@/utils/image/getImageUrl";
import avatar1 from "@images/avatars/my-avatar-1.jpg";
import ShowImageDialog from "@/components/ShowImageDialog.vue";
import formatCurrency from "@/utils/formater/formatCurrency";
import DepositTransitionHistoryDialog from "@/views/loan/deposit-transactions/DepositTransactionHistoryDialog.vue";
import DepositTransitionEditDialog from "@/views/loan/deposit-transactions/DepositTransactionEditDialog.vue";
import { getCurrencies } from "@/services/dataService";
import formatContact from "@/utils/formater/formatContact";
import formatDate from "@/utils/formater/formatDate";

definePage({
  meta: {
    title: "Deposit Transactions",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});

const { t } = useI18n();
const formData = ref({});
const dataTableRef = ref(null);
const isDialogVisible = ref(false);
const isLoading = ref(true);
const isImageDialog = ref(false);
const imageUrlPath = ref(null);
const isHistoryDialogVisible = ref(false);
const isEditDialogVisible = ref(false);
const clientId = ref(null);
const currencies = ref([]);
const depositTransactionRef = ref(null);

const filter = ref({
  search: null,
  currency_id: 1,
});

const headers = [
  { title: t("Client"), key: "code", visible: true },
  { title: t("Branch"), key: "branch.name_kh", visible: true },
  {
    title: t("Credit Officer"),
    key: "client.last_loan.co.name_kh",
    visible: true,
  },
  { title: t("Village"), key: "client.village.name_kh", visible: true },
  { title: t("Commune"), key: "client.village.commune.name_kh", visible: true },
  {
    title: t("Contact"),
    key: "client.contact",
    value: (items) => {
      return formatContact(items.client?.contact);
    },
    visible: true,
  },
  {
    title: t("Transaction Date"),
    key: "transaction_date",
    value: (items) => {
      return formatDate(items.transaction_date);
    },
    visible: true,
  },
  {
    title: t("Deposit Amount"),
    key: "deposit_amount",
    value: (item) => {
      return `${formatCurrency(item.deposit_amount)}`;
    },
    visible: true,
  },
  // { title: t("Action"), key: "actions", align: "center", visible: true },
];
onMounted(async () => {
  const dataCurrencies = await getCurrencies();

  currencies.value = dataCurrencies;
});
</script>

<template>
  <AppCardTable
    ref="dataTableRef"
    title="Deposit"
    title-icon="tabler-pig-money"
    saveHeaderName="header-deposit-transactions-deposit-list"
    saveStateName="save-state-deposit-transactions-deposit-list"
    v-model:loading="isLoading"
    v-model:filters="filter"
    api-url="deposit-transactions-deposit-list"
    :headers="headers"
    is-excel
    is-filter
    save-state
    border="border-none"
    is-full-height-tab
    :isHeader="false"
  >
    <template #filter>
      <VRow class="justify-start">
        <!----Filter Input-->

        <!-- <VCol cols="12" sm="6" md="4" lg="2">
          <AppSelect
            v-model="filter.currency_id"
            :items="currencies"
            item-title="currency_code"
            item-value="id"
          >
            <template #label>Currency</template>
          </AppSelect>
        </VCol> -->
        <VCol cols="12" sm="6" md="4" lg="2">
          <VTextField
            v-model="filter.search"
            :label="t('Search')"
            prepend-inner-icon="tabler-search"
            clearable
            hide-details
            autocomlete="off"
            clear-icon="tabler-x"
          />
        </VCol>
      </VRow>
    </template>

    <template v-slot:item.code="{ item }">
      <div class="d-flex flex-row pt-2 pb-2">
        <AppName
          :title="item.client?.name_kh"
          :sub-title="item.client?.code"
          :image="item.client?.image_path"
          :sub-title-condition="item.client?.is_black_list"
        />
      </div>
    </template>
  </AppCardTable>
</template>
