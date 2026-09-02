<script setup>
import { ref } from "vue";
import MoneyCard from "@/views/accounting/cash-denominations/MoneyCard.vue";
import { api } from "@/utils/api";
import { onMounted } from "vue";
import { useI18n } from "vue-i18n";
import formatCurrency from "@/utils/formater/formatCurrency";
import formatDate from "@/utils/formater/formatDate";
import CreateEditCashDenomination from "@/views/accounting/cash-denominations/CreateEditCashDenomination.vue";
import CashDenominationDetailView from "@/views/accounting/cash-denominations/CashDenominationDetailView.vue";
import { getCashDenominationPurposes, getUsers } from "@/services/dataService";
import moment from "moment-timezone";
import { useSettingStore } from "@/stores/settingStore";
import { useDisplay } from "vuetify";
import AppSelect from "@/@core/components/app-form-elements/AppSelect.vue";
const { mdAndUp } = useDisplay();
definePage({
  meta: {
    title: "Cash Denominations",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-cash-denominations",
  },
});

const currentDate = moment()
  .tz("Asia/Phnom_Penh")
  .format("YYYY-MM-DDTHH:mm:ss.SSS+07:00");
const isLoading = ref(true);
const cashDenominationType = ref({});
const cashDenominationPurposes = ref([]);
const { t } = useI18n();
const currentTab = ref(1);
const isDialogVisible = ref(false);
const isDialogDetailVisible = ref(false);
const isDialogEventVisible = ref(false);
const users = ref([]);
const cashTransitionRef = ref(null);
const formData = ref({
  type: "out",
  cash_date: new Date(),
});

const filterTransaction = ref({
  search: null,
  start_date: currentDate,
  end_date: currentDate,
  transaction: null,
});

const cashDenominationTransaction = [
  { name: t("Daily Cash"), value: "daily-cash" },
  { name: t("Transaction"), value: "cash-denomination" },
];

const headersTranstions = [
  { title: t("Code"), sortable: false, key: "code", visible: true },
  { title: t("Branch"), key: "branch.name_kh", visible: true },
  { title: t("Cash By"), key: "cash_by.name_kh", visible: true },
  { title: t("Cash On User"), key: "cash_on_user.name_kh", visible: true },
  {
    title: t("Cash Date"),
    key: "cash_date",
    value: (item) => formatDate(item.cash_date),
    visible: true,
  },
  { title: t("Purpose"), key: "purpose.name", visible: true },
  {
    title: t("Description"),
    key: "description",
    visible: true,
  },
  {
    title: t("Type"),
    key: "type",
    visible: true,
  },
  // {
  //   title: t("Currency"),
  //   key: "currency.currency_code",
  //   align: "center",
  //   visible: true,
  // },
  {
    title: t("Total Amount"),
    key: "total_amount",
    align: "end",
    value: (item) => {
      return formatCurrency(item.total_amount || 0);
    },
    visible: true,
  },
  { title: t("Transition"), key: "transition", align: "center", visible: true },
  {
    title: t("Action"),
    key: "actions",
    align: "center",
    visible: true,
    fixed: mdAndUp.value,
  },
];

