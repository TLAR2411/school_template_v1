<script setup>
import formatCurrency from "@/utils/formater/formatCurrency";
import formatDate from "@/utils/formater/formatDate";
import { ref } from "vue";
import { useI18n } from "vue-i18n";
import { useRouter } from "vue-router";
import ReceiveDialog from "@/views/loan/receives/ReceiveDialog.vue";
import { api } from "@/utils/api";
import AppTextField from "@/@core/components/app-form-elements/AppTextField.vue";
import PenaltyDialog from "@/views/loan/loans/PenaltyDialog.vue";
import AppDateTimePicker from "@/@core/components/app-form-elements/AppDateTimePicker.vue";
import formatNoneZero from "@/utils/formater/formatNoneZero";
import { useSettingStore } from "@/stores/settingStore";
import { auth } from "@/utils/auth";
import ReceiveHistory from "@/views/loan/schedules/ReceiveHistory.vue";
import { useDisplay } from "vuetify";
import CurrentPreviewLoansDialog from "./CurrentPreviewLoansDialog.vue";
import { getCo } from "@/services/dataService";
import formatContact from "@/utils/formater/formatContact";

definePage({
  meta: {
    title: "Loans",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-loans",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});

const { mdAndUp } = useDisplay();
const router = useRouter();
const { t } = useI18n();
const isLoading = ref(true);
const isReceiveDialogVisible = ref(false);
const isReceiveHistoryDialogVisible = ref(false);
const isPenaltyDialogVisible = ref(false);
const dataTableRef = ref(null);
const loanIdSelected = ref(null);
const isCurrentDialogVisible = ref(false);
const selectedObject = ref({});
const filter = ref({
  date_type: "loan_start_date",
  start_date: null,
  end_date: null,
  loan_type: null,
  co_id: auth()?.user?.position?.is_member ? auth()?.user?.id : null,
  search: null,
});
const co = ref([]);

const loanTypes = [
  { name: "កម្ចីល្អ", value: "current" },
  { name: "កម្ចីយឺត", value: "late" },
  { name: "កម្ចីខូច", value: "overdue" },
];

const dateTypes = [
  { name: "ថ្ងៃចាប់ផ្ដើមកម្ចី", value: "loan_start_date" },
  { name: "ថ្ងៃបញ្ចប់កម្ចី", value: "loan_end_date" },
];

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
    exportValue: (item) => item.client.name_kh,
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
  // { title: t("Currency"), key: "currency.currency_code", align: "center" },
  {
    title: t("Created At"),
    key: "created_at",
    value: (item) => {
      return formatDate(item.created_at);
    },
    align: "center",
  },
  {
    title: t("Loan Durations"),
    key: "loan_duration",
    value: (item) => {
      return `${item.loan_duration} ${item.loan_term?.sort}`;
    },
    align: "center",
    visible: true,
  },
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
    title: t("Rejected Date"),
    key: "rejected_date",
    value: (item) => {
      return formatDate(item.rejected_date);
    },
    align: "center",
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
  router.push({ name: "loan-schedules", query: { id: item.id } });
};

const onView = (item) => {
  selectedObject.value = item;
  isCurrentDialogVisible.value = true;
};

const onEdit = (item) => {
  router.push({ name: "loans-edit-request", query: { id: item.id } });
};

const onDelete = async (item) => {
  try {
    // previewFormDialog.value = true;
    isLoading.value = true;

    const res = await api.post("loans-delete", { id: item.id });
    if (res.data.status) {
      dataTableRef.value.reload();
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

const onReceive = (item) => {
  loanIdSelected.value = item.id;
  isReceiveDialogVisible.value = true;
};

const onReceiveHistory = (item) => {
  loanIdSelected.value = item.id;
  isReceiveHistoryDialogVisible.value = true;
};

const onPenalty = (item) => {
  loanIdSelected.value = item.id;
  isPenaltyDialogVisible.value = true;
};

const onRestructure = (item) => {
  router.push({ name: "loan-loans-restructure", query: { loan_id: item.id } });
};

const getDataCo = async () => {
  const [dataCo] = await Promise.all([getCo()]);
  co.value = dataCo;
};

watch(
  () => useSettingStore().branch_id,
  (newVal) => {
    filter.value.co_id = null;
    getDataCo();
  },
);

onMounted(async () => {
  getDataCo();
});

const onBlackList = async (item) => {
  try {
    // previewFormDialog.value = true;
    isLoading.value = true;

    const res = await api.post("clients-black-list", { id: item.client_id });

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
</script>

<template>
  <ReceiveHistory
    v-if="isReceiveHistoryDialogVisible"
    v-model:is-dialog-visible="isReceiveHistoryDialogVisible"
    :item-data="{ loan_id: loanIdSelected }"
  />

  <ReceiveDialog
    v-if="isReceiveDialogVisible"
    v-model:is-dialog-visible="isReceiveDialogVisible"
    :item-data="{ loan_id: loanIdSelected }"
    @onReload="dataTableRef.reload"
  />
  <PenaltyDialog
    v-if="isPenaltyDialogVisible"
    v-model:is-dialog-visible="isPenaltyDialogVisible"
    :item-data="{ loan_id: loanIdSelected }"
    @onReload="dataTableRef.reload"
  />

  <CurrentPreviewLoansDialog
    v-if="isCurrentDialogVisible"
    v-model:is-dialog-visible="isCurrentDialogVisible"
    :item-data="selectedObject"
  />

  <AppCardTable
    ref="dataTableRef"
    title="Rejected Loans"
    title-icon="tabler-files"
    api-url="loans-rejected-list"
    saveHeaderName="header-rejeced-list-loans"
    saveStateName="save-state-rejeced-list-loans"
    v-model:loading="isLoading"
    v-model:filters="filter"
    :headers="headers"
    :is-title="false"
    is-filter
    is-excel
    is-delete
    is-black-list
    save-state
    can-receive="add-receives"
    can-schedule="view-loans"
    can-delete="delete-loans"
    can-restructure="restructure-loans"
    can-penalty="change-penalty-amount-loans"
    can-check-black-list="check-black-list-clients"
    :is-back="false"
    :is-header="false"
    @onDelete="onDelete"
    @onBlackList="onBlackList"
    @onView="onView"
    border="border-none"
    is-full-height-tab
    :isHeader="false"
  >
    <!-- <template #card-header>
      <VCol cols="7" lg="2" md="4">
        <AppTextField
          v-model="filter.search"
          autocomplete="off"
          variant="filled"
        >
          <template #label>{{ $t("Search") }}</template>
        </AppTextField>
      </VCol>
    </template> -->
    <template #filter="{ appendToEl }">
      <VRow class="justify-end">
        <!----Filter Input-->
        <VCol cols="12" sm="6" md="4" lg="2">
          <AppSelect
            v-model="filter.date_type"
            :items="dateTypes"
            item-title="name"
            item-value="value"
            autocomplete="off"
          >
            <template #label>{{ $t("Date Type") }}</template>
          </AppSelect>
        </VCol>
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
          <AppSelect
            v-model="filter.loan_type"
            :items="loanTypes"
            item-title="name"
            item-value="value"
            clearable
            autocomplete="off"
          >
            <template #label>{{ $t("Loan Type") }}</template>
          </AppSelect>
        </VCol>
        <VCol
          cols="12"
          sm="6"
          md="4"
          lg="2"
          v-if="auth().user?.position?.is_member == false"
        >
          <AppAutocomplete
            v-model="filter.co_id"
            prepend-inner-icon="tabler-user"
            :items="co"
            item-title="name_kh"
            item-value="id"
            clearable
            :readonly="auth().user?.role?.name == 'credit-officer'"
            :disabled="auth().user?.role?.name == 'credit-officer'"
            autocomplete="off"
          >
            <template #label>{{ $t("Credit Officer") }}</template>
            <template #item="{ props, item }">
              <VListItem
                v-bind="props"
                :title="`${item?.raw?.name_kh}`"
                :subtitle="`${formatContact(item?.raw.contact)}`"
              >
                <template #prepend>
                  <AppAvatar
                    :title="item?.raw?.name_kh"
                    :image="item?.raw?.image_path"
                    :size="40"
                    :is-show-full-image="false"
                  />
                  &nbsp;&nbsp;
                </template>
              </VListItem>
            </template>
          </AppAutocomplete>
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

    <template v-slot:item.name_kh="{ item }">
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
