<script setup>
import TermPeriod from "@/views/school/TermPeriod/TermPeriod.vue";
definePage({
  meta: {
    title: "TermPeriod",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-term-periods",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <TermPeriod />
</template>
