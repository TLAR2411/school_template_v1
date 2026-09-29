<script setup>
import { ref, computed, onMounted, watch } from "vue";
import { useRouter, useRoute } from "vue-router";
import { useI18n } from "vue-i18n";
import { api } from "@/utils/api.js";
import StudentClassList from "@/views/school/studentClass/StudentClassList.vue";
import AppCustomTap from "@/components/AppCustomTap.vue";
import AppStatusChip from "@/components/AppStatusChip.vue";
import TeacherClass from "../TeacherClass/TeacherClass.vue";

const route = useRoute();
const router = useRouter();
const { t, locale } = useI18n();

const currentTab = ref(route.query.tab || "general");
watch(currentTab, (newVal) => {
  router.replace({
    query: {
      ...route.query,
      tab: newVal,
    },
  });
});

const classDetail = ref(null);
const isLoading = ref(false);

const payload = ref({
  class_id: route.params.id,
});

const pickLocale = (en, kh) => (locale.value === "km" ? kh || en : en || kh) || "—";

const displayName = computed(() => {
  const d = classDetail.value;
  if (!d) return "";
  return pickLocale(d.name_en, d.name_kh);
});

const displayNameSecondary = computed(() => {
  const d = classDetail.value;
  if (!d) return "";
  // Show the other language under the primary name when both exist
  if (locale.value === "km") {
    return d.name_en && d.name_en !== d.name_kh ? d.name_en : "";
  }
  return d.name_kh && d.name_kh !== d.name_en ? d.name_kh : "";
});

const gradeLabel = computed(() => {
  const d = classDetail.value;
  if (!d) return "";
  if (d.grade_level != null) return `${t("Grade")} ${d.grade_level}`;
  return pickLocale(d.grade_name_en, d.grade_name_kh);
});

/** Chips shown next to the class title — only non-empty values */
const headerChips = computed(() => {
  const d = classDetail.value;
  if (!d) return [];

  const chips = [];

  if (gradeLabel.value && gradeLabel.value !== "—") {
    chips.push({
      key: "grade",
      label: gradeLabel.value,
      bg: "#E1F5EE",
      color: "#0F6E56",
    });
  }
  if (d.room_number) {
    chips.push({
      key: "room",
      label: `${t("Room")} ${d.room_number}`,
      bg: "#FAEEDA",
      color: "#633806",
    });
  }
  if (d.year_name) {
    chips.push({
      key: "year",
      label: d.year_name,
      bg: "#E6F1FB",
      color: "#185FA5",
    });
  }
  if (d.shift_name_en || d.shift_name_kh) {
    chips.push({
      key: "shift",
      label: pickLocale(d.shift_name_en, d.shift_name_kh),
      bg: "#F5E8FF",
      color: "#5B2B82",
    });
  }

  return chips;
});

/** Detail rows under the stats — easy to add/remove later */
const infoRows = computed(() => {
  const d = classDetail.value;
  if (!d) return [];

  const classload =
    d.classload_teacher &&
    pickLocale(d.classload_teacher.name_en, d.classload_teacher.name_kh);

  return [
    {
      key: "education",
      label: t("Education Level"),
      value: pickLocale(d.edu_name_en, d.edu_name_kh),
    },
    {
      key: "class_type",
      label: t("Class Type"),
      value: pickLocale(d.class_type_en, d.class_type_kh),
    },
    {
      key: "classload",
      label: t("Classload Teacher"),
      value: classload || "—",
    },
    {
      key: "description",
      label: t("Description"),
      value: d.description || "—",
    },
  ];
});

