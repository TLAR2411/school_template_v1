<script setup>
import EditStudent from "@/views/admin/students/EditStudent.vue";
definePage({
  meta: {
    title: "Edit Student",
    layout: "default",
    subject: "EditStudent",
    requiresAuth: true,
    permissions: "edit-students",
  },
});
</script>

<template>
  <EditStudent />
</template>
