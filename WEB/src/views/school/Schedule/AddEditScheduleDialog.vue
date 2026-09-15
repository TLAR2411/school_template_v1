<script setup>
import { computed, ref, watch } from "vue";
import { debounce } from "lodash";
import { useI18n } from "vue-i18n";
import { useDisplay } from "vuetify";
import { requiredValidator } from "@/@core/utils/validators";
import AppAddEditDrawer from "@/components/AppAddEditDrawer.vue";

const { xs } = useDisplay();
const { t, locale } = useI18n();

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
    default: false,
  },
  subjects: {
    type: Array,
    default: () => [],
  },
  days: {
    type: Array,
    default: () => [],
  },
  classLabel: {
    type: String,
    default: "",
  },
  hasConflict: {
    type: Boolean,
    default: false,
  },
  hasBreakConflict: {
    type: Boolean,
    default: false,
  },
  colorPresets: {
    type: Array,
    default: () => [
      "#4F46E5",
      "#0EA5E9",
      "#10B981",
      "#F59E0B",
      "#EF4444",
      "#8B5CF6",
      "#EC4899",
      "#64748B",
    ],
  },
});

const emit = defineEmits([
  "onCreate",
  "onUpdate",
  "onDelete",
  "update:isDialogVisible",
]);

const emptyForm = () => ({
  id: null,
  class_id: null,
  subject_id: null,
  day_id: null,
  start: "07:00",
  end: "08:00",
  color: props.colorPresets[0],
});

const itemData = ref({ ...emptyForm(), ...props.itemData });

watch(
  () => props.itemData,
  (newData) => {
    itemData.value = {
      ...emptyForm(),
      ...newData,
      color: newData?.color || props.colorPresets[0],
      start: newData?.start || "07:00",
      end: newData?.end || "08:00",
    };
  },
  { deep: true, immediate: true },
);

watch(
  () => itemData.value.subject_id,
  (id, oldId) => {
    if (!id || id === oldId || itemData.value.id) return;
    const subject = props.subjects.find((s) => s.id == id);
    if (subject?.color) itemData.value.color = subject.color;
  },
);

const isEdit = computed(() => !!itemData.value?.id);

const subjectTitle = computed(() =>
  locale.value === "km" ? "name_kh" : "name_en",
);

/** Days from API: name_en / name_kh / short */
const dayTitle = (day) => {
  if (!day) return "";
  return locale.value === "km"
    ? day.name_kh || day.short || day.name_en
    : day.name_en || day.short || day.name_kh;
};

const durationLabel = computed(() => {
  const start = toMinutes(itemData.value.start);
  const end = toMinutes(itemData.value.end);
  if (start == null || end == null || end <= start) return null;
  const mins = end - start;
  const h = Math.floor(mins / 60);
  const m = mins % 60;
  if (h && m) return `${h}h ${m}m`;
  if (h) return `${h}h`;
  return `${m}m`;
});

const timeInvalid = computed(() => {
  const start = toMinutes(itemData.value.start);
  const end = toMinutes(itemData.value.end);
  return start != null && end != null && end <= start;
});

function toMinutes(time) {
  if (!time || typeof time !== "string") return null;
  const [h, m] = time.split(":").map(Number);
  if (Number.isNaN(h) || Number.isNaN(m)) return null;
  return h * 60 + m;
}

const resetData = () => {
  itemData.value = emptyForm();
};

const onFormSubmit = debounce(async (refForm) => {
  const { valid } = await refForm;
  if (!valid || timeInvalid.value || props.hasBreakConflict) return;

  const payload = { ...itemData.value };
  if (isEdit.value) {
    emit("onUpdate", payload, (ok) => {
      if (ok) resetData();
    });
  } else {
    emit("onCreate", payload, (ok) => {
      if (ok) resetData();
    });
  }
}, 400);

const onDelete = () => {
  emit("onDelete", { ...itemData.value }, (ok) => {
    if (ok) resetData();
  });
};

const onCloseDialog = () => {
  resetData();
  emit("update:isDialogVisible", false);
};

const selectColor = (color) => {
  itemData.value.color = color;
};
</script>

