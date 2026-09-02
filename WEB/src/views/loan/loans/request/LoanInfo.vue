<script setup>
import AppSelect from "@/@core/components/app-form-elements/AppSelect.vue";
import AppTextField from "@/@core/components/app-form-elements/AppTextField.vue";
import CustomCheckboxes from "@/@core/components/app-form-elements/CustomCheckboxes.vue";
import { useDialog } from "@/composables/useDialog";
import {
  getApprover,
  getApproveRanks,
  getCo,
  getCurrencies,
  getLoanDurations,
  getLoanRepayments,
  getLoanSettings,
  getLoanTerms,
  getReceiveDays,
} from "@/services/dataService";
import { useSettingStore } from "@/stores/settingStore";
import { auth } from "@/utils/auth";
import formatContact from "@/utils/formater/formatContact";
import formatCurrency from "@/utils/formater/formatCurrency";
import { onMounted, ref, watch } from "vue";
import { useI18n } from "vue-i18n";

const { showDialog } = useDialog();
const props = defineProps({
  modelValue: {
    type: Object,
    default: () => ({}),
  },
  selectedClient: {
    type: Object,
    default: () => ({}),
  },
  loanMode: {
    type: Number,
    default: 1,
  },
});

const roundRange = [
  { name: "មិនបង្គត់", value: 1 },
  { name: "បង្គត់យក ដប់", value: 10 },
  { name: "បង្គត់យក មួយរយ", value: 100 },
  { name: "បង្គត់យក ប្រាំរយ", value: 500 },
];
const tomorrow = new Date();
const approveRanks = ref([]);
const loanSettings = ref([]);
tomorrow.setDate(tomorrow.getDate() + 1);

// Format as d-m-Y (e.g., 15-05-2025)
// const tomorrowDate = tomorrow
//   .toLocaleDateString("en-GB", {
//     day: "2-digit",
//     month: "2-digit",
//     year: "numeric",
//   })
//   .split("/")
//   .join("-");

const formData = ref({
  loan_mode: props.loanMode || 1,
  loan_term_id: null,
  loan_duration_id: null,
  currency_id: 1,
  loan_repayment_id: 1,
  loan_amount: 0,
  loan_fee_amount: 0,
  operation_fee_amount: 0,
  deposit_amount: 0,
  interest_amount: 0,
  penalty_amount: 0,
  per_schedule_amount: 0,
  insurance_amount: 0,
  interest_rate: 0,
  loan_start_date: tomorrow,
  approval_date: new Date(),
  round_range: 1,
  loan_fee_rate: 0,
  deposit_rate: 0,
  penalty_rate: 0,
  loan_duration: 0,
  insurance_rate: 0,
  is_restructure: false,
  is_quick_loan_service: false,
  quick_loan_service_amount: 0,
  pay_for_holidays_amount: 0,
  is_pay_for_holidays: true,
  co_id: auth()?.user?.position?.is_member ? auth()?.user?.id : null,
  approve_by: null,
  check_by: null,
});
const openReceiveDaysLength = ref(0);
const selectedCheckbox = ref(["is_pay_for_holidays"]);
const receiveDays = ref([]);
const imageErrors = ref(new Set());

const handleImageError = (itemId) => {
  imageErrors.value.add(itemId);
};

const hasImageError = (itemId) => {
  return imageErrors.value.has(itemId);
};

const currencies = ref([]);
const loanDurations = ref([]);
const selectedDurations = ref([]);
const loanTerms = ref([]);
const loanRepayments = ref([]);
const approver = ref([]);
const checker = ref([]);

const allApprover = ref([]);
const co = ref([]);

const emit = defineEmits(["update:modelValue", "restForm"]);

