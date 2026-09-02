<script setup>
import { ref, watch, nextTick } from "vue";
import { debounce } from "lodash";
import AppAddEditDialog from "@/components/AppAddEditDialog.vue";
import { api } from "@/utils/api.js";
import avatar1 from "@images/avatars/my-avatar-1.jpg";
import formatCurrency from "@/utils/formater/formatCurrency.js";
import AppTextField from "@core/components/app-form-elements/AppTextField.vue";
import AppDateTimePicker from "@core/components/app-form-elements/AppDateTimePicker.vue";
import getImageUrl from "@/utils/image/getImageUrl.js";
import { useDialog } from "@/composables/useDialog.js";
import { useI18n } from "vue-i18n";
import hasPermission from "@/utils/hasPermission.js";
import { parse } from "vue/compiler-sfc";
import moment from "moment-timezone";

const props = defineProps({
  itemData: {
    type: Object,
    required: false,
    default: () => ({}),
  },
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
  loading: {
    type: Boolean,
    required: false,
    skipCheck: true,
    default: undefined,
  },
});

const { t } = useI18n();
const { showDialog } = useDialog();
const isLoading = ref(false);

const inintFormData = () => ({
  receive_date: moment()
    .tz("Asia/Phnom_Penh")
    .format("YYYY-MM-DDTHH:mm:ss.SSS+07:00"),
  approval_date: null,
  receive_amount: 0,
  loan_id: null,
  total_payment: 0,
  current_payment: 0,
  loan_type: "current",
  is_receive_bank: true,
  late_penalty_amount: 0,
  overdue_penalty_amount: 0,
  freeze_penalty_amount: 0,
  total_penalty_amount: 0,
  total_penalty: 0,
  penalty_count: 0,
  principal_balance: 0,
  interest_balance: 0,
  maxBalance: 0,
  receive_count: 0,
  payment_method: "cash",
});

const formData = ref(inintFormData());

const clientInfo = ref({});
const loanInfo = ref({});
const today = new Date().toISOString();
const minDate = ref(null);

const emit = defineEmits([
  "onCreate",
  "onUpdate",
  "onReload",
  "update:isDialogVisible",
]);

const propertyRadioContent1 = [
  {
    title: "Bank",
    icon: {
      icon: "tabler-credit-card",
      size: "28",
    },
    value: "bank",
  },
  {
    title: "Cash",
    icon: {
      icon: "tabler-cash",
      size: "28",
    },
    value: "cash",
  },
];
const propertyRadioContent2 = [
  {
    title: "Bank",
    icon: {
      icon: "tabler-credit-card",
      size: "28",
    },
    value: "bank",
  },
  {
    title: "Cash",
    icon: {
      icon: "tabler-cash",
      size: "28",
    },
    value: "cash",
  },
  {
    title: "Deduct",
    icon: {
      icon: "tabler-plus-minus",
      size: "28",
    },
    value: "deduct",
  },
];

const itemData = ref({ ...props.itemData });

watch(
  () => props.itemData,
  (newData) => {
    itemData.value = { ...newData };
  },
  { deep: true },
);

const resetData = () => {
  inintFormData();
};

const initData = async () => {
  formData.value.loan_id = itemData.value.loan_id;
  const res = await api.post("loans-show-loan-info", {
    loan_id: itemData.value.loan_id,
    receive_date: formData.value.receive_date,
  });
  if (res.data.status) {
    clientInfo.value = res.data.data.client_info;
    loanInfo.value = res.data.data.loan_info;
    minDate.value = new Date(
      res?.data?.data?.loan_info?.approval_date,
    ).toISOString();

    const accountName =
      res?.data?.data?.client_info?.bank_account_name ||
      res?.data?.data?.client_info?.name_en ||
      null;

    // Convert to uppercase only if it's not null
    formData.value.bank_account_name = accountName
      ? accountName.toUpperCase()
      : null;
    formData.value.receive_count = res?.data?.data?.loan_info?.receive_count;
    formData.value.loan_type = res?.data?.data?.loan_info?.loan_type;
    formData.value.total_payment = res?.data?.data?.loan_info?.total_payment;
    formData.value.current_payment =
      res?.data?.data?.loan_info?.current_payment;

    formData.value.late_penalty_amount =
      res?.data?.data?.loan_info?.late_penalty_amount;

    formData.value.principal_balance =
      res?.data?.data?.loan_info?.principal_balance;

    formData.value.interest_balance =
      res?.data?.data?.loan_info?.interest_balance;

    formData.value.overdue_penalty_amount =
      res?.data?.data?.loan_info?.overdue_penalty_amount;

    formData.value.freeze_penalty_amount =
      res?.data?.data?.loan_info?.freeze_penalty_amount;

    formData.value.total_penalty_amount =
      res?.data?.data?.loan_info?.total_penalty_amount;

    formData.value.total_penalty =
      res?.data?.data?.loan_info?.total_penalty_amount;

    formData.value.receive_amount = res?.data?.data?.loan_info?.current_payment;
    formData.value.penalty_count = res?.data?.data?.loan_info?.penalty_count;
  }
};

