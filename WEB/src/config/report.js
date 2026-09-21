// Everything tweakable about the report layout lives here.
// Sizes are millimetres so they map 1:1 to CSS `mm` and to the @page rule.

// DOM ids the layout owns. Pages teleport into the outlets and `v-print`
// prints the print area.
export const REPORT_PRINT_AREA_ID = "report-print-area"
export const REPORT_TOOLBAR_OUTLET = "report-toolbar-outlet"
export const REPORT_PANEL_OUTLET = "report-panel-outlet"

// Add a paper size by adding a row here — the toolbar picks it up automatically.
export const PAPER_SIZES = {
  A4: { width: 210, height: 297 },
  A5: { width: 148, height: 210 },
  Letter: { width: 216, height: 279 },
  Legal: { width: 216, height: 356 },
}

export const ORIENTATIONS = [
  { value: "portrait", icon: "tabler-rectangle-vertical", title: "Portrait" },
  { value: "landscape", icon: "tabler-rectangle", title: "Landscape" },
]

export const DEFAULT_PAPER = {
  size: "A4",
  orientation: "portrait",
  margin: 10, // mm, applied as padding inside the sheet
}

export const MARGIN_RANGE = { min: 0, max: 40 }

export const ZOOM_RANGE = { min: 0.4, max: 1.6, step: 0.1 }

// Dragged elements snap to this step, expressed in percent of the sheet.
export const SNAP_STEP = 0.5

// Smallest width a resizable element can be dragged to, in percent.
export const MIN_ELEMENT_WIDTH = 5

// Starting box for the logo: position and width in percent of the sheet.
// Top-left by default so it does not sit on top of the centred header lines.
export const LOGO_DEFAULTS = { x: 6, y: 3, width: 14 }

export const LOGO_SIZE_RANGE = { min: MIN_ELEMENT_WIDTH, max: 60 }

// Free-floating date: position in percent of the sheet. z-index sits above
// the logo and signature pictures so the text stays readable on top of them.
export const DATE_BOX_DEFAULTS = { x: 18, y: 20, fontSize: 13 }

export const DATE_Z_INDEX = 20

export const HEADER_DEFAULTS = {
  lineFontSize: 13,
  titleFontSize: 18,
  subtitleFontSize: 13,
}

// `imageWidth` is a percent of the sheet, same unit as the logo, so the
// picture zooms independently of the label and name.
export const SIGNATURE_DEFAULTS = {
  imageWidth: 14,
  fontSize: 13,
  nameFontSize: 13,
  font: "", // empty = follow the report's signature font
  nameFont: "",
  showLine: true,
  showImage: true,
  image: null,
}

export const SIGNATURE_SIZE_RANGE = { min: 6, max: 40 }

export const FONT_SIZE_RANGE = { min: 8, max: 36 }

// Grade 1–6 prints as a single-teacher class; 7+ lists every assigned teacher.
export const PRIMARY_MAX_GRADE = 6

export const SCALE_RANGE = { min: 0.4, max: 3, step: 0.05 }

/*
  Fonts offered in the report panel. `value` must match a family registered
  through @font-face in src/assets/fonts/font.css — add the face there first,
  then add a row here.
*/
export const FONT_OPTIONS = [
  { value: "suwannaphum", title: "Suwannaphum" },
  { value: "hanuman", title: "Hanuman" },
  { value: "nokora", title: "Nokora" },
  { value: "battambang", title: "Battambang" },
  { value: "siemreap", title: "Siem Reap" },
  { value: "odormeanchey", title: "Odor Mean Chey" },
  { value: "moul", title: "Moul" },
  { value: "kantumruy", title: "Kantumruy Pro" },
  { value: "notosans", title: "Noto Sans" },
  { value: "freehand", title: "Freehand" },
  { value: "calibri", title: "Calibri" },
  { value: "googlesans", title: "Google Sans" },
]

export const DEFAULT_FONTS = {
  base: "suwannaphum", // the sheet, inherited by the table
  headerLines: "moul",
  title: "moul",
  signature: "suwannaphum",
}

/** `font-family` value for an inline style, or `undefined` to inherit. */
export function fontFamily(name) {
  return name ? `${name}, sans-serif` : undefined
}

// Uploaded pictures are downscaled to this width before being stored, so a
// saved template stays small enough for localStorage.
export const IMAGE_MAX_WIDTH = 600

// Spacing of the design-mode helper grid, in mm.
export const GRID_STEP = 10

/**
 * Physical size of a sheet, already rotated for landscape.
 * @param {{ size: string, orientation: string }} paper
 */
export function paperDimensions(paper = DEFAULT_PAPER) {
  const { width, height } = PAPER_SIZES[paper?.size] ?? PAPER_SIZES.A4

  return paper?.orientation === "landscape"
    ? { width: height, height: width }
    : { width, height }
}
