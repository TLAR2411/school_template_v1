<script setup>
import ClassList from "@/views/school/Class/ClassList.vue";
import GradeList from "@/views/school/Grade/GradeList.vue";
import RoomList from "@/views/school/Room/RoomList.vue";
import { useRoute, useRouter } from "vue-router";
import { ref } from "vue";
import AppCustomTap from "@/components/AppCustomTap.vue";

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
    value: "class",
    title: "Classes",
    description: "Manage Classes",
    icon: "tabler-home-cog",
  },
  {
    value: "grade",
    title: "Grades",
    description: "Manage Grades",
    icon: "tabler-chart-arrows-vertical",
  },
  {
    value: "room",
    title: "Rooms",
    description: "Manage Rooms",
    icon: "tabler-home",
  },
];

definePage({
  meta: {
    title: "Classes",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    // permissions: "positions:view-page",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <div class="tabs-wrapper">
    <!-- <VTabs v-model="currentTab" grow stacked class="py-0">
      <VTab value="class" class="py-0 custom-tab">
        <VIcon icon="tabler-home-cog" class="mr-1" />
        <span>Classes</span>
      </VTab>
      <VTab value="grade" class="py-0 custom-tab">
        <VIcon icon="tabler-chart-arrows-vertical" class="mr-1" />
        <span>Grades</span>
      </VTab>
      <VTab value="room" class="py-0 custom-tab">
        <VIcon icon="tabler-home" class="mr-1" />
        <span>Rooms</span>
      </VTab>
    </VTabs> -->

    <AppCustomTap v-model="currentTab" :tabs="tabs" />

    <VWindow v-model="currentTab" class="mt-1">
      <VWindowItem value="class">
        <ClassList />
      </VWindowItem>
      <VWindowItem value="grade">
        <GradeList />
      </VWindowItem>
      <VWindowItem value="room">
        <RoomList />
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
