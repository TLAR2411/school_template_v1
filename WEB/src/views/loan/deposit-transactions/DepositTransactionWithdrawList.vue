<script setup>
import { useI18n } from "vue-i18n";
import formatCurrency from "@/utils/formater/formatCurrency";
import { getCurrencies } from "@/services/dataService";
import formatContact from "@/utils/formater/formatContact";
import formatDate from "@/utils/formater/formatDate";
import { api } from "@/utils/api";
import { auth } from "@/utils/auth";
import { useDisplay } from "vuetify";

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
const dataTableRef = ref(null);
const isLoading = ref(true);
const isHistoryDialogVisible = ref(false);
const isEditDialogVisible = ref(false);
const clientId = ref(null);
const currencies = ref([]);
const { mdAndUp } = useDisplay();
const filter = ref({
  search: null,
  currency_id: 1,
  start_date: null,
  end_date: null,
});

const headers = [
  { title: t("Client"), key: "code", visible: true, fixed: mdAndUp.value },
  {
    title: t("Branch"),
    key: "branch.name_kh",
    visible: auth()?.user?.manage_branch != 1,
  },
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
    title: t("Withdraw Amount"),
    key: "withdraw_amount",
    value: (item) => {
      return `${formatCurrency(item.withdraw_amount)}`;
    },
    visible: true,
  },
  {
    title: t("Action"),
    key: "actions",
    align: "center",
    visible: true,
    fixed: mdAndUp.value,
  },
];

const onView = (item) => {
  clientId.value = item.client_id;
  isHistoryDialogVisible.value = true;
};

const onEdit = (item) => {
  clientId.value = item.client_id;
  isEditDialogVisible.value = true;
};

onMounted(async () => {
  const dataCurrencies = await getCurrencies();

  currencies.value = dataCurrencies;
});

const onDelte = async (item) => {
  try {
    isLoading.value = true;
    const res = await api.post("deposit-transactions-delete", { id: item.id });

    if (res.data.status) {
      dataTableRef.value.reload();
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};
</script>

<template>
  <AppCardTable
    ref="dataTableRef"
    title="Deposit"
    title-icon="tabler-pig-money"
    saveHeaderName="header-deposit-transactions-withdraw-list"
    saveStateName="save-state-deposit-transactions-withdraw-list"
    v-model:loading="isLoading"
    v-model:filters="filter"
    api-url="deposit-transactions-withdraw-list"
    :headers="headers"
    is-delete
    can-delete="delete-deposit-transactions"
    @onDelete="onDelte"
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
          <AppDateTimePicker
            v-model="filter.start_date"
            clearable
            :config="{
              allowInput: true,
            }"
            autocomplete="off"
            prepend-inner-icon="tabler-calendar-due"
          >
            <template #label>{{ $t("Start Date") }}</template>
          </AppDateTimePicker>
        </VCol>
        <VCol cols="12" sm="6" md="4" lg="2">
          <AppDateTimePicker
            v-model="filter.end_date"
            clearable
            :append-to-el="appendToEl"
            :config="{
              allowInput: true,
            }"
            prepend-inner-icon="tabler-calendar-due"
          >
            <template #label>{{ $t("End Date") }}</template>
          </AppDateTimePicker>
        </VCol>
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
