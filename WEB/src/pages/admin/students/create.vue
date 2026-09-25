<script setup>
// import RoleList from "@/views/admin/roles/RoleList.vue";
import CreateStudent from "@/views/admin/students/CreateStudent.vue";

definePage({
  meta: {
    title: "Create Student",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "add-students",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <CreateStudent />
</template>
