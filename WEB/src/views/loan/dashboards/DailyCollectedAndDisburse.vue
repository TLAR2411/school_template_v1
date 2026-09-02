<script setup>
import formatNoneZero from "@/utils/formater/formatNoneZero";
import { useTheme } from "vuetify";
import { hexToRgb } from "@layouts/utils";
import { onMounted } from "vue";
import { api } from "@/utils/api";
import { useSettingStore } from "@/stores/settingStore";

const props = defineProps({
  itemData: {
    type: Object,
    required: false,
    default: () => ({}),
  },
});

const getPercentage = (part, total) => {
  if (part == 0 && total == 0) return "0.00";
  else if (total == 0) return "0.00";

  return ((part / total) * 100).toFixed(2);
};

const vuetifyTheme = useTheme();
const itemData2 = ref({});
const series = ref([0]);
const settingStore = useSettingStore();

const chartOptions = computed(() => {
  const currentTheme = vuetifyTheme.current.value.colors;
  const variableTheme = vuetifyTheme.current.value.variables;

  return {
    chart: {
      sparkline: { enabled: true },
      parentHeightOffset: 0,
      type: "radialBar",
    },
    colors: ["rgba(var(--v-theme-warning), 1)"],
    plotOptions: {
      radialBar: {
        offsetY: 0,
        startAngle: -90,
        endAngle: 90,
        hollow: { size: "65%" },
        track: {
          strokeWidth: "45%",
          background: "rgba(var(--v-track-bg))",
        },
        dataLabels: {
          name: { show: false },
          value: {
            fontSize: "24px",
            color: `rgba(${hexToRgb(currentTheme["on-background"])},${
              variableTheme["high-emphasis-opacity"]
            })`,
            fontWeight: 600,
            offsetY: -5,
          },
        },
      },
    },
    grid: {
      show: false,
      padding: { bottom: 5 },
    },
    stroke: { lineCap: "round" },
    labels: ["Progress"],
    responsive: [
      {
        breakpoint: 1442,
        options: {
          chart: { height: 140 },
          plotOptions: {
            radialBar: {
              dataLabels: { value: { fontSize: "24px" } },
              hollow: { size: "60%" },
            },
          },
        },
      },
      {
        breakpoint: 1370,
        options: { chart: { height: 120 } },
      },
      {
        breakpoint: 1280,
        options: {
          chart: { height: 200 },
          plotOptions: {
            radialBar: {
              dataLabels: { value: { fontSize: "18px" } },
              hollow: { size: "70%" },
            },
          },
        },
      },
      {
        breakpoint: 960,
        options: {
          chart: { height: 250 },
          plotOptions: {
            radialBar: {
              hollow: { size: "70%" },
              dataLabels: { value: { fontSize: "24px" } },
            },
          },
        },
      },
    ],
  };
});

onMounted(async () => {
  getData();
});

const getData = async () => {
  const res = await api.post("loans-dashboard-daily-plan-and-collected");
  if (res.data.status) {
    itemData2.value = res.data.data;
    series.value = res.data?.data?.percentage;
  }
};

watch(
  () => settingStore.branch_id,
  (n, o) => {
    getData();
  },
);
</script>

<template>
  <!-- <VCard>
    <VCol>
      <VCardTitle> លទ្ធផលធៀបនិង ផែនការ </VCardTitle>
      <VCardSubtitle>
        ចំនួនត្រូវប្រមូល
        {{ formatNoneZero(itemData2.plan_to_collect) }}</VCardSubtitle
      >
    </VCol>
    <VCardText class="pt-0">
      <VueApexCharts
        :options="chartOptions"
        :series="series"
        type="radialBar"
        :height="138"
      />

      <div class="text-sm text-center clamp-text text-disabled mt-3">
        ចំនួនប្រមូលបាន {{ formatNoneZero(itemData2.collected_count) }}
      </div>
    </VCardText>

    <VCol class="pb-1">
      <VCardTitle> {{ $t("Daily collected and disburse") }}</VCardTitle>
    </VCol>
    <VCardText class="pt-0">
      <VRow no-gutters>
        <VCol cols="5">
          <div class="py-2">
            <div class="d-flex align-center mb-3">
              <VAvatar
                color="info"
                variant="tonal"
                :size="24"
                rounded
                class="me-2"
              >
                <VIcon size="18" icon="tabler-cash" />
              </VAvatar>
              <span>{{ $t("Collected") }}</span>
            </div>
            <h5 class="text-h5">
              {{ formatNoneZero(itemData.total_receive) }}
            </h5>
            <div class="text-body-2 text-disabled">
              {{
                formatNoneZero(
                  getPercentage(
                    itemData.total_receive,
                    itemData.total_receive + itemData.disburse_receive
                  )
                )
              }}%
            </div>
          </div>
        </VCol>

        <VCol cols="2">
          <div class="d-flex flex-column align-center justify-center h-100">
            <VDivider vertical class="mx-auto" />

            <VAvatar
              size="24"
              color="rgba(var(--v-theme-on-surface), var(--v-hover-opacity))"
              class="my-2"
            >
              <div class="text-overline text-disabled">VS</div>
            </VAvatar>

            <VDivider vertical class="mx-auto" />
          </div>
        </VCol>

        <VCol cols="5" class="text-end">
          <div class="py-2">
            <div class="d-flex align-center justify-end mb-3">
              <span class="me-2">{{ $t("Loan Disburse") }}</span>
              <VAvatar color="primary" variant="tonal" :size="24" rounded>
                <VIcon size="18" icon="tabler-file-dollar" />
              </VAvatar>
            </div>
            <h5 class="text-h5">
              {{ formatNoneZero(itemData.disburse_receive) }}
            </h5>
            <div class="text-body-2 text-disabled">
              {{
                formatNoneZero(
                  getPercentage(
                    itemData.disburse_receive,
                    itemData.total_receive + itemData.disburse_receive
                  )
                )
              }}%
            </div>
          </div>
        </VCol>
      </VRow>

      <div class="mt-6">
        <VProgressLinear
          :model-value="
            getPercentage(
              itemData.total_receive,
              itemData.total_receive + itemData.disburse_receive
            )
          "
          color="#00CFE8"
          height="10"
          bg-color="primary"
          :rounded-bar="false"
          rounded
        />
      </div>
    </VCardText>
  </VCard> -->
</template>
