<script setup>
import {
  DATE_BOX_DEFAULTS,
  FONT_SIZE_RANGE,
  IMAGE_MAX_WIDTH,
  LOGO_SIZE_RANGE,
  REPORT_PANEL_OUTLET,
  REPORT_TOOLBAR_OUTLET,
  SIGNATURE_DEFAULTS,
  SIGNATURE_SIZE_RANGE,
  fontFamily,
} from "@/config/report";
import AppDateTimePicker from "@/@core/components/app-form-elements/AppDateTimePicker.vue";
import ScheduleReportPaper from "@/views/school/Schedule/ScheduleReportPaper.vue";
import {
  SCHEDULE_REPORT_STORE_KEY,
  scheduleReportTemplateDefaults,
} from "@/views/school/Schedule/scheduleReportDefaults.js";
import { useScheduleReportData } from "@/views/school/Schedule/useScheduleReportData.js";

import { formatYear } from "@/utils/formater/formatYear";
definePage({
  meta: {
    title: "Schedule Report",
    layout: "report",
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-schedules",
  },
});

const year = "2025 - 2026";

console.log("year", formatYear(year));

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

/*
  Everything the user can customise for this report. Only listed here — the
  store keeps whatever the user changed, so adding a field later is safe.
*/
const { template: config, designMode } = useReport({
  key: SCHEDULE_REPORT_STORE_KEY,
  title: "Schedule Report",
  previewRoute: "school-schedule-preview",
  getPreviewQuery: () => ({ report_date: reportDate.value }),
  defaults: scheduleReportTemplateDefaults,
});

// Saved signatures are stored as a plain array, so a design saved before a
// field existed keeps its old shape. Fill the gaps on the way in; retired keys
// are simply ignored.
config.value.signatures = config.value.signatures.map((signature) => ({
  ...SIGNATURE_DEFAULTS,
  ...signature,
  // Older designs stored the photo size as `width` on the whole block.
  imageWidth:
    signature.imageWidth ?? signature.width ?? SIGNATURE_DEFAULTS.imageWidth,
}));

config.value.header.dateBox = {
  ...DATE_BOX_DEFAULTS,
  ...config.value.header.dateBox,
};

const openPanels = ref([0, 1]);

watch(
  classTeacher,
  (teacher) => {
    const slot = config.value.signatures.find(
      (signature) => signature.id === "class_teacher",
    );

    if (slot && teacher && !slot.name) slot.name = localized(teacher);
  },
  { immediate: true },
);

// Pictures are downscaled before they are stored — a saved template lives in
// localStorage until the report_templates table exists.
const pickImage = async (event) => {
  const file = event.target?.files?.[0];
  if (!file) return null;

  return readImageFile(file, { maxWidth: IMAGE_MAX_WIDTH });
};

const onLogoChange = async (event) => {
  const image = await pickImage(event);

  if (image) config.value.header.logo = image;
};

const onSignatureImageChange = async (signature, event) => {
  const image = await pickImage(event);

  if (image) signature.image = image;
};

const addSignature = () => {
  config.value.signatures.push({
    ...SIGNATURE_DEFAULTS,
    id: `signature_${Date.now()}`,
    label: "",
    name: "",
    x: 40,
    y: 76,
  });
};

const removeSignature = (index) => {
  config.value.signatures.splice(index, 1);
};

// Empty string = inherit the report-level font for that slot.
const signatureStyle = (signature) => ({
  fontFamily: fontFamily(signature.font || config.value.fonts.signature),
  fontSize: `${signature.fontSize}px`,
});

const signatureNameStyle = (signature) => ({
  fontFamily: fontFamily(
    signature.nameFont || signature.font || config.value.fonts.signature,
  ),
  fontSize: `${signature.nameFontSize}px`,
});

onMounted(loadReport);
</script>

