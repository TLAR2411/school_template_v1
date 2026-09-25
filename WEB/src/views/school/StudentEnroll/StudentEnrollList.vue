<script setup>
import { useI18n } from "vue-i18n";
import { api } from "@/utils/api";
import { useDisplay } from "vuetify";
import AppName from "@/components/AppName.vue";
import formatDate from "@/utils/formater/formatDate";
import formatGender from "@/utils/formater/formatGender";
import formatNation from "@/utils/formater/formatNation";
import formatContact from "@/utils/formater/formatContact.js";
import { useRouter } from "vue-router";
// import AddEditStudentEnrollDialog from "./AddEditStudentEnrollDialog.vue";
// import AddEditStudentClassDialog from "../studentclass/AddEditStudentClassDialog.vue";
import AddEditStudentEnrollDialog from "./AddEditStudentEnrollDialog.vue";

const router = useRouter();

const { mdAndUp } = useDisplay();

const dataTableRef = ref(null);

const isDialogVisible = ref(false);
const isDialogVisibleStudentClass = ref(false);
const isLoading = ref(true);
const formData = ref({});

const filter = ref({
  search: null,
});

const response = ref({});
const summary = computed(() => ({
  enrolled: response.value?.summary?.enrolled ?? 0,
  notEnrolled: response.value?.summary?.not_enrolled ?? 0,
}));

watch(isDialogVisible, (open) => {
  if (!open) formData.value = {};
});

definePage({
  meta: {
    title: "Students",
    layout: "default",
    subject: "Students",
    requiresAuth: true,
    // permissions: "students:view-page",
  },
});

const { t, locale } = useI18n();

const headers = ref([
  { title: t("Students"), key: "photo_path", visible: true },

  {
    title: t("Gender"),
    key: "gender",
    visible: true,
    value: (items) => formatGender(items.gender),
  },
  {
    title: t("Nationality"),
    key: "nation",
    visible: true,
    value: (items) => formatNation(items.nation),
  },
  {
    title: t("Date of Birth"),
    key: "dob",
    visible: true,
    value: (items) => formatDate(items.dob),
  },
  {
    title: "Phone",
    key: t("phone"),
    visible: true,
    value: (items) => formatContact(items.phone),
  },
  { title: "Email", key: "email", visible: true },
  {
    title: "Action",
    key: "actions",
    visible: true,
    align: "center",
    sortable: false,
  },
]);

const onDisable = async (item) => {
  try {
    const res = await api.post("students-curriculums-disable", { id: item.id });
    if (res.data.status) {
      dataTableRef.value.reload();
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to disable student:", error);
  }
};

const onDelete = async (item) => {
  try {
    const res = await api.post("students-curriculums-delete", { id: item.id });

    if (res.data.status) {
      dataTableRef.value.reload();
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  }
};

const onCreate = async (data, callback) => {
  try {
    isLoading.value = true;

    const res = await api.post("student-enroll-store", data);

    if (res.data.status) {
      dataTableRef.value.reload();
      isDialogVisible.value = false;
    } else {
      console.error("Error with the response:", res.data);
    }
    callback(res.data.status);
  } catch (error) {
    console.error("Failed to fetch data:", error);
    callback(false);
  } finally {
    isLoading.value = false;
  }
};

const onEdit = async (item) => {
  router.push({ name: "admin-students-edit-id", params: { id: item.id } });
};
</script>

<template>
  <AddEditStudentEnrollDialog
    v-model:isDialogVisible="isDialogVisible"
    :item-data="formData"
    :loading="isLoading"
    @on-create="onCreate"
  />

  <!-- <AddEditStudentClassDialog
    v-model:isDialogVisibleStudentClass="isDialogVisibleStudentClass"
    :loading="isLoading"
  /> -->

  <AppCardTable
    v-model:isDialogCreateVisible="isDialogVisible"
    v-model:response="response"
    ref="dataTableRef"
    title="Students"
    title-icon="tabler-user-cog"
    saveHeaderName="header-students-list"
    saveStateName="save-state-students-list"
    v-model:loading="isLoading"
    v-model:filters="filter"
    api-url="student-enroll-list"
    :headers="headers"
    is-filter
    is-excel
    is-disable
    create-dialog
    can-create="enroll-students"
    can-disable="change-active-students"
    save-state
    :is-back="false"
    @on-disable="onDisable"
  >
    <template #title>
      {{ t("Students") }}
      <span class="enroll-count ms-4">
        {{ t("Enroll") }} {{ summary.enrolled }}
      </span>
      <span class="enroll-count ms-4">
        {{ t("Not yet") }} {{ summary.notEnrolled }}
      </span>
    </template>

    <template #filter>
      <VRow class="justify-end">
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
      </VRow>
    </template>

    

    <template #[`item.photo_path`]="{ item }">
      <div class="d-flex flex-row pt-2 pb-2">
        <AppName
          :title="item.name_en"
          :sub-title="item.name_kh"
          :image="item.photo_path"
        />
      </div>
    </template>

    <template v-slot:item.is_active="{ item }">
      <AppStatusChip
        :color="item.is_active == true ? 'success' : 'error'"
        :label="item.is_active == true ? t('Study') : t('Not Study')"
      />
    </template>
  </AppCardTable>
</template>

<style scoped>
.enroll-count {
  font-size: 16px;
  font-weight: 500;
  color: rgba(var(--v-theme-on-surface), 0.7);
}
</style>
