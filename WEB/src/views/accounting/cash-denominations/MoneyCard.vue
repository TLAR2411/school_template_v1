<script setup>
import formatCurrency from "@/utils/formater/formatCurrency";

const props = defineProps({
  currency: {
    type: String,
    default: "៛",
  },
  amount: {
    type: Number,
    default: 10000,
  },
  value: {
    type: Number,
    default: 0,
  },
});
</script>

<template>
  <VCard class="w-100">
    <div class="d-flex justify-space-between pa-3 text-subtitle-2 w-100">
      <div class="d-flex flex-row align-center w-100">
        <VAvatar
          :color="value >= 0 ? 'primary' : 'error'"
          rounded
          class="text-subtitle-2 font-weight-bold"
          size="52"
          variant="tonal"
        >
          {{ value }}
        </VAvatar>
        <div class="d-flex flex-column ml-4 w-100 text-center">
          <span
            style="font-size: 16px !important"
            class="font-weight-bold"
            :class="value >= 0 ? 'text-primary' : 'text-error'"
          >
            {{ formatCurrency(amount) }}
          </span>
          <VDivider class="w-100 mt-1 mb-1" />
          <span
            style="font-size: 12px !important"
            :class="value < 0 ? 'text-error' : ''"
          >
            {{ formatCurrency(value * amount) }}
          </span>
        </div>
      </div>
    </div>
  </VCard>
</template>
