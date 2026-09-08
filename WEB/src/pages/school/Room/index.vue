<script setup>
import RoomList from "@/views/school/Room/RoomList.vue";

definePage({
  meta: {
    title: "Rooms",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    // permissions: "positions:view-page",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <RoomList />
</template>
