<script setup>
import { computed, onMounted, ref, watch } from "vue";
import { useI18n } from "vue-i18n";
import { api } from "@/utils/api";
import { getGrades } from "@/services/dataService";
import SubjectRulesBlock from "./SubjectRulesBlock.vue";
import AddEditSubjectSettingDialog from "./AddEditSubjectSettingDialog.vue";
import AddEditAssessmentDialog from "./AddEditAssessmentDialog.vue";
import { useDialog } from "@/composables/useDialog";
const { showDialog } = useDialog();
import { useSettingStore } from "@/stores/settingStore.js";

const settingStore = useSettingStore();

const isDialogVisible = ref(false);
const isAssessmentDialogVisible = ref(false);
const assessmentFormData = ref({});

const { t, locale } = useI18n();

const grades = ref([]);
const subjects = ref([]);
const isLoading = ref(false);
const openSubjectIds = ref([]);
/** `{ [subjectId]: ['rules' | 'children'] }` */
const openSectionMap = ref({});
const openChildIds = ref([]);
const formData = ref({});

const formSearch = ref({
  grade_id: null,
  year_id: null,
  class_type_id: null,
});

const hasGrade = computed(() => !!formSearch.value.grade_id);

const flatSubjects = computed(() => {
  const list = [];
  for (const subject of subjects.value) {
    list.push(subject);
    for (const child of subject.children || []) {
      list.push(child);
    }
  }
  return list;
});

watch(
  () => settingStore.curriculum_id,
  async (newVal) => {
    if (newVal) {
      //   window.location.reload();
      formSearch.value.grade_id = null;
      grades.value = await getGrades();
    }
  },
);

const subjectLabel = (item) =>
  locale.value === "km"
    ? item?.name_kh || item?.name_en || "-"
    : item?.name_en || item?.name_kh || "-";

const gradeTitle = (item) =>
  item?.grade_level != null
    ? `${t("Grade")} ${item.grade_level}`
    : subjectLabel(item);

const getSectionModel = (subjectId) => openSectionMap.value[subjectId] || [];

const setSectionModel = (subjectId, val) => {
  openSectionMap.value = {
    ...openSectionMap.value,
    [subjectId]: val,
  };
};

const isChildOpen = (id) => openChildIds.value.includes(id);

const toggleChild = (childId) => {
  const index = openChildIds.value.indexOf(childId);
  if (index === -1) openChildIds.value.push(childId);
  else openChildIds.value.splice(index, 1);
};

const fetchGradingRules = async () => {
  if (!formSearch.value.grade_id) {
    subjects.value = [];
    openSubjectIds.value = [];
    openChildIds.value = [];
    openSectionMap.value = {};
    return;
  }
  try {
    isLoading.value = true;
    const res = await api.post("grading-rules-list", formSearch.value);

    if (res.data.status) {
      subjects.value = res.data.data || [];
      openSubjectIds.value = [];
      openChildIds.value = [];
      openSectionMap.value = {};
    } else {
      subjects.value = [];
      console.error("grading-rules-list failed:", res.data);
    }
  } catch (error) {
    subjects.value = [];
    console.error("Failed to fetch grading rules:", error);
  } finally {
    isLoading.value = false;
  }
};

const openCreateDialog = (subject = null) => {
  if (!hasGrade.value) return;

  formData.value = {
    id: null,
    grade_id: formSearch.value.grade_id,
    year_id: formSearch.value.year_id,
    class_type_id: formSearch.value.class_type_id,
    subject_id: subject?.id ?? null,
    rules: [
      {
        subject_activity_type_id: null,
        class_type_id: null,
        percentage: null,
        max_score: null,
        assessment_count: 1,
      },
    ],
  };

  isDialogVisible.value = true;
};

const openEditDialog = (subject) => {
  if (!hasGrade.value || !subject?.grading_rules?.length) return;
  formData.value = {
    id: subject.id,
    grade_id: formSearch.value.grade_id,
    year_id: formSearch.value.year_id,
    subject_id: subject.id,
    rules: subject.grading_rules.map((rule) => ({
      id: rule.id,
      subject_activity_type_id: rule.activity?.id ?? null,
      class_type_id: rule.class_type_id ?? null,
      percentage: rule.percentage,
      max_score: rule.max_score,
    })),
  };
  isDialogVisible.value = true;
};

