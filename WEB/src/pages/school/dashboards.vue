<script setup>
import { onMounted } from "vue";
import { useRouter } from "vue-router";
import { auth } from "@/utils/auth";

definePage({
  meta: {
    title: "Dashboards",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
  },
});

const router = useRouter();

onMounted(() => {
  if (auth()?.user?.role?.name === "teacher") {
    router.replace({ name: "school-class-grid" });
  }
});
</script>

<template>
  <div>
    hello world
  </div>
</template>
