<script setup>
import { ref, onMounted, computed, watch } from "vue";
import { api } from "@/utils/api";
import { useDisplay, useTheme } from "vuetify";
import formatNoneZero from "@/utils/formater/formatNoneZero";
import { useSettingStore } from "@/stores/settingStore";
import { set } from "@vueuse/core";

const vuetifyTheme = useTheme();
const { smAndDown } = useDisplay();

const settingStore = useSettingStore();
const itemData = ref({});
const currentTheme = vuetifyTheme.current.value.colors;
const headingColor =
  "rgba(var(--v-theme-on-background), var(--v-high-emphasis-opacity))";
const labelColor =
  "rgba(var(--v-theme-on-background), var(--v-medium-emphasis-opacity))";

const series = ref([25, 25, 50]);
const actualValues = ref([0, 0, 0]);
const principals = ref([0, 0, 0]);
const counts = ref([0, 0, 0]);

const fontFamily = "'Calibri', 'notosans', sans-serif";

// Computed property for chart options to ensure reactivity
const optionConfigs = computed(() => ({
  labels: ["កម្ចីល្អ", "កម្ចីយឺត", "កម្ចីខូច"],
  colors: [
    currentTheme.success, // Current Loans - Green
    currentTheme.warning, // Late Loans - Orange
    currentTheme.error, // Overdue Loans - Red
  ],
  stroke: { width: 1.5 },
  dataLabels: {
    enabled: true,
    textAnchor: "middle", // 'start', 'middle', 'end'
    distributed: false,
    offsetX: -100,
    offsetY: -100,
    style: {
      colors: ["white"], // Text color
      fontSize: "13px", // Customize font size
      fontFamily: "Arial", // Customize font family
    },
    dropShadow: {
      enabled: true, // Turn on shadow
      top: 1, // Shadow offset (vertical)
      left: 1, // Shadow offset (horizontal)
      blur: 3, // Shadow blur radius
      opacity: 0.5, // Shadow opacity
      color: "#000000", // Shadow color (black in this case)
    },
    formatter(val) {
      return `${Math.round(Number.parseFloat(val).toFixed(2))}%`;
    },
  },
  legend: {
    show: true,
    position: "bottom",
    offsetY: 10,
    markers: {
      width: 8,
      height: 8,
      offsetX: -3,
    },
    itemMargin: {
      horizontal: 15,
      vertical: 5,
    },
    fontSize: "13px",
    fontWeight: 400,
    fontFamily: fontFamily,
    labels: {
      colors: headingColor,
      useSeriesColors: false,
    },
    formatter: function (seriesName, opts) {
      const principal = principals.value[opts.seriesIndex];
      const count = counts.value[opts.seriesIndex];
      const percentage =
        (opts.w.globals.series[opts.seriesIndex] /
          opts.w.globals.seriesTotals.reduce((a, b) => a + b)) *
        100;
      return `${seriesName}: ${principal > 0 ? formatNoneZero(principal) : `គ្មាន`} ${count > 0 ? `(${count})` : ``}`;
    },
  },
  // theme: {
  //   monochrome: {
  //     enabled: true,
  //   },
  // },
  tooltip: {
    style: {
      fontFamily: fontFamily,
    },
    y: {
      formatter: function (val, { seriesIndex }) {
        const percentage = val.toFixed(2);
        const actualValue = actualValues.value[seriesIndex];
        return `${actualValue} (${percentage}%)`;
      },
    },
  },
  grid: { padding: { top: 15 } },
  plotOptions: {
    pie: {
      donut: {
        size: "75%",
        labels: {
          show: false,
          value: {
            fontSize: "24px",
            color: "#FFFFFF",
            fontWeight: 500,
            fontFamily: fontFamily,
            offsetY: -20,
            formatter(val) {
              return `${val}%`;
            },
          },
          name: { offsetY: 20 },
          total: {
            show: false,
            fontSize: "0.9375rem",
            fontWeight: 400,
            fontFamily: fontFamily,
            label: "កម្ចីទាំងអស់",
            color: "#FFFFFF",
            formatter() {
              return "100%";
            },
          },
        },
      },
      dataLabels: {
        offset: -10, // Try: -50 (far inside), 0 (default), 30 (outside)
        minAngleToShowLabel: 10,
      },
    },
  },
  responsive: [
    {
      breakpoint: 350,
      options: { chart: { height: 300 } },
    },
  ],
}));

onMounted(async () => {
  getData();
});

const getData = async () => {
  const res = await api.post("loans-dashboard-all-loans");
  if (res.data.status) {
    itemData.value = res.data.data;
    series.value = [
      itemData.value.current_percentage,
      itemData.value.late_percentage,
      itemData.value.overdue_percentage,
    ];
    // Update actual values from API response
    actualValues.value = [
      itemData.value.current_count || 0,
      itemData.value.late_count || 0,
      itemData.value.overdue_count || 0,
    ];

    principals.value = [
      itemData.value.current_balance || 0,
      itemData.value.late_balance || 0,
      itemData.value.overdue_balance || 0,
    ];

    counts.value = [
      itemData.value.current_count || 0,
      itemData.value.late_count || 0,
      itemData.value.overdue_count || 0,
    ];
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
  <VCard>
    <VCol>
      <VCardTitle>{{ $t("Loans Overview") }} </VCardTitle>
    </VCol>
    <VCardText class="pt-0">
      <VueApexCharts
        type="pie"
        :height="!smAndDown ? 377 : 300"
        :options="optionConfigs"
        :series="series"
      />

      <!-- <div class="custom-value-legend-container">
        <div
          v-for="(principal, index) in principals"
          :key="index"
          class="legend-item"
        >
          <span
            class="legend-marker"
            :style="{
              'background-color': optionConfigs.colors[index],
            }"
          ></span>
          <span class="legend-text">
            {{ optionConfigs.labels[index] }}:
            {{ formatNoneZero(principal) }}
          </span>
        </div>
      </div> -->
    </VCardText>
  </VCard>
</template>
