<script setup>
import { computed, ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";

import AppCustomTap from "@/components/AppCustomTap.vue";

import SubjectList from "@/views/school/Subject/SubjectList.vue";
import SubjectSettingList from "@/views/school/SubjectSetting/SubjectSettingList.vue";
import SubjectActivityTypeList from "@/views/school/SubjectActivityType/SubjectActivityTypeList.vue";
import hasPermission from "@/utils/hasPermission";

const route = useRoute();
const router = useRouter();

const allTabs = [
  {
    value: "subject",
    title: "Subjects",
    description: "Manage subjects",
    icon: "tabler-book",
    permission: "view-subjects",
  },
  {
    value: "subject-setting",
    title: "Subject Settings",
    description: "Configure subjects",
    icon: "tabler-settings",
    permission: "view-grading-rules",
  },
  {
    value: "subject-activity",
    title: "Activities",
    description: "Manage activities",
    icon: "tabler-clipboard-list",
    permission: "view-subject-activity-types",
  },
];

const tabs = computed(() =>
  allTabs.filter((tab) => hasPermission(tab.permission)),
);

const currentTab = ref(
  tabs.value.some((tab) => tab.value === route.query.tab)
    ? route.query.tab
    : tabs.value[0]?.value || "subject",
);

watch(currentTab, (newVal) => {
  router.replace({
    query: {
      ...route.query,
      tab: newVal,
    },
  });
});

definePage({
  meta: {
    title: "Subjects",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-subjects",
  },
});
</script>

<template>
  <div class="subject-page">
    <AppCustomTap v-model="currentTab" :tabs="tabs" />

    <VWindow v-model="currentTab" class="mt-1" :touch="false">
      <VWindowItem value="subject">
        <SubjectList />
      </VWindowItem>

      <VWindowItem value="subject-setting">
        <SubjectSettingList />
      </VWindowItem>

      <VWindowItem value="subject-activity">
        <SubjectActivityTypeList />
      </VWindowItem>
    </VWindow>
  </div>
</template>