const restForm = () => {
  formData.value = {
    loan_mode: props.loanMode || 1,
    loan_term_id: null,
    loan_duration_id: null,
    currency_id: 1,
    loan_repayment_id: 1,
    loan_amount: 0,
    loan_fee_amount: 0,
    operation_fee_amount: 0,
    deposit_amount: 0,
    interest_amount: 0,
    penalty_amount: 0,
    per_schedule_amount: 0,
    insurance_amount: 0,
    interest_rate: 0,
    loan_start_date: tomorrow,
    approval_date: new Date(),
    round_range: 1,
    loan_fee_rate: 0,
    deposit_rate: 0,
    penalty_rate: 0,
    loan_duration: 0,
    insurance_rate: 0,
    is_restructure: false,
    is_quick_loan_service: false,
    quick_loan_service_amount: 0,
    is_pay_for_holidays: true,
    co_id: auth()?.user?.position?.is_member ? auth()?.user?.id : null,
    approve_by: null,
    check_by: null,
  };
  setDefault();
};

defineExpose({
  restForm,
});

watch(
  () => formData.value,
  (val) => {
    emit("update:modelValue", val);
  },
  { deep: true },
);

watch(
  () => formData.value.loan_term_id,
  (newVal) => {
    selectedDurations.value = loanDurations.value.filter(
      (v) => v.loan_term_id == formData.value.loan_term_id,
    );
    formData.value.loan_duration_id = selectedDurations.value[0]?.id || null;
  },
);

const calculateAmount = () => {
  const loanDurationRate = loanDurations.value.find(
    (v) => v.id == formData.value.loan_duration_id,
  );

  if (loanDurationRate?.round_range) {
    formData.value.interest_amount =
      Math.ceil(
        ((formData.value.loan_amount * loanDurationRate?.interest_rate) / 100 ||
          0) / formData.value.round_range,
      ) * formData.value.round_range;

    formData.value.loan_fee_amount =
      Math.ceil(
        ((formData.value.loan_amount * loanDurationRate?.loan_fee_rate) / 100 ||
          0) / formData.value.round_range,
      ) * formData.value.round_range;

    formData.value.deposit_amount =
      Math.ceil(
        (formData.value.loan_amount * loanDurationRate?.deposit_rate) /
          100 /
          formData.value.round_range,
      ) * formData.value.round_range;

    if (loanDurationRate.penalty_rate != 0) {
      if (formData.value.loan_amount < 1000000) {
        formData.value.penalty_amount =
          Math.ceil(
            (1000000 * loanDurationRate.penalty_rate) /
              100 /
              formData.value.round_range,
          ) * formData.value.round_range;
      } else {
        formData.value.penalty_amount =
          Math.ceil(
            (formData.value.loan_amount * loanDurationRate.penalty_rate) /
              100 /
              formData.value.round_range,
          ) * formData.value.round_range;
      }
    } else if (loanDurationRate.penalty_amount != 0) {
      formData.value.penalty_amount = loanDurationRate.penalty_amount;
    }

    if (
      loanDurationRate.operation_fee_rate > 0 &&
      formData.value.loan_amount > 0
    ) {
      if (formData.value.loan_amount < 1000000) {
        formData.value.operation_fee_amount =
          Math.ceil(
            (1000000 * loanDurationRate.operation_fee_rate) /
              100 /
              formData.value.round_range,
          ) * formData.value.round_range;
      } else {
        formData.value.operation_fee_amount =
          Math.ceil(
            (formData.value.loan_amount * loanDurationRate.operation_fee_rate) /
              100 /
              formData.value.round_range,
          ) * formData.value.round_range;
      }
    } else if (
      loanDurationRate.operation_fee_amount > 0 &&
      formData.value.loan_amount > 0
    ) {
      formData.value.operation_fee_amount =
        loanDurationRate.operation_fee_amount;
    } else {
      formData.value.operation_fee_amount = 0;
    }

    const perScheduleAmount =
      formData.value.operation_fee_amount +
      (formData.value.interest_amount +
        parseFloat(formData.value.loan_amount)) /
        loanDurationRate.duration;

    formData.value.per_schedule_amount =
      Math.ceil(perScheduleAmount / formData.value.round_range) *
      formData.value.round_range;

    formData.value.insurance_amount =
      formData.value.loan_amount > 0
        ? formData.value.loan_amount < 1000000
          ? Math.ceil(
              loanDurationRate.insurance_amount / formData.value.round_range,
            ) * formData.value.round_range
          : Math.ceil(
              (formData.value.loan_amount * loanDurationRate.insurance_rate) /
                100 /
                formData.value.round_range,
            ) * formData.value.round_range
        : 0;

    formData.value.interest_rate = loanDurationRate.interest_rate;

    if (formData.value.is_pay_for_holidays) {
      formData.value.pay_for_holidays_amount =
        parseFloat(formData.value.per_schedule_amount) *
        parseFloat(openReceiveDaysLength.value);
    }
  } else {
    formData.value.loan_fee_amount = 0;

    formData.value.operation_fee_amount = 0;

    formData.value.deposit_amount = 0;

    formData.value.penalty_amount = 0;

    formData.value.per_schedule_amount = 0;

    formData.value.insurance_amount = 0;

    formData.value.interest_amount = 0;
    formData.value.interest_rate = 0;
  }
};

