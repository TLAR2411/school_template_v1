<script setup>
import TermPeriodDetail from "@/views/school/TermPeriod/TermPeriodDetail.vue";
definePage({
  meta: {
    title: "Term Period Detail",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    // permissions: "positions:view-page",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <TermPeriodDetail />
</template>
