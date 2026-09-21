<script setup>
import ReportToolbar from "./components/ReportToolbar.vue";
import { REPORT_PANEL_OUTLET, REPORT_PRINT_AREA_ID } from "@/config/report";

// Owns the state the toolbar drives; pages read it back with `useReport()`.
const report = provideReportContext();
const { store, paper } = report;

const { injectSkinClasses } = useSkins();

injectSkinClasses();

/*
  The sheet paints its own margin as padding, so @page keeps a zero margin —
  that is what makes the printed result match the screen exactly.
*/
const pageCss = computed(() => {
  const size = paper.value
    ? `${paper.value.size} ${paper.value.orientation}`
    : "auto";

  return `size: ${size}; margin: 0;`;
});

watchEffect(() => {
  // Covers Ctrl+P on the whole window…
  usePrintStyle(pageCss.value).inject();

  // …and the iframe `v-print` builds, which starts from an empty document.
  report.printObj.extraHead = `<style>@page { ${pageCss.value} }</style>`;
});

// SECTION: Loading Indicator
const isFallbackStateActive = ref(false);
const refLoadingIndicator = ref(null);

watch(
  [isFallbackStateActive, refLoadingIndicator],
  () => {
    if (isFallbackStateActive.value && refLoadingIndicator.value)
      refLoadingIndicator.value.fallbackHandle();
    if (!isFallbackStateActive.value && refLoadingIndicator.value)
      refLoadingIndicator.value.resolveHandle();
  },
  { immediate: true },
);
// !SECTION
</script>

<template>
  <div class="layout-wrapper layout-report" data-allow-mismatch>
    <AppLoadingIndicator ref="refLoadingIndicator" />

    <ReportToolbar />

    <div class="report-body">
      <!--
        Pages teleport their customisation panel here so it stays outside the
        printed area. Declared before the canvas so the target exists early.
      -->
      <aside :id="REPORT_PANEL_OUTLET" class="report-panel no-print" />

      <div class="report-canvas">
        <div class="report-zoom" :style="{ transform: `scale(${store.zoom})` }">
          <VThemeProvider theme="light">
            <!-- Only what lives in here reaches the printer. -->
            <div :id="REPORT_PRINT_AREA_ID">
              <RouterView v-slot="{ Component }">
                <Suspense
                  :timeout="0"
                  @fallback="isFallbackStateActive = true"
                  @resolve="isFallbackStateActive = false"
                >
                  <Component :is="Component" />
                </Suspense>
              </RouterView>
            </div>
          </VThemeProvider>
        </div>
      </div>
    </div>
  </div>
</template>

<style lang="scss">
.layout-wrapper.layout-report {
  display: flex;
  flex-direction: column;
  min-block-size: 100vh;
  background: rgb(var(--v-theme-background));

  .report-body {
    display: flex;
    align-items: flex-start;
    flex: 1;
    overflow: hidden;
  }

  .report-panel {
    flex: 0 0 auto;
    max-block-size: calc(100vh - 60px);
    overflow-y: auto;
    inline-size: 330px;
    padding: 16px;

    &:empty {
      display: none;
    }
  }

  .report-canvas {
    display: flex;
    flex: 1;
    justify-content: center;
    padding: 24px;
    overflow: auto;
  }

  .report-zoom {
    transform-origin: top center;
  }
}

/*
  Only needed when the user presses Ctrl+P instead of the Print button:
  strip the app chrome so the sheets are all that is left.
*/
@media print {
  html,
  body {
    background: #fff !important;
    block-size: auto !important;
    overflow: visible !important;
  }

  .v-application,
  .v-application__wrap {
    display: block !important;
    background: #fff !important;
    min-block-size: 0 !important;
  }

  .no-print,
  .v-overlay-container,
  .vue-notification-group,
  .toast-stack {
    display: none !important;
  }

  .layout-wrapper.layout-report {
    min-block-size: 0;
    background: #fff;

    .report-body,
    .report-canvas {
      display: block;
      padding: 0;
      overflow: visible;
    }

    .report-zoom {
      transform: none !important;
    }
  }
}
</style>
