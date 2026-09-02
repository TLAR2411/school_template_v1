<script setup>
import formatDate from "@/utils/formater/formatDate";
import { onMounted, ref } from "vue";
import { useI18n } from "vue-i18n";
import AppDateTimePicker from "@/@core/components/app-form-elements/AppDateTimePicker.vue";
import formatCurrency from "@/utils/formater/formatCurrency";
import { getCo, getCurrencies, getLoanSettings } from "@/services/dataService";
import { api } from "@/utils/api";
import { debounce } from "lodash";
import AppTextField from "@/@core/components/app-form-elements/AppTextField.vue";
import ReceiveDialog from "@/views/loan/receives/ReceiveDialog.vue";
import { useDisplay } from "vuetify";
import { useRouter } from "vue-router";
import { auth } from "@/utils/auth";
import ReceiveHistory from "@/views/loan/schedules/ReceiveHistory.vue";
import moment from "moment-timezone";
import AppAutocomplete from "@/@core/components/app-form-elements/AppAutocomplete.vue";
import { useSettingStore } from "@/stores/settingStore";
import formatContact from "@/utils/formater/formatContact";

definePage({
  meta: {
    title: "Daily collection list",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-loans",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});

const router = useRouter();
const { mdAndUp } = useDisplay();
const { t } = useI18n();
const isLoading = ref(true);
const dataTableRef = ref(null);
const currencies = ref([]);
const loanIdSelected = ref(null);
const isReceiveDialogVisible = ref(false);
const isReceiveHistoryDialogVisible = ref(false);

const isQuickLoanSerive = ref(false);
const isOperationFee = ref(false);

const co = ref([]);

const filter = ref({
  start_date: moment()
    .tz("Asia/Phnom_Penh")
    .format("YYYY-MM-DDTHH:mm:ss.SSS+07:00"), // Set to Phnom Penh timezone
  end_date: moment()
    .tz("Asia/Phnom_Penh")
    .format("YYYY-MM-DDTHH:mm:ss.SSS+07:00"),
  search: null,
  currency_id: 1,
  payment_method: null,
  is_group_by: true,
  co_id: auth()?.user?.position?.is_member ? auth()?.user?.id : null,
  loan_type: null,
});

const loanTypes = [
  { name: "កម្ចីល្អ", value: "current" },
  { name: "កម្ចីយឺត", value: "late" },
  { name: "កម្ចីខូច", value: "overdue" },
];
const groupBy = [
  {
    title: t("True"),
    value: true,
  },
  {
    title: t("False"),
    value: false,
  },
];

const headers = ref([
  {
    title: t("Code"),
    key: "loan_code",
    exportValue: (item) => item.loan_code,
    visible: false,
  },
  {
    title: t("Client"),
    key: "name_kh",
    exportValue: (item) => item.client_name,
    visible: true,
    fixed: mdAndUp.value,
  },

  {
    title: t("Credit Officer"),
    key: "co_name",
    visible: !auth()?.user?.position?.is_member,
  },

  // { title: t("Receiver"), key: "receive_name", visible: true },
  {
    title: t("Branch"),
    key: "branch_name",
    visible: auth()?.user?.manage_branch != 1,
  },
  {
    title: t("Receive Date"),
    key: "receive_date",
    value: (item) => {
      return formatDate(item.receive_date);
    },
    visible: true,
  },
  {
    title: t("Total Penalty"),
    key: "total_penalty",
    value: (item) => {
      return `${formatCurrency(item.total_penalty)}`;
    },
    align: "end",
    visible: true,
  },
  {
    title: t("Loan Fee"),
    key: "loan_fee",
    value: (item) => {
      return `${formatCurrency(item.loan_fee || 0)}`;
    },
    align: "end",
    visible: true,
  },
  {
    title: t("Insurance"),
    key: "insurance",
    value: (item) => {
      return `${formatCurrency(item.insurance || 0)}`;
    },
    align: "end",
    visible: true,
  },
  {
    title: t("Deposit"),
    key: "deposit",
    value: (item) => {
      return `${formatCurrency(item.deposit || 0)}`;
    },
    align: "end",
    visible: true,
  },
  {
    title: t("Quick Loan Service"),
    key: "quick_loan_service_amount",
    value: (item) => {
      return `${formatCurrency(item.quick_loan_service_amount || 0)}`;
    },
    align: "end",
    visible: isQuickLoanSerive,
  },
  {
    title: t("Operation Fee"),
    key: "operation_fee_amount",
    value: (item) => {
      return `${formatCurrency(item.operation_fee_amount || 0)}`;
    },
    align: "end",
    visible: isOperationFee,
  },
  {
    title: t("Total Receive"),
    key: "total_receive",
    value: (item) => {
      return `${formatCurrency(item.total_receive - item.prepaid_amount)}`;
    },
    align: "end",
    visible: true,
  },
  {
    title: t("Prepaid Amount"),
    key: "prepaid_amount",
    value: (item) => {
      return `${formatCurrency(item.prepaid_amount)}`;
    },
    align: "end",
    visible: true,
  },
  {
    title: t("Receive Amount"),
    key: "receive_amount",
    value: (item) => {
      return `${formatCurrency(item.receive_amount)}`;
    },
    align: "end",
    visible: true,
  },
  {
    title: t("Principal Receive"),
    key: "principal_receive",
    value: (item) => {
      return formatCurrency(item.principal_receive);
    },
    align: "end",
    visible: true,
  },
  {
    title: t("Interest Receive"),
    key: "interest_receive",
    value: (item) => {
      return formatCurrency(item.interest_receive);
    },
    align: "end",
    visible: true,
  },
  // {
  //   title: t("Payment Method"),
  //   key: "payment_method",
  //   align: "center",
  //   visible: true,
  // },
  {
    title: t("Loan Type"),
    key: "type",
    align: "center",
    exportValue: (item) => {
      if (item.type == "current") {
        return "កម្ចីល្អ";
      } else if (item.type == "late") {
        return "កម្ចីយឺត";
      } else if (item.type == "overdue") {
        return "កម្ចីខូច";
      }
    },
    visible: true,
  },
  {
    title: t("Receive Status"),
    key: "status",
    align: "center",
    exportValue: (item) => {
      if (item.status == 0 && item.is_disburse == true) {
        return "ទម្លាក់ទុន";
      } else if (item.status == 0 && item.is_disburse == false) {
        return "បង់ធម្មតា";
      } else if (item.status > 0) {
        return "បង់ផ្ដាច់";
      }
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
]);

const response = ref({});

const onRollback = debounce(async (item) => {
  try {
    isLoading.value = true;

    const payload = {
      loan_id: item.loan_id,
      receive_date: item.receive_date,
      is_disburse: item.is_disburse,
      ...(filter.value.is_group_by ? {} : { receive_id: item.receive_id }),
    };
    const res = await api.post("receives-rollback-by-receive", payload);

    if (res.data.status) {
      dataTableRef.value.reload();
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    //
    // isDialogVisible.value = false;
    isLoading.value = false;
  }
}, 500);

const onReceive = (item) => {
  loanIdSelected.value = item.loan_id;
  isReceiveDialogVisible.value = true;
};

const onReceiveHistory = (item) => {
  loanIdSelected.value = item.loan_id;
  isReceiveHistoryDialogVisible.value = true;
};

const onView = (item) => {
  router.push({ name: "loan-schedules", query: { id: item.loan_id } });
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

  const [dataLoanSettings] = await Promise.all([getLoanSettings()]);

  isQuickLoanSerive.value = dataLoanSettings?.find(
    (v) => v.key === "is_quick_loan_service",
  )?.value;
  isOperationFee.value = dataLoanSettings?.find(
    (v) => v.key === "is_operation_fee",
  )?.value;

  headers.value.find((h) => h.key === "quick_loan_service_amount").visible =
    !!isQuickLoanSerive.value;
  headers.value.find((h) => h.key === "operation_fee_amount").visible =
    !!isOperationFee.value;
});
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

  <AppCardTable
    ref="dataTableRef"
    title="Daily collection list"
    title-icon="tabler-file-check"
    api-url="receives-daily-collected-list"
    saveHeaderName="header-list-daily-collection-loan"
    saveStateName="save-state-list-daily-collection-loan"
    v-model:loading="isLoading"
    v-model:filters="filter"
    :headers="headers"
    v-model:response="response"
    is-filter
    is-rollback
    is-receive
    is-receive-history
    save-state
    is-excel
    is-schedule
    :is-pagination="false"
    :limit="-1"
    :is-back="false"
    @onRollback="onRollback"
    @onReceive="onReceive"
    @onReceiveHistory="onReceiveHistory"
    @onSchedule="onView"
    :rollbackCondition="(item) => item.is_disburse == false"
  >
    <!-- <template #card-header>
      <VCol cols="7" lg="3" md="3" v-if="mdAndUp">
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
        <VCol cols="12" sm="6" md="3" lg="2">
          <AppSelect
            v-model="filter.is_group_by"
            :items="groupBy"
            item-title="title"
            item-value="value"
          >
            <template #label>{{ $t("Group By") }}</template>
          </AppSelect>
        </VCol>

        <VCol cols="12" sm="6" md="3" lg="2">
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
        <!-- <VCol cols="12" sm="6" md="3" lg="2">
          <AppSelect
            v-model="filter.payment_method"
            :items="paymentMethod"
            item-title="title"
            item-value="value"
            clearable
            prepend-inner-icon="tabler-wallet"
          >
            <template #label>{{ $t("Payment Method") }}</template>
          </AppSelect>
        </VCol> -->
        <VCol cols="12" sm="6" md="3" lg="2">
          <AppDateTimePicker
            v-model="filter.start_date"
            prepend-inner-icon="tabler-calendar-due"
          >
            <template #label>{{ $t("Start Date") }}</template>
          </AppDateTimePicker>
        </VCol>
        <VCol cols="12" sm="6" md="3" lg="2">
          <AppDateTimePicker
            v-model="filter.end_date"
            prepend-inner-icon="tabler-calendar-due"
          >
            <template #label>{{ $t("End Date") }}</template>
          </AppDateTimePicker>
        </VCol>
        <VCol
          cols="12"
          sm="6"
          md="3"
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
            :readonly="auth().user?.position?.is_member == true"
            :disabled="auth().user?.position?.is_member == true"
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
        <VCol cols="12" sm="6" md="3" lg="2">
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
          :title="item.client_name"
          :sub-title="item.loan_code"
          :image="item.client_image"
          :sub-title-condition="item.is_black_list"
        />
      </div>
    </template>

    <template v-slot:item.type="{ item }">
      <VChip color="success" size="small" v-if="item.type == 'current'">
        {{ $t("Current Loan") }}
      </VChip>
      <VChip color="warning" size="small" v-if="item.type == 'late'">
        {{ $t("Late Loan") }}
      </VChip>
      <VChip color="error" size="small" v-if="item.type == 'overdue'">
        {{ $t("Overdue Loan") }}
      </VChip>
    </template>
    <template v-slot:item.status="{ item }">
      <VChip
        color="info"
        size="small"
        v-if="item.status == 0 && item.is_disburse == true"
      >
        {{ $t("Disburse Loan") }}
      </VChip>
      <VChip
        color="warning"
        size="small"
        v-if="item.status == 0 && item.is_disburse == false"
      >
        {{ $t("Repay Loan") }}
      </VChip>
      <VChip color="success" size="small" v-if="item.status > 0">
        {{ $t("Closed Loan") }}
      </VChip>
    </template>
    <template v-slot:item.payment_method="{ item }">
      <VChip color="warning" size="small" v-if="item.payment_method == 'cash'">
        <VIcon start icon="tabler-cash" />
        {{ $t("Cash") }}
      </VChip>
      <VChip color="success" size="small" v-if="item.payment_method == 'bank'">
        <VIcon start icon="tabler-credit-card" />
        {{ $t("Bank") }}
      </VChip>
      <VChip color="info" size="small" v-if="item.payment_method == 'deduct'">
        <VIcon start icon="tabler-plus-minus" />
        {{ $t("Deduct") }}
      </VChip>
    </template>
    <template #footer>
      <VDivider />
      <div class="p-10 mx-4 my-4 d-flex flex-column">
        <!-- <div class="d-flex flex-row align-center justify-end">
          <span>{{ $t("Count Receive") }} &nbsp;</span>
          <span class="text-primary">
            {{ formatCurrency(response.total_receive) }}
          </span>
        </div>
        <VDivider class="mt-1 mb-1" /> -->
        <!-- <div class="d-flex flex-row align-center justify-end">
            <h4>{{ $t("Count Disburse") }} &nbsp;</h4>
            <h3 class="text-primary">
              {{ formatCurrency(response.total_disburse) }}
            </h3>
          </div> -->
        <div class="d-flex flex-row align-center justify-end">
          <h4>{{ $t("Receive Amount") }}</h4>

          &nbsp;&nbsp;
          <h3 class="text-success">
            {{ formatCurrency(response.total_receive_amount) }}
          </h3>
          &nbsp;&nbsp;
          <VChip size="small" color="primary">
            <h3>
              {{ formatCurrency(response.total_receive) }} {{ $t("Client") }}
            </h3>
          </VChip>
        </div>
      </div>
      <!-- <tr>
          <td class="font-weight-bold text-end" colspan="12">
            {{ $t("Receive Amount") }}
          </td>
          <td class="text-end font-weight-bold">
            
          </td>
          <td class="text-right font-weight-bold" colspan="3"></td>
        </tr> -->
    </template>
  </AppCardTable>
</template>
