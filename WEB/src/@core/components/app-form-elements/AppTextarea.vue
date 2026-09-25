<script setup>
import { isRequiredField } from "@/@core/utils/validators";

defineOptions({
  name: "AppTextarea",
  inheritAttrs: false,
});

const attrs = useAttrs();
const isRequired = computed(() => isRequiredField(attrs.rules, attrs.required));

const elementId = computed(() => {
  const _elementIdToken = attrs.id;
  const _id = useId();

  return _elementIdToken ? `app-textarea-${_elementIdToken}` : _id;
});

const label = computed(() => attrs.label);
</script>

<template>
  <div class="app-textarea flex-grow-1" :class="$attrs.class">
    <VLabel
      v-if="label"
      :for="elementId"
      class="mb-1 text-wrap notasans font-size-0-75 pt-2"
      style="line-height: 15px"
    >
      {{ $t(label) }}
      <span v-if="isRequired" class="text-error" aria-hidden="true">*</span>
    </VLabel>
    <VTextarea
      v-bind="{
        ...$attrs,
        class: null,
        label: undefined,
        variant: 'outlined',
        id: elementId,
      }"
      autocomplete="off"
    >
      <template v-for="(_, name) in $slots" #[name]="slotProps">
        <slot :name="name" v-bind="slotProps || {}" />
      </template>
    </VTextarea>
  </div>
</template>
