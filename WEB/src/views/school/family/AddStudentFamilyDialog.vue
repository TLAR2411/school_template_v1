<script setup>
import { ref, watch } from "vue";
import { debounce } from "lodash";
import { useI18n } from "vue-i18n";
import { useDisplay } from "vuetify";
import { requiredValidator } from "@/@core/utils/validators";
import AppAddEditDrawer from "@/components/AppAddEditDrawer.vue";
import FamilyStudentSelect from "./FamilyStudentSelect.vue";

const { xs } = useDisplay();
const { t } = useI18n();

const props = defineProps({
  isDialogVisible: {
    type: Boolean,
    required: true,
  },
  loading: {
    type: Boolean,
    default: false,
  },
  /** Student IDs already in this family */
  excludeIds: {
    type: Array,
    default: () => [],
  },
});

const emit = defineEmits(["onCreate", "update:isDialogVisible"]);

const studentSelectRef = ref(null);
const studentIds = ref([]);

const resetData = () => {
  studentIds.value = [];
  studentSelectRef.value?.reset();
};

const onFormSubmit = debounce(async (refForm) => {
  const { valid } = await refForm;
  if (!valid) return;

  emit("onCreate", { student_ids: studentIds.value }, (ok) => {
    if (ok) resetData();
  });
}, 500);

const onCloseDialog = () => {
  resetData();
  emit("update:isDialogVisible", false);
};

watch(
  () => props.isDialogVisible,
  (open) => {
    if (!open) resetData();
  },
);
</script>

<template>
  <div>
    <AppAddEditDialog
      v-if="!xs"
      :title="t('Add Student')"
      :is-dialog-visible="isDialogVisible"
      :is-update="false"
      :loading="loading"
      max-width="600px"
      @on-submit="onFormSubmit"
      @on-close-dialog="onCloseDialog"
      @update:is-dialog-visible="emit('update:isDialogVisible', $event)"
    >
      <VRow>
        <VCol cols="12">
          <FamilyStudentSelect
            ref="studentSelectRef"
            v-model="studentIds"
            :exclude-ids="excludeIds"
            :active="isDialogVisible"
            :rules="[requiredValidator]"
          />
        </VCol>
      </VRow>
    </AppAddEditDialog>

    <AppAddEditDrawer
      v-else
      :title="t('Add Student')"
      :is-dialog-visible="isDialogVisible"
      :is-update="false"
      :loading="loading"
      @on-submit="onFormSubmit"
      @on-close-dialog="onCloseDialog"
      @update:is-dialog-visible="emit('update:isDialogVisible', $event)"
    >
      <VRow>
        <VCol cols="12">
          <FamilyStudentSelect
            ref="studentSelectRef"
            v-model="studentIds"
            :exclude-ids="excludeIds"
            :active="isDialogVisible"
            :rules="[requiredValidator]"
          />
        </VCol>
      </VRow>
    </AppAddEditDrawer>
  </div>
</template>
