/**
 * Schedule print table — change values here only.
 *
 * slotMinutes          Row step (60 = 7:00–8:00, 8:00–9:00, …).
 * defaultHourStart/End Fallback range when deriving grid from data.
 * subjectAlign         "middle" | "top" in subject cells.
 * timeColumnWidth      Width of the time column.
 * breakCellBackground  Empty cells (no subject) — uses i18n "Break" / "សម្រាក".
 * mergeBreakCells      Merge adjacent empty cells across rows and columns (e.g. lunch 11:00–14:00 all week).
 *
 * Multi-hour subjects (e.g. Khmer 7:00–9:00) repeat on each hour row:
 *   7:00–8:00 Khmer | 8:00–9:00 Khmer
 */
export const SCHEDULE_REPORT_CONFIG = {
  slotMinutes: 60,
  defaultHourStart: 7,
  defaultHourEnd: 17,
  subjectAlign: "middle",
  timeColumnWidth: "14%",
  breakCellBackground: "#fde8e8",
  mergeBreakCells: true,
};
