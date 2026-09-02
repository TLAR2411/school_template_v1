<script setup>
import { useI18n } from "vue-i18n";
import { api } from "@/utils/api";
import { app } from "@/utils/app";
import AppDateTimePicker from "@/@core/components/app-form-elements/AppDateTimePicker.vue";
import formatCurrency from "@/utils/formater/formatCurrency";
import { useRouter } from "vue-router";
import formatMyDate from "@/utils/formater/formatDate";
// import moment from "moment-timezone";
import formatNoneZero from "@/utils/formater/formatNoneZero";
import { onMounted } from "vue";
import {
  getAccountTypes,
  getChartAccounts,
  getPeople,
} from "@/services/dataService";
import { useSettingStore } from "@/stores/settingStore";
import { useDisplay } from "vuetify";
import AppDetailTable from "@/components/AppDetailTable.vue";
const { mdAndUp } = useDisplay();
definePage({
  meta: {
    title: "Journals",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-journals",
  },
});

const { t, locale } = useI18n();
const dataTableRef = ref(null);
const isLoading = ref(true);
const router = useRouter();
const selectedItemDetail = ref({});
const chartAccountsDefault = ref([]);
const chartAccounts = ref([]);
const accountTypes = ref([]);

// const start_date = moment()
//   .tz("Asia/Phnom_Penh")
//   .startOf("month")
//   .format("YYYY-MM-DDTHH:mm:ss.SSS+07:00");
// const end_date = moment()
//   .tz("Asia/Phnom_Penh")
//   .format("YYYY-MM-DDTHH:mm:ss.SSS+07:00");

const filter = ref({
  start_date: null,
  end_date: null,
  search: null,
  account_type_id: null,
  account_code: null,
  person_id: null,
});

const people = ref([]);

