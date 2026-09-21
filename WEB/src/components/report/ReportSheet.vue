<script setup>
import {
  DEFAULT_PAPER,
  GRID_STEP,
  fontFamily,
  paperDimensions,
} from "@/config/report";

const props = defineProps({
  // Override the paper of this single sheet. Defaults to the template paper
  // chosen in the toolbar.
  paper: {
    type: Object,
    default: null,
  },

  // Show the alignment grid. `null` follows the toolbar's design mode.
  grid: {
    type: Boolean,
    default: null,
  },

  /** When there is no report layout context (e.g. phone preview capture). */
  fonts: {
    type: Object,
    default: null,
  },
});

const report = useReportContext();
const sheetEl = ref(null);

provideReportSheet({ el: sheetEl });

const paper = computed(
  () => props.paper ?? report?.paper.value ?? DEFAULT_PAPER,
);

const showGrid = computed(() =>
  props.grid === null ? Boolean(report?.designMode.value) : props.grid,
);

const style = computed(() => {
  const { width, height } = paperDimensions(paper.value);

  return {
    inlineSize: `${width}mm`,
    minBlockSize: `${height}mm`,
    padding: `${paper.value.margin ?? 0}mm`,

    // Inherited by everything on the paper that does not pick its own font.
    fontFamily:
      fontFamily(props.fonts?.base ?? report?.template.value?.fonts?.base) ??
      fontFamily("suwannaphum"),
  };
});

const gridStyle = computed(() => ({
  backgroundSize: `${GRID_STEP}mm ${GRID_STEP}mm`,
}));
</script>

<template>
  <div ref="sheetEl" class="report-sheet" :style="style">
    <div v-if="showGrid" class="report-sheet__grid no-print" :style="gridStyle" />

    <slot />
  </div>
</template>

<style lang="scss">
@import "../../assets/fonts/font.css";

/*
  Deliberately plain CSS: `vue3-print-nb` clones this element into a blank
  iframe, so anything that depends on an ancestor (`.v-application`, theme
  CSS variables, dark mode) is not available while printing.
  Use explicit colours and fonts inside the sheet.
*/
.report-sheet {
  position: relative;
  box-sizing: border-box;
  margin-block-end: 16px;
  background: #fff;
  box-shadow: 0 2px 12px rgba(0, 0, 0, 15%);
  color: #000;
  font-size: 13px;
  line-height: 1.5;

  &__grid {
    position: absolute;
    background-image:
      linear-gradient(to right, rgba(0, 0, 0, 8%) 1px, transparent 1px),
      linear-gradient(to bottom, rgba(0, 0, 0, 8%) 1px, transparent 1px);
    inset: 0;
    pointer-events: none;
  }

  table {
    border-collapse: collapse;
    inline-size: 100%;
  }
}

@media print {
  .report-sheet {
    margin: 0;
    box-shadow: none;
  }

  .report-sheet + .report-sheet {
    break-before: page;
  }
}
</style>
