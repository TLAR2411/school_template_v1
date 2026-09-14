<script setup>
import { computed, ref, watch } from "vue";
import { useI18n } from "vue-i18n";
import AppAutocomplete from "@/@core/components/app-form-elements/AppAutocomplete.vue";
import { getBranches } from "@/services/dataService";
import { api } from "@/utils/api";

const props = defineProps({
  modelValue: {
    type: Array,
    default: () => [],
  },
  /** Student IDs already linked — hidden from options */
  excludeIds: {
    type: Array,
    default: () => [],
  },
  rules: {
    type: Array,
    default: () => [],
  },
  /** Load branches when parent dialog opens */
  active: {
    type: Boolean,
    default: false,
  },
  disabled: {
    type: Boolean,
    default: false,
  },
});

const emit = defineEmits(["update:modelValue"]);

const { t } = useI18n();

const branches = ref([]);
const selectedBranch = ref(null);
const students = ref([]);
const loadingStudents = ref(false);
const studentSearchQuery = ref("");

const selectedIds = computed({
  get: () => props.modelValue,
  set: (value) => emit("update:modelValue", value ?? []),
});

const excludeSet = computed(
  () => new Set((props.excludeIds || []).map(Number)),
);

const studentOptions = computed(() =>
  students.value.filter((s) => !excludeSet.value.has(Number(s.id))),
);

const selectedBranchLabel = computed(() => {
  if (selectedBranch.value == null || selectedBranch.value === "") return "";
  const found = branches.value.find(
    (b) => Number(b.id) === Number(selectedBranch.value),
  );
  return found?.name_en || found?.name_kh || "";
});

const fetchStudents = async (search = "") => {
  if (!selectedBranch.value) {
    students.value = [];
    return;
  }

  const q = String(search || "").trim();

  try {
    loadingStudents.value = true;
    const res = await api.post("students-all", {
      branch_id: selectedBranch.value,
      ...(q ? { search: q } : {}),
    });

    const data = res.data?.data;
    students.value = Array.isArray(data) ? data : (data?.data ?? []);
  } catch (error) {
    if (error.code === "ERR_CANCELED" || error.name === "CanceledError") return;
    console.error(error);
    students.value = [];
  } finally {
    loadingStudents.value = false;
  }
};

const onStudentSearch = (query) => {
  studentSearchQuery.value = query;
  fetchStudents(query);
};

const reset = () => {
  selectedBranch.value = null;
  students.value = [];
  studentSearchQuery.value = "";
};

watch(selectedBranch, (branchId) => {
  if (!branchId) {
    students.value = [];
    return;
  }
  fetchStudents(studentSearchQuery.value);
});

const ensureBranches = async () => {
  if (branches.value.length) return;
  const data = await getBranches();
  branches.value = Array.isArray(data) ? data : [];
};

watch(
  () => props.active,
  async (open) => {
    if (!open) {
      students.value = [];
      return;
    }
    await ensureBranches();
  },
  { immediate: true },
);

defineExpose({ reset });
</script>

<template>
  <AppAutocomplete
    v-model="selectedIds"
    :items="studentOptions"
    :loading="loadingStudents"
    item-title="name_en"
    item-value="id"
    :label="t('Students')"
    :rules="rules"
    :disabled="disabled"
    multiple
    chips
    clearable
    server-side
    :select-on-enter="false"
    :debounce="400"
    autocomplete="off"
    persistent-hint
    @search="onStudentSearch"
  >
    <template #search-prepend>
      <VSelect
        :key="`branch-${selectedBranch ?? 'none'}`"
        v-model="selectedBranch"
        :items="branches"
        item-title="name_en"
        item-value="id"
        :placeholder="t('Branch')"
        density="compact"
        variant="plain"
        hide-details
        clearable
        :disabled="disabled"
        :menu-props="{ zIndex: 2500 }"
        @click.stop="ensureBranches"
        @mousedown.stop
        @focus="ensureBranches"
      >
        <template #selection>
          <span class="text-truncate">
            {{ selectedBranchLabel || t("Branch") }}
          </span>
        </template>
      </VSelect>
    </template>

    <template #item="{ item, props: itemProps }">
      <VListItem
        v-bind="itemProps"
        :title="
          [item.raw?.name_en, item.raw?.name_kh].filter(Boolean).join(' ') ||
          item.title
        "
      />
    </template>
  </AppAutocomplete>
</template>
