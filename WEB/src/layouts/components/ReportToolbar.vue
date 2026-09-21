<script setup>
import {
  MARGIN_RANGE,
  ORIENTATIONS,
  PAPER_SIZES,
  REPORT_TOOLBAR_OUTLET,
  ZOOM_RANGE,
} from "@/config/report";

import { useRoute } from "vue-router";
import { useRouter } from "vue-router";
import { useDialog } from "@/composables/useDialog";


// `paper` and `store` are mutated in place, which is how the toolbar writes
// straight into the template config the page is designing.
const {
  title,
  designMode,
  saving,
  isReady,
  printObj,
  paper,
  store,
  save,
  reset,
  previewRoute,
  getPreviewQuery,
} = useReportContext();

const route = useRoute();
const router = useRouter();
const { showDialog } = useDialog();

const paperSizes = Object.keys(PAPER_SIZES);

const onSave = async () => {
  await save();

  showDialog({
    title: "Report template saved",
    icon: "success",
    timer: 1500,
  });
};

const onReset = async () => {
  const confirmed = await showDialog({
    title: "Reset this report to its default design?",
    icon: "warning",
    confirmText: "Reset",
  });

  if (confirmed) reset();
};

const goBack = () => {
  router.back();
};

const openPreview = () => {
  if (!previewRoute?.value) return;

  router.push({
    name: previewRoute.value,
    query: {
      ...route.query,
      ...getPreviewQuery.value(),
    },
  });
};
</script>

<template>
  <div class="report-toolbar no-print">
    <VBtn variant="text" size="small" @click="goBack()">
      <VIcon icon="tabler-arrow-left" start />
      {{ $t("Back") }}
    </VBtn>

    <span class="report-toolbar__title text-truncate">{{ $t(title) }}</span>

    <VDivider vertical class="mx-1" />

    <template v-if="paper">
      <VSelect
        v-model="paper.size"
        :items="paperSizes"
        :label="$t('Paper')"
        density="compact"
        variant="outlined"
        hide-details
        style="max-inline-size: 110px"
      />

      <VBtnToggle
        v-model="paper.orientation"
        density="compact"
        variant="outlined"
        divided
        mandatory
      >
        <VBtn
          v-for="orientation in ORIENTATIONS"
          :key="orientation.value"
          :value="orientation.value"
          :icon="orientation.icon"
          :title="$t(orientation.title)"
          size="small"
        />
      </VBtnToggle>

      <VTextField
        v-model.number="paper.margin"
        type="number"
        :min="MARGIN_RANGE.min"
        :max="MARGIN_RANGE.max"
        :label="$t('Margin')"
        suffix="mm"
        density="compact"
        variant="outlined"
        hide-details
        style="max-inline-size: 116px"
      />
    </template>

    <VDivider vertical class="mx-1" />

    <VIcon icon="tabler-zoom-in" size="18" class="text-disabled" />
    <VSlider
      v-model="store.zoom"
      :min="ZOOM_RANGE.min"
      :max="ZOOM_RANGE.max"
      :step="ZOOM_RANGE.step"
      density="compact"
      hide-details
      style="max-inline-size: 120px"
    />

    <VSwitch
      v-model="designMode"
      :label="$t('Design')"
      density="compact"
      hide-details
      class="ms-2"
    />

    <!-- Pages add their own buttons here — see docs/report-layout.md -->
    <div :id="REPORT_TOOLBAR_OUTLET" class="d-flex align-center gap-2" />

    <VSpacer />

    <VBtn
      variant="text"
      size="small"
      color="error"
      :disabled="!isReady"
      @click="onReset"
    >
      {{ $t("Reset") }}
    </VBtn>

    <VBtn
      v-if="previewRoute"
      variant="tonal"
      size="small"
      color="secondary"
      :disabled="!isReady"
      @click="openPreview"
    >
      <VIcon icon="tabler-device-mobile" start />
      {{ $t("Preview") }}
    </VBtn>

    <VBtn
      variant="tonal"
      size="small"
      :loading="saving"
      :disabled="!isReady"
      @click="onSave"
    >
      <VIcon icon="tabler-device-floppy" start />
      {{ $t("Save") }}
    </VBtn>

    <VBtn v-print="printObj" color="primary" size="small" :disabled="!isReady">
      <VIcon icon="tabler-printer" start />
      {{ $t("Print") }}
    </VBtn>
  </div>
</template>

<style lang="scss">
.report-toolbar {
  position: sticky;
  z-index: 5;
  display: flex;
  flex-wrap: wrap;
  align-items: center;
  gap: 8px;
  padding: 8px 16px;
  background: rgb(var(--v-theme-surface));
  border-block-end: 1px solid rgba(var(--v-border-color), 12%);
  inset-block-start: 0;

  &__title {
    max-inline-size: 220px;
    font-size: 15px;
    font-weight: 500;
  }
}
</style>
