<script setup>
import CheckAttendance from "@/views/school/Attendance/CheckAttendance.vue";

definePage({
  meta: {
    title: "Attendance",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <CheckAttendance />
</template>