const headersEvent = [
  { title: t("Code"), sortable: false, key: "code", visible: true },
  { title: t("Branch"), key: "branch.name_kh", visible: true },
  { title: t("User"), key: "user.name_kh", visible: true },
  {
    title: t("Cash Date"),
    key: "cash_date",
    value: (item) => formatDate(item.cash_date),
    visible: true,
  },
  {
    title: t("Description"),
    key: "description",
    visible: true,
  },
  // {
  //   title: t("Type"),
  //   key: "type",
  // },
  { title: t("Currency"), key: "currency.currency_code", visible: true },
  {
    title: t("Total Amount"),
    key: "total_amount",
    value: (item) => {
      return formatCurrency(item.total_amount || 0);
    },
    visible: true,
  },
  {
    title: t("Paid Amount"),
    key: "paid_amount",
    value: (item) => {
      return formatCurrency(item.paid_amount || 0);
    },
    visible: true,
  },
  {
    title: t("Balance Amount"),
    key: "balance_amount",
    value: (item) => {
      return formatCurrency(item.balance_amount || 0);
    },
    visible: true,
  },
  {
    title: t("Event Type"),
    key: "cash_event_type",
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

const initData = async () => {
  try {
    isLoading.value = true;

    const res = await api.post("cash-denomination-types-all");

    if (res.data.status) {
      cashDenominationType.value = res.data.data;
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

onMounted(async () => {
  const [dataUsers, dataCashDenominationPurposes] = await Promise.all([
    getUsers(),
    getCashDenominationPurposes(),
  ]);
  console.log(dataUsers);

  users.value = dataUsers;
  cashDenominationPurposes.value = dataCashDenominationPurposes;
  initData();
});

const onCreate = async (data, callback) => {
  try {
    isLoading.value = true;

    const res = await api.post("cash-denominations-store", data);

    if (res.data.status) {
      initData();
      cashTransitionRef.value.reload();
      isDialogVisible.value = false;
    } else {
      console.error("Error with the response:", res.data);
    }
    callback(res.data.status);
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

const onEdit = async (item) => {
  try {
    isLoading.value = true;

    const res = await api.post("cash-denominations-show", { code: item.code });

    if (res.data.status) {
      console.log(res.data.data);

      formData.value = res.data.data;
      isDialogVisible.value = true;
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

const onUpdate = async (data, callback) => {
  try {
    isLoading.value = true;

    const res = await api.post("cash-denominations-update", data);

    if (res.data.status) {
      initData();
      cashTransitionRef.value.reload();
      isDialogVisible.value = false;
    } else {
      console.error("Error with the response:", res.data);
    }
    callback(res.data.status);
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

const onDelete = async (item) => {
  try {
    isLoading.value = true;

    const res = await api.post("cash-denominations-delete", { id: item.id });

    if (res.data.status) {
      initData();
      cashTransitionRef.value.reload();
      isDialogVisible.value = false;
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

const onDetailView = async (item) => {
  try {
    isLoading.value = true;

    const res = await api.post("cash-denominations-show", { code: item.code });

    if (res.data.status) {
      console.log(res.data.data);

      formData.value = res.data.data;
      isDialogDetailVisible.value = true;
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
  () => useSettingStore().branch_id,
  (newVal) => {
    initData();
  },
);

const onBackDailyCash = async (item) => {
  try {
    isLoading.value = true;

    const res = await api.post("cash-denominations-back-daily-cash", {
      id: item.id,
    });
    cashTransitionRef.value.reload();
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};
</script>

<template>
  <CreateEditCashDenomination
    v-model:isDialogVisible="isDialogVisible"
    :item-data="formData"
    :users="users"
    :cashDenominationType="cashDenominationType"
    :cash-denomination-purposes="cashDenominationPurposes"
    :loading="isLoading"
    @onCreate="onCreate"
    @onUpdate="onUpdate"
  />

  <CashDenominationDetailView
    v-model:isDialogVisible="isDialogDetailVisible"
    :item-data="formData"
    :users="users"
    :cashDenominationType="cashDenominationType"
    :cash-denomination-purposes="cashDenominationPurposes"
  />

  <AppCard
    v-model:isDialogCreateVisible="isDialogVisible"
    title="Cash Denominations"
    title-icon="tabler-cash"
    create-dialog
    can-create="add-cash-denominations"
    :is-back="false"
    :loading="isLoading"
  >
    <VCard class="border-none ma-0 pa-0">
      <VTabs v-model="currentTab" grow stacked class="d-none">
        <template v-for="item in cashDenominationType" :key="item.id">
          <VTab :value="item?.id">
            <span style="font-family: freehand; font-size: 20px">
              {{ item?.abbr }}
            </span>
            <span class="mt-2">{{ item?.name_kh }}</span>
          </VTab>
        </template>
      </VTabs>

      <VCardText class="ma-0 pa-0">
        <VWindow v-model="currentTab">
          <template v-for="item in cashDenominationType" :key="item.id">
            <VWindowItem :value="item.id">
              <VRow>
                <template
                  v-for="i in item?.cash_denomination_types"
                  :key="i.id"
                >
                  <VCol cols="12" sm="4" md="4" lg="3">
                    <MoneyCard
                      :amount="parseFloat(i.value)"
                      :value="parseFloat(i.total_value)"
                    />
                  </VCol>
                </template>
              </VRow>
              <VRow class="ma-0 pa-0 mt-2">
                <VTable class="w-100 table-fixed text-center text-no-wrap">
                  <thead style="background-color: rgba(211, 211, 211, 0.15)">
                    <tr>
                      <th class="w-1/4 text-center">សរុបលុយ</th>
                      <th class="w-1/4 text-center">ប្រាក់បុគ្គលិកបាត់លុយ</th>
                      <th class="w-1/4 text-center">ប្រាក់បុគ្គលិកខ្ចី</th>
                      <th class="w-1/4 text-center">សរុប</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        {{ formatCurrency(item?.cash_amount || 0) }}
                        {{ item?.abbr }}
                      </td>
                      <td>
                        {{ formatCurrency(item?.employee_lost_money || 0) }}
                        {{ item?.abbr }}
                      </td>
                      <td>
                        {{ formatCurrency(item?.employee_own_money || 0) }}
                        {{ item?.abbr }}
                      </td>
                      <td>
                        {{
                          formatCurrency(
                            item?.cash_amount ||
                              0 + item?.employee_lost_money ||
                              0 + item?.employee_own_money ||
                              0,
                          )
                        }}
                        {{ item?.abbr }}
                      </td>
                    </tr>
                  </tbody>
                </VTable>
              </VRow>
            </VWindowItem>
          </template>
        </VWindow>
      </VCardText>
    </VCard>
  </AppCard>

  <AppCardTable
    ref="cashTransitionRef"
    title="Cash Denominations Transactions"
    title-icon="tabler-transfer"
    api-url="cash-denominations-list"
    saveHeaderName="header-cash-denominations-list"
    saveStateName="save-state-cash-denominations-list"
    v-model:loading="isLoading"
    v-model:filters="filterTransaction"
    :headers="headersTranstions"
    is-edit
    is-view
    is-delete
    can-edit="edit-cash-denominations"
    can-delete="delete-cash-denominations"
    :isFullHeight="false"
    @onEdit="onEdit"
    @onDelete="onDelete"
    @onView="onDetailView"
    @onBackDailyCash="onBackDailyCash"
    is-excel
    save-state
    :is-back="false"
    is-back-daily-cash
    :back-daily-cash-condition="(item) => item.transaction == 'daily-cash'"
    class="mt-2"
    is-filter
  >
    <template #filter>
      <VRow class="justify-end">
        <VCol cols="12" sm="6" md="4" lg="2">
          <AppDateTimePicker
            v-model="filterTransaction.start_date"
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
            v-model="filterTransaction.end_date"
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
            v-model="filterTransaction.transaction"
            clearable
            hide-details
            autocomlete="off"
            clear-icon="tabler-x"
            :items="cashDenominationTransaction"
            item-title="name"
            item-value="value"
          >
            <template #label>{{ $t("Transaction") }}</template></AppSelect
          >
        </VCol>
        <VCol cols="12" sm="6" md="4" lg="2">
          <VTextField
            v-model="filterTransaction.search"
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
    <template v-slot:item.type="{ item }">
      <VChip v-if="item.type == 'in'" color="success" size="small">
        <VIcon start icon="tabler-arrow-down" />
        {{ $t("In") }}
      </VChip>
      <VChip v-if="item.type == 'out'" color="error" size="small">
        <VIcon start icon="tabler-arrow-up" />
        {{ $t("Out") }}
      </VChip>
    </template>
    <template v-slot:item.transition="{ item }">
      <VChip
        color="success"
        size="small"
        v-if="item.transaction == 'cash-denomination'"
      >
        {{
          item.transaction == "cash-denomination"
            ? $t("Transaction")
            : $t("Daily Cash")
        }}
      </VChip>
      <VChip color="warning" size="small" v-else>
        {{
          item.transaction == "cash-denomination"
            ? $t("Transaction")
            : $t("Daily Cash")
        }}
      </VChip>
    </template>
  </AppCardTable>

  <AppCardTable
    ref="cashEventRef"
    title="Cash Denominations Events"
    title-icon="tabler-user"
    api-url="cash-events-list"
    saveHeaderName="header-cash-events-list"
    saveStateName="save-state-cash-events-list"
    v-model:loading="isLoading"
    v-model:filters="filter"
    :headers="headersEvent"
    :isFullHeight="false"
    is-excel
    save-state
    :is-back="false"
    class="mt-2"
  >
    <template v-slot:item.cash_event_type="{ item }">
      <VChip
        color="warning"
        size="small"
        v-if="item.cash_event_type.value == 1"
      >
        {{ item.cash_event_type.name_kh }}
      </VChip>
      <VChip color="error" size="small" v-else>
        {{ item.cash_event_type.name_kh }}
      </VChip>
    </template>
  </AppCardTable>
</template>
