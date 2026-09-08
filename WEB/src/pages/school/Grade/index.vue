<script setup>
import GradeList from "@/views/school/Grade/GradeList.vue";

definePage({
  meta: {
    title: "Grades",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    // permissions: "positions:view-page",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <GradeList />
</template>
