<script setup>
import { MIN_ELEMENT_WIDTH, SCALE_RANGE } from "@/config/report";

const props = defineProps({
  // Position in percent of the sheet, so it survives a change of paper size.
  x: {
    type: Number,
    default: 0,
  },
  y: {
    type: Number,
    default: 0,
  },

  /*
    What the corner handle does:
      "width" — drags `width`, height follows the content. Right for an image,
                which keeps its aspect ratio on its own.
      "scale" — zooms the whole block through `scale`, so text, pictures and
                spacing all grow together.
      null    — no handle.
  */
  resize: {
    type: String,
    default: null,
    validator: (value) => [null, "width", "scale"].includes(value),
  },

  // Width in percent of the sheet. `null` sizes to the content.
  width: {
    type: Number,
    default: null,
  },

  minWidth: {
    type: Number,
    default: MIN_ELEMENT_WIDTH,
  },

  scale: {
    type: Number,
    default: 1,
  },

  // Lock this element even while the report is in design mode.
  locked: {
    type: Boolean,
    default: false,
  },

  // Paint order on the sheet. The date sits above logo / signature pictures.
  zIndex: {
    type: Number,
    default: 1,
  },
});

const emit = defineEmits(["update:x", "update:y", "update:width", "update:scale", "dragend"]);

const report = useReportContext();
const sheet = useReportSheet();

const el = ref(null);
const dragging = ref(false);
const resizing = ref(false);

const editable = computed(
  () => !props.locked && Boolean(report?.designMode.value) && Boolean(sheet),
);

const style = computed(() => ({
  insetInlineStart: `${props.x}%`,
  insetBlockStart: `${props.y}%`,
  inlineSize: props.width ? `${props.width}%` : undefined,
  zIndex: dragging.value || resizing.value ? 100 : props.zIndex,

  // Anchored top-left so zooming grows the block without moving its corner.
  transformOrigin: "top left",
  transform: props.scale === 1 ? undefined : `scale(${props.scale})`,
}));

// Keep the grab handle the same size on screen however far the block is zoomed.
const handleStyle = computed(() =>
  props.resize === "scale" && props.scale !== 1
    ? { transform: `scale(${1 / props.scale})`, transformOrigin: "bottom right" }
    : undefined,
);

let stopGesture = null;

// One pointer gesture at a time, cleaned up however it ends.
const startGesture = (onMove, onDone) => {
  stopGesture = () => {
    window.removeEventListener("pointermove", onMove);
    window.removeEventListener("pointerup", stopGesture);
    window.removeEventListener("pointercancel", stopGesture);
    stopGesture = null;
    dragging.value = false;
    resizing.value = false;
    onDone?.();
  };

  window.addEventListener("pointermove", onMove);
  window.addEventListener("pointerup", stopGesture);
  window.addEventListener("pointercancel", stopGesture);
};

/*
  Rects are measured once per gesture. `getBoundingClientRect` reports the
  on-screen box — it already includes both the canvas zoom and this block's own
  scale — so every gesture stays accurate at any zoom level.
*/
const measure = () => ({
  sheetRect: sheet.el.value.getBoundingClientRect(),
  blockRect: el.value.getBoundingClientRect(),
});

const canGesture = (event) =>
  editable.value && event.button === 0 && Boolean(sheet?.el.value);

const onPointerDown = (event) => {
  if (!canGesture(event)) return;

  event.preventDefault();

  const { sheetRect, blockRect } = measure();

  const grabX = event.clientX - (sheetRect.left + (props.x / 100) * sheetRect.width);
  const grabY = event.clientY - (sheetRect.top + (props.y / 100) * sheetRect.height);

  const maxX = 100 - (blockRect.width / sheetRect.width) * 100;
  const maxY = 100 - (blockRect.height / sheetRect.height) * 100;

  const onPointerMove = (moveEvent) => {
    const x = ((moveEvent.clientX - grabX - sheetRect.left) / sheetRect.width) * 100;
    const y = ((moveEvent.clientY - grabY - sheetRect.top) / sheetRect.height) * 100;

    emit("update:x", snapPercent(x, maxX));
    emit("update:y", snapPercent(y, maxY));
  };

  dragging.value = true;
  startGesture(onPointerMove, () => emit("dragend", { x: props.x, y: props.y }));
};

const onResizeDown = (event) => {
  if (!canGesture(event) || !props.resize) return;

  event.preventDefault();

  const { sheetRect, blockRect } = measure();

  // Distance from the pointer to the edge being dragged, so the handle does
  // not jump under the cursor.
  const grabX = event.clientX - blockRect.right;
  const widthAt = (moveEvent) => moveEvent.clientX - grabX - blockRect.left;

  let onPointerMove;

  if (props.resize === "scale") {
    // Unscaled width, so the pointer maps straight onto a scale factor.
    const baseWidth = blockRect.width / (props.scale || 1);
    if (!baseWidth) return;

    const { min, max, step } = SCALE_RANGE;

    onPointerMove = (moveEvent) => {
      const next = Math.round(widthAt(moveEvent) / baseWidth / step) * step;

      emit("update:scale", Math.min(Math.max(Number(next.toFixed(2)), min), max));
    };
  } else {
    const maxWidth = 100 - ((blockRect.left - sheetRect.left) / sheetRect.width) * 100;

    onPointerMove = (moveEvent) => {
      const width = (widthAt(moveEvent) / sheetRect.width) * 100;

      emit("update:width", Math.max(props.minWidth, snapPercent(width, maxWidth)));
    };
  }

  resizing.value = true;
  startGesture(onPointerMove);
};

onBeforeUnmount(() => stopGesture?.());
</script>

<template>
  <div
    ref="el"
    class="report-draggable"
    :class="{
      'report-draggable--editable': editable,
      'report-draggable--active': dragging || resizing,
    }"
    :style="style"
    @pointerdown="onPointerDown"
  >
    <slot />

    <span
      v-if="editable && resize"
      class="report-draggable__handle no-print"
      :class="`report-draggable__handle--${resize}`"
      :style="handleStyle"
      @pointerdown.stop="onResizeDown"
    />
  </div>
</template>

<style lang="scss">
.report-draggable {
  position: absolute;

  &--editable {
    cursor: move;
    outline: 1px dashed rgba(0, 0, 0, 25%);
    outline-offset: 4px;

    /* required so a touch drag is not swallowed by scrolling */
    touch-action: none;
    user-select: none;
  }

  &--active {
    outline-color: rgba(25, 118, 210, 80%);
  }

  &__handle {
    position: absolute;
    background: #1976d2;
    block-size: 10px;
    inline-size: 10px;
    inset-block-end: -9px;
    inset-inline-end: -9px;
    touch-action: none;

    &--width {
      cursor: ew-resize;
    }

    &--scale {
      cursor: nwse-resize;
    }
  }
}

@media print {
  .report-draggable {
    outline: none !important;
  }
}
</style>
