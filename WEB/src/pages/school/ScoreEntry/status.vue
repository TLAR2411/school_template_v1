<script setup>
import ScoreEntryStatus from "@/views/school/ScoreEntry/ScoreEntryStatus.vue";

definePage({
  meta: {
    title: "Score Entry Status",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-score-entry",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <ScoreEntryStatus />
</template>