const stats = computed(() => {
  const s = classDetail.value?.stats || {};
  return [
    {
      label: t("Total students"),
      value: s.student_total ?? 0,
      icon: "tabler-users",
      iconBg: "#E6F1FB",
      iconColor: "#185FA5",
    },
    {
      label: t("Female students"),
      value: s.student_female ?? 0,
      icon: "tabler-gender-female",
      iconBg: "#FBEAF0",
      iconColor: "#993556",
    },
    {
      label: t("Teachers"),
      value: s.teacher_total ?? 0,
      icon: "tabler-chalkboard",
      iconBg: "#E1F5EE",
      iconColor: "#0F6E56",
    },
    {
      label: t("Assistants"),
      value: s.assistant_total ?? 0,
      icon: "tabler-user-check",
      iconBg: "#FAEEDA",
      iconColor: "#633806",
    },
  ];
});

const getClassDetail = async () => {
  try {
    isLoading.value = true;
    const res = await api.post("classes-detail", payload.value);
    if (res.data?.status) {
      classDetail.value = res.data.data;
    }
  } catch (error) {
    console.error("Failed to load class detail:", error);
  } finally {
    isLoading.value = false;
  }
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

onMounted(() => {
  getClassDetail();
});
</script>

<template>
  <AppCustomTap v-model="currentTab" :tabs="tabs" />

  <VWindow v-model="currentTab" class="mt-4">
    <VWindowItem value="general">
      <VCard class="pa-5 mb-4" v-if="isLoading">
        <div class="d-flex align-center justify-center py-10">
          <VProgressCircular indeterminate color="primary" />
        </div>
      </VCard>

      <VCard class="pa-5 mb-4" v-else-if="classDetail">
        <!-- Header: identity + chips -->
        <div class="d-flex align-start justify-space-between flex-wrap ga-3">
          <div class="d-flex align-center ga-3">
            <div
              class="d-flex align-center justify-center rounded-lg text-h5 font-weight-medium bg-primary"
              style="width: 52px; height: 52px; color: white; flex-shrink: 0"
            >
              {{ classDetail.symbol || "—" }}
            </div>
            <div>
              <div class="d-flex align-center ga-2 flex-wrap">
                <p class="text-h6 font-weight-medium mb-0">
                  {{ displayName }}
                </p>
                <AppStatusChip
                  :color="classDetail.is_active ? 'success' : 'error'"
                  :label="classDetail.is_active ? t('Active') : t('Inactive')"
                />
              </div>
              <p
                v-if="displayNameSecondary"
                class="text-body-2 text-medium-emphasis mb-0"
              >
                {{ displayNameSecondary }}
              </p>
            </div>
          </div>

          <div class="d-flex ga-2 flex-wrap align-center">
            <VChip
              v-for="chip in headerChips"
              :key="chip.key"
              size="small"
              :style="{ background: chip.bg, color: chip.color }"
            >
              {{ chip.label }}
            </VChip>
          </div>
        </div>

        <VDivider class="my-4" />

        <!-- Stats -->
        <VRow>
          <VCol cols="12" sm="6" md="3" v-for="stat in stats" :key="stat.label">
            <div class="pa-3 rounded-lg border">
              <div class="d-flex align-center justify-space-between mb-2">
                <span class="text-caption text-medium-emphasis">
                  {{ stat.label }}
                </span>
                <div
                  class="d-flex align-center justify-center rounded"
                  :style="{
                    width: '38px',
                    height: '38px',
                    background: stat.iconBg,
                  }"
                >
                  <VIcon size="22" :color="stat.iconColor">
                    {{ stat.icon }}
                  </VIcon>
                </div>
              </div>
              <p class="text-h4 font-weight-medium mb-0">
                {{ stat.value }}
              </p>
            </div>
          </VCol>
        </VRow>

        <VDivider class="my-4" />

        <!-- Extra info -->
        <VRow>
          <VCol
            v-for="row in infoRows"
            :key="row.key"
            cols="12"
            sm="6"
            md="3"
          >
            <p class="text-caption text-medium-emphasis mb-1">
              {{ row.label }}
            </p>
            <p class="text-body-1 mb-0">
              {{ row.value }}
            </p>
          </VCol>
        </VRow>
      </VCard>

      <VCard v-else class="pa-5 mb-4">
        <p class="text-medium-emphasis mb-0 text-center py-6">
          {{ t("No data available") }}
        </p>
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
