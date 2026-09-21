<script setup>
import {
  DATE_Z_INDEX,
  SIGNATURE_SIZE_RANGE,
  fontFamily,
} from "@/config/report";
import { SCHEDULE_REPORT_CONFIG } from "@/config/scheduleReport";
import { resolveReportAsset } from "@/utils/reportAsset";

const props = defineProps({
  config: { type: Object, required: true },
  className: { type: String, default: "" },
  khmerDate: { type: Object, default: () => ({}) },
  setting: { type: Object, required: true },
  isPrimary: { type: Boolean, default: true },
  classTeacher: { type: Object, default: null },
  days: { type: Array, default: () => [] },
  scheduleRows: { type: Array, default: () => [] },
  scheduleTableStyle: { type: Object, default: () => ({}) },
  listedTeachers: { type: Array, default: () => [] },
  localized: { type: Function, required: true },
  teacherLine: { type: Function, required: true },
  signatureStyle: { type: Function, required: true },
  signatureNameStyle: { type: Function, required: true },
});

const { config } = toRefs(props);

const logoSrc = computed(() => resolveReportAsset(config.value.header?.logo));
</script>

<template>
  <ReportDraggable
    v-if="config.header.showLogo && config.header.logo"
    v-model:x="config.header.logoBox.x"
    v-model:y="config.header.logoBox.y"
    v-model:width="config.header.logoBox.width"
    :z-index="1"
    resize="width"
  >
    <img :src="logoSrc" alt="" class="schedule-report__logo" />
  </ReportDraggable>

  <header class="schedule-report__header">
    <p
      v-for="(line, index) in config.header.lines"
      :key="index"
      class="mb-0"
      :style="{
        fontFamily: fontFamily(config.fonts.headerLines),
        fontSize: `${config.header.lineFontSize}px`,
        fontWeight: 0,
      }"
    >
      {{ line }}
    </p>

    <p
      v-if="config.header.title"
      style="margin-top: 30px"
      class="schedule-report__title"
      :style="{
        fontFamily: fontFamily(config.fonts.title),
        fontSize: `${config.header.titleFontSize}px`,
      }"
    >
      {{ config.header.title }}
    </p>

    <p
      v-if="className"
      class="mb-0"
      :style="{
        fontFamily: fontFamily(config.fonts.title),
        fontSize: `${config.header.titleFontSize}px`,
      }"
    >
      ថ្នាក់ទី {{ className }}
      <template v-if="setting.year_name"> ឆ្នាំសិក្សា{{ setting.year_name }}</template>
    </p>
    <p
      v-else-if="setting.year_name"
      class="mb-0"
      :style="{ fontSize: `${config.header.subtitleFontSize}px` }"
    >
      ឆ្នាំសិក្សា{{ setting.year_name }}
    </p>
    <p
      v-if="config.header.subtitle"
      class="mb-0"
      :style="{ fontSize: `${config.header.subtitleFontSize}px` }"
    >
      {{ config.header.subtitle }}
    </p>
    <div class="schedule-report__date-slot" />
  </header>

  <ReportDraggable
    v-if="khmerDate.lunar || khmerDate.gregorian"
    v-model:x="config.header.dateBox.x"
    v-model:y="config.header.dateBox.y"
    :z-index="DATE_Z_INDEX"
    class="schedule-report__date"
  >
    <div
      :style="{
        fontFamily: fontFamily(config.fonts.base),
        fontSize: `${config.header.dateBox.fontSize}px`,
      }"
    >
      <p v-if="khmerDate.lunar" class="mb-1">{{ khmerDate.lunar }}</p>
      <p v-if="khmerDate.gregorian" class="mb-0">{{ khmerDate.gregorian }}</p>
    </div>
  </ReportDraggable>

  <p v-if="isPrimary && classTeacher" class="schedule-report__homeroom">
    {{ $t("Class teacher") }}:
    {{ localized(classTeacher) }}
  </p>

  <table
    style="margin-top: -35px"
    class="schedule-report__table"
    :style="[
      scheduleTableStyle,
      { '--schedule-time-width': SCHEDULE_REPORT_CONFIG.timeColumnWidth },
    ]"
  >
    <thead>
      <tr>
        <th class="schedule-report__time-col">{{ $t("Study time") }}</th>
        <th v-for="day in days" :key="day.id">{{ localized(day) }}</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="row in scheduleRows" :key="row.key">
        <td class="text-center text-no-wrap schedule-report__time-col">
          {{ row.start }} - {{ row.end }}
        </td>
        <template
          v-for="cell in row.dayCells"
          :key="`${row.key}-${cell.dayId}`"
        >
          <td
            v-if="!cell.skip"
            class="text-center schedule-report__subject-cell"
            :class="{ 'schedule-report__break-cell': cell.isBreak }"
            :rowspan="cell.rowspan > 1 ? cell.rowspan : undefined"
            :colspan="cell.colspan > 1 ? cell.colspan : undefined"
          >
            {{ cell.isBreak ? $t("Break") : cell.text }}
          </td>
        </template>
      </tr>
      <tr v-if="!scheduleRows.length">
        <td :colspan="Math.max(days.length, 1) + 1" class="text-center">
          {{ $t("No schedule found for this class.") }}
        </td>
      </tr>
    </tbody>
  </table>

  <ol
    v-if="!isPrimary && listedTeachers.length"
    class="schedule-report__teachers"
  >
    <li v-for="teacher in listedTeachers" :key="teacher.teacher_id">
      {{ teacherLine(teacher) }}
    </li>
  </ol>

  <ReportDraggable
    v-for="signature in config.signatures"
    :key="signature.id"
    v-model:x="signature.x"
    v-model:y="signature.y"
    :z-index="2"
    class="schedule-report__signature"
    :style="signatureStyle(signature)"
  >
    <div>{{ signature.label }}</div>

    <ReportImage
      v-if="signature.showImage && signature.image"
      v-model:width="signature.imageWidth"
        :src="resolveReportAsset(signature.image)"
      :min-width="SIGNATURE_SIZE_RANGE.min"
      :max-width="SIGNATURE_SIZE_RANGE.max"
      class="mb-1"
    />

    <div v-if="signature.showLine" class="schedule-report__signature-line" />
    <div class="font-weight-bold" :style="signatureNameStyle(signature)">
      {{ signature.name }}
    </div>
  </ReportDraggable>

  <footer v-if="config.footer.show" class="schedule-report__footer">
    {{ config.footer.note }}
  </footer>
