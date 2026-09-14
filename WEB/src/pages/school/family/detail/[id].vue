<script setup>
import FamilyDetail from "@/views/school/family/FamilyDetail.vue";

definePage({
  meta: {
    title: "Family Detail",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    // permissions: "positions:view-page",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <FamilyDetail />
</template>