const manualCalculateAmount = () => {
  const interestRate = formData.value.interest_rate || 0;
  const loanFeeRate = formData.value.loan_fee_rate || 0;
  const depositRate = formData.value.deposit_rate || 0;
  const penaltyRate = formData.value.penalty_rate || 0;
  const penaltyAmount = formData.value.penalty_amount || 0;
  const loanDuration = formData.value.loan_duration || 0;

  formData.value.interest_amount =
    Math.ceil(
      (formData.value.loan_amount * (interestRate / 100 || 0)) /
        formData.value.round_range,
    ) * formData.value.round_range;

  formData.value.loan_fee_amount =
    Math.ceil(
      (formData.value.loan_amount * (loanFeeRate / 100 || 0)) /
        formData.value.round_range,
    ) * formData.value.round_range;

  formData.value.deposit_amount =
    Math.ceil(
      (formData.value.loan_amount * depositRate) /
        100 /
        formData.value.round_range,
    ) * formData.value.round_range;

  if (penaltyRate != 0) {
    formData.value.penalty_amount =
      Math.ceil(
        (formData.value.loan_amount * penaltyRate) /
          100 /
          formData.value.round_range,
      ) * formData.value.round_range;
  }

  const perScheduleAmount =
    (formData.value.interest_amount + parseFloat(formData.value.loan_amount)) /
    loanDuration;

  formData.value.per_schedule_amount =
    Math.ceil(perScheduleAmount / formData.value.round_range) *
    formData.value.round_range;
};

watch(
  () => formData.value.loan_amount,
  (newVal) => {
    calculateAmount();
  },
);

watch(
  () => formData.value.loan_duration_id,
  (newVal) => {
    if (props.loanMode == 1) {
      const loanDurationRate = loanDurations.value.find((v) => v.id == newVal);

      if (loanDurationRate?.round_range) {
        formData.value.round_range = loanDurationRate?.round_range;
      }

      calculateAmount();
    } else {
      manualCalculateAmount();
    }
  },
);

watch(
  () => formData.value.round_range,
  (newVal) => {
    if (props.loanMode == 1) {
      calculateAmount();
    } else {
      manualCalculateAmount();
    }
  },
);

onMounted(async () => {
  const [
    dataCurrencies,
    dataLoanDurations,
    dataLoanTerms,
    dataLoanRepayments,
    dataLoanSettings,
    dataReceiveDays,
  ] = await Promise.all([
    getCurrencies(),
    getLoanDurations(),
    getLoanTerms(),
    getLoanRepayments(),
    getLoanSettings(),
    getReceiveDays(),
  ]);

  currencies.value = dataCurrencies;
  loanDurations.value = dataLoanDurations;
  loanTerms.value = dataLoanTerms;
  loanRepayments.value = dataLoanRepayments;
  loanSettings.value = dataLoanSettings;
  receiveDays.value = dataReceiveDays;
  setDefault();

  getNewData();
});

