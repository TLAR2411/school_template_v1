```vue
<script setup>
import { ref, watch } from "vue";
import { useRoute, useRouter } from "vue-router";

import AppCustomTap from "@/components/AppCustomTap.vue";

import SubjectList from "@/views/school/Subject/SubjectList.vue";
import SubjectSettingList from "@/views/school/SubjectSetting/SubjectSettingList.vue";
import SubjectActivityTypeList from "@/views/school/SubjectActivityType/SubjectActivityTypeList.vue";

const route = useRoute();
const router = useRouter();

const currentTab = ref(route.query.tab || "subject");

const tabs = [
  {
    value: "subject",
    title: "Subjects",
    description: "Manage subjects",
    icon: "tabler-book",
  },
  {
    value: "subject-setting",
    title: "Subject Settings",
    description: "Configure subjects",
    icon: "tabler-settings",
  },
  {
    value: "subject-activity",
    title: "Activities",
    description: "Manage activities",
    icon: "tabler-clipboard-list",
  },
];

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
```