<template>
  <!-- Extra toolbar controls, rendered up in the layout toolbar -->
  <Teleport defer :to="`#${REPORT_TOOLBAR_OUTLET}`">
    <AppDateTimePicker
      v-model="reportDate"
      density="compact"
      hide-details
      class="schedule-report-date"
    />
    <!-- 
    <VBtn variant="text" size="small" :loading="isLoading" @click="loadReport">
      <VIcon icon="tabler-refresh" start />
      {{ $t("Reload") }}
    </VBtn> -->
  </Teleport>

  <!-- Customisation panel, rendered outside the printed area -->
  <Teleport defer :to="`#${REPORT_PANEL_OUTLET}`">
    <VExpansionPanels
      v-if="designMode"
      v-model="openPanels"
      multiple
      variant="accordion"
    >
      <VExpansionPanel :title="$t('Header')">
        <VExpansionPanelText>
          <VSwitch
            v-model="config.header.showLogo"
            :label="$t('Show logo')"
            density="compact"
            hide-details
            class="mb-2"
          />

          <template v-if="config.header.showLogo">
            <div class="mb-2" style="block-size: 110px">
              <AppImageUploadBox
                :label="$t('Logo')"
                icon="tabler-photo-plus"
                :preview-url="config.header.logo"
                @change="onLogoChange"
                @clear="config.header.logo = null"
              />
            </div>

            <VSlider
              v-model="config.header.logoBox.width"
              :label="$t('Size')"
              :min="LOGO_SIZE_RANGE.min"
              :max="LOGO_SIZE_RANGE.max"
              :step="0.5"
              density="compact"
              hide-details
              class="mb-4"
            />
          </template>

          <VTextField
            v-for="(line, index) in config.header.lines"
            :key="index"
            v-model="config.header.lines[index]"
            :label="`${$t('Header line')} ${index + 1}`"
            density="compact"
            hide-details
            class="mb-2"
          />

          <VSlider
            v-model="config.header.lineFontSize"
            :label="$t('Header size')"
            :min="FONT_SIZE_RANGE.min"
            :max="FONT_SIZE_RANGE.max"
            :step="1"
            density="compact"
            hide-details
            class="mb-4"
          />

          <VTextField
            v-model="config.header.title"
            :label="$t('Title')"
            density="compact"
            hide-details
            class="mb-2"
          />
          <VSlider
            v-model="config.header.titleFontSize"
            :label="$t('Title size')"
            :min="FONT_SIZE_RANGE.min"
            :max="FONT_SIZE_RANGE.max"
            :step="1"
            density="compact"
            hide-details
            class="mb-4"
          />

          <VTextField
            v-model="config.header.subtitle"
            :label="$t('Subtitle')"
            density="compact"
            hide-details
            class="mb-2"
          />
          <VSlider
            v-model="config.header.subtitleFontSize"
            :label="$t('Subtitle size')"
            :min="FONT_SIZE_RANGE.min"
            :max="FONT_SIZE_RANGE.max"
            :step="1"
            density="compact"
            hide-details
            class="mb-4"
          />

          <VSlider
            v-model="config.header.dateBox.fontSize"
            :label="$t('Date size')"
            :min="FONT_SIZE_RANGE.min"
            :max="FONT_SIZE_RANGE.max"
            :step="1"
            density="compact"
            hide-details
          />
        </VExpansionPanelText>
      </VExpansionPanel>

      <VExpansionPanel :title="$t('Fonts')">
        <VExpansionPanelText>
          <ReportFontSelect
            v-model="config.fonts.headerLines"
            :label="$t('Header font')"
            class="mb-2"
          />
          <ReportFontSelect
            v-model="config.fonts.title"
            :label="$t('Title font')"
            class="mb-2"
          />
          <ReportFontSelect
            v-model="config.fonts.base"
            :label="$t('Body font')"
            class="mb-2"
          />
          <ReportFontSelect
            v-model="config.fonts.signature"
            :label="$t('Signature font')"
          />
        </VExpansionPanelText>
      </VExpansionPanel>

      <VExpansionPanel :title="$t('Signatures')">
        <VExpansionPanelText>
          <p class="text-caption mb-3">
            {{ $t("Drag to move. Drag the corner to resize the picture.") }}
          </p>

          <VCard
            v-for="(signature, index) in config.signatures"
            :key="signature.id"
            variant="outlined"
            class="pa-3 mb-2"
          >
            <VTextField
              v-model="signature.label"
              :label="$t('Label')"
              density="compact"
              hide-details
              class="mb-2"
            />
            <VTextField
              v-model="signature.name"
              :label="$t('Name')"
              density="compact"
              hide-details
            />

            <VSwitch
              v-model="signature.showImage"
              :label="$t('Signature image')"
              density="compact"
              hide-details
            />

            <div
              v-if="signature.showImage"
              class="mb-2"
              style="block-size: 90px"
            >
              <AppImageUploadBox
                :label="$t('Signature image')"
                icon="tabler-signature"
                :preview-url="signature.image"
                @change="onSignatureImageChange(signature, $event)"
                @clear="signature.image = null"
              />
            </div>

            <VSlider
              v-if="signature.showImage"
              v-model="signature.imageWidth"
              :label="$t('Image size')"
              :min="SIGNATURE_SIZE_RANGE.min"
              :max="SIGNATURE_SIZE_RANGE.max"
              :step="0.5"
              density="compact"
              hide-details
              class="mb-2"
            />

            <VSlider
              v-model="signature.fontSize"
              :label="$t('Label size')"
              :min="FONT_SIZE_RANGE.min"
              :max="FONT_SIZE_RANGE.max"
              :step="1"
              density="compact"
              hide-details
              class="mb-2"
            />
            <VSlider
              v-model="signature.nameFontSize"
              :label="$t('Name size')"
              :min="FONT_SIZE_RANGE.min"
              :max="FONT_SIZE_RANGE.max"
              :step="1"
              density="compact"
              hide-details
              class="mb-2"
            />

            <ReportFontSelect
              v-model="signature.font"
              :label="$t('Label font')"
              :inherit-label="$t('Use default font')"
              class="mb-2"
            />
            <ReportFontSelect
              v-model="signature.nameFont"
              :label="$t('Name font')"
              :inherit-label="$t('Use default font')"
              class="mb-2"
            />

            <div class="d-flex align-center justify-space-between">
              <VSwitch
                v-model="signature.showLine"
                :label="$t('Signature line')"
                density="compact"
                hide-details
              />
              <VBtn
                icon="tabler-trash"
                variant="text"
                color="error"
                size="small"
                @click="removeSignature(index)"
              />
            </div>
          </VCard>

          <VBtn variant="tonal" size="small" block @click="addSignature">
            <VIcon icon="tabler-plus" start />
            {{ $t("Add signature") }}
          </VBtn>
        </VExpansionPanelText>
      </VExpansionPanel>

      <VExpansionPanel :title="$t('Footer')">
        <VExpansionPanelText>
          <VSwitch
            v-model="config.footer.show"
            :label="$t('Show footer')"
            density="compact"
            hide-details
          />
          <VTextarea
            v-if="config.footer.show"
            v-model="config.footer.note"
            :label="$t('Note')"
            rows="2"
            density="compact"
            hide-details
          />
        </VExpansionPanelText>
      </VExpansionPanel>
    </VExpansionPanels>
  </Teleport>

  <!-- ── The paper ─────────────────────────────────────────────────────── -->
  <ReportSheet>
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
</template>

<style lang="scss">
.schedule-report-date {
  max-inline-size: 168px;
}
</style>
