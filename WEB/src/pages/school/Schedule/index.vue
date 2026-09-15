<script setup>
import ScheduleList from "@/views/school/Schedule/ScheduleList.vue";

definePage({
  meta: {
    title: "Schedule",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    // permissions: "positions:view-page",
    // layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <ScheduleList />
</template>
