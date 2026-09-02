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
import moment from "moment-timezone";
import formatContact from "@/utils/formater/formatContact";
import { usePartStore } from "@/stores/partStore";

definePage({
  meta: {
    title: "Loans",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-loans",
  },
});

const todayDate = formatDate(
  moment().tz("Asia/Phnom_Penh").format("YYYY-MM-DDTHH:mm:ss.SSS+07:00"),
);
const { mdAndUp } = useDisplay();
const router = useRouter();
const { t } = useI18n();
const isLoading = ref(true);
const isReceiveDialogVisible = ref(false);
const isPenaltyDialogVisible = ref(false);
const isReceiveHistoryDialogVisible = ref(false);
const dataTableRef = ref(null);
const loanIdSelected = ref(null);
const isCurrentDialogVisible = ref(false);
const selectedObject = ref({});
const filter = ref({
  date_type: "approval_date",
  start_date: null,
  end_date: null,
  loan_type: "overdue",
  payment_status: null,
  co_id: auth()?.user?.position?.is_member ? auth()?.user?.id : null,
  search: null,
});

const co = ref([]);

const dateTypes = [
  { name: "ថ្ងៃអនុម័តកម្ចី", value: "approval_date" },
  { name: "ថ្ងៃចាប់ផ្ដើមកម្ចី", value: "loan_start_date" },
  { name: "ថ្ងៃបញ្ចប់កម្ចី", value: "loan_end_date" },
];

