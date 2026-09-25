<script setup>
import AttendanceReport from "@/views/school/Attendance/AttendanceReport.vue";

definePage({
  meta: {
    title: "Attendance Report",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-attendance",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <AttendanceReport />
</template>