const setDefault = async () => {
  selectedCheckbox.value = ["is_pay_for_holidays"];
  // Auto-select first loan term if not set
  if (!formData.value.loan_term_id && loanTerms.value.length > 0) {
    formData.value.loan_term_id = loanTerms.value[0]?.id || null;
  }

  // Filter durations after setting loan_term_id
  selectedDurations.value = loanDurations.value.filter(
    (v) => v.loan_term_id === formData.value.loan_term_id,
  );

  // Auto-select first loan duration
  if (!formData.value.loan_duration_id && selectedDurations.value.length > 0) {
    formData.value.loan_duration_id = selectedDurations.value[0]?.id || null;
  }

  // Auto-select first currency
  if (!formData.value.currency_id && currencies.value.length > 0) {
    formData.value.currency_id = currencies.value[0]?.id || null;
  }

  if (!formData.value.loan_repayment_id && loanRepayments.value.length > 0) {
    formData.value.loan_repayment_id = loanRepayments.value[0]?.id || null;
  }

  const res = await api.post("loans-get-loan-end-date", formData.value);
  if (res.data.status) {
    formData.value.loan_end_data = res.data.data;

    openReceiveDaysLength.value = receiveDays.value.filter(
      (v) =>
        new Date(formData.value.approval_date) <= new Date(v.date) &&
        new Date(v.date) < new Date(res.data.data),
    ).length;
  }
};

watch(
  () => [
    formData.value.loan_amount,
    formData.value.interest_rate,
    formData.value.insurance_amount,
    formData.value.deposit_rate,
    formData.value.loan_duration,
    formData.value.loan_fee_rate,
    formData.value.penalty_rate,
  ],
  (newVal) => {
    if (props.loanMode == 2) {
      manualCalculateAmount();
    }

    if (formData.value.is_pay_for_holidays) {
      formData.value.pay_for_holidays_amount =
        parseFloat(formData.value.per_schedule_amount) *
        parseFloat(openReceiveDaysLength.value);
    }
  },
);

watch(
  () => props.selectedClient,
  (newVal) => {
    formData.value.loan_duration_id = null;
    if (
      !formData.value.loan_duration_id &&
      selectedDurations.value.length > 0
    ) {
      formData.value.loan_duration_id = selectedDurations.value[0]?.id || null;
    }
  },
);

watch(
  () => props.loanMode,
  (newVal) => {
    formData.value.loan_mode = newVal;
  },
);

const getNewData = async () => {
  imageErrors.value.clear(); // Clear image errors on branch change
  const [dataApprover, dataCo, dataApproveRanks] = await Promise.all([
    getApprover(),
    getCo(),
    getApproveRanks(),
  ]);
  approver.value = [];
  checker.value = [];

  allApprover.value = dataApprover;

  approveRanks.value = dataApproveRanks;
  co.value = dataCo;

  formData.value.co_id = null;

  if (dataApprover.length == 1) {
    formData.value.approve_by = dataApprover[0]?.id || null;
    formData.value.check_by = dataApprover[0]?.id || null;
  } else {
    formData.value.approve_by = null;
    formData.value.check_by = null;
  }
};

watch(
  () => useSettingStore().branch_id,
  async () => {
    getNewData();
  },
);

const setCheckerApprover = () => {
  const loanAmount = parseFloat(formData.value.loan_amount ?? 0);
  console.log(loanAmount);

  const approveRank = approveRanks.value.filter(
    (v) =>
      parseFloat(v.min_amount) <= loanAmount &&
      parseFloat(v.max_amount) >= loanAmount,
  );

  const levelApprove = approveRank[0]?.level_approve;
  const levelCheck = approveRank[0]?.level_check;

  if (loanAmount <= 0) {
    approver.value = [];
    checker.value = [];
  } else {
    approver.value = allApprover.value.filter(
      (v) => parseFloat(v.position_level) >= parseFloat(levelApprove),
    );

    checker.value = allApprover.value.filter(
      (v) => parseFloat(v.position_level) >= parseFloat(levelCheck),
    );

    const defaultCheckBy = checker?.value?.find(
      (v) => v.user_id == auth()?.user?.under_user_id, // <--- HERE
    )?.user_id;

    const defaultApproveBy = approver?.value?.find(
      (v) => v.user_id == auth()?.user?.under_user_id, // <--- AND HERE
    )?.user_id;

    formData.value.check_by = defaultCheckBy || checker?.value[0]?.user_id;

    formData.value.approve_by = defaultApproveBy || approver?.value[0]?.user_id;
  }
};

