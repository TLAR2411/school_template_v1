<script setup>
import { ref } from 'vue';
import { api } from '@/utils/api';
import { useI18n } from "vue-i18n";
import AppCardTable from '@/components/AppCardTable.vue';
import formatDate from "@/utils/formater/formatDate";
import formatGender from "@/utils/formater/formatGender";
import formatNation from "@/utils/formater/formatNation";
import formatContact from "@/utils/formater/formatContact";
import { useRouter } from 'vue-router';

const router = useRouter();

definePage({
  meta: {
    title: "Student List",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    // permissions: "view-products",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});

const { t, locale } = useI18n();

const headers = ref([
{ title: "Photo", key: "photo_path", visible: true },

{ title: "Gender", key: "gender", visible: true,value:(items)=>formatGender(items.gender) },
{ title: "Nationality", key: "nation", visible: true, value:(items)=>formatNation(items.nation) },
{ title: "Date of Birth", key: "dob", visible: true,value:(items)=>formatDate(items.dob) },
{ title: "Phone", key: "phone", visible: true,value:(items)=>formatContact(items.phone) },
{ title: "Email", key: "email", visible: true },
{
  title: "Action",key: "actions", visible: true,align: "center",sortable: false,
}
])

const dataTableRef = ref(null);

const isLoading = ref(true);

const isDialogVisible = ref(false);

const filter = ref({
  search: null,
});

const onEdit = async (item) => {
  router.push({ name: "admin-students-edit-id", params: { id: item.id } });
};

const onDisable = async (item) => {
  try {
    // isLoading.value = true;
    const res = await api.post("students-disable", { id: item.id });
    if (res.data.status) {
      dataTableRef.value.reload();
    } else {
      console.error("Error with the response:", res.data);
    }
  } catch (error) {
    console.error("Failed to disable student:", error);
  } finally {
    // isLoading.value = false;
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
  } finally {
    // isLoading.value = false;
  }
};


</script>

<template>
    <AppCardTable
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
      is-filter
      is-excel
      is-edit
      is-back
      is-delete
      is-disable
      create-dialog
      create-page="admin-students-create"
      save-state
      @on-delete="onDelete"
      @on-edit="onEdit"
      @on-disable="onDisable"
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
  
      <!-- <template v-slot:item.is_active="{ item }">
        <AppStatusChip
          :color="item.is_active == true ? 'success' : 'error'"
          :label="item.is_active == true ? t('Study') : t('Not Study')"
        />
      </template> -->
    </AppCardTable>
  </template>