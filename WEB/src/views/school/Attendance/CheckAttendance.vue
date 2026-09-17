<script setup>
import { ref, onMounted, computed, watch, nextTick } from "vue";
import { useI18n } from "vue-i18n";
import { useRoute } from "vue-router";
import { getGrades, getClasses } from "@/services/dataService";
import { useSettingStore } from "@/stores/settingStore.js";

const route = useRoute();
const settingStore = useSettingStore();
const { t, locale } = useI18n();

const isLoading = ref(false);

const grades = ref([]);
const allClasses = ref([]);
const subjects = ref([]);

const formSearch = ref({
  class_id: null,
  date: new Date(),
  day_id: null,
  subject_id: null,
  grade_id: null,
});

const filteredClasses = computed(() => {
  if (!formSearch.value.grade_id) return allClasses.value;
  return allClasses.value.filter(
    (item) => item.grade_id == formSearch.value.grade_id,
  );
});

const selectedClass = computed(() =>
  allClasses.value.find((c) => c.id == formSearch.value.class_id),
);

const classLabel = computed(() => {
  const c = selectedClass.value;
  if (!c) return "";
  return locale.value === "km"
    ? c.name_kh || c.name_en || ""
    : c.name_en || c.name_kh || "";
});

const classTitle = computed(() =>
  locale.value === "km" ? "name_kh" : "name_en",
);

const gradeTitle = (item) => {
  if (item?.grade_level != null) {
    return locale.value === "km"
      ? `កម្រិត ${item.grade_level}`
      : `Level ${item.grade_level}`;
  }
  return locale.value === "km"
    ? item?.name_kh || item?.name_en
    : item?.name_en || item?.name_kh;
};

async function onClassSelected(classId) {
  if (!classId) {
    subjects.value = [];
    formSearch.value.subject_id = null;
    return;
  }
  // Load attendance / subjects when API is wired
}

/** Skip clearing class when we set grade from route param */
let applyingFromRoute = false;

async function applyClassFromRoute(rawId) {
  if (!rawId) return;

  const classId = Number(rawId);
  if (!Number.isFinite(classId)) return;

  if (!allClasses.value.length) {
    allClasses.value = (await getClasses()) || [];
  }

  const cls = allClasses.value.find((c) => c.id == classId);
  if (!cls) return;

  applyingFromRoute = true;
  formSearch.value.grade_id = cls.grade_id;
  formSearch.value.class_id = classId;
  await nextTick();
  applyingFromRoute = false;
}

watch(
  () => formSearch.value.date,
  (newDate) => {
    if (!newDate) return;
    formSearch.value.day_id = new Date(newDate).getDay();
    // if (formSearch.value.class_id) { load attendance for date }
  },
);

watch(
  () => settingStore.curriculum_id,
  async (newVal) => {
    if (!newVal) return;
    formSearch.value.grade_id = null;
    formSearch.value.class_id = null;
    subjects.value = [];
    formSearch.value.subject_id = null;
    grades.value = (await getGrades()) || [];
    allClasses.value = (await getClasses()) || [];
  },
);

watch(
  () => formSearch.value.grade_id,
  () => {
    if (applyingFromRoute) return;
    formSearch.value.class_id = null;
    subjects.value = [];
    formSearch.value.subject_id = null;
  },
);

watch(
  () => formSearch.value.class_id,
  (classId) => {
    onClassSelected(classId);
  },
);

watch(
  () => route.params.id,
  (id) => {
    applyClassFromRoute(id);
  },
);

onMounted(async () => {
  isLoading.value = true;
  try {
    grades.value = (await getGrades()) || [];
    allClasses.value = (await getClasses()) || [];
    if (formSearch.value.date) {
      formSearch.value.day_id = new Date(formSearch.value.date).getDay();
    }
    await applyClassFromRoute(route.params.id);
  } finally {
    isLoading.value = false;
  }
});
</script>
<template>
  <AppCard
    :title="t('Attendance')"
    title-icon="tabler-file-check"
    :is-back="false"
    :is-filter="true"
    :show-filters="true"
    :loading="isLoading"
  >
    <template #filter>
      <VRow class="align-end">
        <VCol cols="6" sm="3" md="3" lg="3">
          <AppAutocomplete
            v-model="formSearch.grade_id"
            :items="grades"
            :item-title="gradeTitle"
            item-value="id"
            :placeholder="t('Grade')"
            autocomplete="off"
            clearable
            hide-details
          />
        </VCol>

        <VCol cols="6" sm="3" md="3" lg="3">
          <AppAutocomplete
            v-model="formSearch.class_id"
            :items="filteredClasses"
            :item-title="classTitle"
            item-value="id"
            :placeholder="t('Class')"
            autocomplete="off"
            clearable
            hide-details
            :disabled="!formSearch.grade_id"
          />
        </VCol>
        <VCol id="page-tour-attendance-date" cols="6" sm="3" md="3" lg="3">
          <AppDateTimePicker
            v-model="formSearch.date"
            :placeholder="$t('Select date')"
          />
        </VCol>
      </VRow>
    </template>

    <VTable
      fixed-header
      density="comfortable"
      class="border rounded attendance-table"
    >
      <thead>
        <tr>
          <th class="sticky-header" style="width: 270px">
            <span class="d-none d-sm-inline">{{ $t("Name") }}</span>
            <span class="d-inline d-sm-none">{{ $t("Name") }}</span>
          </th>
          <th style="width: 20px">
            <span class="d-none d-sm-inline">{{ $t("Gender") }}</span>
            <span class="d-inline d-sm-none">{{ $t("Sex") }}</span>
          </th>
          <th style="width: 150px" class="text-center">
            <span class="d-none d-sm-inline">{{ $t("Present") }}</span>
            <span class="d-inline d-sm-none">Pr</span>
          </th>
          <th style="width: 150px" class="text-center">
            <span class="d-none d-sm-inline">{{ $t("Late") }}</span>
            <span class="d-inline d-sm-none">L</span>
          </th>
          <th style="width: 150px" class="text-center">
            <span class="d-none d-sm-inline">{{ $t("Ask Permission") }}</span>
            <span class="d-inline d-sm-none">P</span>
          </th>
          <th style="min-width: 250px; text-align: left">
            {{ $t("Reason") }}
          </th>
        </tr>
      </thead>
    </VTable>
  </AppCard>
</template>

<style scoped>
.attendance-table {
  overflow-x: auto;
}
.sticky-header {
  position: sticky;
  left: 0;
  top: 0;
  z-index: 20;
  background: white !important;
}

.sticky-col {
  position: sticky;
  left: 0;
  z-index: 10;
  background: white;
}
</style>