watch(
  () => formData.value.loan_amount,
  (newValue, oldValue) => {
    if (newValue) {
      formData.value.check_by = null;
      formData.value.approve_by = null;

      approver.value = [];
      checker.value = [];

      setCheckerApprover();
    }
  },
);
const { t } = useI18n();

const checkboxContent = computed(() => {
  const getSetting = (key) =>
    loanSettings.value.find((s) => s.key === key)?.value;

  const quickLoanServiceAmount = selectedDurations.value.find(
    (s) => s.id == formData.value.loan_duration_id,
  )?.quick_loan_service_amount;

  const options = [];
  if (getSetting("is_quick_loan_service")) {
    options.push({
      title: t("Quick Loan Service"),
      desc: `សេវាបង្វិលទុនរហ័ស គិតសេវា ${formatCurrency(quickLoanServiceAmount)}`,
      value: "is_quick_loan_service",
      color: "warning",
    });
  }
  options.push({
    title: t("Loan Restructure"),
    desc: "រៀបចំកម្ចីឡើងវិញ ដោយគិតសេវាដូចស្នើថ្មី",
    value: "is_restructure",
    color: "error",
  });
  if (openReceiveDaysLength.value > 0) {
    options.push({
      title: t("Pay for holidays"),
      desc: "ធ្វើការបង់ប្រាក់ទុកសម្រាបថ្ងៃសម្រាក",
      value: "is_pay_for_holidays",
      color: "success",
    });
  }

  return options;
});

watch(selectedCheckbox, async (newValue, oldValue) => {
  formData.value.is_restructure = newValue.includes("is_restructure");
  const isQuickLoanSerive = newValue.includes("is_quick_loan_service");
  formData.value.is_quick_loan_service = isQuickLoanSerive;

  if (isQuickLoanSerive) {
    const quickLoanServiceAmount = selectedDurations.value.find(
      (s) => s.id == formData.value.loan_duration_id,
    )?.quick_loan_service_amount;

    formData.value.quick_loan_service_amount = quickLoanServiceAmount;
  }

  if (
    oldValue.includes("is_pay_for_holidays") &&
    !newValue.includes("is_pay_for_holidays")
  ) {
    const confirmed = await showDialog({
      title: t(
        "If you uncheck this it well not able to auto pay for holidays.",
      ),
      icon: "warning",
      confirmColor: "error",
      confirmText: "Confirm",
    });
    if (!confirmed) {
      selectedCheckbox.value = [...newValue, "is_pay_for_holidays"];
      return;
    }
  }
  formData.value.is_pay_for_holidays = newValue.includes("is_pay_for_holidays");

  if (formData.value.is_pay_for_holidays) {
    formData.value.pay_for_holidays_amount =
      parseFloat(formData.value.per_schedule_amount) *
      parseFloat(openReceiveDaysLength.value);
  }
});
</script>

