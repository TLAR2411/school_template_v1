<script setup>
import html2canvas from "html2canvas";
import { useReportStore } from "@/stores/reportStore";
import {
  DATE_BOX_DEFAULTS,
  SIGNATURE_DEFAULTS,
  fontFamily,
} from "@/config/report";
import ScheduleReportPaper from "@/views/school/Schedule/ScheduleReportPaper.vue";
import {
  SCHEDULE_REPORT_STORE_KEY,
  scheduleReportTemplateDefaults,
} from "@/views/school/Schedule/scheduleReportDefaults.js";
import { useScheduleReportData } from "@/views/school/Schedule/useScheduleReportData.js";

definePage({
  meta: {
    title: "Schedule Preview",
    layout: "blank",
    subject: "Auth",
    requiresAuth: true,
  },
});

const route = useRoute();
const router = useRouter();
const reportStore = useReportStore();

const config = computed(() => reportStore.templates[SCHEDULE_REPORT_STORE_KEY]);

const captureRoot = ref(null);
const previewImage = ref(null);
const capturing = ref(true);

const {
  setting,
  isLoading,
  reportDate,
  localized,
  khmerDate,
  className,
  isPrimary,
  classTeacher,
  listedTeachers,
  teacherLine,
  days,
  scheduleRows,
  scheduleTableStyle,
  loadReport,
} = useScheduleReportData();

const signatureStyle = (signature) => ({
  fontFamily: fontFamily(signature.font || config.value?.fonts?.signature),
  fontSize: `${signature.fontSize}px`,
});

const signatureNameStyle = (signature) => ({
  fontFamily: fontFamily(
    signature.nameFont || signature.font || config.value?.fonts?.signature,
  ),
  fontSize: `${signature.nameFontSize}px`,
});

const normalizeConfig = () => {
  const tpl = reportStore.ensure(
    SCHEDULE_REPORT_STORE_KEY,
    scheduleReportTemplateDefaults,
  );

  tpl.signatures = tpl.signatures.map((signature) => ({
    ...SIGNATURE_DEFAULTS,
    ...signature,
    imageWidth:
      signature.imageWidth ?? signature.width ?? SIGNATURE_DEFAULTS.imageWidth,
  }));

  tpl.header.dateBox = {
    ...DATE_BOX_DEFAULTS,
    ...tpl.header.dateBox,
  };
};

async function waitForAssets(el) {
  if (!el) return;

  if (document.fonts?.ready) {
    try {
      await document.fonts.ready;
    } catch {
      /* ignore */
    }
  }

  const imgs = [...el.querySelectorAll("img")];

  await Promise.all(
    imgs.map((img) =>
      img.complete
        ? Promise.resolve()
        : new Promise((resolve) => {
            img.addEventListener("load", resolve, { once: true });
            img.addEventListener("error", resolve, { once: true });
          }),
    ),
  );
}

async function buildPreviewImage() {
  capturing.value = true;
  previewImage.value = null;

  await nextTick();
  await waitForAssets(captureRoot.value);

  const el = captureRoot.value;

  if (!el) {
    capturing.value = false;

    return;
  }

  try {
    const scale = Math.min(window.devicePixelRatio || 1, 2);

    const canvas = await html2canvas(el, {
      scale,
      backgroundColor: "#ffffff",
      useCORS: true,
      allowTaint: true,
      logging: false,
    });

    previewImage.value = canvas.toDataURL("image/png");
  } finally {
    capturing.value = false;
  }
}

const goToDesign = () => {
  router.push({
    name: "school-schedule-print",
    query: { ...route.query },
  });
};

onMounted(async () => {
  normalizeConfig();

  await reportStore.load(
    SCHEDULE_REPORT_STORE_KEY,
    scheduleReportTemplateDefaults,
  );

  const dateFromQuery = route.query.report_date;

  if (typeof dateFromQuery === "string" && dateFromQuery)
    reportDate.value = dateFromQuery;

  await loadReport();
  await buildPreviewImage();
});
</script>

