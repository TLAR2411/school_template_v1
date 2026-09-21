<script setup>
import {
  DEFAULT_PAPER,
  MIN_ELEMENT_WIDTH,
  paperDimensions,
} from "@/config/report";

const props = defineProps({
  src: {
    type: String,
    required: true,
  },

  // Width as a percent of the sheet — same unit the logo uses.
  width: {
    type: Number,
    required: true,
  },

  minWidth: {
    type: Number,
    default: MIN_ELEMENT_WIDTH,
  },

  maxWidth: {
    type: Number,
    default: 60,
  },
});

const emit = defineEmits(["update:width"]);

const report = useReportContext();
const sheet = useReportSheet();
const el = ref(null);
const resizing = ref(false);

const editable = computed(
  () => Boolean(report?.designMode.value) && Boolean(sheet),
);

// Physical millimetres, so a 14% image is the same size as a 14% logo.
const style = computed(() => {
  const paper = report?.paper.value ?? DEFAULT_PAPER;
  const { width: sheetMm } = paperDimensions(paper);

  return { inlineSize: `${(props.width / 100) * sheetMm}mm` };
});

let stopResize = null;

const onResizeDown = (event) => {
  if (!editable.value || event.button !== 0 || !sheet?.el.value) return;

  event.preventDefault();

  const sheetRect = sheet.el.value.getBoundingClientRect();
  const blockRect = el.value.getBoundingClientRect();
  const grabX = event.clientX - blockRect.right;

  const onMove = (moveEvent) => {
    const widthPx = moveEvent.clientX - grabX - blockRect.left;
    const width = (widthPx / sheetRect.width) * 100;
    const snapped = snapPercent(width, props.maxWidth);

    emit("update:width", Math.max(props.minWidth, snapped));
  };

  stopResize = () => {
    window.removeEventListener("pointermove", onMove);
    window.removeEventListener("pointerup", stopResize);
    window.removeEventListener("pointercancel", stopResize);
    stopResize = null;
    resizing.value = false;
  };

  resizing.value = true;
  window.addEventListener("pointermove", onMove);
  window.addEventListener("pointerup", stopResize);
  window.addEventListener("pointercancel", stopResize);
};

onBeforeUnmount(() => stopResize?.());
</script>

<template>
  <div
    ref="el"
    class="report-image"
    :class="{
      'report-image--editable': editable,
      'report-image--active': resizing,
    }"
    :style="style"
  >
    <img :src="src" alt="" />

    <span
      v-if="editable"
      class="report-image__handle no-print"
      @pointerdown.stop="onResizeDown"
    />
  </div>
</template>

<style lang="scss">
.report-image {
  position: relative;
  display: inline-block;
  max-inline-size: 100%;

  img {
    display: block;
    inline-size: 100%;
    block-size: auto;
  }

  &--editable {
    outline: 1px dashed rgba(0, 0, 0, 25%);
    outline-offset: 2px;
  }

  &--active {
    outline-color: rgba(25, 118, 210, 80%);
  }

  &__handle {
    position: absolute;
    background: #1976d2;
    block-size: 10px;
    cursor: nwse-resize;
    inline-size: 10px;
    inset-block-end: -6px;
    inset-inline-end: -6px;
    touch-action: none;
  }
}

@media print {
  .report-image {
    outline: none !important;
  }
}
</style>