<template>
  <VRow>
    <!-- Borrower -->
    <AppLabel
      title="Loan Information"
      icon="tabler-cash"
      :is-border-top="false"
    />
    <VCol cols="12">
      <CustomCheckboxes
        v-model:selected-checkbox="selectedCheckbox"
        :checkbox-content="checkboxContent"
        :grid-column="{ sm: '4', cols: '12' }"
      />
    </VCol>
    <!-- <VCol cols="12" lg="3" md="4" sm="6">
      <AppSelect
        v-model="formData.loan_term_id"
        label="Loan Term"
        :items="loanTerms"
        item-title="name_kh"
        item-value="id"
      />
    </VCol> -->
    <VCol cols="12" lg="3" md="4" sm="6">
      <AppSelect
        v-model="formData.loan_duration_id"
        label="Loan Duration"
        :items="selectedDurations"
        item-title="name"
        item-value="id"
      >
        <template #item="{ props, item }">
          <VListItem
            v-bind="props"
            :title="item?.raw?.name"
            :disabled="
              selectedClient?.loan?.closed_loan_type != 'overdue' &&
              item?.raw?.is_overdue &&
              !formData.is_restructure
            "
            :class="{
              'text-error':
                selectedClient?.loan?.closed_loan_type != 'overdue' &&
                item?.raw?.is_overdue &&
                !formData.is_restructure,
            }"
          />
        </template>
      </AppSelect>
    </VCol>

    <VCol cols="12" lg="3" md="4" sm="6">
      <AppTextField
        v-model="formData.loan_amount"
        format-currency
        label="Loan Amount"
        autocomplete="off"
      />
    </VCol>
    <VCol
      cols="12"
      lg="3"
      md="4"
      sm="6"
      v-if="auth()?.user?.position?.is_member == false"
    >
      <AppAutocomplete
        v-model="formData.co_id"
        label="Credit Officer"
        :placeholder="$t('Select Credit Officer')"
        prepend-inner-icon="tabler-user"
        :items="co"
        item-title="name_kh"
        item-value="id"
        :readonly="auth().user?.role?.name == 'credit-officer'"
        autocomplete="off"
        :rules="[requiredValidator]"
      >
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

    <VCol cols="12" lg="3" md="4" sm="6">
      <AppAutocomplete
        v-model="formData.approve_by"
        prepend-inner-icon="tabler-user"
        :items="approver"
        :item-title="
          (item) => {
            return `${item.name_kh} (${item.position_abbr})`;
          }
        "
        item-value="user_id"
        label="Approver"
        :placeholder="$t('Select Approver')"
        :rules="[requiredValidator]"
        autocomplete="off"
      >
        <template #item="{ props, item }">
          <VListItem
            v-bind="props"
            :title="`${item?.raw?.name_kh} (${item?.raw?.position_abbr})`"
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
  </VRow>

  <VRow v-if="parseFloat(formData.per_schedule_amount) > 0">
    <AppLabel title="Other Fee (Automatic)" icon="tabler-cash" />

    <!-- Auto Calculate -->
    <VCol cols="12" lg="3" md="6" sm="6">
      <AppTextField
        v-model="formData.loan_fee_amount"
        format-currency
        label="Loan Fee Amount"
        readonly
        variant="underlined"
        disabled
      />
    </VCol>
    <VCol
      cols="12"
      lg="3"
      md="6"
      sm="6"
      v-if="parseFloat(formData.deposit_amount) > 0"
    >
      <AppTextField
        v-model="formData.deposit_amount"
        format-currency
        label="Deposit Amount"
        readonly
        variant="underlined"
        disabled
      />
    </VCol>

    <VCol cols="12" lg="3" md="6" sm="6">
      <AppTextField
        v-model="formData.insurance_amount"
        format-currency
        label="Insurance Amount"
        readonly
        variant="underlined"
        disabled
      />
    </VCol>

    <VCol
      cols="12"
      lg="3"
      md="6"
      sm="6"
      v-if="parseFloat(formData.operation_fee_amount) > 0"
    >
      <AppTextField
        v-model="formData.operation_fee_amount"
        format-currency
        label="Operation Fee Amount"
        readonly
        variant="underlined"
        disabled
      />
    </VCol>
    <VCol cols="12" lg="3" md="6" sm="6" v-if="formData.loan_repayment_id == 1">
      <AppTextField
        v-model="formData.per_schedule_amount"
        format-currency
        label="Per Schedule Amount"
        readonly
        variant="underlined"
        disabled
      />
    </VCol>
  </VRow>
</template>
