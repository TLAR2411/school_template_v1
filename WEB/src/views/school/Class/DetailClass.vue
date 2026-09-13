<script setup>
import { ref, computed, onMounted, watch } from "vue";
import { useRouter, useRoute } from "vue-router";
import { api } from "@/utils/api.js";
import StudentClassList from "@/views/school/studentClass/StudentClassList.vue";
import AppCustomTap from "@/components/AppCustomTap.vue";
import TeacherClass from "../TeacherClass/TeacherClass.vue";

const route = useRoute();
const router = useRouter();

const currentTab = ref(route.query.tab || "general");
watch(currentTab, (newVal) => {
  router.replace({
    query: {
      ...route.query,
      tab: newVal,
    },
  });
});

const classDetail = ref(1);

const payload = ref({
  class_id: route.params.id,
});

const stats = computed(() => {
  //   if (!classDetail.value) return [];
  const d = classDetail.value;
  return [
    {
      label: "Total students",
      //   value: d.student_total ?? 0,
      value: 10,
      icon: "tabler-users",
      iconBg: "#E6F1FB",
      iconColor: "#185FA5",
    },
    {
      label: "Female students",
      //   value: d.student_female ?? 0,
      value: 5,
      icon: "tabler-gender-female",
      iconBg: "#FBEAF0",
      iconColor: "#993556",
    },
    {
      label: "Teachers",
      //   value: d.teacher_total ?? 0,
      value: 3,
      icon: "tabler-chalkboard",
      iconBg: "#E1F5EE",
      iconColor: "#0F6E56",
    },
    {
      label: "Assistance",
      // value: d.assistance_total ?? 0,
      value: 2,

      icon: "tabler-user-check",
      iconBg: "#FAEEDA",
      iconColor: "#633806",
    },
  ];
});

const getClassDetail = async () => {
  try {
    const res = await api.post("classes-detail", payload.value);
    classDetail.value = res.data.data;
  } catch (error) {}
};

const tabs = [
  {
    value: "general",
    title: "General",
    description: "General Information",
    icon: "tabler-settings",
  },
  {
    value: "student",
    title: "Students",
    description: "Student Information",
    icon: "tabler-users-group",
  },
  {
    value: "teacher",
    title: "Teachers",
    description: "Teacher Information",
    icon: "tabler-users",
  },
];

onMounted(async () => {
  getClassDetail();
});
</script>
<template>
  <!-- <VTabs v-model="currentTab" grow stacked class="py-0">
    <VTab value="window1" class="py-0 custom-tab">
      <VIcon icon="tabler-settings" class="mr-1" />
      <span>General</span>
    </VTab>
    <VTab value="window2" class="py-0 custom-tab">
      <VIcon icon="tabler-users-group" class="mr-1" />
      <span>Students</span>
    </VTab>

    <VTab value="window3" class="py-0 custom-tab">
      <VIcon icon="tabler-users" class="mr-1" />
      <span>Teachers</span>
    </VTab>
  </VTabs> -->

  <AppCustomTap v-model="currentTab" :tabs="tabs" />

  <VWindow v-model="currentTab" class="mt-4">
    <VWindowItem value="general">
      <VCard class="pa-5 mb-4" v-if="classDetail">
        <div class="d-flex align-start justify-space-between flex-wrap ga-3">
          <div class="d-flex align-center ga-3">
            <div
              class="d-flex align-center justify-center rounded-lg text-h5 font-weight-medium bg-primary"
              style="width: 52px; height: 52px; color: white; flex-shrink: 0"
            >
              <!-- {{ classDetail.class?.symbol }} -->
              A
            </div>
            <div>
              <p class="text-h6 font-weight-medium mb-0">
                <!-- {{ classDetail.class?.name_en }} -->
                Class A
              </p>
              <p class="text-body-2 text-medium-emphasis mb-0">
                <!-- {{ classDetail.class?.name_kh }} -->
                ថ្នាក់ A
              </p>
            </div>
          </div>

          <!-- Badges -->
          <div class="d-flex ga-2 flex-wrap align-center">
            <VChip size="small" style="background: #e1f5ee; color: #0f6e56">
              <!-- {{ classDetail.grade?.name_en }} -->
              Grade 10
            </VChip>
            <VChip size="small" style="background: #faeeda; color: #633806">
              <!-- Room {{ classDetail.class?.room_number }} -->
              Room 101
            </VChip>
            <VChip size="small" style="background: #e6f1fb; color: #185fa5">
              <!-- {{ classDetail.year?.name }} -->
              2023-2024
            </VChip>
          </div>
        </div>

        <VDivider class="my-3" />

        <VRow id="page-tour-class-stats">
          <VCol cols="12" md="3" v-for="stat in stats" :key="stat.label">
            <VCard rounded="lg" class="pa-3">
              <div class="d-flex align-center justify-space-between mb-2">
                <span class="text-caption text-medium-emphasis">{{
                  stat.label
                }}</span>
                <div
                  class="d-flex align-center justify-center rounded"
                  :style="{
                    width: '38px',
                    height: '38px',
                    background: stat.iconBg,
                  }"
                >
                  <VIcon size="26" :color="stat.iconColor">{{
                    stat.icon
                  }}</VIcon>
                </div>
              </div>
              <p class="text-h4 font-weight-medium mb-0">
                {{ stat.value }}
              </p>
            </VCard>
          </VCol>
        </VRow>
      </VCard>
    </VWindowItem>

    <VWindowItem value="student">
      <StudentClassList :payload="payload" :class-data="classDetail" />
    </VWindowItem>

    <VWindowItem value="teacher">
      <TeacherClass :class_id="route.params.id" />
    </VWindowItem>
  </VWindow>
</template>
<style scoped>
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
