<script setup>
import formatCurrency from "@/utils/formater/formatCurrency";
import formatDate from "@/utils/formater/formatDate";
import { useI18n } from "vue-i18n";
import formatNoneZero from "@/utils/formater/formatNoneZero";
import { useRouter } from "vue-router";

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

const router = useRouter();
const { t } = useI18n();
const headers = [
  {
    title: t("Effective Date"),
    key: "effective_date",
    value: (item) => {
      return formatDate(item.effective_date);
    },
    align: "start",
    visible: true,
  },
  {
    title: t("Employee"),
    key: "employee.name_kh",
    exportValue: (item) => item.employee?.name_kh,
    visible: true,
  },

  {
    title: t("Branch"),
    key: "branch_id",
    value: (item) => {
      return item.branch.name_kh;
    },
    visible: true,
  },
  {
    title: t("Department"),
    key: "department.name_kh",
    visible: true,
  },
  {
    title: t("Position"),
    key: "position.name_kh",
    visible: true,
  },

  {
    title: t("Base Salary"),
    key: "salary.base_salary",
    value: (item) => {
      return formatCurrency(item.base_salary || 0);
    },
    align: "end",
    visible: true,
  },
  {
    title: t("Gasoline Fee"),
    key: "salary.gasoline_fee",
    value: (item) => {
      return formatCurrency(item.gasoline_fee || 0);
    },
    align: "end",
    visible: true,
  },
  {
    title: t("Phone Card Fee"),
    key: "salary.phone_card_fee",
    value: (item) => {
      return formatCurrency(item.phone_card_fee || 0);
    },
    align: "end",
    visible: true,
  },
  {
    title: t("Position Fee"),
    key: "salary.position_fee",
    value: (item) => {
      return formatCurrency(item.position_fee || 0);
    },
    align: "end",
    visible: true,
  },
  {
    title: t("Net Salary"),
    key: "salary.net_salary",
    value: (item) => {
      return formatCurrency(item.net_salary || 0);
    },
    align: "end",
    visible: true,
  },
];

const onView = (item) => {
  router.push({ name: "loan-schedules", query: { id: item.id } });
};
</script>

<template>
  <AppCardTable
    title="History"
    title-icon="tabler-history"
    :is-back="false"
    api-url="employees-movements"
    :api-data="{ id: itemId }"
    :headers="headers"
    :isPagination="false"
    :isMoreAction="false"
    :isFullHeight="false"
    :limit="-1"
  >
  </AppCardTable>
</template>
