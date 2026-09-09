<script setup>
import { useI18n } from "vue-i18n";
import { api } from "@/utils/api";
import { computed, onMounted, ref, watch } from "vue";
import { useRouter } from "vue-router";
import { getGrades, getEducationLevels } from "@/services/dataService";
import AddEditClassDialog from "@/views/school/Class/AddEditClassDialog.vue";
import AddEditStudentClassDialog from "@/views/school/studentClass/AddEditStudentClassDialog.vue";
import AppStatusChip from "@/components/AppStatusChip.vue";
import { useSettingStore } from "@/stores/settingStore";

const settingStore = useSettingStore();
const router = useRouter();

definePage({
  meta: {
    title: "Checkin Checkout",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    // permissions: "view-curriculumns",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});

const { t, locale } = useI18n();
const formData = ref({});
const formDataStudentClass = ref({});
const isDialogVisible = ref(false);
const isDialogVisibleStudentClass = ref(false);
const isLoading = ref(true);
const dataTableRef = ref(null);

const classData = ref(null);

const educationLevels = ref([]);
const grades = ref([]);

const filter = ref({
  search: null,
  edu_id: null,
  grade_id: null,
});

const filteredGrades = computed(() => {
  if (!filter.value.edu_id) return grades.value;
  return grades.value.filter((g) => g.edu_id == filter.value.edu_id);
});

watch(isDialogVisible, (open) => {
  if (!open) formData.value = {};
});

watch(
  () => filter.value.edu_id,
  () => {
    if (!filter.value.grade_id) return;
    const stillValid = filteredGrades.value.some(
      (g) => g.id == filter.value.grade_id,
    );
    if (!stillValid) filter.value.grade_id = null;
  },
);

const headers = [
  { title: t("Class Name"), key: "className", visible: true },
  { title: t("Grade"), key: "gradeName", visible: true },
  { title: t("Room Number"), key: "room_number", visible: true },
  { title: t("Education Level"), key: "educationLevel", visible: true },
  { title: t("Status"), key: "is_active", visible: true },

  { title: t("Description"), key: "description", visible: true },

  {
    title: t("Action"),
    key: "actions",
    align: "center",
    visible: true,
    // fixed: mdAndUp.value,
  },
];

const onDelete = async (item) => {
  try {
    isLoading.value = true;

    const res = await api.post("classes-delete", {
      id: item.id,
    });
    if (res.data.status) {
      dataTableRef.value.reload();
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

const class_id = ref(null);

const onCreate = async (data, callback) => {
  try {
    isLoading.value = true;

    const res = await api.post("classes-store", data);

    if (res.data.status) {
      dataTableRef.value.reload();
      isDialogVisible.value = false;
    } else {
      console.error("Error with the response:", res.data);
    }
    callback(res.data.status);
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

const onCreateStudentClass = async (data, callback) => {
  console.log("data oncreateStudentclass", data.student_id);

  const payload = {
    student_id: data.student_id || [],
    class_id: class_id.value,
  };

  console.log(payload);

  try {
    isLoading.value = true;

    const res = await api.post("students-classes-enrollment", payload);

    if (res.data.status) {
      dataTableRef.value.reload();
      isDialogVisibleStudentClass.value = false;
    } else {
      console.error("Error with the response:", res.data);
    }
    callback(res.data.status);
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

const onAdd = async (item) => {
  isLoading.value = true;
  class_id.value = item.id;
  try {
    const res = await api.post("students-available-enrollment", {
      class_id: item.id,
    });
    if (res.data.status) {
      formDataStudentClass.value = res.data.data;
      isDialogVisibleStudentClass.value = true;
      classData.value = item;
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

const onEdit = async (item) => {
  try {
    isLoading.value = true;

    const res = await api.post("classes-show", { id: item.id });

    if (res.data.status) {
      formData.value = res.data.data;
      // console.log(formData.value)
      isDialogVisible.value = true;
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

const onUpdate = async (data, callback) => {
  try {
    isLoading.value = true;

    const res = await api.post("classes-update", data);

    if (res.data.status) {
      dataTableRef.value.reload();
      isDialogVisible.value = false;
    } else {
      console.error("Error with the response:", res.data);
    }
    callback(res.data.status);
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
    isLoading.value = false;
  }
};

const onView = async (item) => {
  console.log("item", item);
  router.push({ name: "school-class-detail-id", params: { id: item.id } });
  console.log("hel");
};

const onDisable = async (item) => {
  try {
    const res = await api.post("classes-disable", {
      id: item.id,
    });

    if (res.data.status) {
      await dataTableRef.value.reload();
    } else {
      console.error("Error with the response:", res.data);
    }
    callback(res.data.status);
  } catch (error) {
    console.error("Failed to fetch data:", error);
  } finally {
  }
};

const gradeLabel = (item) => {
  const name = locale.value === "km" ? item.name_kh : item.name_en;
  return [item.grade_level, name]
    .filter((v) => v != null && v !== "")
    .join(" ");
};

// const onAtt = (item) => {
//   console.log(item);
//   router.push({ name: "global-attendance-id", params: { id: item.id } });
// };

watch(
  () => settingStore.curriculum_id,
  async (newVal) => {
    if (newVal) {
      educationLevels.value = await getEducationLevels();
      grades.value = await getGrades();
    }
  },
);

onMounted(async () => {
  educationLevels.value = await getEducationLevels();
  grades.value = await getGrades();
});
</script>

<template>
  <AddEditClassDialog
    v-model:isDialogVisible="isDialogVisible"
    :item-data="formData"
    :loading="isLoading"
    @on-create="onCreate"
    @on-update="onUpdate"
  />

  <AddEditStudentClassDialog
    v-model:isDialogVisibleStudentClass="isDialogVisibleStudentClass"
    :loading="isLoading"
    :item-data="formDataStudentClass"
    :classData="classData"
    @on-create-student-class="onCreateStudentClass"
  />

  <AppCardTable
    v-model:isDialogCreateVisible="isDialogVisible"
    ref="dataTableRef"
    title="Classes"
    title-icon="tabler-cash-banknote"
    saveHeaderName="header-classes-list"
    saveStateName="save-state-classes-list"
    v-model:loading="isLoading"
    v-model:filters="filter"
    api-url="classes-list"
    :headers="headers"
    is-filter
    is-excel
    is-edit
    is-add
    is-attendance
    is-delete
    is-disable
    is-view
    create-dialog
    save-state
    :is-back="false"
    @on-delete="onDelete"
    @on-edit="onEdit"
    @on-disable="onDisable"
    @on-add="onAdd"
    @on-view="onView"
  >
    <template #filter>
      <VRow class="justify-end">
        <!----Filter Input-->

        <VCol cols="12" sm="6" md="4" lg="2">
          <VTextField
            v-model="filter.search"
            :label="t('Search')"
            prepend-inner-icon="tabler-search"
            clearable
            hide-details
            autocomlete="off"
            clear-icon="tabler-x"
          />
        </VCol>

        <VCol cols="12" sm="6" md="4" lg="2">
          <AppAutocomplete
            :items="educationLevels"
            :item-title="locale === 'km' ? 'name_kh' : 'name_en'"
            item-value="id"
            v-model="filter.edu_id"
            :placeholder="t('Select Education')"
            prepend-inner-icon="tabler-search"
            clearable
            hide-details
            autocomlete="off"
            clear-icon="tabler-x"
          />
        </VCol>

        <VCol cols="12" sm="6" md="4" lg="2">
          <AppAutocomplete
            :items="filteredGrades"
            :item-title="gradeLabel"
            item-value="id"
            v-model="filter.grade_id"
            :placeholder="t('Select Grade')"
            clearable
            hide-details
            autocomlete="off"
            prepend-inner-icon="tabler-search"
            clear-icon="tabler-x"
          />
        </VCol>
      </VRow>
    </template>

    <template #item.className="{ item }">
      <span v-if="locale === 'km'">
        {{ item.name_kh }}
      </span>
      <span v-else>
        <span v-if="item.grade_level">
          {{ item.name_kh }}
        </span>
        {{ item.name_en }}
      </span>
    </template>

    <template #item.gradeName="{ item }">
      <span v-if="item.grade_level != null">{{ item.grade_level }}</span>
      {{ locale === "km" ? item.grade_name_kh : item.grade_name_en }}
    </template>

    <template #item.educationLevel="{ item }">
      <span v-if="item.grade_level != null">
        {{ locale === "km" ? item.edu_name_kh : item.edu_name_en }}
      </span>
      <span v-else>N/A</span>
    </template>

    <template v-slot:item.is_active="{ item }">
      <AppStatusChip
        :color="item.is_active == true ? 'success' : 'error'"
        :label="item.is_active == true ? t('Active') : t('Inactive')"
      />
    </template>
  </AppCardTable>
</template>
