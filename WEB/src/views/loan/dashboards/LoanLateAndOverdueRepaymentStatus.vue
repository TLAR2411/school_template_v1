<script setup>
import { ref, onMounted, computed, watch } from "vue";
import { api } from "@/utils/api";
import { useTheme } from "vuetify";
import formatNoneZero from "@/utils/formater/formatNoneZero";
import { useSettingStore } from "@/stores/settingStore";

const vuetifyTheme = useTheme();
const settingStore = useSettingStore();
const itemData = ref({});

// Make theme reactive
const currentTheme = computed(() => vuetifyTheme.current.value.colors);
const headingColor =
  "rgba(var(--v-theme-on-background), var(--v-high-emphasis-opacity))";
const labelColor =
  "rgba(var(--v-theme-on-background), var(--v-medium-emphasis-opacity))";

const lateSeries = ref([0, 0, 0]);
const overdueSeries = ref([0, 0, 0]);
const latePrincipals = ref([0, 0, 0]);
const overduePrincipals = ref([0, 0, 0]);

const fontFamily = "'Calibri', 'notosans', sans-serif";

// Computed property for chart options to ensure reactivity
const lateOptionConfigs = computed(() => ({
  labels: ["សកម្ម", "ម្ដងម្កាល", "អសកម្ម"],
  colors: [
    "#FF9F43", // Late Loans - Orange
    "#FF9F43BF", // Late Loans - Orange
    "#FF9F4380", // Overdue Loans - Red
  ],
  stroke: { width: 1.5 },
  dataLabels: {
    enabled: false,
    style: {
      colors: ["#2F2B3D"], // Text color
      fontSize: "14px", // Customize font size
      fontWeight: "bold", // Customize font weight
      fontFamily: "Arial", // Customize font family
    },
    dropShadow: {
      enabled: false, // Turn on shadow
      top: 1, // Shadow offset (vertical)
      left: 1, // Shadow offset (horizontal)
      blur: 3, // Shadow blur radius
      opacity: 0.5, // Shadow opacity
      color: "#000000", // Shadow color (black in this case)
    },
    formatter(val) {
      return `${Math.round(Number.parseFloat(val))}%`;
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
      const principal = latePrincipals.value[opts.seriesIndex];
      const percentage =
        (opts.w.globals.series[opts.seriesIndex] /
          opts.w.globals.seriesTotals.reduce((a, b) => a + b)) *
        100;
      return `${seriesName}: ${principal > 0 ? formatNoneZero(principal) : ""} ${
        percentage > 0
          ? `(${Math.round(Number.parseFloat(percentage).toFixed(2))}%)`
          : ``
      }`;
    },
  },
  tooltip: {
    style: {
      fontFamily: fontFamily,
    },
    y: {
      formatter: function (val, { seriesIndex }) {
        const percentage = val.toFixed(2);
        return `${percentage}%`;
      },
    },
  },
  grid: { padding: { top: 15 } },
  plotOptions: {
    pie: {
      donut: {
        size: "75%",
        labels: {
          show: false, // Changed to true to show center labels
          value: {
            fontSize: "24px",
            color: headingColor, // Use heading color instead of white
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
            label: "សរុប",
            color: headingColor, // Use heading color instead of white
            formatter() {
              return "100%";
            },
          },
        },
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

const overdueOptionConfigs = computed(() => ({
  labels: ["សកម្ម", "ម្ដងម្កាល", "អសកម្ម"],
  colors: ["#FF4C51", "#FF4C51BF", "#FF4C5180"],
  stroke: { width: 1.5 },
  dataLabels: {
    enabled: false,
    style: {
      colors: ["#2F2B3D"], // Text color
      fontSize: "14px", // Customize font size
      // fontWeight: "bold", // Customize font weight
      fontFamily: "Arial", // Customize font family
    },
    dropShadow: {
      enabled: false, // Turn on shadow
      top: 1, // Shadow offset (vertical)
      left: 1, // Shadow offset (horizontal)
      blur: 3, // Shadow blur radius
      opacity: 0.5, // Shadow opacity
      color: "#000000", // Shadow color (black in this case)
    },
    formatter(val) {
      return `${Math.round(Number.parseFloat(val))}%`;
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
      const principal = overduePrincipals.value[opts.seriesIndex];
      const percentage =
        (opts.w.globals.series[opts.seriesIndex] /
          opts.w.globals.seriesTotals.reduce((a, b) => a + b)) *
        100;
      return `${seriesName}: ${principal > 0 ? formatNoneZero(principal) : "គ្មាន"} ${
        percentage > 0
          ? `(${Math.round(Number.parseFloat(percentage).toFixed(2))}%)`
          : ``
      }`;
    },
  },
  tooltip: {
    style: {
      fontFamily: fontFamily,
    },
    y: {
      formatter: function (val, { seriesIndex }) {
        const percentage = val.toFixed(2);
        return `${percentage}%`;
      },
    },
  },
  grid: { padding: { top: 15 } },
  plotOptions: {
    pie: {
      donut: {
        size: "75%",
        labels: {
          show: false, // Changed to true to show center labels
          value: {
            fontSize: "24px",
            color: headingColor, // Use heading color instead of white
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
            label: "សរុប",
            color: headingColor, // Use heading color instead of white
            formatter() {
              if (
                overdueSeries?.value[0] == 0 &&
                overdueSeries?.value[1] == 0 &&
                overdueSeries?.value[2] == 0
              ) {
                return "-";
              }
              return "100%";
            },
          },
        },
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
  try {
    const res = await api.post("loans-dashboard-late-overdue-repayment-status");
    if (res.data.status) {
      itemData.value = res.data.data;

      // Update series with percentages
      // series.value = [
      //   itemData.value.total_late_principal || 0,
      //   itemData.value.total_overdue_principal || 0,
      // ];
      const totalLate = [
        parseFloat(
          getPercentage(
            itemData.value.late_active_principal,
            itemData.value.total_late_principal,
          ),
        ),
        parseFloat(
          getPercentage(
            itemData.value.late_inactive_principal,
            itemData.value.total_late_principal,
          ),
        ),
        parseFloat(
          getPercentage(
            itemData.value.late_non_active_principal,
            itemData.value.total_late_principal,
          ),
        ),
      ];
      const totalOverdue = [
        parseFloat(
          getPercentage(
            itemData.value.overdue_active_principal,
            itemData.value.total_overdue_principal,
          ),
        ),
        parseFloat(
          getPercentage(
            itemData.value.overdue_inactive_principal,
            itemData.value.total_overdue_principal,
          ),
        ),
        parseFloat(
          getPercentage(
            itemData.value.overdue_non_active_principal,
            itemData.value.total_overdue_principal,
          ),
        ),
      ];

      lateSeries.value = totalLate;
      latePrincipals.value = [
        itemData.value.late_active_principal || 0,
        itemData.value.late_inactive_principal || 0,
        itemData.value.late_non_active_principal || 0,
      ];

      overdueSeries.value = totalOverdue;
      overduePrincipals.value = [
        itemData.value.overdue_active_principal || 0,
        itemData.value.overdue_inactive_principal || 0,
        itemData.value.overdue_non_active_principal || 0,
      ];
    }
  } catch (error) {
    console.error("Error fetching loan data:", error);
  }
};

const getPercentage = (part, total) => {
  if (part == 0 && total == 0) return "0.00";
  else if (total == 0) return "0.00";
  return ((part / total) * 100).toFixed(2);
};

watch(
  () => settingStore.branch_id,
  () => {
    getData();
  },
);
</script>

<template>
  <VCard>
    <VCol>
      <VCardTitle>{{ $t("Late and Overdue Status") }}</VCardTitle>
    </VCol>
    <VCardText class="pt-0">
      <VRow>
        <VCol cols="12" sm="6">
          <VueApexCharts
            type="donut"
            height="225"
            :options="lateOptionConfigs"
            :series="lateSeries"
          />
        </VCol>
        <VCol cols="12" sm="6">
          <VueApexCharts
            type="donut"
            height="225"
            :options="overdueOptionConfigs"
            :series="overdueSeries"
          />
        </VCol>
      </VRow>
    </VCardText>
  </VCard>
</template>

<style scoped>
.custom-value-legend-container {
  display: flex;
  justify-content: center;
  flex-wrap: wrap; /* Allows items to wrap on smaller screens */
  padding: 10px 0;
  font-family: "Calibri", "notosans", sans-serif;
  font-size: 13px;
  color: rgba(var(--v-theme-on-background), var(--v-medium-emphasis-opacity));
}
.legend-item {
  display: flex;
  align-items: center;
  margin: 0 15px;
  white-space: nowrap; /* Prevents text from wrapping */
}
.legend-marker {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  margin-right: 5px;
  display: inline-block;
}
</style>
