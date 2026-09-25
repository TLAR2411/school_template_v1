<script setup>
import ClassList from "@/views/school/Class/ClassList.vue";
import GradeList from "@/views/school/Grade/GradeList.vue";
import RoomList from "@/views/school/Room/RoomList.vue";
import { useRoute, useRouter } from "vue-router";
import { computed, onMounted, ref, watch } from "vue";
import AppCustomTap from "@/components/AppCustomTap.vue";
import hasPermission from "@/utils/hasPermission";
import { auth } from "@/utils/auth";

const route = useRoute();
const router = useRouter();

const allTabs = [
  {
    value: "class",
    title: "Classes",
    description: "Manage Classes",
    icon: "tabler-home-cog",
    permission: "view-classes",
  },
  {
    value: "grade",
    title: "Grades",
    description: "Manage Grades",
    icon: "tabler-chart-arrows-vertical",
    permission: "view-grades",
  },
  {
    value: "room",
    title: "Rooms",
    description: "Manage Rooms",
    icon: "tabler-home",
    permission: "view-rooms",
  },
];

const tabs = computed(() =>
  allTabs.filter((tab) => hasPermission(tab.permission)),
);

const currentTab = ref(
  tabs.value.some((tab) => tab.value === route.query.tab)
    ? route.query.tab
    : tabs.value[0]?.value || "class",
);

watch(
  () => currentTab.value,
  (newVal) => {
    router.replace({ query: { ...route.query, tab: newVal } });
  },
);

// onMounted(() => {
//   if (auth()?.user?.role?.name === "teacher") {
//     router.replace({ name: "school-class-grid" });
//   }
// });

definePage({
  meta: {
    title: "Classes",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-classes",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});
</script>

<template>
  <div class="tabs-wrapper">
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
