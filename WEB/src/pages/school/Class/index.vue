<script setup>
import ClassList from "@/views/school/Class/ClassList.vue";

definePage({
  meta: {
    title: "Classes",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    // permissions: "positions:view-page",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <ClassList />
</template>
