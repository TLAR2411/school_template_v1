<script setup>
import { onMounted } from "vue";
import { useRouter } from "vue-router";
import { auth } from "@/utils/auth";
import SchoolDashboardOverview from "@/views/school/Dashboard/SchoolDashboardOverview.vue";
import AttendanceReport from "@/views/school/Attendance/AttendanceReport.vue";

definePage({
  meta: {
    title: "Dashboards",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
  },
});

const router = useRouter();

onMounted(() => {
  if (auth()?.user?.role?.name === "teacher") {
    router.replace({ name: "school-class-grid" });
  }
});
</script>

<template>
  <div class="school-dashboard">
    <SchoolDashboardOverview />

    <!-- Attendance overview for today -->
    <AttendanceReport
      variant="dashboard"
      :is-back="false"
      :auto-load="true"
    />
  </div>
</template>
