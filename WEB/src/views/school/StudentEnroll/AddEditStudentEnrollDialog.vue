<script setup>
import { ref, watch, onMounted, computed } from "vue";
import { debounce } from "lodash";
import { useI18n } from "vue-i18n";

import { api } from "@/utils/api";
import formatGender from "@/utils/formater/formatGender";
import { useSettingStore } from "@/stores/settingStore";

import { useDisplay } from "vuetify/lib/composables/display.mjs";
import AppAddEditDrawer from "@/components/AppAddEditDrawer.vue";
import AppName from "@/components/AppName.vue";

import { getBranches } from "@/services/dataService";

const branches = ref([]);

const filter = ref({
    search:"",
    branch_id:null,
}
)


const { xs } = useDisplay();

const { t } = useI18n();

const loadingtable = ref(false);

const props = defineProps({
  itemData: {
    type: Object,
    required: false,
    default: () => ({}),
  },
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
  loading: {
    type: Boolean,
    required: false,
    skipCheck: true,
    default: undefined,
  },
});

const emit = defineEmits(["onCreate", "onUpdate", "update:isDialogVisible"]);

const students = ref([]);

const itemData = ref({
  student_id: [],
  ...props.itemData,
});

const getAllStudents = async () => {
  if (!props.isDialogVisible) return;
  try {
    loadingtable.value = true;
    const res = await api.post("student-not-yet-enroll", {
      branch_id: filter.value.branch_id,
      search: filter.value.search || null,
    });
    students.value = res.data.data ?? [];
  } catch (error) {
    if (error.code === "ERR_CANCELED" || error.name === "CanceledError") return;
    console.error("Failed to fetch data:", error);
  } finally {
    loadingtable.value = false;
  }
};

const debouncedGetStudents = debounce(() => {
  getAllStudents();
}, 400);


watch(
  () => filter.value.branch_id,
  () => {
    if (!props.isDialogVisible) return;
    getAllStudents();
  },
);

watch(
  () => filter.value.search,
  () => {
    if (!props.isDialogVisible) return;
    debouncedGetStudents();
  },
);

watch(
  () => props.itemData,
  (newData) => {
    itemData.value = {
      student_id: newData?.student_id ?? [],
      ...newData,
    };
  },
  { deep: true },
);

const resetData = () => {
  itemData.value = {
    student_id: [],
  };
};

const onFormSubmit = debounce(async () => {
  if (!itemData.value.student_id?.length) return;

  const itemId = itemData.value.id || null;
  if (itemId) {
    emit("onUpdate", itemData.value, (res) => {
      if (res) {
        resetData();
      }
    });
  } else {
    emit("onCreate", itemData.value, (res) => {
      if (res) {
        resetData();
      }
    });
  }
}, 500);

const onCloseDialog = () => {
  resetData();
  emit("update:isDialogVisible", false);
};

const headers = computed(() => [
  {
    title: xs.value ? t("Student") : t("Student"),
    key: "name_en",
    visible: true,
  },
  {
    title: xs.value ? t("Gender") : t("Gender"),
    key: "gender",
    visible: true,
    value: (item) => formatGender(item.gender, t),
  },
  {
    title: xs.value ? t("Dob") : t("Date of Birth"),
    key: "dob",
    visible: true,
    value: (item) => formatDate(item.dob),
  },
]);

onMounted(async () => {
//   getAllStudents();
  branches.value = await getBranches();
});

watch(
  () => props.isDialogVisible,
  async (open) => {
    if (!open) return;
    filter.value = { search: "", branch_id: null }; // optional reset
    await getAllStudents();
    if (!branches.value.length) {
      branches.value = await getBranches();
    }
  },
);
</script>

<template>
  <AppAddEditDialog
    v-if="!xs"
    max-width="700"
    :title="itemData.id == null ? t('Add Student') : t('Update Student')"
    :is-dialog-visible="isDialogVisible"
    :is-update="itemData.id != null ? true : false"
    :loading="loading"
    :show-tour-help="!itemData.id"
    @on-tour-help="startAssignDialogTour({ force: true })"
    @on-close-dialog="onCloseDialog"
    @on-submit="onFormSubmit"
  >
    <VRow>
        <VCol  cols="12" md="6">
            <VSelect
                :label="t('Branch')"
                :items="branches"
                item-title="name_en"
                item-value="id"
                v-model="filter.branch_id"
            />
        </VCol>
        <VCol  cols="12" md="6">
            <VTextField
                v-model="filter.search"
                :label="t('Search')"
            />
        </VCol>
      <VCol id="page-tour-student-curriculum-select" cols="12" md="12">
        <VDataTable
          :loading="loadingtable"
          v-model="itemData.student_id"
          item-value="id"
          :headers="headers"
          :items="students"
          show-select
        />
      </VCol>
    </VRow>
  </AppAddEditDialog>

  <AppAddEditDrawer
    v-else
    max-width="700"
    :title="itemData.id == null ? t('Add Student') : t('Update Student')"
    :is-dialog-visible="isDialogVisible"
    :is-update="itemData.id != null ? true : false"
    :loading="loading"
    :show-tour-help="!itemData.id"
    @on-tour-help="startAssignDialogTour({ force: true })"
    @on-close-dialog="onCloseDialog"
    @on-submit="onFormSubmit"
  >
    <VRow>
      <VCol id="page-tour-student-curriculum-select" cols="12" md="12">
        <VDataTable
          :loading="loadingtable"
          v-model="itemData.student_id"
          item-value="id"
          :headers="headers"
          :items="students"
          show-select
        >
          <template #[`item.name_en`]="{ item }">
            <div class="d-flex flex-row pt-2 pb-2">
              <AppName
                :title="item.name_kh"
                :sub-title="item.name_en"
                :image="item.photo_path"
              />
            </div>
          </template>
        </VDataTable>
      </VCol>
    </VRow>
  </AppAddEditDrawer>
</template>
