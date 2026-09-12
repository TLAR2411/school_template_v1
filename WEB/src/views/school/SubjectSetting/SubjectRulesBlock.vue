<script setup>
import { ref } from "vue";
import { useI18n } from "vue-i18n";

const props = defineProps({
  rules: {
    type: Array,
    default: () => [],
  },
  emptyText: {
    type: String,
    default: "No rule yet",
  },
});

const emit = defineEmits([
  "add-rule",
  "add-assessment",
  "edit-assessment",
  "delete-rule",
]);

const { t, locale } = useI18n();
const openRuleIds = ref([]);

const subjectName = (item) =>
  locale.value === "km"
    ? item?.name_kh || item?.name_en
    : item?.name_en || item?.name_kh;

const toggleRule = (ruleId) => {
  const index = openRuleIds.value.indexOf(ruleId);
  if (index === -1) openRuleIds.value.push(ruleId);
  else openRuleIds.value.splice(index, 1);
};

const isRuleOpen = (ruleId) => openRuleIds.value.includes(ruleId);

const classTypeLabel = (rule) => {
  if (!rule.class_type) return;
  return subjectName(rule.class_type);
};

const yearLabel = (rule) => {
  if (!rule.year_id) return t("Every year");
  return `${t("Year")} #${rule.year_id}`;
};

const handleDelete = (ruleId) => {
  console.log("delete rule", ruleId);
  emit("delete-rule", ruleId);
};
</script>

<template>
  <div
    v-if="!rules.length"
    class="empty-rules d-flex align-center justify-space-between ga-2"
  >
    <div class="d-flex align-center text-medium-emphasis">
      <VIcon icon="tabler-clipboard-off" size="18" class="me-2" />
      <span class="text-body-2">{{ t(emptyText) }}</span>
    </div>
    <VBtn
      size="small"
      variant="tonal"
      color="success"
      prepend-icon="tabler-plus"
      @click="$emit('add-rule')"
    >
      {{ t("Add Rule") }}
    </VBtn>
  </div>

  <div v-else class="rules-list">
    <div
      v-for="rule in rules"
      :key="rule.id"
      class="rule-item"
      :class="{ 'rule-item--open': isRuleOpen(rule.id) }"
    >
      <button type="button" class="rule-row" @click="toggleRule(rule.id)">
        <!-- <VIcon
          :icon="isRuleOpen(rule.id) ? 'tabler-chevron-down' : 'tabler-chevron-right'"
          size="18"
          class="rule-row__chevron"
        /> -->

        <!-- <VAvatar color="lightprimary" size="30" rounded="sm">
          <span class="text-white"><VIcon size="18">tabler-book</VIcon></span>
        </VAvatar> -->

        <div class="rule-row__main">
          <div class="d-flex align-center flex-wrap ga-2">
            <!-- <VAvatar color="lightprimary" size="30" rounded="sm">
              <span class="text-white"
                ><VIcon size="18">tabler-book</VIcon></span
              >
            </VAvatar> -->
            <span class="font-weight-medium">
              {{ subjectName(rule.activity) || t("Activity") }}
            </span>
            <VChip
              v-if="classTypeLabel(rule) != null"
              size="x-small"
              variant="tonal"
              color="primary"
            >
              {{ classTypeLabel(rule) }}
            </VChip>
          </div>

          <div class="rule-row__meta text-medium-emphasis">
            <span>{{ t("Max") }} {{ rule.max_score ?? "-" }}</span>
            <span class="dot">·</span>
            <span>{{ rule.percentage ?? 0 }}%</span>
            <span class="dot">·</span>
            <!-- <span>{{ classTypeLabel(rule) }}</span> -->
            <span class="dot">·</span>
            <span>{{ yearLabel(rule) }}</span>
          </div>
        </div>

        <VChip size="x-small" variant="tonal" color="secondary">
          {{ rule.assessments?.length || 0 }} {{ t("items") }}
        </VChip>

        <VBtn
          icon
          size="x-small"
          variant="text"
          color="success"
          @click.stop="$emit('add-assessment', rule)"
        >
          <VIcon icon="tabler-plus" size="18" />
          <VTooltip activator="parent" location="top">
            {{ t("Add Assessment") }}
          </VTooltip>
        </VBtn>

        <VBtn
          v-if="rule.assessments?.length"
          icon
          size="x-small"
          variant="text"
          color="warning"
          @click.stop="$emit('edit-assessment', rule)"
        >
          <VIcon icon="tabler-pencil" size="18" />
          <VTooltip activator="parent" location="top">
            {{ t("Edit Assessment") }}
          </VTooltip>
        </VBtn>

        <VBtn
          icon
          size="x-small"
          variant="text"
          color="error"
          @click.stop="handleDelete(rule.id)"
        >
          <VIcon icon="tabler-trash" size="18" />
          <VTooltip activator="parent" location="top">
            {{ t("Delete") }}
          </VTooltip>
        </VBtn>
        <VIcon
          :icon="
            isRuleOpen(rule.id) ? 'tabler-chevron-down' : 'tabler-chevron-right'
          "
          size="18"
          class="rule-row__chevron"
        />
      </button>

      <div v-if="isRuleOpen(rule.id)" class="assessments">
        <div
          v-if="!rule.assessments?.length"
          class="text-body-2 text-medium-emphasis px-2 py-2"
        >
          {{ t("No assessments") }}
        </div>
        <div v-else class="assessment-chips">
          <VChip
            v-for="item in rule.assessments"
            :key="item.id"
            size="small"
            variant="outlined"
            color="primary"
          >
            {{ item.ass_name }}
            <span class="text-medium-emphasis ms-1"
              >({{ item.max_score }})</span
            >
          </VChip>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.empty-rules {
  padding: 12px 14px;
  border: 1px dashed rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 10px;
  background: rgba(var(--v-theme-surface), 1);
}

.rules-list {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.rule-item {
  border: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  border-radius: 5px;
  background: rgb(var(--v-theme-surface));
  overflow: hidden;
}

.rule-item--open {
  border-color: rgba(var(--v-theme-primary), 0.35);
}

.rule-row {
  width: 100%;
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 10px 12px;
  border: 0;
  background: transparent;
  text-align: left;
  cursor: pointer;
}

.rule-row:hover {
  background: rgba(var(--v-theme-primary), 0.04);
}

.rule-row__chevron {
  color: rgba(var(--v-theme-on-surface), 0.55);
  flex-shrink: 0;
}

.rule-row__main {
  flex: 1;
  min-width: 0;
}

.rule-row__meta {
  margin-top: 2px;
  font-size: 12px;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 4px;
}

.dot {
  opacity: 0.5;
}

.assessments {
  padding: 0 12px 12px 40px;
  border-top: 1px solid rgba(var(--v-border-color), var(--v-border-opacity));
  background: rgba(var(--v-theme-on-surface), 0.02);
}

.assessment-chips {
  display: flex;
  flex-wrap: wrap;
  gap: 8px;
  padding-top: 10px;
}
</style>
