<script setup>
import formatCurrency from "@/utils/formater/formatCurrency";
import formatDate from "@/utils/formater/formatDate";
import { useI18n } from "vue-i18n";
import formatNoneZero from "@/utils/formater/formatNoneZero";
import { useRouter } from "vue-router";
import { useDisplay } from "vuetify";

const props = defineProps({
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
const { mdAndUp } = useDisplay();
const router = useRouter();
const { t } = useI18n();
const headers = [
  { title: t("No"), key: "loan_cycle", align: "center", visible: true },
  // { title: t("Code"), key: "code" },
  { title: t("Branch"), key: "branch_name", visible: true },
  { title: t("Credit Officer"), key: "co_name", visible: true },
  {
    title: t("Approve Date"),
    key: "approval_date",
    value: (item) => {
      return formatDate(item.approval_date);
    },
    align: "center",
    visible: true,
  },
  {
    title: t("End Date"),
    key: "loan_end_date",
    value: (item) => {
      return formatDate(item.loan_end_date);
    },
    align: "center",
    visible: true,
  },
  {
    title: t("Closed Date"),
    key: "loan_closed_date",
    value: (item) => {
      if (item.loan_closed_date) {
        return formatDate(item.loan_closed_date);
      } else {
        return "-";
      }
    },
    align: "center",
    visible: true,
  },
  // {
  //   title: t("Duration"),
  //   key: "loan_duration",
  //   value: (item) => {
  //     return `${item.loan_duration} ${item.loan_term}`;
  //   },
  //   align: "center",
  // },
  {
    title: t("Loan Amount"),
    key: "loan_amount",
    value: (item) => {
      return `${formatCurrency(item.loan_amount)} ${item.currency}`;
    },
    align: "end",
    visible: true,
  },
  { title: t("Type"), key: "loan_type", align: "center", visible: true },
  {
    title: t("#Paid"),
    key: "paid_days",
    value: (item) => {
      return formatNoneZero(item.paid_days);
    },
    align: "center",
    visible: true,
  },
  {
    title: t("#Late"),
    key: "late_days",
    value: (item) => {
      return formatNoneZero(item.late_days);
    },
    align: "center",
    visible: true,
  },
  {
    title: t("#Over"),
    key: "overdue_days",
    value: (item) => {
      return formatNoneZero(item.overdue_days);
    },
    align: "center",
    visible: true,
  },
  { title: t("Status"), key: "status", align: "center", visible: true },
  {
    title: t("Action"),
    key: "actions",
    align: "center",
    visible: true,
    fixed: mdAndUp.value,
  },
];

const onView = (item) => {
  router.push({ name: "loan-schedules", query: { id: item.id } });
};
</script>

<template>
  <AppCardTable
    title="Loan History"
    title-icon="tabler-cash"
    :is-back="false"
    api-url="loans-client-list"
    :api-data="{ client_id: itemId }"
    :headers="headers"
    :isMoreAction="false"
    :isFullHeight="false"
    is-schedule
    btn-schedule
    :limit="5"
    @onSchedule="onView"
  >
    <template v-slot:item.loan_type="{ item }">
      <template v-if="item.status == 'approved'">
        <VChip color="success" size="small" v-if="item.loan_type == 'current'">
          {{ $t("Current Loan") }}
        </VChip>
        <VChip color="warning" size="small" v-if="item.loan_type == 'late'">
          {{ $t("Late Loan") }}
        </VChip>
        <VChip color="error" size="small" v-if="item.loan_type == 'overdue'">
          {{ $t("Overdue Loan") }}
        </VChip>
      </template>
      <template v-else>
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
    </template>

    <template v-slot:item.status="{ item }">
      <VChip color="warning" size="small" v-if="item.status == 'pending'">
        {{ $t("Pending") }}
      </VChip>
      <VChip color="success" size="small" v-if="item.status == 'approved'">
        {{ $t("Opening") }}
      </VChip>
      <VChip color="error" size="small" v-if="item.status == 'closed'">
        {{ $t("Closed") }}
      </VChip>
    </template>
  </AppCardTable>
</template>
