<script setup>
import { api } from "@/utils/api";
import { useDialog } from "@/composables/useDialog";
import hasPermission from "@/utils/hasPermission";
import { formatPermissionLabel } from "@/utils/permissionName";
import AddEditPermissionDialog from "@/views/admin/permissions/AddEditPermissionDialog.vue";
import { useI18n } from "vue-i18n";

const { t } = useI18n();
const { showDialog } = useDialog();

const isLoading = ref(false);
const isDialogVisible = ref(false);
const search = ref("");
const openPanels = ref([]);
const groups = ref([]);
const formData = ref({});

const totalPermissions = computed(() =>
  groups.value.reduce((sum, group) => sum + group.count, 0),
);

const groupNames = computed(() => groups.value.map((group) => group.name));

const filteredGroups = computed(() => {
  const q = search.value.trim().toLowerCase();

  if (!q) return groups.value;

  return groups.value
    .map((group) => {
      const items = group.items.filter((item) => {
        return (
          group.name.toLowerCase().includes(q) ||
          String(item.name || "").toLowerCase().includes(q) ||
          String(item.display_name || "").toLowerCase().includes(q) ||
          String(item.description || "").toLowerCase().includes(q)
        );
      });

      return {
        ...group,
        items,
        count: items.length,
      };
    })
    .filter((group) => group.count > 0);
});

watch(filteredGroups, (value) => {
  if (!search.value.trim()) return;

  openPanels.value = value.map((group) => group.name);
});

const loadPermissions = async () => {
  isLoading.value = true;

  try {
    const res = await api.post("permissions-list");

    if (res.data.status) {
      groups.value = res.data.data?.groups || [];
    }
  } catch (error) {
    console.error("Failed to load permissions:", error);
  } finally {
    isLoading.value = false;
  }
};

const openCreate = (groupName = "") => {
  formData.value = {
    id: null,
    group: groupName,
    display_name: "",
    name: "",
    description: "",
  };
  isDialogVisible.value = true;
};

const onEdit = (item) => {
  formData.value = { ...item };
  isDialogVisible.value = true;
};

const onSave = async (endpoint, data, callback) => {
  isLoading.value = true;

  try {
    const res = await api.post(endpoint, data);

    if (res.data.status) {
      isDialogVisible.value = false;
      await loadPermissions();
    }

    callback(res.data.status);
  } catch (error) {
    console.error("Failed to save permission:", error);
    callback(false);
  } finally {
    isLoading.value = false;
  }
};

const onCreate = (data, callback) =>
  onSave("permissions-store", data, callback);

const onUpdate = (data, callback) =>
  onSave("permissions-update", data, callback);

const onDelete = async (item) => {
  const confirmed = await showDialog({
    title: t("Delete Item?"),
    icon: "delete",
    confirmColor: "error",
    confirmText: t("Delete"),
  });

  if (!confirmed) return;

  isLoading.value = true;

  try {
    const res = await api.post("permissions-delete", { id: item.id });

    if (res.data.status) {
      await loadPermissions();
    }
  } catch (error) {
    console.error("Failed to delete permission:", error);
  } finally {
    isLoading.value = false;
  }
};

onMounted(loadPermissions);
</script>

<template>
  <AddEditPermissionDialog
    v-model:isDialogVisible="isDialogVisible"
    :loading="isLoading"
    :item-data="formData"
    :groups="groupNames"
    @on-create="onCreate"
    @on-update="onUpdate"
  />

  <VCard class="permission-page">
    <VCardItem class="permission-page__header">
      <div class="d-flex align-center justify-space-between flex-wrap gap-3 w-100">
        <div class="d-flex align-center gap-3">
          <VAvatar rounded color="primary" variant="tonal" size="40">
            <VIcon icon="tabler-key" size="22" />
          </VAvatar>
          <div>
            <div class="text-h6">{{ $t("Permissions") }}</div>
            <div class="text-body-2 text-medium-emphasis">
              {{ totalPermissions }} {{ $t("permissions") }} ·
              {{ groups.length }} {{ $t("groups") }}
            </div>
          </div>
        </div>

        <div class="d-flex align-center gap-3 flex-wrap">
          <VTextField
            v-model="search"
            :placeholder="$t('Search')"
            prepend-inner-icon="tabler-search"
            clearable
            clear-icon="tabler-x"
            hide-details
            density="compact"
            style="min-width: 220px"
          />

          <VBtn
            v-if="hasPermission('add-permissions')"
            color="primary"
            prepend-icon="tabler-plus"
            @click="openCreate()"
          >
            {{ $t("Create") }}
          </VBtn>
        </div>
      </div>
    </VCardItem>

    <VDivider />

    <VCardText>
      <VProgressLinear v-if="isLoading" indeterminate class="mb-4" />

      <VExpansionPanels v-model="openPanels" multiple>
        <VExpansionPanel
          v-for="group in filteredGroups"
          :key="group.name"
          :value="group.name"
          elevation="0"
          class="permission-group mb-2"
        >
          <VExpansionPanelTitle>
            <div class="d-flex align-center w-100 pe-2">
              <span class="text-body-1 font-weight-medium">
                {{ formatPermissionLabel(group.name) }}
              </span>
              <VChip size="small" variant="tonal" class="ms-2">
                {{ group.count }}
              </VChip>
              <VSpacer />
              <VBtn
                v-if="hasPermission('add-permissions')"
                icon
                size="x-small"
                variant="text"
                color="primary"
                @click.stop="openCreate(group.name)"
              >
                <VIcon icon="tabler-plus" />
                <VTooltip activator="parent">{{ $t("Add Permission") }}</VTooltip>
              </VBtn>
            </div>
          </VExpansionPanelTitle>

          <VExpansionPanelText>
            <VList v-if="group.items.length" class="py-0">
              <VListItem
                v-for="item in group.items"
                :key="item.id"
                class="px-0"
              >
                <VListItemTitle class="d-flex align-center flex-wrap gap-2">
                  <span>{{ formatPermissionLabel(item.display_name) }}</span>
                  <VChip size="x-small" variant="outlined">
                    {{ item.name }}
                  </VChip>
                </VListItemTitle>
                <VListItemSubtitle v-if="item.description">
                  {{ item.description }}
                </VListItemSubtitle>

                <template #append>
                  <IconBtn
                    v-if="hasPermission('edit-permissions')"
                    size="small"
                    @click="onEdit(item)"
                  >
                    <VIcon icon="tabler-edit" size="20" />
                  </IconBtn>
                  <IconBtn
                    v-if="hasPermission('delete-permissions')"
                    size="small"
                    color="error"
                    @click="onDelete(item)"
                  >
                    <VIcon icon="tabler-trash" size="20" />
                  </IconBtn>
                </template>
              </VListItem>
            </VList>
          </VExpansionPanelText>
        </VExpansionPanel>
      </VExpansionPanels>

      <div
        v-if="!isLoading && !filteredGroups.length"
        class="text-center py-10 text-medium-emphasis"
      >
        <VIcon icon="tabler-search-off" size="40" class="mb-2" />
        <div>{{ $t("No permissions found") }}</div>
      </div>
    </VCardText>
  </VCard>
</template>

<style scoped>
.permission-page__header {
  background-color: rgba(211, 211, 211, 0.2);
}

.permission-group {
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 8px;
}
</style>
