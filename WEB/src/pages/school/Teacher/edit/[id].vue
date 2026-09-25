<script setup>
import EditTeacher from "@/views/school/Teacher/EditTeacher.vue";
definePage({
  meta: {
    title: "Edit Teacher",
    layout: "default",
    subject: "EditTeacher",
    requiresAuth: true,
    permissions: "edit-teachers",
  },
});
</script>

<template>
  <EditTeacher />
</template>