const onCreate = async (data, callback) => {
  try {
    isLoading.value = true;
    const res = await api.post("grading-rules-store", data);
    if (res.data.status) {
      await fetchGradingRules();
      isDialogVisible.value = false;
      callback?.(true);
    } else {
      console.error(res.data.message);
      callback?.(false);
    }
  } catch (error) {
    console.error(error);
    callback?.(false);
  } finally {
    isLoading.value = false;
  }
};

const onUpdate = (data, callback) => {
  console.log("onUpdate", data);
  callback?.(true);
  isDialogVisible.value = false;
};

watch(
  () => formSearch.value.grade_id,
  (gradeId) => {
    if (gradeId) fetchGradingRules();
    else {
      subjects.value = [];
      openSubjectIds.value = [];
      openChildIds.value = [];
      openSectionMap.value = {};
    }
  },
);

const openAssessmentDialog = (rule, subject, { edit = false } = {}) => {
  if (!rule?.id) return;

  const existing = rule.assessments || [];
  assessmentFormData.value = {
    id: rule.id,
    subject_id: subject?.id ?? rule.subject_id ?? null,
    max_score: rule.max_score,
    activity: rule.activity,
    symbol: rule.activity?.symbol,
    is_edit: edit,
    // create = empty list to generate new; edit = load all existing
    assessments: edit ? existing : [],
  };
  isAssessmentDialogVisible.value = true;
};

const onSaveAssessments = async (data, callback) => {
  try {
    isLoading.value = true;
    const res = await api.post("assessments-store", data);
    if (res.data.status) {
      await fetchGradingRules();
      isAssessmentDialogVisible.value = false;
      callback?.(true);
    } else {
      console.error(res.data.message);
      callback?.(false);
    }
  } catch (error) {
    console.error("Failed to save assessments:", error);
    callback?.(false);
  } finally {
    isLoading.value = false;
  }
};

const onDeleteRule = async (ruleId) => {
  const confirmed = await showDialog({
    title: t("Delete this grading rule?"),
    icon: "warning",
    confirmColor: "error",
    confirmText: t("Delete"),
  });
  if (!confirmed) return; // user clicked Cancel
  try {
    isLoading.value = true;
    const res = await api.post("grading-rules-delete", { id: ruleId });
    if (res.data.status) {
      await fetchGradingRules(); // reload list
    } else {
      console.error(res.data.message);
    }
  } catch (error) {
    console.error("Failed to delete:", error);
  } finally {
    isLoading.value = false;
  }
};

onMounted(async () => {
  grades.value = await getGrades();
});
</script>

