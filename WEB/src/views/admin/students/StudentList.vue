<script setup>
import { ref } from "vue";
import { api } from "@/utils/api";
import { useI18n } from "vue-i18n";
import AppCardTable from "@/components/AppCardTable.vue";
import formatDate from "@/utils/formater/formatDate";
import formatGender from "@/utils/formater/formatGender";
import formatNation from "@/utils/formater/formatNation";
import formatContact from "@/utils/formater/formatContact";
import { useRouter } from "vue-router";
import { useDialog } from "@/composables/useDialog";
import hasPermission from "@/utils/hasPermission";

const router = useRouter();
const { showDialog } = useDialog();

definePage({
  meta: {
    title: "Student List",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});

const { t } = useI18n();

const headers = ref([
  { title: "Photo", key: "photo_path", visible: true },
  {
    title: "Gender",
    key: "gender",
    visible: true,
    value: (items) => formatGender(items.gender),
  },
  {
    title: "Nationality",
    key: "nation",
    visible: true,
    value: (items) => formatNation(items.nation),
  },
  {
    title: "Date of Birth",
    key: "dob",
    visible: true,
    value: (items) => formatDate(items.dob),
  },
  {
    title: "Phone",
    key: "phone",
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

const dataTableRef = ref(null);
const isLoading = ref(true);
const isDialogVisible = ref(false);
const selectStudents = ref([]);
const isDeletingMany = ref(false);

const filter = ref({
  search: null,
});

const selectedIds = () =>
  selectStudents.value.map((row) => (typeof row === "object" ? row.id : row));

const onEdit = async (item) => {
  router.push({ name: "admin-students-edit-id", params: { id: item.id } });
};

const onDisable = async (item) => {
  try {
    const res = await api.post("students-disable", { id: item.id });
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
    const res = await api.post("students-delete", { id: item.id });
    if (res.data.status) {
      dataTableRef.value.reload();
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to fetch data:", error);
  }
};

const onDeleteSelected = async () => {
  const ids = selectedIds();
  if (!ids.length) return;

  const ok = await showDialog({
    title: t("Delete selected students?"),
    icon: "delete",
    confirmColor: "error",
    confirmText: "Delete",
  });
  if (!ok) return;

  try {
    isDeletingMany.value = true;
    const res = await api.post("students-delete-many", { ids });
    if (res.data.status) {
      selectStudents.value = [];
      dataTableRef.value?.reload();
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to delete selected students:", error);
  } finally {
    isDeletingMany.value = false;
  }
};
</script>

<template>
  <AppCardTable
    v-model="selectStudents"
    v-model:isDialogCreateVisible="isDialogVisible"
    ref="dataTableRef"
    title="Students"
    title-icon="tabler-user-cog"
    saveHeaderName="header-students-list"
    saveStateName="save-state-students-list"
    v-model:loading="isLoading"
    v-model:filters="filter"
    api-url="students-list"
    :headers="headers"
    item-value="id"
    show-select
    is-filter
    is-excel
    is-edit
    is-back
    is-delete
    is-disable
    create-dialog
    create-page="admin-students-create"
    can-create="add-students"
    can-edit="edit-students"
    can-delete="delete-students"
    can-disable="change-active-students"
    save-state
    @on-delete="onDelete"
    @on-edit="onEdit"
    @on-disable="onDisable"
  >
    <template #card-header>
      <VBtn
        v-if="
          selectStudents.length &&
          hasPermission('delete-students')
        "
        color="error"
        variant="tonal"
        size="small"
        class="mr-2"
        :loading="isDeletingMany"
        @click="onDeleteSelected"
      >
        <VIcon icon="tabler-trash" start />
        {{ t("Delete") }} ({{ selectStudents.length }})
      </VBtn>
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
            autocomplete="off"
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
  </AppCardTable>
</template>
