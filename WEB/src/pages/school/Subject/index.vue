<script setup>
import SubjectList from "@/views/school/Subject/SubjectList.vue";
import SubjectSettingList from "@/views/school/SubjectSetting/SubjectSettingList.vue";
import { ref } from "vue";
import SubjectActivityTypeList from "@/views/school/SubjectActivityType/SubjectActivityTypeList.vue";

definePage({
  meta: {
    title: "Subjects",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    // permissions: "positions:view-page",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});

const currentTab = ref("class");
</script>

<template>
  <div class="tabs-wrapper">
    <VTabs v-model="currentTab" grow stacked class="py-0">
      <VTab value="subject" class="py-0 custom-tab">
        <VIcon icon="tabler-folders" class="mr-1" />
        <span>Subjects</span>
      </VTab>
      <VTab value="subject-setting" class="py-0 custom-tab">
        <VIcon icon="tabler-folder-cog" class="mr-1" />
        <span>Subject Setting</span>
      </VTab>
      <VTab value="subject-activity" class="py-0 custom-tab">
        <VIcon icon="tabler-folder" class="mr-1" />
        <span>Subject Activity Type</span>
      </VTab>
    </VTabs>

    <VWindow v-model="currentTab" class="mt-1">
      <VWindowItem value="subject">
        <SubjectList />
      </VWindowItem>
      <VWindowItem value="subject-setting">
        <!-- <GradeList /> -->
      </VWindowItem>
      <VWindowItem value="subject-activity">
        <SubjectActivityTypeList />
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
