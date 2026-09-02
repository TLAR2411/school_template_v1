<script setup>
import AddEditClosedDayDialog from "@/views/admin/closed-days/AddEditDialog.vue";
import { useI18n } from "vue-i18n";
import { api } from "@/utils/api";

definePage({
  meta: {
    title: "Closed Days",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-closed-days",
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});

const { t } = useI18n();
const isDialogVisible = ref(false);
const isLoading = ref(true);
const dataTableRef = ref(null);

const filter = ref({
  search: null,
});

const formData = ref({});

const headers = [
  // { title: t("ID"), sortable: false, key: "id" },
  { title: t("Date"), key: "date" },
  {
    title: t("Type"),
    key: "is_public_holiday",
    value: (items) =>
      items.is_public_holiday == 1 ? "ពិធីបុណ្យជាតិ" : "ថ្ងៃឈប់សម្រាប់ធម្មតា",
  },
  { title: t("Description"), key: "description" },
  { title: t("Status"), key: "is_active", align: "center" },
  { title: t("Action"), key: "actions", align: "center" },
];

const onDelete = async (item) => {
  try {
    isLoading.value = true;

    const res = await api.post("closed-days-delete", { id: item.id });

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

const onCreate = async (data, callback) => {
  try {
    isLoading.value = true;

    const res = await api.post("closed-days-store", data);

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

const onEdit = async (item) => {
  try {
    isLoading.value = true;

    const res = await api.post("closed-days-show", { id: item.id });

    if (res.data.status) {
      formData.value = {
        ...res.data.data,
        is_public_holiday: res.data.data.is_public_holiday == 0 ? false : true,
      };
      console.log(formData.value);

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

    const res = await api.post("closed-days-update", data);

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

const onDisable = async (item) => {
  try {
    isLoading.value = true;

    const res = await api.post("closed-days-disable", { id: item.id });

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
</script>

<template>
  <AddEditClosedDayDialog
    v-model:isDialogVisible="isDialogVisible"
    :item-data="formData"
    :loading="isLoading"
    @on-create="onCreate"
    @on-update="onUpdate"
  />

  <AppCardTable
    v-model:isDialogCreateVisible="isDialogVisible"
    ref="dataTableRef"
    title="Closed Days"
    title-icon="tabler-calendar-minus"
    saveHeaderName="header-closed-days-list"
    saveStateName="save-state-closed-days-list"
    v-model:loading="isLoading"
    v-model:filters="filter"
    api-url="closed-days-list"
    :headers="headers"
    is-filter
    is-excel
    is-edit
    is-delete
    is-disable
    create-dialog
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

    <template v-slot:item.is_active="{ item }">
      <VChip color="success" size="small" v-if="item.is_active == true">
        {{ $t("Active") }}
      </VChip>
      <VChip color="error" size="small" v-if="item.is_active == false">
        {{ $t("Inactive") }}
      </VChip>
    </template>
  </AppCardTable>
</template>
