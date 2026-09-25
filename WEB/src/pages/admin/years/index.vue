<script setup>
// import RoleList from "@/views/admin/roles/RoleList.vue";
import YearList from "@/views/admin/years/YearList.vue";

definePage({
  meta: {
    title: "Years",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-years",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <YearList />
</template>
