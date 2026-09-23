<script setup>
import ClassesGrid from "@/views/school/Class/ClassesGrid.vue";

definePage({
  meta: {
    title: "Rooms",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    // permissions: "positions:view-page",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <ClassesGrid />
</template>