<template>
  <div class="schedule-preview-page">
    <header class="schedule-preview-page__bar">
      <VBtn variant="text" size="small" @click="goToDesign">
        <VIcon icon="tabler-arrow-left" start />
        {{ $t("Back to design") }}
      </VBtn>
      <span class="schedule-preview-page__title">{{ $t("Preview") }}</span>
      <VSpacer />
      <VProgressCircular
        v-if="isLoading || capturing"
        indeterminate
        size="22"
        width="2"
        class="me-2"
      />
    </header>

    <main class="schedule-preview-page__main">
      <div v-if="capturing || isLoading" class="schedule-preview-page__loading">
        <VProgressCircular indeterminate color="primary" size="40" width="3" />
        <span class="text-caption text-medium-emphasis mt-3">
          {{ $t("Generating preview…") }}
        </span>
      </div>

      <img
        v-else-if="previewImage"
        :src="previewImage"
        class="schedule-preview-page__image"
        alt=""
        draggable="false"
      />

      <p v-else class="schedule-preview-page__empty text-caption text-medium-emphasis">
        {{ $t("No preview available.") }}
      </p>
    </main>

    <!-- Full-size sheet off-screen, captured as one PNG for the phone screen -->
    <div
      v-if="config"
      ref="captureRoot"
      data-capture-root="true"
      class="schedule-preview-capture"
      aria-hidden="true"
    >
      <ReportSheet :paper="config.paper" :fonts="config.fonts" :grid="false">
        <ScheduleReportPaper
          :config="config"
          :class-name="className"
          :khmer-date="khmerDate"
          :setting="setting"
          :is-primary="isPrimary"
          :class-teacher="classTeacher"
          :days="days"
          :schedule-rows="scheduleRows"
          :schedule-table-style="scheduleTableStyle"
          :listed-teachers="listedTeachers"
          :localized="localized"
          :teacher-line="teacherLine"
          :signature-style="signatureStyle"
          :signature-name-style="signatureNameStyle"
        />
      </ReportSheet>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.schedule-preview-page {
  display: flex;
  flex-direction: column;
  block-size: 100vh;
  block-size: 100dvh;
  overflow: hidden;
  background: #fff;

  &__bar {
    z-index: 2;
    display: flex;
    flex-shrink: 0;
    align-items: center;
    gap: 8px;
    padding: 8px 12px;
    background: rgb(var(--v-theme-surface));
    border-block-end: 1px solid rgba(var(--v-border-color), 12%);
  }

  &__title {
    font-size: 15px;
    font-weight: 500;
  }

  &__main {
    display: flex;
    flex: 1;
    flex-direction: column;
    min-block-size: 0;
    overflow: auto;
    background: #fff;
  }

  &__loading,
  &__empty {
    display: flex;
    flex: 1;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    min-block-size: 0;
    padding: 24px;
    text-align: center;
  }

  &__image {
    display: block;
    inline-size: 100%;
    max-inline-size: 100%;
    block-size: auto;
    margin-inline: auto;
    background: #fff;
  }
}

/* Large screens: cap width so the sheet is not overly stretched */
@media (min-width: 768px) {
  .schedule-preview-page__main {
    align-items: center;
    padding: 16px;
    background: rgb(var(--v-theme-background));
  }

  .schedule-preview-page__image {
    inline-size: 100%;
    max-inline-size: min(920px, 92vw);
    border-radius: 8px;
    box-shadow: 0 2px 20px rgba(0, 0, 0, 10%);
  }
}

/* In DOM for html2canvas; not shown on the page */
.schedule-preview-capture {
  position: fixed;
  z-index: -1;
  overflow: visible;
  inset-block-start: 0;
  inset-inline-start: 0;
  pointer-events: none;
  /* Off-screen but painted — html2canvas cannot snapshot opacity: 0 nodes */
  transform: translateX(-200vw);
}
</style>