onMounted(async () => {
  isLoading.value = true;
  await initData();
  isLoading.value = false;
});

const onFormSubmit = debounce(async (refForm) => {
  if (isLoading.value) return; // Prevent multiple submissions while loading
  const { valid } = await refForm;
  if (valid) {
    let result = await showDialog({
      title: t("Do you want to store this record?"),
      icon: "warning",
      confirmColor: "error",
    });

    if (result) {
      try {
        if (isLoading.value) return;
        isLoading.value = true; // Start the loading process
        const principal = parseFloat(formData.value.principal_balance);
        const interest = parseFloat(formData.value.interest_balance);
        const penalty = parseFloat(formData.value.total_penalty);
        formData.value.maxBalance = principal + interest + penalty;

        const res = await api.post("receives-store", formData.value);

        if (res.data.status) {
          onCloseDialog();
        } else {
          console.error("Error with the response:", res.data);
        }
      } catch (error) {
        console.error("Failed to fetch data:", error);
      } finally {
        resetData();
        initData();
        emit("onReload");
        isLoading.value = false; // Reset loading state
      }
    }
  }
}, 500);

const onCloseDialog = () => {
  resetData();
  emit("update:isDialogVisible", false);
};
const getAge = (birthDate) => {
  return Math.floor((new Date() - new Date(birthDate).getTime()) / 3.15576e10);
};

watch(
  () => formData.value.loan_paying,
  (newVal, oldVal) => {
    formData.value.payment_method = "bank";
    if (newVal) {
      const principal = parseFloat(formData.value.principal_balance);
      const interest = parseFloat(formData.value.interest_balance);
      const penalty = parseFloat(formData.value.total_penalty);
      formData.value.receive_amount = principal + interest + penalty;
    } else {
      formData.value.receive_amount = formData.value.current_payment;
    }
  },
);

watch(
  () => formData.value.total_penalty,
  (newVal) => {
    if (formData.value.loan_paying) {
      const principal = parseFloat(formData.value.principal_balance);
      const interest = parseFloat(formData.value.interest_balance);
      const total = principal + interest + parseFloat(newVal);
      console.log(total);

      formData.value.receive_amount = total;
    } else {
      formData.value.receive_amount = formData.value.current_payment;
    }
  },
);

watch(
  () => formData.value.receive_date,
  (newVal, oldVal) => {
    initData();
  },
);
</script>

