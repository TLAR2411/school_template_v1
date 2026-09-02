<script setup>
import { useI18n } from "vue-i18n";
import AppCard from "@/components/AppCard.vue";
import AppTextField from "@/@core/components/app-form-elements/AppTextField.vue";
import AppDateTimePicker from "@/@core/components/app-form-elements/AppDateTimePicker.vue";
import { onMounted, ref, watch } from "vue";
import { api } from "@/utils/api";
import { getLoanDurations, getLoanTerms } from "@/services/dataService";
import calculateLoanAmount from "@/utils/loan/calculateLoanAmount";

const props = defineProps({
  itemData: {
    type: Number,
    required: false,
    default: () => ({}),
  },
  itemId: {
    type: Number,
    required: false,
    default: () => null,
  },
  loading: {
    type: Boolean,
    required: false,
    skipCheck: true,
    default: true,
  },
});

const itemId = ref(props.itemId);

const { t } = useI18n();
const itemData = ref([]);
const loanTerms = ref(null);
const loanDurations = ref([]);
const loanDuration = ref(null);
const loanDurationId = ref(null);

const emit = defineEmits(["update:itemData"]);

onMounted(async () => {
  try {
    const [dataLoanTerm, dataLoanDurations] = await Promise.all([
      getLoanTerms(),
      getLoanDurations(),
    ]);
    const res = await api.post("loans-show", { id: itemId?.value });
    if (res.data.status) {
      itemData.value = {
        ...res.data.data,
        approval_date: res.data.data.approval_date
          ? new Date(res.data.data.approval_date + "T00:00:00")
          : null,
        loan_start_date: res.data.data.loan_start_date
          ? new Date(res.data.data.loan_start_date + "T00:00:00")
          : null,
      };
      loanTerms.value = `${
        dataLoanTerm.find((v) => v.id == itemData?.value?.loan_term_id).name_kh
      }`;
      loanDurations.value = dataLoanDurations;
      if (parseFloat(itemData?.value?.loan_amount) > 1000000) {
        const insuranceRate =
          (parseFloat(itemData?.value?.insurance_amount) /
            parseFloat(itemData?.value?.loan_amount)) *
          100;

        loanDuration.value = `${
          dataLoanDurations.find(
            (v) =>
              v.loan_term_id == itemData?.value?.loan_term_id &&
              v.duration == itemData?.value?.loan_duration &&
              v.insurance_rate == insuranceRate,
          ).name
        }`;

        loanDurationId.value = dataLoanDurations.find(
          (v) =>
            v.loan_term_id == itemData?.value?.loan_term_id &&
            v.duration == itemData?.value?.loan_duration &&
            v.insurance_rate == insuranceRate,
        ).id;
      } else {
        loanDuration.value = `${
          dataLoanDurations.find(
            (v) =>
              v.loan_term_id == itemData?.value?.loan_term_id &&
              v.duration == itemData?.value?.loan_duration &&
              v.insurance_amount == itemData?.value?.insurance_amount,
          ).name
        }`;

        loanDurationId.value = dataLoanDurations.find(
          (v) =>
            v.loan_term_id == itemData?.value?.loan_term_id &&
            v.duration == itemData?.value?.loan_duration &&
            v.insurance_amount == itemData?.value?.insurance_amount,
        ).id;
      }
    }
  } catch (error) {}
});

watch(
  () => props.itemId,
  (newVal) => {
    itemId.value = newVal;
  },
);

watch(
  () => itemData.value,
  (newVal) => {
    emit("update:itemData", newVal);
  },
);

