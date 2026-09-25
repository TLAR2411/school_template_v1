<script setup>
import AddEditFamilyDialog from "./AddEditFamilyDialog.vue";
import { useI18n } from "vue-i18n";
import { api } from "@/utils/api";
import { useDisplay } from "vuetify";
import { useRouter } from "vue-router";

const router = useRouter();
const { mdAndUp } = useDisplay();
const { t } = useI18n();

const formData = ref({});
const isDialogVisible = ref(false);
const isLoading = ref(true);
const dataTableRef = ref(null);
const openingEdit = ref(false);

watch(isDialogVisible, (visible) => {
  if (visible && !openingEdit.value) {
    formData.value = {
      name_en: "",
      name_kh: "",
      description: "",
      guardians: [],
      students: [],
    };
  }
  if (!visible) {
    openingEdit.value = false;
    formData.value = {};
  }
});

const filter = ref({
  search: null,
});

const headers = [
  { title: t("Name English"), key: "name_en", visible: true },
  { title: t("Name Khmer"), key: "name_kh", visible: true },
  { title: t("Guardians"), key: "guardian_count", visible: true },
  { title: t("Students"), key: "student_count", visible: true },
  { title: t("Description"), key: "description", visible: true },
  {
    title: t("Action"),
    key: "actions",
    align: "center",
    visible: true,
    fixed: mdAndUp.value,
  },
];

const onDelete = async (item) => {
  try {
    const res = await api.post("families-delete", { id: item.id });
    if (res.data.status) {
      dataTableRef.value.reload();
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to delete family:", error);
  }
};

const onCreate = async (data, callback) => {
  try {
    isLoading.value = true;
    console.log("data", data);
    const res = await api.post("families-store", data);
    if (res.data.status) {
      dataTableRef.value.reload();
      isDialogVisible.value = false;
    } else {
      console.error("Error with the response:", res.data);
    }
    callback(res.data.status);
  } catch (error) {
    console.error("Failed to create family:", error);
    callback(false);
  } finally {
    isLoading.value = false;
  }
};

const onEdit = async (item) => {
  try {
    isLoading.value = true;
    const res = await api.post("families-show", { id: item.id });
    if (res.data.status) {
      openingEdit.value = true;
      formData.value = res.data.data; // FamilyResource
      isDialogVisible.value = true;
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to fetch family:", error);
  } finally {
    isLoading.value = false;
  }
};

const onView = (item) => {
  router.push({ name: "school-family-detail-id", params: { id: item.id } });
};

const onUpdate = async (data, callback) => {
  try {
    isLoading.value = true;
    const res = await api.post("families-update", {
      id: data.id,
      name_en: data.name_en,
      name_kh: data.name_kh,
      description: data.description,
    });

    if (res.data.status) {
      dataTableRef.value.reload();
      isDialogVisible.value = false;
      callback(true);
    } else {
      callback(false);
    }
  } catch (error) {
    console.error("Failed to update family:", error);
    callback(false);
  } finally {
    isLoading.value = false;
  }
};
</script>

<template>
  <AddEditFamilyDialog
    v-model:isDialogVisible="isDialogVisible"
    :item-data="formData"
    :loading="isLoading"
    @on-create="onCreate"
    @on-update="onUpdate"
  />

  <AppCardTable
    v-model:isDialogCreateVisible="isDialogVisible"
    ref="dataTableRef"
    title="Families"
    title-icon="tabler-home-heart"
    saveHeaderName="header-families-list"
    saveStateName="save-state-families-list"
    v-model:loading="isLoading"
    v-model:filters="filter"
    api-url="families-list"
    :headers="headers"
    is-filter
    is-edit
    is-delete
    is-view
    create-dialog
    can-create="add-families"
    can-edit="edit-families"
    can-delete="delete-families"
    can-view="view-families"
    save-state
    :is-back="false"
    @on-delete="onDelete"
    @on-edit="onEdit"
    @on-view="onView"
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
  </AppCardTable>
</template>
