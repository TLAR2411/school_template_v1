<script setup>
import AppDateTimePicker from "@/@core/components/app-form-elements/AppDateTimePicker.vue";
import { onMounted, ref, watch } from "vue";
import { api } from "@/utils/api";
import formatCurrency from "@/utils/formater/formatCurrency";
import formatDate from "@/utils/formater/formatDate";
import { useVueToPrint } from "vue-to-print";
import { auth } from "@/utils/auth";
import { getCo, getCurrencies } from "@/services/dataService";
import hasPermission from "@/utils/hasPermission";
import { useSettingStore } from "@/stores/settingStore";
import moment from "moment-timezone";
import CashDenominationCheckForm from "@/views/accounting/closed-entries/CashDenominationCheckForm.vue";
import formatNoneZero from "@/utils/formater/formatNoneZero";
import formatContact from "@/utils/formater/formatContact";
import { getLoanSettings } from "@/services/dataService";

const logos = import.meta.glob("@images/logo/*/logo.png", {
  eager: true,
  import: "default",
});

const company = import.meta.env.VITE_BASE_COMPANY;
const MainLogo = logos[`/src/assets/images/logo/${company}/logo.png`];
// const formatDate = (date) => {
//   const d = date.getDate().toString().padStart(2, "0");
//   const m = (date.getMonth() + 1).toString().padStart(2, "0");
//   const y = date.getFullYear();
//   return `${d}-${m}-${y}`;
// };
const companyName = import.meta.env.VITE_BASE_COMPANY_NAME;
const filter = ref({
  start_date: moment()
    .tz("Asia/Phnom_Penh")
    .format("YYYY-MM-DDTHH:mm:ss.SSS+07:00"),
  end_date: null,
  currency_id: 1,
  credit_officer: null,
  co_id: null,
});
const itemData = ref({});
const currencies = ref([]);
const isLoading = ref(false);
const co = ref([]);
const loanSettings = ref([]);
const isPermitAdvancePayment = ref(false);
const isPaymentByBank = ref(false);
const isQuickLoanSerive = ref(false);
const isOperationFee = ref(false);
const today = moment()
  .tz("Asia/Phnom_Penh")
  .format("YYYY-MM-DDTHH:mm:ss.SSS+07:00");