</template>

<style lang="scss">
.schedule-report {
  &__header {
    margin-block-end: 16px;
    text-align: center;
  }

  &__logo {
    display: block;
    inline-size: 100%;
    block-size: auto;
  }

  &__title {
    margin-block: 10px 2px;
  }

  &__date {
    text-align: center;
    pointer-events: auto;
  }

  &__date-slot {
    block-size: 2.6em;
    margin-block-start: 6px;
  }

  &__homeroom {
    margin-block: 0 8px;
    font-size: 13px;
  }

  &__table {
    inline-size: 100%;
    border-collapse: collapse;
    table-layout: fixed;

    th,
    td {
      padding: 3px 5px;
      border: 1px solid #000;
    }

    th {
      background: #f0f0f0;
      font-weight: 700;
    }
  }

  &__time-col {
    inline-size: var(--schedule-time-width, 14%);
  }

  &__subject-cell {
    vertical-align: var(--schedule-subject-align, middle);
  }

  &__break-cell {
    background: var(--schedule-break-bg, #fde8e8);
  }

  &__teachers {
    margin-block: 10px 0;
    padding-inline-start: 5px;
    font-size: 12px;
    line-height: 1.55;
    column-count: 2;
    column-gap: 24px;
  }

  &__teachers li {
    break-inside: avoid;
  }

  &__signature {
    min-inline-size: 120px;
    text-align: center;
  }

  &__signature-line {
    margin-block: 0 4px;
    border-block-end: 1px solid #000;
  }

  &__footer {
    position: absolute;
    font-size: 11px;
    font-style: italic;
    inset-block-end: 6mm;
    inset-inline: 10mm;
  }
}
</style>
