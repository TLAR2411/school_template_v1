<script setup>
import formatCurrency from "@/utils/formater/formatCurrency";
import formatDate from "@/utils/formater/formatDate";
import { ref } from "vue";
import { useI18n } from "vue-i18n";
import { useRouter } from "vue-router";
import ReceiveHistory from "@/views/loan/schedules/ReceiveHistory.vue";
import { useDisplay } from "vuetify";
import { usePartStore } from "@/stores/partStore";
import { auth } from "@/utils/auth";

definePage({
  meta: {
    title: "Closed Loans",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-loans",
  },
});

const { mdAndUp } = useDisplay();
const router = useRouter();
const { t } = useI18n();
const isLoading = ref(true);
const dataTableRef = ref(null);
const isReceiveHistoryDialogVisible = ref(false);
const loanIdSelected = ref(null);
const filter = ref({
  loan_type: null,
  search: null,
  co_id: auth()?.user?.position?.is_member ? auth()?.user?.id : null,
});

const headers = [
  {
    title: t("Code"),
    key: "code",
    exportValue: (item) => item.code,
    visible: false,
  },
  {
    title: t("Client"),
    key: "name_kh",
    exportValue: (item) => item.client?.name_kh,
    visible: true,
    fixed: mdAndUp.value,
  },

  {
    title: t("Credit Officer"),
    key: "co.name_kh",
    visible: !auth()?.user?.position?.is_member,
  },
  {
    title: t("Branch"),
    key: "branch.name_kh",
    visible: auth()?.user?.manage_branch != 1,
  },
  { title: t("Contact"), key: "client.contact", visible: true },
  {
    title: t("Loan Durations"),
    key: "loan_duration",
    value: (item) => {
      return `${item.loan_duration} ${item.loan_term?.sort}`;
    },
    align: "center",
    visible: true,
  },
  { title: t("Collateral"), key: "collateral.name_kh", align: "start" },
  // { title: t("Currency"), key: "currency.currency_code", align: "center" },
  {
    title: t("Loan Amount"),
    key: "loan_amount",
    value: (item) => {
      return formatCurrency(item.loan_amount);
    },
    align: "end",
    visible: true,
  },
  {
    title: t("Start Date"),
    key: "loan_start_date",
    value: (item) => {
      return formatDate(item.loan_start_date);
    },
    visible: true,
  },
  {
    title: t("End Date"),
    key: "loan_end_date",
    value: (item) => {
      return formatDate(item.loan_end_date);
    },
    visible: true,
  },
  {
    title: t("Closed Date"),
    key: "loan_closed_date",
    value: (item) => {
      return formatDate(item.loan_closed_date);
    },
    visible: true,
  },

  {
    title: t("Loan Type"),
    key: "closed_loan_type",
    align: "center",
    exportValue: (item) => {
      if (item.closed_loan_type == "current") {
        return "កម្ចីល្អ";
      } else if (item.closed_loan_type == "late") {
        return "កម្ចីយឺត";
      } else if (item.closed_loan_type == "overdue") {
        return "កម្ចីខូច";
      }
    },
    visible: true,
  },
  {
    title: t("Village"),
    key: "village",
    value: (item) => {
      return item?.client?.village
        ? `
      ${item?.client?.village?.name_kh || ""}`
        : "";
    },
    visible: true,
  },
  {
    title: t("Commune"),
    key: "commune",
    value: (item) => {
      return item?.client?.village
        ? `
      ${item?.client?.village?.commune.name_kh || ""}
        `
        : "";
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

const onSchedule = (item) => {
  if (usePartStore().system_part == "loan") {
    router.push({ name: "loan-schedules", query: { id: item.id } });
  } else {
    router.push({ name: "accounting-schedules", query: { id: item.id } });
  }
};
const onReceiveHistory = (item) => {
  loanIdSelected.value = item.id;
  isReceiveHistoryDialogVisible.value = true;
};
</script>

<template>
  <ReceiveHistory
    v-if="isReceiveHistoryDialogVisible"
    v-model:is-dialog-visible="isReceiveHistoryDialogVisible"
    :item-data="{ loan_id: loanIdSelected }"
  />

  <AppCardTable
    ref="dataTableRef"
    title="Closed List Loans"
    title-icon="tabler-file-check"
    saveHeaderName="header-list-closed-loans"
    saveStateName="save-state-list-closed-loans"
    v-model:loading="isLoading"
    v-model:filters="filter"
    api-url="loans-closed-list"
    :headers="headers"
    is-schedule
    btn-schedule
    is-receive-history
    btn-receive-history
    :is-more-action="false"
    is-excel
    save-state
    is-view
    :is-back="false"
    can-schedule="view-loans"
    @onSchedule="onSchedule"
    @onReceiveHistory="onReceiveHistory"
    border="border-none"
    :isTitle="false"
    is-full-height-tab
    :is-header="false"
    is-filter
  >
    <!-- <template #card-header>
      <VCol cols="7" lg="3" md="4">
        <AppTextField
          v-model="filter.search"
          autocomplete="off"
          variant="filled"
        >
          <template #label>{{ $t("Search") }}</template>
        </AppTextField>
      </VCol>
    </template> -->
    <template #filter>
      <VRow class="justify-start">
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

    <template v-slot:item.name_kh="{ item }">
      <div class="d-flex flex-row pt-2 pb-2">
        <AppName
          :title="item.client?.name_kh"
          :sub-title="item.code"
          :image="item.client?.image_path"
          :sub-title-condition="item.client?.is_black_list"
        />
      </div>
    </template>

    <template v-slot:item.closed_loan_type="{ item }">
      <VChip
        color="success"
        size="small"
        v-if="item.closed_loan_type == 'current'"
      >
        {{ $t("Current Loan") }}
      </VChip>
      <VChip
        color="warning"
        size="small"
        v-if="item.closed_loan_type == 'late'"
      >
        {{ $t("Late Loan") }}
      </VChip>
      <VChip
        color="error"
        size="small"
        v-if="item.closed_loan_type == 'overdue'"
      >
        {{ $t("Overdue Loan") }}
      </VChip>
    </template>
    <template v-slot:item.last_receive_date="{ item }">
      <div
        :class="
          formatDate(item.last_receive_date) === todayDate ? 'text-success' : ''
        "
      >
        {{ formatDate(item.last_receive_date) }}
      </div>
    </template>
  </AppCardTable>
</template>
