<script setup>
import { api } from "@/utils/api";
import formatCurrency from "@/utils/formater/formatCurrency";
import formatDate from "@/utils/formater/formatDate";
import { onMounted, ref } from "vue";
import { useI18n } from "vue-i18n";

const { t } = useI18n();
const depositTransactionRef = ref(null);
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

function addBalance(data) {
  let balance = 0;
  return data.map((item, index) => {
    const deposit = item.deposit_amount || 0;
    const withdraw = item.withdraw_amount || 0;
    balance += deposit - withdraw;
    return { ...item, balance_amount: balance, index: index + 1 }; // Add index starting from 1
  });
}

const headers = [
  { title: t("No"), key: "index", align: "center" },
  { title: t("Branch"), key: "branch.name_kh" },
  {
    title: t("Date"),
    key: "transaction_date",
    value: (item) => {
      return formatDate(item.transaction_date);
    },
  },
  { title: t("Credit Officer"), key: "transition_by.name_kh" },
  {
    title: t("Deposit Amount"),
    key: "deposit_amount",
    align: "end",
  },
  {
    title: t("Withdraw Amount"),
    key: "withdraw_amount",
    align: "end",
  },
  {
    title: t("Balance Amount"),
    key: "balance_amount",
    value: (item) =>
      `${formatCurrency(item.balance_amount)} ${item.currency?.currency_code}`,
    align: "end",
  },
  {
    title: t("Action"),
    key: "actions",
    align: "center",
  },
];
const isLoading = ref(false);
const emit = defineEmits([
  "update:isDialogVisible",
  "update:loading",
  "onDelete",
]);
const onCloseDialog = () => {
  emit("update:isDialogVisible", false);
};

const onDelete = async (item) => {
  emit("onDelete", item.id);
};

const reload = () => {
  depositTransactionRef.value.reload();
};
defineExpose({
  reload,
});
</script>

<template>
  <VDialog
    :model-value="isDialogVisible"
    persistent
    class="v-dialog-xl"
    max-width="1000px"
  >
    <!-- Dialog close btn -->
    <DialogCloseBtn @click="onCloseDialog" />

    <!-- Dialog Content -->
    <VCard>
      <VCardItem style="padding-top: 12px; padding-bottom: 12px">
        <span style="font-size: 18px">
          <VIcon>tabler-history</VIcon>
          {{ $t("Deposit History") }}
        </span>
      </VCardItem>
      <VDivider />
      <AppCardTable
        ref="depositTransactionRef"
        v-model:filters="filter"
        :limit="-1"
        :headers="headers"
        :loading="loading"
        :isPagination="false"
        :isHeader="false"
        :isFullHeight="false"
        is-delete
        on-delete="delete-deposit-transactions"
        api-url="deposit-transactions-client-list"
        :api-data="{
          client_id: itemData.client_id,
          currency_id: itemData.currency_id,
        }"
        border="border-none"
        :transform-data="addBalance"
        @onDelete="onDelete"
      >
        <template v-slot:item.deposit_amount="{ item }">
          <template v-if="item.deposit_amount > 0">
            {{ formatCurrency(item.deposit_amount) }}
            {{ item.currency.currency_code }}
          </template>
          <template v-else>-</template>
        </template>

        <template v-slot:item.withdraw_amount="{ item }">
          <template v-if="item.withdraw_amount > 0">
            {{ formatCurrency(item.withdraw_amount) }}
            {{ item.currency.currency_code }}
          </template>
          <template v-else>-</template>
        </template>
      </AppCardTable>

      <VDivider />
      <VCardText
        class="d-flex justify-end gap-3 flex-wrap"
        style="padding-top: 12px; padding-bottom: 12px"
      >
        <VBtn color="secondary" variant="tonal" @click="onCloseDialog">
          <VIcon start icon="tabler-arrow-left" />
          {{ $t("Close") }}
        </VBtn>
        <!-- <VBtn @click="onCloseDialog"> Agree </VBtn> -->
      </VCardText>
    </VCard>
  </VDialog>
</template>
