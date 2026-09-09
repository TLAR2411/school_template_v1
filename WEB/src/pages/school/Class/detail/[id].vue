<script setup>
import DetailClass from "@/views/school/Class/DetailClass.vue";

definePage({
  meta: {
    title: "Class Detail",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    // permissions: "positions:view-page",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <DetailClass />
</template>
