<script setup>
import AppAutocomplete from "@/@core/components/app-form-elements/AppAutocomplete.vue";
import { auth } from "@/utils/auth";
import { useSettingStore } from "@/stores/settingStore";
import { computed, ref, watch, onMounted } from "vue";
import { useI18n } from "vue-i18n";
import { useLoanStore } from "@/stores/loanStore";
import { useDisplay } from "vuetify";
import hasPermission from "@/utils/hasPermission.js";

const branches = ref(auth()?.branches || []);
const filter = ref({
  branch_id: useSettingStore().branch_id,
});
const { locale } = useI18n();
const { smAndDown } = useDisplay();

const canSeeAllBranches = computed(
  () => Number(auth()?.user?.manage_branch) === 3 && (branches.value?.length ?? 0) > 1,
);

const formatBranches = (branchList) => {
  if (canSeeAllBranches.value && branchList?.length > 1) {
    return [
      {
        name_kh: "គ្រប់សាខា",
        name_en: "All Branch",
        abbr: null,
        id: "*",
        province_code: null,
      },
      ...branchList,
    ];
  }
  return branchList || [];
};

const showBranches = computed(() => formatBranches(branches.value));

watch(
  [() => auth()?.branches, () => auth()?.user?.manage_branch],
  ([newBranches]) => {
    if (newBranches) {
      branches.value = newBranches;
    }
    setBranch();
  },
  { deep: true },
);

onMounted(() => {
  setBranch();
});

const setBranch = () => {
  const settingStore = useSettingStore();
  const assignedIds = (branches.value || []).map((b) => b.id);
  let branchId = settingStore.branch_id;

  const isAssigned = assignedIds.some((id) => id == branchId);
  const isAllSelected = branchId === "*";

  if ((isAllSelected && !canSeeAllBranches.value) || (!isAllSelected && !isAssigned)) {
    const userBranchId = auth()?.user?.branch_id;
    branchId = assignedIds.some((id) => id == userBranchId)
      ? userBranchId
      : assignedIds[0] ?? null;
  }

  filter.value.branch_id = branchId;
  settingStore.setBranchId(branchId);

  const selected = showBranches.value.find((i) => i.id == branchId);

  settingStore.setBranchAbbr(selected?.abbr);
  settingStore.setBranchProvinceCode(selected?.province_code);
};

const changeBranch = (id) => {
  useSettingStore().setBranchId(id);
  const loan = useLoanStore();
  const branchAbbr = showBranches.value.find((i) => i.id == id)?.abbr;
  const provinceCode = showBranches.value.find((i) => i.id == id)?.province_code;
  useSettingStore().setBranchAbbr(branchAbbr);
  useSettingStore().setBranchProvinceCode(provinceCode);

  if (hasPermission("view-loans")) {
    loan.fetchApprovalCount();
    loan.fetchCollectCount();
  }
};

const getItemTitle = (item) => {
  const name = item[locale.value === "km" ? "name_kh" : "name_en"];
  return item.abbr ? `${name} (${item.abbr})` : name;
};

const getSelectionLabel = (item) => {
  const raw = item?.raw ?? item;
  if (smAndDown.value) {
    return raw.abbr || getItemTitle(raw);
  }
  return getItemTitle(raw);
};

const fieldStyle = computed(() =>
  smAndDown.value
    ? { width: "88px", minWidth: "88px", maxWidth: "110px" }
    : { width: "230px", minWidth: "180px", maxWidth: "230px" },
);
</script>

<template>
  <div class="navbar-branches d-flex align-center">
    <AppAutocomplete
      class="branch-autocomplete"
      :class="{
        'single-branch': branches.length === 1,
        'is-compact': smAndDown,
      }"
      v-model="filter.branch_id"
      :items="showBranches"
      :item-title="getItemTitle"
      item-value="id"
      density="compact"
      hide-details
      :readonly="branches.length <= 1"
      :disabled="branches.length === 1"
      @update:model-value="(value) => changeBranch(value)"
      autocomplete="off"
      :style="fieldStyle"
    >
      <template #selection="{ item }">
        <span class="selection-label text-truncate">
          {{ getSelectionLabel(item) }}
        </span>
      </template>
    </AppAutocomplete>
  </div>
</template>

<style scoped>
.navbar-branches {
  margin-inline-end: 8px;
}

.branch-autocomplete.single-branch :deep(.v-field.v-field--disabled) {
  background-color: transparent !important;
  color: inherit !important;
  opacity: 1 !important;
  cursor: default !important;
}

.branch-autocomplete.is-compact :deep(.v-field__input) {
  padding-inline: 8px;
}

.branch-autocomplete.is-compact :deep(.v-select__selection) {
  margin-inline-end: 0;
}

.selection-label {
  display: inline-block;
  max-width: 100%;
  font-weight: 500;
}
</style>
