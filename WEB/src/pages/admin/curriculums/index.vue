<script setup>
// import RoleList from "@/views/admin/roles/RoleList.vue";
import CurriculumList from "@/views/admin/curriculums/CurriculumList.vue";

definePage({
  meta: {
    title: "Curriculums",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-curriculums",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <CurriculumList />
</template>