const headersRight = [
  {
    title: t("Date"),
    key: "journal_date",
    value: (item) => {
      return formatMyDate(item.journal_date);
    },
    align: "center",
    visible: true,
  },
  {
    title: t("Account Code"),
    key: "account_code",
    visible: true,
  },
  {
    title: t("Account Name"),
    key: "chart_account.name_kh",
    visible: true,
  },
  { title: t("Description"), key: "description", visible: true },
  { title: t("Code"), key: "code", visible: true },
  // { title: t("Reference"), key: "reference", visible: false },

  // {
  //   title: t("Name"),
  //   key: "person.name_kh",
  //   visible: true,
  // },
  // {
  //   title: t("Budget Classification"),
  //   key: "journal_class.name_kh",
  //   visible: true,
  // },
  // { title: t("Currency"), key: "currency.abbr", align: "center" },
  {
    title: t("Debit"),
    key: "debit",
    value: (item) => {
      return `${formatNoneZero(item.debit)}`;
    },
    align: "end",
    visible: true,
  },
  {
    title: t("Credit"),
    key: "credit",
    value: (item) => {
      return `${formatNoneZero(item.credit)}`;
    },
    align: "end",
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

const onDelete = async (item) => {
  try {
    isLoading.value = true;

    const res = await api.post("journals-delete", { code: item.code });

    if (res.data.status) {
      dataTableRef.value.reload();
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

const onEdit = async (item) => {
  router.push({
    name: "accounting-journals-tab",
    params: { tab: "create" },
    query: { code: item.code },
  });
};

const selectedItemHeader = ref({
  title: null,
  listFlex: "flex-column",
  objectList: [
    {
      title: "Balance",
      value: 0,
    },
  ],
});

const showDetails = async () => {
  try {
    isLoading.value = true;
    const res = await api.post("journals-show-detail", {
      filter: filter.value,
    });

    if (res.data.status) {
      selectedItemDetail.value = res.data.data;
      selectedItemHeader.value = {
        title: selectedItemDetail?.value?.account_name,
        listFlex: "flex-column",
        objectList: [
          {
            title: "Balance",
            value: formatCurrency(selectedItemDetail?.value?.balance || 0) || 0,
          },
        ],
      };
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

watch(
  () => [
    filter.value.account_code,
    filter.value.start_date,
    filter.value.end_date,
    useSettingStore().branch_id,
  ],
  (newVal, oldVal) => {
    showDetails();
  },
);

onMounted(async () => {
  const [dataAccountType, dataChartAccount] = await Promise.all([
    getAccountTypes(),
    getChartAccounts(),
  ]);

  accountTypes.value = dataAccountType;
  chartAccountsDefault.value = dataChartAccount;
  chartAccounts.value = dataChartAccount;
});

watch(
  () => filter.value.account_type_id,
  (newVal, oldVal) => {
    if (newVal) {
      filter.value.account_code = null;
      chartAccounts.value = chartAccountsDefault.value.filter(
        (v) => v.account_type_id == newVal,
      );
    } else {
      chartAccounts.value = chartAccountsDefault.value;
    }
  },
);
</script>

<template>
  <div class="journal-list-height">
    <AppDetailTable
      ref="dataTableRef"
      saveHeaderName="header-list-journals"
      saveStateRightName="app-list-journals"
      v-model:selectedItem="filter.account_code"
      v-model:filtersRight="filter"
      v-model:selectedItemHeader="selectedItemHeader"
      api-url-right="journals-list"
      :headersRight="headersRight"
      border="border-none"
      is-edit
      is-delete
      is-excel
      selectedItemKey="code"
      save-state
      @onEdit="onEdit"
      @onDelete="onDelete"
      can-edit="edit-journals"
      can-delete="delete-journals"
    >
      <template #filtersRight>
        <VRow class="justify-end">
          <!----Filter Input-->

          <VCol cols="12" sm="4" md="4" lg="2">
            <AppDateTimePicker
              v-model="filter.start_date"
              prepend-inner-icon="tabler-calendar-due"
              :config="{
                allowInput: true,
              }"
              clearable
            >
              <template #label>{{ $t("Start Date") }}</template>
            </AppDateTimePicker>
          </VCol>
          <VCol cols="12" sm="4" md="4" lg="2">
            <AppDateTimePicker
              v-model="filter.end_date"
              prepend-inner-icon="tabler-calendar-due"
              :config="{
                allowInput: true,
              }"
              clearable
            >
              <template #label>{{ $t("End Date") }}</template>
            </AppDateTimePicker>
          </VCol>
          <VCol cols="12" sm="4" md="4" lg="2">
            <AppAutocomplete
              v-model="filter.account_type_id"
              clearable
              :items="accountTypes"
              item-value="id"
              :item-title="
                (item) => {
                  return `${item.id} - ${item.name_kh}`;
                }
              "
              autocomplete="off"
            >
              <template #label>{{ $t("Account Type") }}</template>
            </AppAutocomplete>
          </VCol>
          <VCol cols="12" sm="4" md="4" lg="2">
            <AppAutocomplete
              v-model="filter.account_code"
              clearable
              :items="chartAccounts"
              item-value="code"
              :item-title="
                (item) => {
                  return `${item.code} - ${item.name_kh}`;
                }
              "
              autocomplete="off"
            >
              <template #label>{{ $t("Chart Account") }}</template>
            </AppAutocomplete>
          </VCol>
          <VCol cols="12" sm="4" md="4" lg="2">
            <VTextField
              v-model="filter.search"
              clearable
              autocomplete="off"
              clear-icon="tabler-x"
              prepend-inner-icon="tabler-search"
            >
              <template #label>{{ $t("Search") }}</template>
            </VTextField>
          </VCol>
        </VRow>
      </template>
      <template v-slot:item.chart_account.name_kh="{ item }">
        <div class="d-flex flex-column">
          <span style="font-size: 14px">{{ item.chart_account?.name_kh }}</span>
          <span class="text-secondary" style="font-size: 12px">{{
            item.chart_account?.name_en
          }}</span>
        </div>
      </template>
      <template v-slot:item.description="{ item }">
        <div class="d-flex flex-row justify-space-between" style="width: 300px">
          <div
            class="mr-2"
            :style="{
              'word-break': 'break-word',
              'white-space': 'normal',
            }"
          >
            <span>{{ item.description }}</span>
          </div>
          <div>
            <template v-if="item.journal_type == 1">
              <VChip color="success" size="x-small">
                {{ $t("Close Entry") }}
              </VChip>
            </template>
          </div>
        </div>
      </template>
    </AppDetailTable>
  </div>
</template>

<style lang="scss" scoped>
.journal-list-height {
  height: calc(100dvh - 147px); /* Use dvh instead of vh */
  display: flex;
  flex-direction: column;
}

.filter-left-group {
  // Remove right rounding + right border from the Select so it opens into the TextField
  :deep(.v-col:first-child .v-field__outline__end) {
    border-start-end-radius: 0 !important;
    border-end-end-radius: 0 !important;
    border-inline-end: none !important;
  }
  // Remove left rounding from the TextField — its left border becomes the shared divider
  :deep(.v-col:last-child .v-field__outline__start) {
    border-start-start-radius: 0 !important;
    border-end-start-radius: 0 !important;
  }
}

@media (max-width: 768px) {
  .journal-list-height {
    height: calc(100dvh - 147px); /* Adjust as needed */
    position: relative;
  }

  /* Ensure the table container takes full available height */
  .h-100 {
    height: 100% !important;
    min-height: 0; /* Important for flex children */
  }
}
</style>
