import {
  DATE_BOX_DEFAULTS,
  SIGNATURE_DEFAULTS,
} from "@/config/report";
import { REPORT_KEYS } from "@/config/reportKeys";

/** Same key as useReport({ key }) on the schedule print page. */
export const SCHEDULE_REPORT_STORE_KEY = REPORT_KEYS.SCHEDULE;

export const scheduleReportTemplateDefaults = {
  paper: {
    orientation: "landscape",
  },
  header: {
    title: "កាលវិភាគសិក្សា",
    subtitle: "Class Schedule",
    lines: ["ព្រះរាជាណាចក្រកម្ពុជា", "ជាតិ សាសនា ព្រះមហាក្សត្រ"],
    dateBox: { ...DATE_BOX_DEFAULTS },
  },
  signatures: [
    {
      ...SIGNATURE_DEFAULTS,
      id: "class_teacher",
      label: "គ្រូបន្ទុកថ្នាក់",
      name: "",
      x: 12,
      y: 76,
    },
    {
      ...SIGNATURE_DEFAULTS,
      id: "principal",
      label: "នាយកសាលា",
      name: "",
      x: 62,
      y: 76,
    },
  ],
};
