import { useReportStore } from "@/stores/reportStore";
import { REPORT_PRINT_AREA_ID, SNAP_STEP } from "@/config/report";

const REPORT_CONTEXT = Symbol("report-context");
const SHEET_CONTEXT = Symbol("report-sheet-context");

/* -------------------------------------------------------------------------- */
/* Layout context                                                              */
/* -------------------------------------------------------------------------- */

/**
 * Called once by `layouts/report.vue`. Holds the state the toolbar drives and
 * hands it down to the page rendered inside the layout.
 */
export function provideReportContext() {
  const store = useReportStore();

  const key = ref(null);
  const title = ref("Report");
  const defaults = ref({});
  const designMode = ref(true);
  const saving = ref(false);
  const previewRoute = ref(null);
  const getPreviewQuery = ref(() => ({}));

  const template = computed(() =>
    key.value ? store.templates[key.value] ?? null : null,
  );
  const paper = computed(() => template.value?.paper ?? null);
  const isReady = computed(() => Boolean(template.value));

  // `v-print` reads this object once when the button mounts, so mutate it —
  // never reassign it.
  const printObj = reactive({
    id: REPORT_PRINT_AREA_ID,
    popTitle: title.value,
    preview: false,
  });

  watchEffect(() => {
    printObj.popTitle = title.value;
  });

  const register = (options = {}) => {
    key.value = options.key;
    title.value = options.title ?? options.key;
    defaults.value = options.defaults ?? {};
    designMode.value = options.designMode ?? true;
    previewRoute.value = options.previewRoute ?? null;
    getPreviewQuery.value = options.getPreviewQuery ?? (() => ({}));

    store.ensure(options.key, defaults.value);
    void store.load(options.key, defaults.value);

    return store.templates[options.key];
  };

  const save = async () => {
    if (!key.value) return;

    saving.value = true;
    try {
      await store.save(key.value, defaults.value);
    } finally {
      saving.value = false;
    }
  };

  const reset = () => {
    if (key.value) store.reset(key.value, defaults.value);
  };

  const context = {
    store,
    key,
    title,
    designMode,
    saving,
    template,
    paper,
    isReady,
    printObj,
    register,
    save,
    reset,
    previewRoute,
    getPreviewQuery,
  };

  provide(REPORT_CONTEXT, context);

  return context;
}

/**
 * Report context without registering anything — for components that live on
 * the sheet. Returns `null` outside the report layout.
 */
export function useReportContext() {
  return inject(REPORT_CONTEXT, null);
}

/**
 * Page entry point. Call it once in a page that uses `meta.layout = "report"`.
 *
 * @param {object} options
 * @param {string} options.key       Template key, e.g. "school-schedule".
 * @param {string} [options.title]   Shown in the toolbar and the print window.
 * @param {object} [options.defaults] Extra template fields for this report.
 * @param {boolean} [options.designMode] Start in design mode. Default true.
 * @param {string} [options.previewRoute] Route name for the phone preview page.
 * @param {() => Record<string, string>} [options.getPreviewQuery] Extra query params for preview.
 */
export function useReport(options = {}) {
  const context = useReportContext();

  if (!context) {
    throw new Error(
      'useReport() requires the report layout. Add `layout: "report"` to the page meta.',
    );
  }

  if (options.key) context.register(options);

  return context;
}

/* -------------------------------------------------------------------------- */
/* Sheet context                                                               */
/* -------------------------------------------------------------------------- */

/** Called by `ReportSheet` so draggable children can measure the paper. */
export function provideReportSheet(context) {
  provide(SHEET_CONTEXT, context);

  return context;
}

/** Used by `ReportDraggable`. Returns `null` outside a sheet. */
export function useReportSheet() {
  return inject(SHEET_CONTEXT, null);
}

/* -------------------------------------------------------------------------- */
/* Geometry helpers                                                            */
/* -------------------------------------------------------------------------- */

const clamp = (value, min, max) => Math.min(Math.max(value, min), max);

/** Rounds to the snap grid and keeps the value inside `[0, max]`. */
export function snapPercent(value, max = 100) {
  const snapped = Math.round(value / SNAP_STEP) * SNAP_STEP;

  return clamp(Number(snapped.toFixed(2)), 0, Math.max(max, 0));
}
