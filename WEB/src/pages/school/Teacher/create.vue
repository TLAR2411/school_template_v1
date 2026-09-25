<script setup>
import CreateTeacher from "@/views/school/Teacher/CreateTeacher.vue";

definePage({
  meta: {
    title: "Create Teacher",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "add-teachers",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <CreateTeacher />
</template>