<template>
  <div class="subject-setting">
    <AddEditSubjectSettingDialog
      max-width="700"
      v-model:isDialogVisible="isDialogVisible"
      :loading="isLoading"
      :item-data="formData"
      :subject-options="flatSubjects"
      :subject-tree="subjects"
      @on-create="onCreate"
      @on-update="onUpdate"
    />

    <AddEditAssessmentDialog
      v-model:isDialogVisible="isAssessmentDialogVisible"
      :loading="isLoading"
      :item-data="assessmentFormData"
      @on-create="onSaveAssessments"
      @on-update="onSaveAssessments"
    />

    <VRow class="align-center">
      <VCol cols="12" sm="6" md="4">
        <AppAutocomplete
          v-model="formSearch.grade_id"
          :items="grades"
          :item-title="gradeTitle"
          item-value="id"
          :placeholder="t('Select Grade')"
          prepend-inner-icon="tabler-school"
          clearable
          hide-details
          autocomplete="off"
          clear-icon="tabler-x"
        />
      </VCol>

      <VCol cols="12" sm="6" md="8">
        <VBtn
          variant="tonal"
          color="success"
          prepend-icon="tabler-plus"
          :disabled="!hasGrade"
          @click="openCreateDialog()"
        >
          {{ t("Add Rule") }}
        </VBtn>
      </VCol>
    </VRow>

    <VAlert
      v-if="!hasGrade"
      color="warning"
      icon="tabler-info-circle"
      variant="tonal"
      class="mt-3"
    >
      {{ t("Select Grade for View Subject Setting") }}
    </VAlert>

    <template v-else>
      <div v-if="isLoading" class="d-flex justify-center py-10">
        <VProgressCircular indeterminate color="primary" />
      </div>

      <div
        v-else-if="!subjects.length"
        class="text-center py-10 text-medium-emphasis"
      >
        <VIcon icon="tabler-folders-off" size="40" class="mb-2" />
        <div class="text-body-1">{{ t("No subjects found") }}</div>
      </div>

      <VExpansionPanels
        v-else
        v-model="openSubjectIds"
        multiple
        class="subject-panels mt-3"
      >
        <VExpansionPanel
          v-for="subject in subjects"
          :key="subject.id"
          :value="subject.id"
          elevation="0"
          class="subject-panel mb-2"
        >
          <VExpansionPanelTitle class="subject-panel__title">
            <div class="d-flex align-center flex-wrap ga-2 w-100 pe-2">
              <div class="subject-panel__name d-flex align-center gap-3">
                <VAvatar color="primary" size="40" rounded="sm">
                  <span class="text-h6 text-white">{{ subject.symbol }}</span>
                </VAvatar>
                <div class="font-weight-medium text-high-emphasis">
                  {{ subjectLabel(subject) }}
                </div>
              </div>

              <VSpacer />

              <VChip
                size="small"
                variant="tonal"
                :color="subject.has_grading ? 'success' : 'default'"
              >
                {{
                  subject.has_grading
                    ? `${subject.grading_rules.length} ${t("rules")}`
                    : t("No rule")
                }}
              </VChip>

              <VChip
                v-if="subject.children?.length"
                size="small"
                variant="tonal"
                color="primary"
              >
                {{ subject.children.length }} {{ t("children") }}
              </VChip>

              <VBtn
                icon
                size="x-small"
                variant="text"
                color="warning"
                @click.stop="openEditDialog(subject)"
              >
                <VIcon icon="tabler-pencil" size="18" />
                <VTooltip activator="parent" location="top">
                  {{ t("Edit Rule") }}
                </VTooltip>
              </VBtn>
            </div>
          </VExpansionPanelTitle>

          <VExpansionPanelText class="subject-panel__body">
            <!-- Only 2 sections: Rules + Child -->
            <VExpansionPanels
              :model-value="getSectionModel(subject.id)"
              multiple
              class="section-panels"
              @update:model-value="(val) => setSectionModel(subject.id, val)"
            >
              <VExpansionPanel
                value="rules"
                elevation="0"
                class="section-panel"
              >
                <VExpansionPanelTitle class="section-panel__title">
                  <div class="d-flex align-center ga-2 w-100 pe-2">
                    <VIcon icon="tabler-clipboard-list" size="18" />
                    <span class="font-weight-medium">{{ t("Rules") }}</span>
                    <VSpacer />
                    <VChip size="x-small" variant="tonal" color="secondary">
                      {{ subject.grading_rules?.length || 0 }}
                    </VChip>
                    <VBtn
                      icon
                      size="x-small"
                      variant="text"
                      color="success"
                      @click.stop="openCreateDialog(subject)"
                    >
                      <VIcon icon="tabler-plus" size="16" />
                    </VBtn>
                  </div>
                </VExpansionPanelTitle>
                <VExpansionPanelText>
                  <SubjectRulesBlock
                    :rules="subject.grading_rules"
                    @add-rule="openCreateDialog(subject)"
                    @add-assessment="
                      (rule) => openAssessmentDialog(rule, subject, { edit: false })
                    "
                    @edit-assessment="
                      (rule) => openAssessmentDialog(rule, subject, { edit: true })
                    "
                    @delete-rule="onDeleteRule"
                  />
                </VExpansionPanelText>
              </VExpansionPanel>

              <VExpansionPanel
                v-if="subject.children?.length"
                value="children"
                elevation="0"
                class="section-panel"
              >
                <VExpansionPanelTitle class="section-panel__title">
                  <div class="d-flex align-center ga-2 w-100 pe-2">
                    <VIcon icon="tabler-folders" size="18" />
                    <span class="font-weight-medium">{{ t("Child") }}</span>
                    <VSpacer />
                    <VChip size="x-small" variant="tonal" color="primary">
                      {{ subject.children.length }}
                    </VChip>
                  </div>
                </VExpansionPanelTitle>
                <VExpansionPanelText>
                  <div class="children-list">
                    <div
                      v-for="child in subject.children"
                      :key="child.id"
                      class="child-item"
                      :class="{ 'child-item--open': isChildOpen(child.id) }"
                    >
                      <button
                        type="button"
                        class="child-row"
                        @click="toggleChild(child.id)"
                      >
                        <VAvatar size="30" rounded="sm" class="avatar">
                          <span class="text-primary text-body2">
                            {{ child.symbol }}
                          </span>
                        </VAvatar>

                        <div class="child-row__main">
                          <span class="font-weight-medium">
                            {{ subjectLabel(child) }}
                          </span>
                        </div>

                        <VChip
                          size="x-small"
                          variant="tonal"
                          :color="child.has_grading ? 'success' : 'default'"
                        >
                          {{
                            child.has_grading
                              ? `${child.grading_rules.length} ${t("rules")}`
                              : t("No rule")
                          }}
                        </VChip>

                        <VBtn
                          icon
                          size="x-small"
                          variant="text"
                          color="success"
                          class="ms-1"
                          @click.stop="openCreateDialog(child)"
                        >
                          <VIcon icon="tabler-plus" size="16" />
                        </VBtn>
                      </button>

                      <div v-if="isChildOpen(child.id)" class="child-body">
                        <!-- Each category (Homework, Exam…) expands inside -->
                        <SubjectRulesBlock
                          class="mt-2"
                          :rules="child.grading_rules"
                          @add-rule="openCreateDialog(child)"
                          @add-assessment="
                            (rule) =>
                              openAssessmentDialog(rule, child, { edit: false })
                          "
                          @edit-assessment="
                            (rule) =>
                              openAssessmentDialog(rule, child, { edit: true })
                          "
                          @delete-rule="onDeleteRule"
                        />
                      </div>
                    </div>
                  </div>
                </VExpansionPanelText>
              </VExpansionPanel>
            </VExpansionPanels>
          </VExpansionPanelText>
        </VExpansionPanel>
      </VExpansionPanels>
    </template>
  </div>
