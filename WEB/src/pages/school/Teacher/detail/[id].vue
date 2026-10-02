<script setup>
import TeacherDetail from "@/views/school/Teacher/TeacherDetail.vue";

definePage({
  meta: {
    title: "Teacher Detail",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-teachers",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <TeacherDetail />
</template>
