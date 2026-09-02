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
import { auth } from "@/utils/auth";
import { useDisplay } from "vuetify";
const { mdAndUp } = useDisplay();
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
  // { title: t("Currency"), key: "currency.currency_code", visible: true },
  {
    title: t("Deposit Amount"),
    key: "deposit_amount",
    value: (item) => {
      return `${formatCurrency(item.deposit_amount)}`;
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
    title: t("Balance Amount"),
    key: "balance_amount",
    value: (item) => {
      return `${formatCurrency(item.balance_amount)}`;
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
const showImage = (image) => {
  imageUrlPath.value = image ? getImageUrl(image) : avatar1;
  isImageDialog.value = true;
};

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

const onSubmit = async (item) => {
  try {
    isLoading.value = true;
    const res = await api.post("deposit-transactions-store", item);

    if (res.data.status) {
      isEditDialogVisible.value = false;
      dataTableRef.value.reload();
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

const onDelte = async (item) => {
  try {
    isLoading.value = true;
    const res = await api.post("deposit-transactions-delete", { id: item });

    if (res.data.status) {
      depositTransactionRef.value.reload();
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
  <DepositTransitionHistoryDialog
    ref="depositTransactionRef"
    v-if="isHistoryDialogVisible"
    v-model:is-dialog-visible="isHistoryDialogVisible"
    v-model:loading="isLoading"
    :item-data="{ client_id: clientId, currency_id: filter.currency_id }"
    @onDelete="onDelte"
  />
  <DepositTransitionEditDialog
    v-if="isEditDialogVisible"
    v-model:is-dialog-visible="isEditDialogVisible"
    v-model:loading="isLoading"
    :item-data="{ client_id: clientId }"
    @onSubmit="onSubmit"
  />
  <ShowImageDialog
    v-model:isDialogVisible="isImageDialog"
    :image="imageUrlPath"
  />

  <AppCardTable
    ref="dataTableRef"
    title="Deposit"
    title-icon="tabler-pig-money"
    saveHeaderName="header-deposit-transactions-list"
    saveStateName="save-state-deposit-transactions-list"
    v-model:loading="isLoading"
    v-model:filters="filter"
    api-url="deposit-transactions-list"
    :headers="headers"
    is-view
    is-edit
    can-edit="edit-deposit-transactions"
    can-view="view-deposit-transactions"
    @onView="onView"
    @onEdit="onEdit"
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
