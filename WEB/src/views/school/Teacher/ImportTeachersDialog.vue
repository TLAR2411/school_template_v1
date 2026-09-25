<script setup>
import { computed, ref, watch } from "vue";
import { useI18n } from "vue-i18n";
import * as XLSX from "xlsx";
import { api } from "@/utils/api";
import { getRoles } from "@/services/dataService";
import AppAutocomplete from "@/@core/components/app-form-elements/AppAutocomplete.vue";

const props = defineProps({
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
});

const emit = defineEmits(["update:isDialogVisible", "imported"]);

const { t } = useI18n();
const loading = ref(false);
const file = ref(null);
const roleId = ref(null);
const roles = ref([]);
const result = ref(null);
const selectedFile = computed(() =>
  Array.isArray(file.value) ? file.value[0] : file.value
);

const hasResultRows = computed(
  () => Array.isArray(result.value?.rows) && result.value.rows.length > 0
);

const close = () => {
  emit("update:isDialogVisible", false);
};

watch(
  () => props.isDialogVisible,
  async (visible) => {
    if (!visible) {
      return;
    }
    file.value = null;
    result.value = null;
    if (!roles.value.length) {
      roles.value = (await getRoles()) || [];
    }
  }
);

const downloadTemplate = async () => {
  try {
    loading.value = true;
    const res = await api.post(
      "teachers-import-template",
      {},
      { responseType: "blob", timeout: 60000 }
    );
    const url = window.URL.createObjectURL(new Blob([res.data]));
    const link = document.createElement("a");
    link.href = url;
    link.download = "teacher-import-template.xlsx";
    link.click();
    window.URL.revokeObjectURL(url);
  } catch (error) {
    console.error("Failed to download template:", error);
  } finally {
    loading.value = false;
  }
};

/** Export import result rows (username + password) for backup. */
const exportResults = () => {
  if (!hasResultRows.value) return;

  const rows = result.value.rows.map((row) => ({
    [t("Row")]: row.row ?? "",
    [t("Status")]: row.status ?? "",
    [t("Name")]: row.name_en ?? "",
    [t("Username")]: row.username ?? "",
    [t("Password")]: row.password ?? "",
    [t("Reason")]: row.reason ?? "",
  }));

  const ws = XLSX.utils.json_to_sheet(rows);
  const keys = Object.keys(rows[0] || {});
  ws["!cols"] = keys.map((k) => {
    const max = Math.max(
      k.length,
      ...rows.map((r) => (r[k] ? String(r[k]).length : 0))
    );
    return { wch: Math.min(Math.max(max + 2, 10), 40) };
  });

  const wb = XLSX.utils.book_new();
  XLSX.utils.book_append_sheet(wb, ws, "Import Results");

  const stamp = new Date().toISOString().slice(0, 19).replace(/[:T]/g, "-");
  XLSX.writeFile(wb, `teacher-import-results-${stamp}.xlsx`);
};

const onSubmit = async () => {
  if (!file.value) {
    return;
  }

  try {
    loading.value = true;
    const selected = Array.isArray(file.value) ? file.value[0] : file.value;
    if (!selected) {
      return;
    }

    const formData = new FormData();
    formData.append("file", selected);
    if (roleId.value) {
      formData.append("role_id", roleId.value);
    }

    const res = await api.post("teachers-import", formData, {
      timeout: 180000,
    });

    if (res.data.status) {
      result.value = res.data.data;
      emit("imported");
    }
  } catch (error) {
    console.error("Failed to import teachers:", error);
  } finally {
    loading.value = false;
  }
};
</script>

<template>
  <VDialog
    :model-value="isDialogVisible"
    max-width="760px"
    persistent
    @update:model-value="emit('update:isDialogVisible', $event)"
  >
    <VCard>
      <VCardItem style="padding-top: 12px; padding-bottom: 12px">
        <span style="font-size: 18px">
          <VIcon icon="tabler-upload" />
          {{ t("Import Teachers") }}
        </span>
      </VCardItem>
      <VDivider />
      <VCardText>
        <p class="text-medium-emphasis mb-4">
          {{
            t(
              "Upload an Excel file. Each row creates a teacher and a login user automatically."
            )
          }}
        </p>

        <VBtn
          class="mb-4"
          variant="tonal"
          color="primary"
          prepend-icon="tabler-download"
          :loading="loading"
          @click="downloadTemplate"
        >
          {{ t("Download template") }}
        </VBtn>

        <VFileInput
          v-model="file"
          accept=".xlsx,.xls,.csv"
          prepend-icon="tabler-file-spreadsheet"
          :label="t('Excel file')"
          show-size
          clearable
        />

        <AppAutocomplete
          v-model="roleId"
          class="mt-2"
          :label="t('Default role (optional)')"
          :items="roles"
          item-title="display_name"
          item-value="id"
          clearable
        />

        <div v-if="result" class="mt-4">
          <div class="d-flex flex-wrap align-center gap-2 mb-3">
            <VChip color="success" variant="tonal">
              {{ t("Created") }}: {{ result.created }}
            </VChip>
            <VChip color="warning" variant="tonal">
              {{ t("Skipped") }}: {{ result.skipped }}
            </VChip>
            <VChip color="error" variant="tonal">
              {{ t("Failed") }}: {{ result.failed }}
            </VChip>

            <VSpacer />

            <VBtn
              v-if="hasResultRows"
              color="success"
              variant="tonal"
              size="small"
              prepend-icon="tabler-file-spreadsheet"
              @click="exportResults"
            >
              {{ t("Export results") }}
            </VBtn>
          </div>

          <VTable density="compact">
            <thead>
              <tr>
                <th>{{ t("Row") }}</th>
                <th>{{ t("Status") }}</th>
                <th>{{ t("Name") }}</th>
                <th>{{ t("Username") }}</th>
                <th>{{ t("Password") }}</th>
                <th>{{ t("Reason") }}</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="row in result.rows" :key="row.row">
                <td>{{ row.row }}</td>
                <td>
                  <VChip
                    size="small"
                    :color="
                      row.status === 'created'
                        ? 'success'
                        : row.status === 'skipped'
                          ? 'warning'
                          : 'error'
                    "
                    variant="tonal"
                  >
                    {{ row.status }}
                  </VChip>
                </td>
                <td>{{ row.name_en }}</td>
                <td>{{ row.username }}</td>
                <td>{{ row.password }}</td>
                <td>{{ row.reason }}</td>
              </tr>
            </tbody>
          </VTable>
        </div>
      </VCardText>
      <VDivider />
      <VCardText
        class="d-flex justify-space-between flex-wrap gap-3"
        style="padding-top: 12px; padding-bottom: 12px"
      >
        <VBtn variant="tonal" color="secondary" @click="close">
          <VIcon start icon="tabler-arrow-left" />
          {{ t("Close") }}
        </VBtn>
        <div class="d-flex flex-wrap gap-2">
          <VBtn
            v-if="hasResultRows"
            color="success"
            variant="tonal"
            @click="exportResults"
          >
            <VIcon start icon="tabler-file-spreadsheet" />
            {{ t("Export results") }}
          </VBtn>
          <VBtn
            color="success"
            :loading="loading"
            :disabled="!selectedFile"
            @click="onSubmit"
          >
            <VIcon start icon="tabler-upload" />
            {{ t("Import") }}
          </VBtn>
        </div>
      </VCardText>
    </VCard>
  </VDialog>
</template>
