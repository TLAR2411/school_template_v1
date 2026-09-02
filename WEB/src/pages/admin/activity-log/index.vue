<script setup>
definePage({
  meta: {
    title: "Activity Log",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-activity-log",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
import ActivityLogsList from "@/views/admin/activity-logs/ActivityLogsList.vue";
</script>

<template>
  <ActivityLogsList />
</template>
