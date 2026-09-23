<script setup>
import { ref, watch } from "vue";
import CheckAttendance from "@/views/school/Attendance/CheckAttendance.vue";
import AppCustomTap from "@/components/AppCustomTap.vue";

import { useRoute, useRouter } from "vue-router";
import ScoreEntry from "@/views/school/ScoreEntry/ScoreEntry.vue";

const route = useRoute();

const router = useRouter();

const currentTab = ref(route.query.tab || "class");

watch(
  () => currentTab.value,
  (newVal) => {
    router.replace({ query: { ...route.query, tab: newVal } });
  },
);

const tabs = [
  {
    value: "attendance",
    title: "Attendances",
    description: "Attendances",
    icon: "tabler-file-check",
  },
  {
    value: "score",
    title: "Score",
    description: "Score",
    icon: "tabler-folders",
  },
];

definePage({
  meta: {
    title: "Teacher Action",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    // permissions: "positions:view-page",
    // layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <div class="tabs-wrapper">
    <AppCustomTap v-model="currentTab" :tabs="tabs" />

    <VWindow v-model="currentTab" class="mt-1">
      <VWindowItem value="attendance">
        <CheckAttendance :class-id="route.params.id" lock-class />
      </VWindowItem>
      <VWindowItem value="score">
        <ScoreEntry :class-id="route.params.id" lock-class />
      </VWindowItem>
    </VWindow>
  </div>
</template>

<style scoped>
.tabs-wrapper {
  display: flex;
  flex-direction: column;
}

/* Default order (desktop / tablet) */
.tabs-wrapper :deep(.v-tabs) {
  order: 1;
}
.tabs-wrapper :deep(.v-window) {
  order: 2;
}

/* On small screens (phone), swap order */
@media (max-width: 600px) {
  .tabs-wrapper :deep(.v-tabs) {
    order: 2;
  }
  .tabs-wrapper :deep(.v-window) {
    order: 1;
  }
}

.custom-tab {
  /* min-height: 55px !important;
  height: 55px !important; */
}

.custom-tab.v-tab--selected {
  background-color: rgba(var(--v-theme-primary), 0.09);
  color: rgb(var(--v-theme-primary));
}

/* Change the dark slider */
:deep(.custom-tab.v-tab--selected .v-tab__slider) {
  background-color: rgba(var(--v-theme-primary)) !important;
  display: none !important;
}
</style>
