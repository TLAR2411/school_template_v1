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
  <!-- Month only — must pick grade, class, month, subject -->
  <AttendanceReport variant="report" />
</template>
