<script setup>
// import RoleList from "@/views/admin/roles/RoleList.vue";
import StudentEnrollList from "@/views/school/StudentEnroll/StudentEnrollList.vue";

definePage({
  meta: {
    title: "Students",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-students",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <StudentEnrollList />
</template>