const calculateAmount = () => {
  const loanDurationRate = loanDurations.value.find(
    (v) => v.id == loanDurationId.value,
  );

  if (loanDurationRate?.round_range) {
    itemData.value.interest_amount =
      Math.ceil(
        ((itemData.value.loan_amount * loanDurationRate?.interest_rate) / 100 ||
          0) / itemData.value.round_range,
      ) * itemData.value.round_range;

    itemData.value.loan_fee_amount =
      Math.ceil(
        ((itemData.value.loan_amount * loanDurationRate?.loan_fee_rate) / 100 ||
          0) / itemData.value.round_range,
      ) * itemData.value.round_range;

    itemData.value.deposit_amount =
      Math.ceil(
        (itemData.value.loan_amount * loanDurationRate?.deposit_rate) /
          100 /
          itemData.value.round_range,
      ) * itemData.value.round_range;

    if (loanDurationRate.penalty_rate != 0) {
      if (itemData.value.loan_amount < 1000000) {
        itemData.value.penalty_amount =
          Math.ceil(
            (1000000 * loanDurationRate.penalty_rate) /
              100 /
              itemData.value.round_range,
          ) * itemData.value.round_range;
      } else {
        itemData.value.penalty_amount =
          Math.ceil(
            (itemData.value.loan_amount * loanDurationRate.penalty_rate) /
              100 /
              itemData.value.round_range,
          ) * itemData.value.round_range;
      }
    } else if (loanDurationRate.penalty_amount != 0) {
      itemData.value.penalty_amount = loanDurationRate.penalty_amount;
    }

    if (
      loanDurationRate.operation_fee_rate > 0 &&
      itemData.value.loan_amount > 0
    ) {
      if (itemData.value.loan_amount < 1000000) {
        itemData.value.operation_fee_amount =
          Math.ceil(
            (1000000 * loanDurationRate.operation_fee_rate) /
              100 /
              itemData.value.round_range,
          ) * itemData.value.round_range;
      } else {
        itemData.value.operation_fee_amount =
          Math.ceil(
            (itemData.value.loan_amount * loanDurationRate.operation_fee_rate) /
              100 /
              itemData.value.round_range,
          ) * itemData.value.round_range;
      }
    } else if (
      loanDurationRate.operation_fee_amount > 0 &&
      itemData.value.loan_amount > 0
    ) {
      itemData.value.operation_fee_amount =
        loanDurationRate.operation_fee_amount;
    } else {
      itemData.value.operation_fee_amount = 0;
    }

    const perScheduleAmount =
      itemData.value.operation_fee_amount +
      (itemData.value.interest_amount +
        parseFloat(itemData.value.loan_amount)) /
        loanDurationRate.duration;

    // console.log(`this is interest: ${itemData.value.interest_amount}`);
    // console.log(`this is loan amount: ${itemData.value.loan_amount}`);
    // console.log(`this is duration: ${loanDurationRate.duration}`);

    // console.log(perScheduleAmount);

    itemData.value.per_schedule_amount =
      Math.ceil(perScheduleAmount / itemData.value.round_range) *
      itemData.value.round_range;

    itemData.value.insurance_amount =
      itemData.value.loan_amount > 0
        ? itemData.value.loan_amount < 1000000
          ? Math.ceil(
              loanDurationRate.insurance_amount / itemData.value.round_range,
            ) * itemData.value.round_range
          : Math.ceil(
              (itemData.value.loan_amount * loanDurationRate.insurance_rate) /
                100 /
                itemData.value.round_range,
            ) * itemData.value.round_range
        : 0;
    itemData.value.interest_rate = loanDurationRate.interest_rate;
  } else {
    itemData.value.loan_fee_amount = 0;

    itemData.value.deposit_amount = 0;

    itemData.value.penalty_amount = 0;

    itemData.value.per_schedule_amount = 0;

    itemData.value.insurance_amount = 0;

    itemData.value.interest_amount = 0;
    itemData.value.interest_rate = 0;
  }
};

watch(
  () => itemData.value.loan_amount,
  (n, o) => {
    // console.log(n);

    if (n) {
      calculateAmount();
    }
  },
);

watch(
  () => itemData.value.approval_date,
  (newVal) => {
    // If the date is cleared, clear the start date
    if (!newVal) {
      itemData.value.start_date = "";
      return;
    }

    // Create a new Date object
    const date = new Date(newVal);

    // Add one day
    date.setDate(date.getDate() + 1);

    // Assign the new value using .value
    itemData.value.loan_start_date = date.toISOString().split("T")[0];

    // console.log(date.toISOString().split("T")[0]);
  },
);
</script>