<template>
  <AppAddEditDialog
    title="Receive"
    icon="tabler-cash"
    :is-dialog-visible="isDialogVisible"
    :is-update="itemData.id != null ? true : false"
    :loading="isLoading"
    @on-close-dialog="onCloseDialog"
    @on-submit="onFormSubmit"
  >
    <VRow>
      <VCol class="pb-0">
        <div
          class="rounded pa-3 d-flex flex-row align-start mb-2 border w-100 justify-space-between"
        >
          <div>
            <div class="d-flex flex-row align-center">
              <AppAvatar
                :title="clientInfo.name_kh"
                :image="clientInfo.image_path"
                :size="50"
              />
              <!-- <VAvatar rounded :size="50" border>
                <VImg
                  v-if="clientInfo.image_path"
                  :src="getImageUrl(clientInfo.image_path)"
                  @click="showImage(null)"
                />
                <VImg v-else :src="avatar1" @click="showImage(null)" />
              </VAvatar> -->
              <div class="d-flex flex-column ml-2 align-start">
                <span style="font-size: 14px"
                  >{{ clientInfo.name_kh }}
                  <template v-if="clientInfo?.village?.name_kh">
                    <VChip size="small">
                      {{ clientInfo?.village?.name_kh }}
                    </VChip></template
                  ></span
                >
                <span class="text-primary" style="font-size: 14px">{{
                  loanInfo.code
                }}</span>
              </div>
            </div>
          </div>
          <div>
            <h1 class="text-primary">{{ loanInfo.receive_count }}</h1>
          </div>
        </div>
      </VCol>

      <VCol cols="12" class="pt-0">
        <div class="d-flex flex-column">
          <h4 class="mb-2">
            <VChip size="small">
              ទំហំកម្ចី
              <span class="font-weight-bold ml-1">
                {{ formatCurrency(loanInfo?.loan_amount) || 0 }} ({{
                  loanInfo?.currency
                }})
              </span>
            </VChip>
          </h4>
          <h4 class="mb-2">
            <VChip size="small">
              ប្រាក់ត្រូវបង់ថ្ងៃនេះ
              <span class="font-weight-bold ml-1">
                {{
                  formatCurrency(
                    formData.current_payment - loanInfo.total_penalty_amount,
                  )
                }}
              </span>
            </VChip>
            <VChip
              color="error"
              size="small"
              v-if="loanInfo?.total_penalty_amount > 0"
              class="ml-1"
            >
              +ពិន័យ
              <span class="font-weight-bold ml-1">{{
                formatCurrency(loanInfo.total_penalty_amount)
              }}</span>
            </VChip>
          </h4>
          <h4 class="mb-2">
            <VChip size="small">
              សរុបប្រាក់ត្រូវបង់ថ្ងៃនេះ
              <span class="font-weight-bold ml-1">
                {{ formatCurrency(formData.current_payment) }}
              </span>
            </VChip>
          </h4>
          <h4>
            <VChip size="small">
              ប្រាក់បង់ផ្តាច់
              <span class="font-weight-bold ml-1">{{
                formatCurrency(formData.total_payment)
              }}</span>
            </VChip>
          </h4>
        </div>
        <!-- <VDivider /> -->
        <div class="d-flex flex-row mt-4 mb-4">
          <VRow>
            <div class="d-flex flex-row justify-space-between">
              <VCheckbox
                v-model="formData.loan_paying"
                :true-value="true"
                :false-value="false"
                color="primary"
                label="បង់ផ្ដាច់"
              />
              <!-- <VCheckbox
                v-model="formData.is_receive_bank"
                :true-value="true"
                :false-value="false"
                color="primary"
                label="បង់តាមធនាគារ"
              /> -->
            </div>
          </VRow>
        </div>
        <!-- <AppTowRadioIcon
          v-if="formData.loan_paying"
          v-model:selected-radio="formData.payment_method"
          :radio-content="propertyRadioContent2"
          :grid-column="{ cols: '4', sm: '4' }"
        />
        <AppTowRadioIcon
          v-else
          v-model:selected-radio="formData.payment_method"
          :radio-content="propertyRadioContent1"
          :grid-column="{ cols: '6', sm: '6' }"
        /> -->
        <AppDateTimePicker
          v-if="hasPermission('back-date-receives')"
          v-model="formData.receive_date"
          label="Receive Date"
          :config="{
            minDate: minDate,
            maxDate: today,
            allowInput: true,
          }"
          autocomplete="off"
          prepend-inner-icon="tabler-calendar-due"
        />

        <!-- <AppTextField
          v-if="formData.payment_method == 'bank'"
          v-model="formData.bank_account_name"
          label="Bank Account Name"
        /> -->

        <AppTextField
          v-if="formData.total_penalty_amount > 0"
          v-model="formData.total_penalty"
          label="Total Penalty"
          format-currency
          :disabled="!hasPermission('change-penalty-amount-receives')"
          :max="formData.total_penalty_amount"
        />
        <AppTextField
          v-model="formData.receive_amount"
          label="Receive Amount"
          format-currency
          :max="
            parseFloat(formData.principal_balance) +
            parseFloat(formData.interest_balance) +
            parseFloat(formData.total_penalty)
          "
          :disabled="formData.loan_paying"
          :hint="
            parseFloat(formData.receive_amount) >
            parseFloat(formData.current_payment)
              ? `បង់ទុកចំនួន ${formatCurrency(
                  parseFloat(formData.receive_amount) -
                    parseFloat(formData.current_payment),
                )}`
              : ``
          "
        />
      </VCol>
    </VRow>
  </AppAddEditDialog>
</template>
