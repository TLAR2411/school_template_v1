<script setup>
import ScoreEntry from "@/views/school/ScoreEntry/ScoreEntry.vue";
definePage({
  meta: {
    title: "Score Entry",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-score-entry",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <ScoreEntry />
</template>