</template>

<style scoped>
.subject-setting {
  padding-bottom: 16px;
}

.subject-panels :deep(.v-expansion-panel) {
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 12px !important;
  overflow: hidden;
}

.avatar {
  background-color: rgba(var(--v-theme-on-surface), 0.1);
}

.subject-panels :deep(.v-expansion-panel__shadow) {
  display: none;
}

.subject-panel__title {
  min-height: 64px;
  padding-block: 10px;
}

.subject-panel__body {
  padding-top: 4px;
}

.section-panels {
  gap: 8px;
  display: flex;
  flex-direction: column;
}

.section-panels :deep(.v-expansion-panel) {
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 10px !important;
  overflow: hidden;
}

.section-panels :deep(.v-expansion-panel__shadow) {
  display: none;
}

.section-panel__title {
  min-height: 48px;
  padding-block: 8px;
}

.children-list {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.child-item {
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 5px;
  background: rgb(var(--v-theme-surface));
  overflow: hidden;
}

.child-item--open {
  border-color: rgba(var(--v-theme-primary), 0.3);
}

.child-row {
  width: 100%;
  display: flex;
  align-items: center;
  gap: 8px;
  padding: 10px 12px;
  border: 0;
  background: transparent;
  text-align: left;
  cursor: pointer;
}

.child-row:hover {
  background: rgba(var(--v-theme-primary), 0.04);
}

.child-row__chevron {
  color: rgba(var(--v-theme-on-surface), 0.55);
  flex-shrink: 0;
}

.child-row__main {
  flex: 1;
  min-width: 0;
}

.child-body {
  padding: 0 12px 12px 36px;
  border-top: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  background: rgba(var(--v-theme-on-surface), 0.015);
}
</style>
