<script setup>
import FamilyList from "@/views/school/family/FamilyList.vue";

definePage({
  meta: {
    title: "Families",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    // permissions: "positions:view-page",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <FamilyList />
</template>
