# Report layout

A second layout, next to `default` and `blank`, for printable documents.
It gives you a toolbar (paper size, orientation, margin, zoom, design mode,
save, print), a real A4/A5/Letter/Legal sheet on screen, and drag-and-drop
positioning for things like signatures — so the user designs the report first,
then prints it.

Optional **Preview** button: pass `previewRoute` and `getPreviewQuery` to
`useReport()` on the print page; the toolbar opens that route with the current
query (e.g. `class_id`, `report_date`).

Printing uses [`vue3-print-nb`](https://github.com/Power-kxLee/vue-print-nb):
only the paper is sent to the printer, never the app chrome.

---

## Files

| File | What it does |
|---|---|
| `src/layouts/report.vue` | The layout. Toolbar + paper canvas + print area. |
| `src/layouts/components/ReportToolbar.vue` | The toolbar controls. |
| `src/config/report.js` | Paper sizes, defaults, snap grid, outlet ids. **Tweak here first.** |
| `src/stores/reportStore.js` | Saved template config per report, persisted to `localStorage`. |
| `src/composables/useReport.js` | `useReport()` for pages, plus the sheet/geometry helpers. |
| `src/components/report/ReportSheet.vue` | One sheet of paper. |
| `src/components/report/ReportImage.vue` | In-flow photo with the same zoom-by-width handle as the logo. |
| `src/components/report/ReportFontSelect.vue` | Font dropdown; each option is drawn in its own typeface. |
| `src/utils/readImageFile.js` | Reads an uploaded picture into a downscaled data URL. |
| `src/utils/formatReportDate.js` | Khmer lunar + Gregorian labels for a `YYYY-MM-DD` date. |
| `src/pages/school/Schedule/print.vue` | Working example — copy this for a new report. |
| `src/config/scheduleReport.js` | Schedule print table: hour rows, merge cells, day range. |
| `src/pages/school/Schedule/preview.vue` | Mobile-width image preview for the schedule report. |

---

## Step by step: add a new report

### 1. Create the page

Put it next to the page it prints from. The file path becomes the route name,
so `src/pages/school/Transcript/print.vue` becomes `school-transcript-print`.

```vue
<script setup>
definePage({
  meta: {
    title: "Transcript Report",
    layout: "report",          // ← this line picks the report layout
    subject: "Auth",
    requiresAuth: true,
    permissions: "view-transcripts",
  },
});
</script>
```

Nothing to register in `src/router/index.js`: the layout is found by filename
and the route by file path.

### 2. Declare what the user can customise

Call `useReport()` once. `defaults` is the starting design — the store keeps
whatever the user changed after that.

```js
const { template: config, designMode } = useReport({
  key: "school-transcript",        // storage key, must be unique per report
  title: "Transcript Report",      // toolbar + print window title
  defaults: {
    header: {
      title: "សញ្ញាបត្រ",
      lines: ["ព្រះរាជាណាចក្រកម្ពុជា", "ជាតិ សាសនា ព្រះមហាក្សត្រ"],
    },
    signatures: [
      { id: "principal", label: "នាយកសាលា", name: "", x: 62, y: 76, showLine: true },
    ],
  },
});
```

Every report already has `paper`, `header`, `footer` and `signatures` — see
`baseTemplate()` in `src/stores/reportStore.js`. Add any field you like under
`defaults`; it is stored and restored automatically.

### 3. Draw the paper

```vue
<template>
  <ReportSheet>
    <h2 class="text-center">{{ config.header.title }}</h2>

    <table>...</table>

    <ReportDraggable
      v-for="signature in config.signatures"
      :key="signature.id"
      v-model:x="signature.x"
      v-model:y="signature.y"
    >
      {{ signature.label }}
    </ReportDraggable>
  </ReportSheet>
</template>
```

`ReportSheet` and `ReportDraggable` are auto-registered, no import needed.
For a multi-page report just render several `ReportSheet`s — each one starts a
new printed page.

### 4. Add the customisation panel

Teleport it into the layout's panel outlet so it never reaches the printer:

```vue
<Teleport defer :to="`#${REPORT_PANEL_OUTLET}`">
  <div v-if="designMode">
    <VSwitch v-model="config.header.showLogo" :label="$t('Show logo')" />
    <AppImageUploadBox
      :label="$t('Logo')"
      icon="tabler-photo-plus"
      :preview-url="config.header.logo"
      @change="onLogoChange"
      @clear="config.header.logo = null"
    />
  </div>
</Teleport>
```

Import the id from the config: `import { REPORT_PANEL_OUTLET } from "@/config/report"`.
There is a second outlet, `REPORT_TOOLBAR_OUTLET`, for page-specific toolbar
buttons.

### 5. Link to it

Open it in a new tab so printing does not disturb the list page:

```js
const openReport = () => {
  const { href } = router.resolve({
    name: "school-schedule-print",
    query: { class_id: formSearch.value.class_id },
  });

  window.open(href, "_blank");
};
```

Pass filters through the query string, not through a store, so a refresh or a
shared link still works. Read them back with `route.query` and fetch in
`onMounted`.

---

## Schedule report

`src/pages/school/Schedule/print.vue` follows the paper samples:

- **Date.** Pick a day in the toolbar. The printed Khmer lunar and Gregorian
  lines are a free-floating block: drag them in design mode. They sit above
  the logo and signature pictures (`DATE_Z_INDEX` in `src/config/report.js`).
- **Primary (grade 1–6, nursery).** One homeroom teacher (`is_classload`), no
  numbered list. `PRIMARY_MAX_GRADE` in `src/config/report.js`.
- **Secondary / high school (grade 7+).** The week grid plus a numbered list
  of every teacher assigned to the class.

Switch the toolbar to landscape if a saved template is still portrait.

---

## Rules for anything drawn on the sheet

`vue3-print-nb` clones the print area into an **empty iframe**. All the app's
CSS is copied along with it, but the ancestors are not — no `.v-application`,
no `.v-theme--light`, no theme CSS variables.

- Use explicit colours: `color: #000`, `background: #f0f0f0`.
  `rgb(var(--v-theme-surface))` prints as nothing.
- Set the font explicitly with an inline `font-family`. `ReportSheet`
  inherits `fonts.base`; header lines and signatures pick their own.
  The `.suwannaphum` helper classes in `font.css` are scoped to `App.vue`
  and will not reach the print iframe.
- Prefer plain `<table>` / `<div>` over `VTable` / `VCard` on the paper.
  Vuetify components render, but their colours come from theme variables.
- Style with top-level class names (`.schedule-report__table`), not selectors
  that depend on a parent outside the sheet.
- Anything inside the sheet that is only a design aid gets `class="no-print"`.

## Positions and sizes

`ReportDraggable` stores `x` / `y` (and `width`, for images) as a
**percentage of the sheet**, snapped to `SNAP_STEP`. Percentages mean an
element stays in the same relative spot when the user switches A4 to A5,
and both gestures stay accurate at any zoom level. They only work while
design mode is on.

Positions are measured against the whole sheet, including the margin, so
`x: 0` sits on the very edge of the paper.

The corner handle has two modes:

```vue
<!-- Logo: free-floating, width is a percent of the sheet -->
<ReportDraggable
  v-model:x="logo.x"
  v-model:y="logo.y"
  v-model:width="logo.width"
  resize="width"
>

<!-- Signature photo: same unit as the logo, but stays inside the signature -->
<ReportImage v-model:width="signature.imageWidth" :src="signature.image" />
```

`ReportImage` sizes the picture in millimetres from a **percent of the sheet**,
so a 14% signature photo is the same size as a 14% logo. Height follows the
photo's aspect ratio. The signature block itself is only dragged to move —
its letters use `fontSize` / `nameFontSize` and do not change when the photo
zooms.

Header lines, title and subtitle have their own font-size sliders
(`lineFontSize`, `titleFontSize`, `subtitleFontSize` on `config.header`).

Defaults live in `src/config/report.js`: `LOGO_DEFAULTS`, `HEADER_DEFAULTS`,
`SIGNATURE_DEFAULTS`, `MIN_ELEMENT_WIDTH`, `SIGNATURE_SIZE_RANGE`,
`FONT_SIZE_RANGE`.

## Fonts

Each report has a `fonts` group (`base`, `headerLines`, `title`,
`signature`) plus optional per-signature `font` and `nameFont` overrides.
The dropdown is `ReportFontSelect`; the list of faces is `FONT_OPTIONS` in
`src/config/report.js`. To offer a new face:

1. Add the `@font-face` in `src/assets/fonts/font.css`.
2. Add a `{ value, title }` row to `FONT_OPTIONS`. `value` must match the
   CSS family name.

Apply fonts as inline styles (`fontFamily(name)` from the same config)
so they survive the print clone. Do not rely on the `.suwannaphum` helper
classes — those are scoped to `App.vue`.

## Uploaded pictures

The logo and each teacher's signature go through `readImageFile()`, which
downscales to `IMAGE_MAX_WIDTH` (600px) and encodes WebP so transparency
survives — a signature scanned as a transparent PNG will not print inside a
white box. Without downscaling, a few photos from a phone would blow past the
~5MB localStorage limit.

When templates move to the API, upload these through the existing
`storeImage()` helper and keep the returned path in the config instead of the
data URL. Long term the teacher's signature belongs on `teachers.signature_path`
next to `photo_path`, with the report referring to the teacher rather than
holding a copy of the picture.

## Margins

The sheet paints its own margin as padding and the `@page` rule is kept at
`margin: 0`. That is what makes the print match the screen exactly. Change the
margin from the toolbar, or the default in `DEFAULT_PAPER`.

## Where the design is stored

**Database:** `report_templates` (`key`, `branch_id`, `config` JSON). API:
`report-templates-show`, `report-templates-save`.

**Which report?** Each print page passes a unique `key` to `useReport()` — see
`src/config/reportKeys.js` (`school-schedule`, `school-score`, …). Shared logo
and header lines use `report-brand` and are merged on load.

**Cache:** `localStorage` (Pinia persist) keeps a copy on the device; Save
writes to the API so all staff on the same branch see the same design.

The branch is taken from `X-Branch-Id` / `branchId` on each request
(`src/utils/api.js`).

Two things not to put in the JSON config:

- **Image bytes.** Upload the logo/signature and store the returned path. A
  base64 image makes every settings response huge.
- **Teacher names.** Store which slot maps to which role and resolve the real
  teacher at print time, otherwise a report reprinted next year still shows the
  teacher who left.

---

## Troubleshooting

**An extra blank page prints.** The content overflows the sheet by a fraction.
Reduce the margin, or subtract 1mm from the height in `PAPER_SIZES`.

**Content is longer than one sheet.** It flows onto the next printed page, but
the signatures are positioned against the whole (now taller) sheet, so they can
end up on the wrong page. For long reports split the rows and render one
`<ReportSheet>` per page.

**Print output has no styling.** Something on the paper depends on an ancestor
that does not exist in the print iframe. See the rules above.

**Khmer text prints as boxes.** The `@font-face` rules are copied from the app,
so this normally works. If it fails, set the font on the element itself rather
than inheriting it.

**The print button does nothing.** It is disabled until the page has called
`useReport()` with a `key`.

**Dragging does not work.** Design mode is off (toolbar switch), or the
`ReportDraggable` is not inside a `ReportSheet`.

**No resize handle.** The element is missing `resize="width"` or
`resize="scale"`, or design mode is off. The handle is also hidden while
printing.

**A signature picture prints with a white box around it.** The upload was a
JPEG, which has no transparency. Re-scan it as a PNG with a transparent
background.

**`useReport() requires the report layout`.** The page is missing
`layout: "report"` in its `definePage` meta.
