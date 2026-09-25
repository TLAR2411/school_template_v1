<script setup>
import { useI18n } from "vue-i18n";
import { ref, onMounted } from "vue";
import { api } from "@/utils/api";
import { useDisplay } from "vuetify";
import AppName from "@/components/AppName.vue";
import formatGender from "@/utils/formater/formatGender";
import formatDate from "@/utils/formater/formatDate";
import { useRouter } from "vue-router";
import AddEditStudentClassDialog from "./AddEditStudentClassDialog.vue";

const props = defineProps({
  payload: {
    type: Object,
    default: () => ({}),
  },
  classData: {
    type: Object,
    default: () => ({}),
  },
});

const router = useRouter();
const { mdAndUp } = useDisplay();
const { t } = useI18n();

const dataTableRef = ref(null);
const isDialogVisibleStudentClass = ref(false);
const formDataStudentClass = ref([]);
const isLoading = ref(true);
const filter = ref({ search: null });
const selectStudents = ref([]);
const class_id = ref(props.payload?.class_id);

const headers = ref([
  { title: t("photo"), key: "photo_path", visible: true },
  {
    title: t("Gender"),
    key: "gender",
    visible: true,
    value: (item) => formatGender(item.gender),
  },
  {
    title: t("date_of_birth"),
    key: "dob",
    visible: true,
    value: (item) => formatDate(item.dob),
  },
  { title: t("Nation"), key: "nation", visible: true },
  {
    title: t("Action"),
    key: "actions",
    align: "center",
    visible: true,
    fixed: mdAndUp.value,
  },
]);

const onDelete = async (item) => {
  try {
    const res = await api.post("students-classes-delete", { id: item.id });
    if (res.data.status) {
      dataTableRef.value?.reload();
      await getStudentAvailable();
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  }
};

const onCreateStudentClass = async (data, callback) => {
  const payload = {
    student_id: data.student_id || [],
    class_id: class_id.value,
  };

  try {
    isLoading.value = true;
    const res = await api.post("student-class-store", payload);

    if (res.data.status) {
      dataTableRef.value?.reload();
      isDialogVisibleStudentClass.value = false;
      await getStudentAvailable();
    } else {
      console.error("Error with the response:", res.data);
    }
    callback?.(res.data.status);
  } catch (error) {
    console.error("Failed to fetch data:", error);
    callback?.(false);
  } finally {
    isLoading.value = false;
  }
};

const getStudentAvailable = async () => {
  try {
    const res = await api.post("student-not-yet-enroll-class", {
      class_id: class_id.value,
    });
    if (res.data.status) {
      formDataStudentClass.value = res.data.data ?? [];
    }
  } catch (error) {
    console.error(error);
  }
};

const onDeleteSelected = async () => {
  if (!selectStudents.value.length) return;

  try {
    const res = await api.post("students-classes-delete", {
      id: selectStudents.value,
    });
    if (res.data.status) {
      selectStudents.value = [];
      dataTableRef.value?.reload();
      await getStudentAvailable();
    }
  } catch (error) {
    console.error("Failed to delete selected:", error);
  }
};

onMounted(() => {
  getStudentAvailable();
});
</script>

<template>
  <AddEditStudentClassDialog
    v-model:isDialogVisibleStudentClass="isDialogVisibleStudentClass"
    :loading="isLoading"
    :item-data="formDataStudentClass"
    :class-data="classData"
    @on-create-student-class="onCreateStudentClass"
  />

  <AppCardTable
    v-model="selectStudents"
    v-model:isDialogCreateVisible="isDialogVisibleStudentClass"
    ref="dataTableRef"
    title="Students"
    title-icon="tabler-user-cog"
    saveHeaderName="header-students-list"
    saveStateName="save-state-students-list"
    v-model:loading="isLoading"
    v-model:filters="filter"
    api-url="student-class-list"
    :api-data="payload"
    :headers="headers"
    is-filter
    is-excel
    is-delete
    is-delete-selected
    item-value="id"
    show-select
    create-dialog
    can-create="add-student-classes"
    can-delete="delete-student-classes"
    save-state
    @on-delete="onDelete"
    @on-delete-selected="onDeleteSelected"
  >
    <template #filter>
      <VRow class="justify-end">
        <VCol cols="12" sm="6" md="4" lg="2">
          <VTextField
            v-model="filter.search"
            :label="t('Search')"
            prepend-inner-icon="tabler-search"
            clearable
            hide-details
            autocomplete="off"
            clear-icon="tabler-x"
          />
        </VCol>
      </VRow>
    </template>

    <template #[`item.photo_path`]="{ item }">
      <div class="d-flex flex-row pt-2 pb-2">
        <AppName
          :title="item.name_kh"
          :sub-title="item.name_en"
          :image="item.photo_path"
        />
      </div>
    </template>
  </AppCardTable>
</template>
