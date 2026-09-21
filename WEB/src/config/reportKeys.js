/**
 * How the app knows which report is which:
 * Each print page calls useReport({ key: REPORT_KEYS.SCHEDULE, ... }).
 * That key is stored in the database separately from score, attendance, etc.
 *
 * report-brand = shared logo, header lines, fonts (all reports).
 */

export const REPORT_BRAND_KEY = "report-brand";

export const REPORT_KEYS = {
  SCHEDULE: "school-schedule",
  /** Add print pages with useReport({ key: REPORT_KEYS.SCORE, ... }) */
  SCORE: "school-score",
  ATTENDANCE: "school-attendance",
};
