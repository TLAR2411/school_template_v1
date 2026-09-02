<script setup>
import formatCurrency from "@/utils/formater/formatCurrency";
import { useDisplay } from "vuetify";

const { smAndDown } = useDisplay();
const props = defineProps({
  itemData: {
    type: Object,
    required: false,
    default: () => ({}),
  },
});
</script>

<template>
  <VCard>
    <VCardText class="pa-0">
      <VRow class="">
        <VCol cols="12">
          <div
            class="d-flex justify-space-between align-center"
            :style="!smAndDown ? 'height: 98px;' : ''"
          >
            <div
              class="pa-4 d-flex flex-row align-center position-relative"
              style="width: 50%; overflow: hidden"
            >
              <div
                class="icon-background"
                :style="{
                  color: itemData[0].color,
                  opacity: 0.1,
                  fontSize: '120px',
                  position: 'absolute',
                  left: '-20px',
                  top: '80%',
                  transform: 'translateY(-50%)',
                  zIndex: 0,
                }"
              >
                <VIcon :size="80" :color="itemData[0].color">
                  {{ itemData[0].icon }}
                </VIcon>
              </div>
              <div
                class="d-flex flex-column"
                style="position: relative; z-index: 1"
              >
                <span class="text-h5" :class="`text-${itemData[0].color}`">
                  {{ formatCurrency(itemData[0].value) }}
                </span>
                <span style="font-size: 14px">
                  {{ $t(itemData[0].title) }}
                </span>
              </div>
            </div>
            <VDivider vertical="" />
            <div
              class="pa-4 d-flex flex-row align-center justify-end position-relative"
              style="width: 50%; overflow: hidden"
            >
              <div
                class="d-flex flex-column text-end"
                style="position: relative; z-index: 1"
              >
                <span class="text-h5" :class="`text-${itemData[1].color}`">
                  {{ formatCurrency(itemData[1].value) }}
                </span>
                <span style="font-size: 14px">
                  {{ $t(itemData[1].title) }}
                </span>
              </div>
              <div
                class="icon-background"
                :style="{
                  color: itemData[1].color,
                  opacity: 0.1,
                  fontSize: '120px',
                  position: 'absolute',
                  right: '-20px',
                  top: '80%',
                  transform: 'translateY(-50%)',
                  zIndex: 0,
                }"
              >
                <VIcon :size="80" :color="itemData[1].color">
                  {{ itemData[1].icon }}
                </VIcon>
              </div>
            </div>
          </div>
        </VCol>
      </VRow>
    </VCardText>
  </VCard>
</template>
