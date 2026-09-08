<script setup>
import AppAutocomplete from "@/@core/components/app-form-elements/AppAutocomplete.vue";
import { auth } from "@/utils/auth";
import { useSettingStore } from "@/stores/settingStore";
import { computed, ref, watch, onMounted } from "vue";
import { useI18n } from "vue-i18n";
import { useDisplay } from "vuetify";

const curriculums = ref(auth()?.curriculums || []);
const filter = ref({
  curriculum_id: useSettingStore().curriculum_id,
});
const { locale } = useI18n();
const { smAndDown } = useDisplay();

watch(
  () => auth()?.curriculums,
  (newCurriculums) => {
    if (newCurriculums) {
      curriculums.value = newCurriculums;
      setCurriculum();
    }
  },
  { deep: true },
);

onMounted(() => {
  setCurriculum();
});

const setCurriculum = () => {
  const savedId = useSettingStore().curriculum_id;
  const stillValid = curriculums.value.some((i) => i.id == savedId);

  filter.value.curriculum_id = stillValid
    ? savedId
    : curriculums.value[0]?.id || null;

  useSettingStore().setCurriculumId(filter.value.curriculum_id);

  const symbol = curriculums.value.find(
    (i) => i.id == filter.value.curriculum_id,
  )?.symbol;

  useSettingStore().setCurriculumSymbol(symbol);
};

const changeCurriculum = (id) => {
  useSettingStore().setCurriculumId(id);

  const symbol = curriculums.value.find((i) => i.id == id)?.symbol;
  useSettingStore().setCurriculumSymbol(symbol);
};

const getItemTitle = (item) => {
  const name = item[locale.value === "km" ? "name_kh" : "name_en"];
  return item.symbol ? `${name} (${item.symbol})` : name;
};

const getSelectionLabel = (item) => {
  const raw = item?.raw ?? item;
  if (smAndDown.value) {
    return raw.symbol || getItemTitle(raw);
  }
  return getItemTitle(raw);
};

const fieldStyle = computed(() =>
  smAndDown.value
    ? { width: "72px", minWidth: "72px", maxWidth: "72px" }
    : { width: "230px", minWidth: "180px", maxWidth: "230px" },
);
</script>

<template>
  <div class="navbar-curriculum d-flex align-center">
    <AppAutocomplete
      class="curriculum-autocomplete"
      :class="{
        'single-curriculum': curriculums.length === 1,
        'is-compact': smAndDown,
      }"
      v-model="filter.curriculum_id"
      :items="curriculums"
      :item-title="getItemTitle"
      item-value="id"
      density="compact"
      hide-details
      :readonly="curriculums.length <= 1"
      :disabled="curriculums.length === 1"
      @update:model-value="(value) => changeCurriculum(value)"
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
.navbar-curriculum {
  margin-inline-end: 8px;
}

.curriculum-autocomplete.single-curriculum :deep(.v-field.v-field--disabled) {
  background-color: transparent !important;
  color: inherit !important;
  opacity: 1 !important;
  cursor: default !important;
}

.curriculum-autocomplete.is-compact :deep(.v-field__input) {
  padding-inline: 8px;
  justify-content: center;
  text-align: center;
}

.curriculum-autocomplete.is-compact :deep(.v-select__selection) {
  margin-inline-end: 0;
}

.curriculum-autocomplete.is-compact :deep(.v-field__append-inner) {
  padding-inline-start: 0;
}

.selection-label {
  display: inline-block;
  max-width: 100%;
  font-weight: 500;
}
</style>
