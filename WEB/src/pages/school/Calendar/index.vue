<script setup>
import CalendarView from "@/views/school/Calendar/CalendarView.vue";

definePage({
  meta: {
    title: "Calendar",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
  },
});
</script>

<template>
  <CalendarView />
</template>
