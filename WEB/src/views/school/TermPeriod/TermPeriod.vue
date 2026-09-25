<script setup>
import { useI18n } from "vue-i18n";
import { api } from "@/utils/api";
import { useDisplay } from "vuetify";
import { useRouter } from "vue-router";
import AddEditTermPeriodDialog from "./AddEditTermPeriodDialog.vue";
import formatDate from "@/utils/formater/formatDate";

const router = useRouter();
const { mdAndUp } = useDisplay();

definePage({
  meta: {
    title: "Term Period",
    layout: "default",
    subject: "Auth",
    requiresAuth: true,
    layoutWrapperClasses: "layout-content-height-fixed",
  },
});

const { t } = useI18n();
const formData = ref({});
const isDialogVisible = ref(false);
const isLoading = ref(true);
const dataTableRef = ref(null);

const filter = ref({
  search: null,
});

const headers = [
  { title: t("Name Khmer"), key: "name_kh", visible: true },
  { title: t("Name English"), key: "name_en", visible: true },
  {
    title: t("Start Date"),
    key: "start_date",
    visible: true,
    value: (item) => formatDate(item.start_date),
  },
  {
    title: t("End Date"),
    key: "end_date",
    visible: true,
    value: (item) => formatDate(item.end_date),
  },
  { title: t("Months"), key: "lists_count", visible: true },
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
    const res = await api.post("term-periods-delete", { id: item.id });
    if (res.data.status) {
      dataTableRef.value.reload();
    }
  } catch (error) {
    console.error("Failed to delete term period:", error);
  } finally {
    isLoading.value = false;
  }
};

const onCreate = async (data, callback) => {
  try {
    isLoading.value = true;
    const res = await api.post("term-periods-store", data);
    if (res.data.status) {
      dataTableRef.value.reload();
      isDialogVisible.value = false;
    }
    callback(res.data.status);
  } catch (error) {
    console.error("Failed to create term period:", error);
    callback(false);
  } finally {
    isLoading.value = false;
  }
};

const onEdit = async (item) => {
  try {
    isLoading.value = true;
    const res = await api.post("term-periods-show", { id: item.id });
    if (res.data.status) {
      const payload = res.data.data;
      formData.value = payload?.term_period ?? payload;
      isDialogVisible.value = true;
    }
  } catch (error) {
    console.error("Failed to fetch term period:", error);
  } finally {
    isLoading.value = false;
  }
};

const onUpdate = async (data, callback) => {
  try {
    isLoading.value = true;
    const res = await api.post("term-periods-update", data);
    if (res.data.status) {
      dataTableRef.value.reload();
      isDialogVisible.value = false;
    }
    callback(res.data.status);
  } catch (error) {
    console.error("Failed to update term period:", error);
    callback(false);
  } finally {
    isLoading.value = false;
  }
};

const onView = (item) => {
  router.push({ name: "school-term-period-id", params: { id: item.id } });
};
</script>

<template>
  <AddEditTermPeriodDialog
    v-model:isDialogVisible="isDialogVisible"
    :item-data="formData"
    :loading="isLoading"
    @on-create="onCreate"
    @on-update="onUpdate"
  />

  <AppCardTable
    v-model:isDialogCreateVisible="isDialogVisible"
    ref="dataTableRef"
    :title="t('Term Period')"
    title-icon="tabler-calendar-event"
    saveHeaderName="header-term-periods-list"
    saveStateName="save-state-term-periods-list"
    v-model:loading="isLoading"
    v-model:filters="filter"
    api-url="term-periods-list"
    :headers="headers"
    is-filter
    is-excel
    is-edit
    is-delete
    is-view
    create-dialog
    can-create="add-term-periods"
    can-edit="edit-term-periods"
    can-delete="delete-term-periods"
    can-view="view-term-periods"
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

    <template #item.lists_count="{ item }">
      <VChip
        :color="item.lists_count > 0 ? 'success' : 'default'"
        size="small"
        variant="tonal"
      >
        {{ item.lists_count ?? 0 }}
      </VChip>
    </template>
  </AppCardTable>
</template>
