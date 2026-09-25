<script setup>
import PermissionList from "@/views/admin/permissions/PermissionList.vue";

definePage({
  meta: {
    title: "Permissions",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-permissions",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <PermissionList />
</template>