const paymentStatus = [
  { name: "សកម្ម", value: "active" },
  { name: "ម្ដងម្កាល", value: "inactive" },
  { name: "អសកម្ម", value: "non_active" },
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
  {
    title: t("Contact"),
    key: "client.contact",
    value: (items) => {
      return formatContact(items.client?.contact);
    },
    visible: true,
  },
  // { title: t("Currency"), key: "currency.currency_code", align: "center" },
  { title: t("Type"), key: "type", align: "center" },
  { title: t("Loan Term"), key: "loan_term", align: "center" },
  { title: t("Duration"), key: "loan_duration", align: "center" },
  { title: t("Collateral"), key: "collateral.name_kh", align: "start" },
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
    title: t("Approval Date"),
    key: "approval_date",
    value: (item) => {
      return formatDate(item.approval_date);
    },
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
    title: t("Paid Days"),
    key: "paid_days",
    align: "center",
    visible: true,
  },
  {
    title: t("Late Days"),
    key: "late_days",
    align: "center",
    visible: true,
  },
  {
    title: t("Overdue Days"),
    key: "overdue_days",
    align: "center",
    visible: true,
  },
  {
    title: t("Total Penalty"),
    key: "total_penalty_amount",
    value: (item) => {
      return formatNoneZero(item.total_penalty_amount);
    },
    align: "end",
    visible: true,
  },

  // {
  //   title: t("Total Due"),
  //   key: "total_balance",
  //   value: (item) => {
  //     return formatCurrency(item.total_balance);
  //   },
  //   align: "end",
  //   visible: true,
  // },

  {
    title: t("Last Receive Date"),
    key: "last_receive_date",
    value: (item) => {
      return item.last_receive_date ? formatDate(item.last_receive_date) : "-";
    },
    align: "center",
    visible: true,
  },

  {
    title: t("Last Receive Amount"),
    key: "last_receive_amount",
    value: (item) => {
      return formatNoneZero(item.last_receive_amount);
    },
    align: "center",
    visible: true,
  },
  {
    title: t("Current Payment"),
    key: "current_payment",
    value: (item) => {
      return formatCurrency(item.current_payment);
    },
    align: "end",
    visible: true,
  },
  {
    title: t("Total Due"),
    key: "total_balance",
    value: (item) => {
      return formatCurrency(item.total_balance);
    },
    align: "end",
    visible: true,
  },
  {
    title: t("Principal Balance"),
    key: "principal_balance",
    value: (item) => {
      return formatCurrency(item.principal_balance);
    },
    align: "end",
    visible: true,
  },
  {
    title: t("Deposit Amount"),
    key: "deposit_balance",
    value: (item) => {
      return formatCurrency(item.deposit_balance);
    },
    align: "end",
    visible: true,
  },
  {
    title: t("After Deduct"),
    key: "after_deduct",
    value: (item) => {
      return formatCurrency(item.total_balance - item.deposit_balance);
    },
    align: "end",
    visible: true,
  },
  {
    title: t("Payment Status"),
    key: "payment_status",

    align: "center",
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

const onReceiveHistory = (item) => {
  loanIdSelected.value = item.id;
  isReceiveHistoryDialogVisible.value = true;
};

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

const onClientHistory = (item) => {
  if (usePartStore().system_part == "loan") {
    router.push({
      name: "loan-clients-client-profile",
      query: { id: item.client_id },
    });
  } else {
    router.push({
      name: "accounting-clients-client-profile",
      query: { id: item.client_id },
    });
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
    title="List Loans"
    title-icon="tabler-files"
    api-url="loans-list"
    saveHeaderName="header-list-overdue-loans"
    saveStateName="save-state-list-overdue-loans"
    v-model:loading="isLoading"
    v-model:filters="filter"
    :headers="headers"
    :is-title="false"
    is-filter
    is-receive
    is-schedule
    btn-schedule
    is-excel
    is-delete
    is-penalty
    is-restructure
    is-receive-history
    is-black-list
    is-view
    is-client-history
    save-state
    can-receive="add-receives"
    can-schedule="view-loans"
    can-delete="delete-loans"
    can-restructure="restructure-loans"
    can-penalty="change-penalty-amount-loans"
    can-check-black-list="check-black-list-clients"
    can-uncheck-black-list="uncheck-black-list-clients"
    :is-back="false"
    @onEdit="onEdit"
    @onDelete="onDelete"
    @onSchedule="onSchedule"
    @onReceive="onReceive"
    @onRestructure="onRestructure"
    @onPenalty="onPenalty"
    @onReceiveHistory="onReceiveHistory"
    @onBlackList="onBlackList"
    @onClientHistory="onClientHistory"
    @onView="onView"
    border="border-none"
    is-full-height-tab
    :is-header="false"
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
      <VRow class="justify-end">
        <!----Filter Input-->
        <VCol cols="12" sm="6" md="4" lg="2">
          <AppSelect
            v-model="filter.payment_status"
            :items="paymentStatus"
            item-title="name"
            item-value="value"
            autocomplete="off"
            clearable
          >
            <template #label>{{ $t("Payment Status") }}</template>
          </AppSelect>
        </VCol>
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
            prepend-inner-icon="tabler-calendar-due"
          >
            <template #label>{{ $t("Start Date") }}</template>
          </AppDateTimePicker>
        </VCol>
        <VCol cols="12" sm="6" md="4" lg="2">
          <AppDateTimePicker
            v-model="filter.end_date"
            clearable
            :config="{
              allowInput: true,
            }"
            prepend-inner-icon="tabler-calendar-due"
          >
            <template #label>{{ $t("End Date") }}</template>
          </AppDateTimePicker>
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
          :sub-title="item.code"
          :image="item.client?.image_path"
          :sub-title-condition="item.client?.is_black_list"
        />
      </div>
    </template>
    <template v-slot:item.type="{ item }">
      <VChip color="success" size="small" v-if="item.type == 'normal'">
        ធម្មតា
      </VChip>
      <VChip color="warning" size="small" v-if="item.type == 'restructure'">
        រៀបឡើងវិញ
      </VChip>
    </template>
    <template v-slot:item.paid_days="{ item }">
      <div class="d-flex flex-row justify-center">
        <VAvatar
          rounded
          color="success"
          size="x-small"
          v-if="item.paid_days > 0"
        >
          <small>{{ formatNoneZero(item.paid_days) }}</small>
        </VAvatar>
      </div>
    </template>

    <template v-slot:item.late_days="{ item }">
      <div class="d-flex flex-row justify-center">
        <VAvatar
          rounded
          color="warning"
          size="x-small"
          v-if="item.late_days > 0"
        >
          <small>{{ formatNoneZero(item.late_days) }}</small>
        </VAvatar>
      </div>
    </template>
    <template v-slot:item.overdue_days="{ item }">
      <div class="d-flex flex-row justify-center">
        <VAvatar
          rounded
          color="error"
          size="x-small"
          v-if="item.overdue_days > 0"
        >
          <small>{{ formatNoneZero(item.overdue_days) }}</small>
        </VAvatar>
      </div>
    </template>
    <template v-slot:item.payment_status="{ item }">
      <VChip
        color="success"
        size="small"
        v-if="item.payment_status == 'active'"
      >
        សកម្ម
      </VChip>
      <VChip
        color="warning"
        size="small"
        v-if="item.payment_status == 'inactive'"
      >
        ម្ដងម្កាល
      </VChip>
      <VChip
        color="error"
        size="small"
        v-if="item.payment_status == 'non_active'"
      >
        អសកម្ម
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
