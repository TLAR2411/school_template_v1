<script setup>
import { FONT_OPTIONS, fontFamily } from "@/config/report";

const props = defineProps({
  modelValue: {
    type: String,
    default: "",
  },

  label: {
    type: String,
    default: "",
  },

  // Adds an empty option, for slots that fall back to the report font.
  inheritLabel: {
    type: String,
    default: "",
  },
});

defineEmits(["update:modelValue"]);

const items = computed(() =>
  props.inheritLabel
    ? [{ value: "", title: props.inheritLabel }, ...FONT_OPTIONS]
    : FONT_OPTIONS,
);
</script>

<template>
  <!-- Each option is drawn in its own typeface, so the choice is a preview. -->
  <VSelect
    :model-value="modelValue"
    :items="items"
    item-title="title"
    item-value="value"
    :label="label"
    density="compact"
    hide-details
    @update:model-value="$emit('update:modelValue', $event)"
  >
    <template #selection="{ item }">
      <span :style="{ fontFamily: fontFamily(item.value) }">{{ item.title }}</span>
    </template>

    <template #item="{ item, props: itemProps }">
      <VListItem
        v-bind="itemProps"
        :style="{ fontFamily: fontFamily(item.value) }"
      />
    </template>
  </VSelect>
</template>