const initData = async () => {
  try {
    isLoading.value = true;

    const res = await api.post("close-entries-show", {
      filter: filter.value,
    });

    if (res.data.status) {
      itemData.value = res.data.data;
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
};

const filterData = () => {
  initData();
};
const printAreaRef = ref(null);
const { handlePrint } = useVueToPrint({
  content: () => {
    isLoading.value = true;
    return printAreaRef.value;
  },
  onAfterPrint: () => {
    isLoading.value = false;
  },
});

const onSubmit = async () => {
  try {
    isLoading.value = true;

    const res = await api.post("close-entries-store", itemData.value);
    if (res.data.status) {
      filterData();
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    //
    // isDialogVisible.value = false;
    isLoading.value = false;
  }
};

// watch(filter.value, (newVal, OldVal) => {
//   initData();
// });

watch(
  () => useSettingStore().branch_id,
  async (newVal, oldVal) => {
    if (newVal) {
      filterData();

      filter.value.co_id = null;

      const [dataCo] = await Promise.all([getCo()]);

      co.value = dataCo;
    }
  },
);

watch(
  () => [filter.value.start_date, filter.value.end_date, filter.value.co_id],
  () => {
    initData();
  },
);

onMounted(async () => {
  const [dataCurrencies, dataCo, dataLoanSettings] = await Promise.all([
    getCurrencies(),
    getCo(),
    getLoanSettings(),
  ]);

  loanSettings.value = dataLoanSettings;
  currencies.value = dataCurrencies;
  co.value = dataCo;
  isPermitAdvancePayment.value = dataLoanSettings?.find(
    (v) => v.key === "is_permit_advance_payments",
  )?.value;

  isPaymentByBank.value = dataLoanSettings?.find(
    (v) => v.key === "is_payment_by_bank",
  )?.value;
  isQuickLoanSerive.value = dataLoanSettings?.find(
    (v) => v.key === "is_quick_loan_service",
  )?.value;
  isOperationFee.value = dataLoanSettings?.find(
    (v) => v.key === "is_operation_fee",
  )?.value;
  initData();
});

const denominationGrid = computed(() => {
  const types = itemData?.value?.cash_denomination?.type || [];
  const values = itemData?.value?.cash_denomination?.value || [];

  // 1. Split data into 3 columns based on the image logic
  // Col 1: 200k, 100k, 50k, 30k, 20k
  const col1 = types.slice(0, 5).map((t, i) => ({ type: t, count: values[i] }));

  // Col 2: 15k, 10k, 5k, 2k
  const col2 = types
    .slice(5, 10)
    .map((t, i) => ({ type: t, count: values[i + 5] }));

  // Col 3: 1000, 500, 200, 100
  const col3 = types
    .slice(10, 14)
    .map((t, i) => ({ type: t, count: values[i + 10] }));

  // 2. Determine max rows needed (usually 5 based on your image)
  const maxRows = Math.max(col1.length, col2.length, col3.length);

  // 3. Build the rows for the table
  const rows = [];
  for (let i = 0; i < maxRows; i++) {
    rows.push({
      col1: col1[i] || { type: null, count: null },
      col2: col2[i] || { type: null, count: null }, // This handles the empty cell next to 200,000
      col3: col3[i] || { type: null, count: null },
    });
  }
  return rows;
});
</script>

<template>
  <VRow class="match-height">
    <VCol cols="12" lg="8">
      <AppCard
        title="Close Entry"
        title-icon="tabler-checklist"
        :loading="isLoading"
        :is-back="false"
      >
        <VRow>
          <VCol cols="12" lg="12" md="12" sm="12">
            <VRow>
              <VCol cols="12">
                <VRow class="justify-end">
                  <VCol cols="6" sm="4" md="4" lg="3">
                    <AppDateTimePicker
                      v-model="filter.start_date"
                      :config="{
                        allowInput: true,
                        maxDate: today,
                      }"
                      prepend-inner-icon="tabler-calendar-due"
                    >
                      <template #label>{{ $t("Date") }}</template>
                    </AppDateTimePicker>
                  </VCol>
                  <VCol cols="6" sm="4" md="4" lg="3">
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
                  <VCol cols="12" sm="3" md="2" lg="2">
                    <VBtn
                      @click="handlePrint"
                      :loading="isLoading"
                      color="warning"
                      class="w-100"
                    >
                      <VIcon start icon="tabler-printer" />
                      {{ $t("Print") }}
                    </VBtn>
                  </VCol>
                </VRow>
                <VDivider class="mt-2" />
                <div ref="printAreaRef">
                  <!-- <h3 class="text-center mt-8 mb-2 printDiv" style="color: #000000">
                របាយការណ៍ បិទបញ្ចីប្រចាំថ្ងៃ
              </h3> -->
                  <div class="printDiv">
                    <div
                      class="d-flex flex-column align-center"
                      style="width: 180px"
                    >
                      <div>
                        <img style="height: 45px !important" :src="MainLogo" />
                      </div>
                      <span
                        style="
                          font-family: moul-light !important;
                          color: black;
                          text-align: center;
                          font-size: 14px;
                          margin-top: 4px;
                        "
                      >
                        {{ companyName }}
                      </span>
                      <!-- <span style="font-family: tacteing; text-align: center"
                        >rrts s</span
                      > -->
                    </div>
                    <div class="d-flex flex-column flex-grow-1 mt-2">
                      <span
                        class="text-center mt-1"
                        style="
                          color: #000000;
                          font-family: moul-light !important;
                          font-size: 16px;
                        "
                      >
                        របាយការណ៍ បិទបញ្ចីប្រចាំថ្ងៃ ({{
                          itemData.branch_name
                        }})
                      </span>
                    </div>
                  </div>
                  <span
                    style="color: #000000; font-family: moul-light !important"
                  ></span>
                  <span
                    style="color: #000000; font-family: tacteing !important"
                  ></span>

                  <VCardTitle class="d-flex flex-row justify-space-between">
                    <div class="d-flex flex-column">
                      <!-- <h5 class="section-header text-start">
                        {{ itemData.branch_name }}
                      </h5> -->
                      <!-- <h5 class="mt-1">
                    រូបិយប័ណ្ណ : {{ itemData.currency_code }}
                  </h5> -->
                    </div>
                    <template
                      v-if="
                        formatDate(itemData.start_date) ==
                        formatDate(itemData.end_date)
                      "
                    >
                      <h5 class="text-error date-header text-end">
                        កាលបរិច្ឆេទ: &nbsp;{{ formatDate(itemData.start_date) }}
                      </h5>
                    </template>

                    <template v-else>
                      <div class="d-flex flex-column">
                        <!-- <h5 class="text-end text-error">
                      ពីថ្ងៃទី: &nbsp;{{ formatDate(itemData.start_date) }}
                    </h5> -->
                        <h5 class="mt-1 text-end text-error">
                          កាលបរិច្ឆេទ: &nbsp;{{
                            formatDate(itemData.start_date)
                          }}
                        </h5>
                      </div>
                    </template>
                  </VCardTitle>
                  <VDivider />
                  <VTable class="text-no-wrap">
                    <tbody>
                      <tr
                        class="font-weight-bold"
                        style="background-color: rgba(211, 211, 211, 0.2)"
                      >
                        <td>ទម្លាក់ទុន សរុប</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td
                          class="text-end"
                          style="
                            background-color: rgb(var(--v-theme-primary), 0.1);
                          "
                        >
                          {{ formatCurrency(itemData.total_disburse_amount) }}
                        </td>
                      </tr>
                      <tr
                        class="font-weight-bold"
                        style="background-color: rgba(211, 211, 211, 0.2)"
                      >
                        <td>ប្រមូល សរុប</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td
                          class="text-end"
                          style="
                            background-color: rgb(var(--v-theme-primary), 0.1);
                          "
                        >
                          {{ formatCurrency(itemData.receive_amount) }}
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td>ថ្លៃសេវារដ្ឋបាល</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-end">
                          {{ formatCurrency(itemData.loan_fee_amount) }}
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td>ប្រាក់បង្គរ</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-end">
                          {{ formatCurrency(itemData.deposit_amount) }}
                        </td>
                      </tr>
                      <tr>
                        <td></td>
                        <td>ថ្លៃគាំពារកម្ចី</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-end">
                          {{ formatCurrency(itemData.insurance_amount) }}
                        </td>
                      </tr>
                      <tr v-if="isQuickLoanSerive">
                        <td></td>
                        <td>ថ្លៃសេវាបង្វិលទុនរហ័ស</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-end">
                          {{
                            formatCurrency(itemData.quick_loan_service_amount)
                          }}
                        </td>
                      </tr>
                      <!-- <tr v-if="isOperationFee">
                        <td></td>
                        <td>ថ្លៃសេវាប្រតិបត្តិការ</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="text-end">
                          {{ formatCurrency(itemData.operation_fee_amount) }}
                        </td>
                      </tr> -->
                      <template v-if="isPermitAdvancePayment">
                        <tr
                          class="font-weight-bold"
                          style="background-color: rgba(211, 211, 211, 0.3)"
                        >
                          <td></td>
                          <td>អតិថិជនបង់</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td
                            class="text-end"
                            style="
                              background-color: rgb(
                                var(--v-theme-primary),
                                0.1
                              );
                            "
                          >
                            {{ formatCurrency(itemData.total_receive) }}
                          </td>
                        </tr>
                        <tr class="font-weight-bold">
                          <td></td>
                          <td></td>
                          <td>អតិថិជនបង់ក្នុងថ្ងៃ</td>
                          <td></td>
                          <td></td>
                          <td
                            class="text-end"
                            style="
                              background-color: rgb(
                                var(--v-theme-primary),
                                0.1
                              );
                            "
                          >
                            {{ formatCurrency(itemData.total_receive_due) }}
                          </td>
                        </tr>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>ប្រាក់បង់ល្អ</td>
                          <td></td>
                          <td class="text-end">
                            {{ formatCurrency(itemData.current_paid_amount) }}
                          </td>
                        </tr>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>ប្រាក់បង់យឺត</td>
                          <td></td>

                          <td class="text-end">
                            {{ formatCurrency(itemData.late_paid_amount) }}
                          </td>
                        </tr>

                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>ប្រាក់បង់ខូច</td>
                          <td></td>
                          <td class="text-end">
                            {{ formatCurrency(itemData.overdue_paid_amount) }}
                          </td>
                        </tr>

                        <tr
                          style="background-color: rgba(211, 211, 211, 0.15)"
                          class="hideDivWhenPrint"
                        >
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>ប្រាក់ពិន័យ</td>
                          <td class="text-end">
                            {{ formatCurrency(itemData.total_penalty) }}
                          </td>
                        </tr>
                        <tr
                          style="background-color: rgba(211, 211, 211, 0.15)"
                          class="hideDivWhenPrint"
                        >
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>ប្រាក់ដើម</td>
                          <td class="text-end">
                            {{ formatCurrency(itemData.principal_due) }}
                          </td>
                        </tr>

                        <tr
                          v-if="isOperationFee"
                          style="background-color: rgba(211, 211, 211, 0.15)"
                          class="hideDivWhenPrint"
                        >
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>សេវាប្រតិបត្តិការ</td>
                          <td class="text-end">
                            {{ formatCurrency(itemData.operation_fee_due) }}
                          </td>
                        </tr>
                        <tr
                          style="background-color: rgba(211, 211, 211, 0.15)"
                          class="hideDivWhenPrint"
                        >
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>ការប្រាក់</td>
                          <td class="text-end">
                            {{ formatCurrency(itemData.interest_due) }}
                          </td>
                        </tr>
                        <tr class="font-weight-bold">
                          <td></td>
                          <td></td>
                          <td>ប្រាក់បង់ទុក</td>
                          <td></td>
                          <td></td>
                          <td
                            class="text-end"
                            style="
                              background-color: rgb(
                                var(--v-theme-primary),
                                0.1
                              );
                            "
                          >
                            {{ formatCurrency(itemData.prepaid_amount) }}
                          </td>
                        </tr>

                        <tr
                          style="background-color: rgba(211, 211, 211, 0.15)"
                          class="hideDivWhenPrint"
                        >
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>ប្រាក់ដើម</td>
                          <td class="text-end">
                            {{ formatCurrency(itemData.principal_prepaid) }}
                          </td>
                        </tr>

                        <tr
                          v-if="isOperationFee"
                          style="background-color: rgba(211, 211, 211, 0.15)"
                          class="hideDivWhenPrint"
                        >
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>សេវាប្រតិបត្តិការ</td>
                          <td class="text-end">
                            {{ formatCurrency(itemData.operation_fee_prepaid) }}
                          </td>
                        </tr>
                        <tr
                          style="background-color: rgba(211, 211, 211, 0.15)"
                          class="hideDivWhenPrint"
                        >
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>ការប្រាក់</td>
                          <td class="text-end">
                            {{ formatCurrency(itemData.interest_prepaid) }}
                          </td>
                        </tr>
                      </template>

                      <template v-else>
                        <tr
                          class="font-weight-bold"
                          style="background-color: rgba(211, 211, 211, 0.3)"
                        >
                          <td></td>
                          <td>អតិថិជនបង់</td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td
                            class="text-end"
                            style="
                              background-color: rgb(
                                var(--v-theme-primary),
                                0.1
                              );
                            "
                          >
                            {{ formatCurrency(itemData.total_receive) }}
                          </td>
                        </tr>
                        <!-- <tr class="font-weight-bold">
                      <td></td>
                      <td></td>
                      <td>អតិថិជនបង់ក្នុងថ្ងៃ</td>
                      <td></td>
                      <td></td>
                      <td
                        class="text-end"
                        style="
                          background-color: rgb(var(--v-theme-primary), 0.1);
                        "
                      >
                        {{ formatCurrency(itemData.total_receive_due) }}
                      </td>
                    </tr> -->
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>ប្រាក់បង់ល្អ</td>
                          <td></td>
                          <td class="text-end">
                            {{ formatCurrency(itemData.current_paid_amount) }}
                          </td>
                        </tr>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>ប្រាក់បង់យឺត</td>
                          <td></td>

                          <td class="text-end">
                            {{ formatCurrency(itemData.late_paid_amount) }}
                          </td>
                        </tr>

                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>ប្រាក់បង់ខូច</td>
                          <td></td>
                          <td class="text-end">
                            {{ formatCurrency(itemData.overdue_paid_amount) }}
                          </td>
                        </tr>
                        <tr>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>ប្រាក់បង់ទុក</td>
                          <td></td>
                          <td class="text-end">
                            {{ formatCurrency(itemData.prepaid_amount) }}
                          </td>
                        </tr>

                        <tr style="background-color: rgba(211, 211, 211, 0.15)">
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>ប្រាក់ពិន័យ</td>
                          <td class="text-end">
                            {{ formatCurrency(itemData.total_penalty) }}
                          </td>
                        </tr>
                        <tr style="background-color: rgba(211, 211, 211, 0.15)">
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>ប្រាក់ដើម</td>
                          <td class="text-end">
                            {{ formatCurrency(itemData.principal_amount) }}
                          </td>
                        </tr>

                        <tr
                          v-if="isOperationFee"
                          style="background-color: rgba(211, 211, 211, 0.15)"
                        >
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>សេវាប្រតិបត្តិការ</td>
                          <td class="text-end">
                            {{ formatCurrency(itemData.operation_fee_amount) }}
                          </td>
                        </tr>
                        <tr style="background-color: rgba(211, 211, 211, 0.15)">
                          <td></td>
                          <td></td>
                          <td></td>
                          <td></td>
                          <td>ការប្រាក់</td>
                          <td class="text-end">
                            {{ formatCurrency(itemData.interest_amount) }}
                          </td>
                        </tr>
                      </template>
                    </tbody>
                  </VTable>
                  <template> </template>

                  <div class="text-center mt-5 printDiv">
                    <VCol class="pa-0">
                      <VTable density="compact" class="cash-count-table">
                        <tbody>
                          <!-- <tr>
                            <td
                              colspan="9"
                              class="text-center font-weight-bold"
                            >
                              <span style="font-size: 16px; color: black"
                                >កំណត់ត្រាសាច់ប្រាក់ប្រចាំថ្ងៃ</span
                              >
                            </td>
                          </tr> -->
                          <tr
                            v-for="(row, index) in denominationGrid"
                            :key="index"
                          >
                            <td class="text-end border-e" style="width: 14%">
                              {{
                                row.col1.type
                                  ? formatCurrency(row.col1.type)
                                  : ""
                              }}
                            </td>
                            <td
                              class="text-center"
                              style="
                                width: 5.33%;
                                background-color: rgba(211, 211, 211, 0.1);
                              "
                            >
                              {{ row.col1.type ? row.col1.count || 0 : "" }}
                            </td>
                            <td
                              class="text-end font-weight-bold border-e"
                              style="
                                background-color: rgba(211, 211, 211, 0.3);
                                width: 14%;
                              "
                            >
                              {{
                                row.col1.type
                                  ? formatNoneZero(
                                      parseFloat(row.col1.type) *
                                        parseFloat(row.col1.count),
                                    ) || 0
                                  : ""
                              }}
                            </td>

                            <td class="text-end border-e" style="width: 14%">
                              {{
                                row.col2.type
                                  ? formatCurrency(row.col2.type)
                                  : ""
                              }}
                            </td>
                            <td
                              class="text-center"
                              style="
                                width: 5.33%;
                                background-color: rgba(211, 211, 211, 0.1);
                              "
                            >
                              {{ row.col2.type ? row.col2.count || 0 : "" }}
                            </td>
                            <td
                              class="text-end font-weight-bold border-e"
                              style="
                                background-color: rgba(211, 211, 211, 0.3);
                                width: 14%;
                              "
                            >
                              {{
                                row.col2.type
                                  ? formatNoneZero(
                                      parseFloat(row.col2.type) *
                                        parseFloat(row.col2.count),
                                    ) || 0
                                  : ""
                              }}
                            </td>
                            <td class="text-end border-e" style="width: 14%">
                              {{
                                row.col3.type
                                  ? formatCurrency(row.col3.type)
                                  : ""
                              }}
                            </td>
                            <td
                              class="text-center"
                              style="
                                width: 5.33%;
                                background-color: rgba(211, 211, 211, 0.1);
                              "
                            >
                              {{ row.col3.type ? row.col3.count || 0 : "" }}
                            </td>
                            <td
                              class="text-end font-weight-bold"
                              style="
                                background-color: rgba(211, 211, 211, 0.3);
                                width: 14%;
                              "
                            >
                              {{
                                row.col3.type
                                  ? formatNoneZero(
                                      parseFloat(row.col3.type) *
                                        parseFloat(row.col3.count),
                                    ) || 0
                                  : ""
                              }}
                            </td>
                          </tr>

                          <tr>
                            <td
                              colspan="8"
                              class="text-end font-weight-bold border-t"
                            >
                              សរុប
                            </td>
                            <td class="text-end font-weight-bold border-t">
                              {{
                                formatCurrency(
                                  itemData?.cash_denomination?.cash || 0,
                                )
                              }}
                            </td>
                          </tr>
                        </tbody>
                      </VTable>

                      <VDivider />
                    </VCol>
                  </div>
                  <template class="printDiv">
                    <div
                      class="d-flex flex-row justify-space-between mt-6 mr-4"
                    >
                      <div
                        class="d-flex flex-column text-center"
                        style="
                          margin-top: 80px;
                          margin-left: 80px;
                          font-size: 13px;
                        "
                      >
                        <span>ត្រួតពិនិត្យដោយ</span>
                        <span style="margin-top: 90px">{{
                          itemData.co_id
                            ? auth().user.name_kh
                            : `.................`
                        }}</span>
                      </div>
                      <div
                        class="d-flex flex-column text-center"
                        style="margin-right: 30px; font-size: 13px"
                      >
                        <span>{{ itemData.current_date }}</span>
                        <span>រៀបចំដោយ</span>
                        <span style="margin-top: 90px">{{
                          itemData.co_id
                            ? itemData.co_name
                            : auth().user.name_kh
                        }}</span>
                      </div>
                    </div>
                  </template>
                </div>
                <template v-if="itemData.is_all_branch">
                  <div class="text-center mt-3">
                    <h3 class="text-primary text-center">សូមជ្រើសរើសសាខា</h3>
                  </div>
                </template>

                <template v-if="itemData.already_close_entry">
                  <div class="text-center mt-3">
                    <h3 class="text-error text-center">
                      សាខាបានបិទបញ្ចីរួចរាល់
                    </h3>
                  </div>
                </template>

                <VRow v-if="hasPermission('add-close-entries')">
                  <VDivider class="mt-3" v-if="itemData.can_close_entry" />
                  <VCol cols="12" class="d-flex justify-end">
                    <VBtn v-if="itemData.can_close_entry" @click="onSubmit">
                      <VIcon start icon="tabler-check" />
                      {{ $t("Close Entry") }}
                    </VBtn>
                  </VCol>
                  <!-- <VCol
                    cols="12"
                    class="d-flex justify-center"
                    v-if="
                      !itemData.can_close_entry && !itemData.already_close_entry
                    "
                  >
                    <h2 class="text-primary text-center">សូមជ្រើសរើសសាខា</h2>
                  </VCol>
                  <VCol
                    cols="12"
                    class="d-flex justify-center"
                    v-if="itemData.already_close_entry"
                  >
                    <h2 class="text-error text-center">
                      បានបិទបញ្ចីរួចរាល់
                    </h2>
                  </VCol> -->
                </VRow>
              </VCol>
            </VRow>
          </VCol>
        </VRow>
      </AppCard>
    </VCol>

    <VCol cols="12" lg="4">
      <CashDenominationCheckForm
        :item-data="itemData"
        :loading="isLoading"
        :co-id="filter.co_id"
        :is-payment-by-bank="isPaymentByBank"
        :is-quick-loan-service="isQuickLoanSerive"
        @reload="initData()"
      />
    </VCol>
  </VRow>
</template>

<style scoped>
.v-table td,
.v-table th {
  padding: 2px;
  height: 40px !important;
}
.printDiv {
  display: none !important;
}

/* .hideDivWhenPrint {
  display: block !important;
} */

@media print {
  .printDiv {
    display: block !important;
  }
  .hideDivWhenPrint {
    display: none !important;
  }
  h5 {
    color: black;
    font-size: 13px;
  }
  span {
    color: black;
    font-size: 13px;
  }

  .v-table td,
  .v-table th {
    font-size: 13px;
    padding: 2px;
    height: 30px !important;
    color: black;
  }

  .v-table td,
  .v-table th {
    padding: 2px;
    height: 30px !important;
    color: black;
    font-size: 13px;
  }
  /* Remove all margins and padding from the body, card, and table */

  .date-header {
    color: red !important;
    font-size: 13px;
  }
  .section-header {
    color: black;
    font-size: 13px;
  }
}

@page {
  size: A4 portrait !important;
  margin: 0.5cm !important;
}

.printDiv {
  display: none;
}
</style>