<template>
  <div>
    <AppAddEditDialog
      v-if="!xs"
      :title="isEdit ? t('Edit Schedule') : t('Add Schedule')"
      icon="tabler-calendar-event"
      :is-dialog-visible="isDialogVisible"
      :is-update="isEdit"
      :loading="loading"
      max-width="560px"
      @on-close-dialog="onCloseDialog"
      @on-submit="onFormSubmit"
    >
      <div v-if="classLabel" class="mb-4">
        <div class="text-caption text-medium-emphasis mb-1">
          {{ t("Class") }}
        </div>
        <VChip
          size="small"
          color="primary"
          variant="tonal"
          prepend-icon="tabler-school"
        >
          {{ classLabel }}
        </VChip>
      </div>

      <VAlert
        v-if="hasConflict"
        type="warning"
        variant="tonal"
        density="compact"
        class="mb-4"
        icon="tabler-alert-triangle"
      >
        {{ t("This time overlaps another schedule for this class.") }}
      </VAlert>

      <VAlert
        v-if="hasBreakConflict"
        type="warning"
        variant="tonal"
        density="compact"
        class="mb-4"
        icon="tabler-coffee"
      >
        {{ t("This time overlaps the break / lunch period.") }}
      </VAlert>

      <VAlert
        v-if="timeInvalid"
        type="error"
        variant="tonal"
        density="compact"
        class="mb-4"
      >
        {{ t("End time must be after start time.") }}
      </VAlert>

      <VRow>
        <VCol cols="12">
          <AppAutocomplete
            v-model="itemData.subject_id"
            :items="subjects"
            :item-title="subjectTitle"
            item-value="id"
            :label="t('Subject')"
            :rules="[requiredValidator]"
            autocomplete="off"
          />
        </VCol>

        <VCol cols="12" sm="6">
          <AppAutocomplete
            v-model="itemData.day_id"
            :items="days"
            :item-title="dayTitle"
            item-value="id"
            :label="t('Day')"
            :rules="[requiredValidator]"
            autocomplete="off"
          />
        </VCol>

        <VCol cols="6" sm="3">
          <AppTextField
            v-model="itemData.start"
            type="time"
            :label="t('Start')"
            :rules="[requiredValidator]"
          />
        </VCol>

        <VCol cols="6" sm="3">
          <AppTextField
            v-model="itemData.end"
            type="time"
            :label="t('End')"
            :rules="[requiredValidator]"
          />
        </VCol>

        <VCol v-if="durationLabel" cols="12" class="pt-0">
          <span class="text-caption text-medium-emphasis">
            {{ t("Duration") }}: {{ durationLabel }}
          </span>
        </VCol>

        <VCol cols="12">
          <div class="text-body-2 mb-2">{{ t("Color") }}</div>
          <div class="d-flex flex-wrap ga-2 align-center">
            <button
              v-for="color in colorPresets"
              :key="color"
              type="button"
              class="color-swatch"
              :class="{ active: itemData.color === color }"
              :style="{ backgroundColor: color }"
              :aria-label="color"
              @click="selectColor(color)"
            />
            <VTextField
              v-model="itemData.color"
              type="color"
              hide-details
              density="compact"
              style="max-width: 56px"
              class="color-input"
            />
          </div>
        </VCol>
      </VRow>

      <div v-if="isEdit" class="mt-4 d-flex justify-start">
        <VBtn
          color="error"
          variant="tonal"
          prepend-icon="tabler-trash"
          :loading="loading"
          @click="onDelete"
        >
          {{ t("Delete") }}
        </VBtn>
      </div>
    </AppAddEditDialog>

    <AppAddEditDrawer
      v-else
      :title="isEdit ? t('Edit Schedule') : t('Add Schedule')"
      :is-dialog-visible="isDialogVisible"
      :is-update="isEdit"
      :loading="loading"
      @on-close-dialog="onCloseDialog"
      @on-submit="onFormSubmit"
    >
      <VRow>
        <VCol cols="12">
          <AppAutocomplete
            v-model="itemData.subject_id"
            :items="subjects"
            :item-title="subjectTitle"
            item-value="id"
            :label="t('Subject')"
            :rules="[requiredValidator]"
            autocomplete="off"
          />
        </VCol>
        <VCol cols="12">
          <AppAutocomplete
            v-model="itemData.day_id"
            :items="days"
            :item-title="dayTitle"
            item-value="id"
            :label="t('Day')"
            :rules="[requiredValidator]"
            autocomplete="off"
          />
        </VCol>
        <VCol cols="6">
          <AppTextField
            v-model="itemData.start"
            type="time"
            :label="t('Start')"
            :rules="[requiredValidator]"
          />
        </VCol>
        <VCol cols="6">
          <AppTextField
            v-model="itemData.end"
            type="time"
            :label="t('End')"
            :rules="[requiredValidator]"
          />
        </VCol>
        <VCol cols="12">
          <div class="text-body-2 mb-2">{{ t("Color") }}</div>
          <div class="d-flex flex-wrap ga-2">
            <button
              v-for="color in colorPresets"
              :key="color"
              type="button"
              class="color-swatch"
              :class="{ active: itemData.color === color }"
              :style="{ backgroundColor: color }"
              @click="selectColor(color)"
            />
          </div>
        </VCol>
        <VCol v-if="isEdit" cols="12">
          <VBtn
            block
            color="error"
            variant="tonal"
            prepend-icon="tabler-trash"
            @click="onDelete"
          >
            {{ t("Delete") }}
          </VBtn>
        </VCol>
      </VRow>
    </AppAddEditDrawer>
  </div>
</template>

<style scoped>
.color-swatch {
  width: 28px;
  height: 28px;
  border-radius: 8px;
  border: 2px solid transparent;
  cursor: pointer;
  padding: 0;
  box-shadow: inset 0 0 0 1px rgba(0, 0, 0, 0.08);
}

.color-swatch.active {
  border-color: rgb(var(--v-theme-on-surface));
  outline: 2px solid rgba(var(--v-theme-primary), 0.35);
  outline-offset: 1px;
}

.color-input :deep(.v-field) {
  min-height: 36px;
}
</style>