<template>
  <AppCard
    title="New Loan Request"
    title-icon="tabler-cash-plus"
    :is-back="false"
    :loading="loading"
  >
    <VRow>
      <VCol cols="6" md="4" lg="3">
        <AppTextField
          v-model="loanTerms"
          label="Loan Term"
          variant="underlined"
          readonly
          disabled
        />
      </VCol>
      <VCol cols="6" md="4" lg="3">
        <AppTextField
          v-model="loanDuration"
          label="Loan Duration"
          variant="underlined"
          readonly
          disabled
        />
      </VCol>
      <VCol cols="12" md="4" lg="3">
        <AppTextField
          v-model="itemData.loan_amount"
          label="Loan Amount"
          variant="underlined"
          format-currency
          readonly
          disabled
        />
      </VCol>
    </VRow>

    <VRow>
      <VCol cols="6" lg="3" md="6" sm="6">
        <AppTextField
          v-model="itemData.loan_fee_amount"
          format-currency
          label="Loan Fee Amount"
          variant="underlined"
          readonly
          disabled
        />
      </VCol>
      <VCol
        cols="6"
        lg="3"
        md="6"
        sm="6"
        v-if="parseFloat(itemData.deposit_amount) > 0"
      >
        <AppTextField
          v-model="itemData.deposit_amount"
          format-currency
          label="Deposit Amount"
          variant="underlined"
          readonly
          disabled
        />
      </VCol>

      <VCol cols="6" lg="3" md="6" sm="6">
        <AppTextField
          v-model="itemData.insurance_amount"
          format-currency
          label="Insurance Amount"
          variant="underlined"
          readonly
          disabled
        />
      </VCol>

      <!-- <VCol cols="12" lg="3" md="6" sm="12">
      <AppTextField
        v-model="itemData.interest_amount"
        format-currency
        label="Interest Amount"
        readonly
      />
    </VCol> -->

      <!-- <VCol cols="12" lg="3" md="6" sm="6">
        <AppTextField
          v-model="itemData.penalty_amount"
          format-currency
          label="Penalty Amount"
          variant="underlined"
          readonly
          disabled
        />
      </VCol> -->

      <VCol
        cols="12"
        lg="3"
        md="6"
        sm="6"
        v-if="parseFloat(itemData.quick_loan_service_amount) > 0"
      >
        <AppTextField
          v-model="itemData.quick_loan_service_amount"
          format-currency
          label="Quick Loan Service"
          variant="underlined"
          readonly
          disabled
        />
      </VCol>
      <VCol
        cols="12"
        lg="3"
        md="6"
        sm="6"
        v-if="parseFloat(itemData.operation_fee_amount) > 0"
      >
        <AppTextField
          v-model="itemData.operation_fee_amount"
          format-currency
          label="Operation Fee Amount"
          readonly
          variant="underlined"
          disabled
        />
      </VCol>
      <VCol cols="6" lg="3" md="6" sm="6">
        <AppTextField
          v-model="itemData.per_schedule_amount"
          format-currency
          label="Per Schedule Amount"
          variant="underlined"
          readonly
          disabled
        />
      </VCol>
      <VCol cols="12" lg="3" md="6" sm="6">
        <AppDateTimePicker
          v-model="itemData.approval_date"
          format-currency
          label="Approve Date"
          variant="underlined"
          autocomplete="off"
          prepend-inner-icon="tabler-calendar-due"
        />
      </VCol>

      <!-- <VCol cols="6" lg="3" md="6" sm="6">
        <AppDateTimePicker
          v-model="itemData.loan_start_date"
          format-currency
          label="Start Date"
          variant="underlined"
          autocomplete="off"
          prepend-inner-icon="tabler-calendar-due"
        />
      </VCol> -->
    </VRow>
  </AppCard>
</template>
