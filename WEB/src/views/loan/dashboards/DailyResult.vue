<script setup>
import { api } from "@/utils/api";
import formatCurrency from "@/utils/formater/formatCurrency";
import { onMounted } from "vue";

const props = defineProps({
  itemData: {
    type: Object,
    required: false,
    default: () => ({}),
  },
  loading: { type: Boolean, required: false, default: false },
});
const items = ref({ ...props.itemData });

watch(
  () => props.itemData,
  (n, o) => {
    items.value = n;
  },
);

const logisticData = computed(() => [
  {
    icon: "tabler-file-check",
    color: "success",
    title: "Loan Current Collected",
    collected: formatCurrency(items.value.current_plan?.collected) || 0,
    total_plan: formatCurrency(items.value.current_plan?.total_plan) || 0,
    to_be_collect: formatCurrency(items.value.current_plan?.to_be_collect) || 0,
    percentage:
      formatCurrency(Math.round(items.value.current_plan?.percentage)) || 0,
    isHover: false,
    label: "ប្រាក់ប្រមូលបានពីកម្ចីល្អ",
  },
  {
    icon: "tabler-file-info",
    color: "warning",
    title: "Loan Late Collected",
    collected: formatCurrency(items.value.late_plan?.collected) || 0,
    total_plan: formatCurrency(items.value.late_plan?.total_plan) || 0,
    to_be_collect: formatCurrency(items.value.late_plan?.to_be_collect) || 0,
    percentage:
      formatCurrency(Math.round(items.value.late_plan?.percentage)) || 0,
    isHover: false,
    label: "ប្រាក់ប្រមូលបានពីកម្ចីយឺត",
  },
  {
    icon: "tabler-file-x",
    color: "error",
    title: "Loan Overdue Collected",
    collected: formatCurrency(items.value.overdue_plan?.collected) || 0,
    total_plan: formatCurrency(items.value.overdue_plan?.total_plan) || 0,
    to_be_collect: formatCurrency(items.value.overdue_plan?.to_be_collect) || 0,
    percentage:
      formatCurrency(Math.round(items.value.overdue_plan?.percentage)) || 0,
    isHover: false,
    label: "ប្រាក់ប្រមូលបានពីកម្ចីខូច",
  },
  {
    icon: "tabler-file-x",
    color: "primary",
    title: "Loan Overdue Collected",
    collected: formatCurrency(items.value.collected) || 0,
    total_plan: formatCurrency(items.value.total_plan) || 0,
    to_be_collect: formatCurrency(items.value.to_be_collect) || 0,
    percentage: formatCurrency(Math.round(items.value.percentage)) || 0,
    isHover: false,
    label: "សរុបរួមប្រាក់ប្រមូលបាន",
  },
  // {
  //   icon: "tabler-file-check",
  //   color: "info",
  //   title: "Total Collected",
  //   amount: formatCurrency(items.value.total_receive) || 0,
  //   value: formatCurrency(items.value.total_count) || 0,
  //   isHover: false,
  // },
  // {
  //   icon: "tabler-file-dollar",
  //   color: "primary",
  //   title: "Loan Disburse",
  //   amount: formatCurrency(items.value.disburse_receive) || 0,
  //   value: formatCurrency(items.value.disburse_count) || 0,
  //   isHover: false,
  // },
]);
</script>

<template>
  <VRow>
    <VCol
      v-for="(data, index) in logisticData"
      :key="index"
      cols="12"
      lg="3"
      md="6"
      sm="12"
    >
      <div>
        <VCard
          class="logistics-card-statistics cursor-pointer"
          :style="
            data.isHover
              ? `border-block-end-color: rgb(var(--v-theme-${data.color}))`
              : `border-block-end-color: rgba(var(--v-theme-${data.color}),0.38)`
          "
          @mouseenter="data.isHover = true"
          @mouseleave="data.isHover = false"
          :loading="loading"
        >
          <VCardText class="pa-0">
            <div class="d-flex flex-row w-100">
              <div
                style="width: 100%; color: white"
                class="pa-2 pt-4"
                :style="`background-color: rgb(var(--v-theme-${data.color}))`"
              >
                <div class="d-flex flex-column ml-4">
                  <div class="d-flex flex-row">
                    <VTooltip location="top">
                      <template #activator="{ props }">
                        <VIcon v-bind="props" icon="tabler-circle-letter-a" />
                        <span
                          class="text-h6 ml-2"
                          style="
                            font-size: 14px !important;
                            color: white;
                            font-weight: 900;
                          "
                        >
                          {{ data.total_plan }}
                        </span>
                      </template>
                      <span>សរុបប្រាក់ត្រូវប្រមូល</span>
                    </VTooltip>
                  </div>
                  <div class="d-flex flex-row mt-1">
                    <VTooltip location="top">
                      <template #activator="{ props }">
                        <VIcon v-bind="props" icon="tabler-hourglass-empty" />
                        <span
                          class="text-h6 ml-2"
                          style="font-size: 14px !important; color: white"
                        >
                          {{ data.to_be_collect }}
                        </span>
                      </template>
                      <span>ប្រាក់នៅសល់</span>
                    </VTooltip>
                  </div>
                </div>
              </div>
            </div>
            <VDivider />
            <div class="d-flex justify-space-between pa-2 ml-4 mb-2 mt-2">
              <div class="d-flex flex-row align-center justify-space-between">
                <VProgressCircular
                  v-model="data.percentage"
                  :size="52"
                  :color="data.color"
                  aria-label="Loading progress Daily Result"
                  role="progressbar"
                >
                  <span
                    class="text-body-1 text-high-emphasis font-weight-medium"
                    style="font-size: 13px !important"
                  >
                    {{ data.percentage }}%
                  </span>
                </VProgressCircular>
                <div class="d-flex flex-column ml-4">
                  <span class="text-h5" :class="`text-${data.color}`">
                    {{ data.collected }}
                  </span>
                  <span style="font-size: 14px"> {{ data.label }} </span>
                </div>
              </div>
            </div>
          </VCardText>
        </VCard>
      </div>
    </VCol>
  </VRow>
</template>

<style lang="scss" scoped>
@use "@core/scss/base/mixins" as mixins;

.logistics-card-statistics {
  border-block-end-style: solid;
  border-block-end-width: 2px;

  &:hover {
    border-block-end-width: 3px;
    margin-block-end: -1px;

    @include mixins.elevation(8);

    transition: all 0.1s ease-out;
  }
}

.skin--bordered {
  .logistics-card-statistics {
    border-block-end-width: 2px;

    &:hover {
      border-block-end-width: 3px;
      margin-block-end: -2px;
      transition: all 0.1s ease-out;
    }
  }
}
</style>
