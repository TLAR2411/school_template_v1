import { ref } from "vue";
import { api } from "@/utils/api";

/**
 * Easy calls
 * ----------
 *   const { load, summary, students, studentsAbsent, studentsPermission } = useAttendanceReport()
 *   await load({ class_id: 12, date: "2026-09-24" })
 *   await load({ class_id: 12, date_from: "2026-09-01", date_to: "2026-09-24" })
 *   await load({ class_id: 12, month_id: 9 })
 *   await load({ session: "AM" })
 *
 * Or one-shot:
 *   const data = await fetchAttendanceReport({ date: "2026-09-24" })
 *   // data.students_absent, data.students_permission
 */

export const emptySummary = () => ({
  present: 0,
  late: 0,
  permission: 0,
  absent: 0,
  total: 0,
});

/** Keep only fields the API accepts. */
export function toReportPayload(filters = {}) {
  const body = {};
  const keys = [
    "class_id",
    "student_id",
    "subject_id",
    "session",
    "date",
    "date_from",
    "date_to",
    "month_id",
  ];

  for (const key of keys) {
    const value = filters[key];
    if (value !== null && value !== undefined && value !== "") {
      body[key] = value;
    }
  }

  return body;
}

export async function fetchAttendanceReport(filters = {}) {
  const res = await api.post("attendance-report", toReportPayload(filters));
  if (!res.data?.status) {
    throw new Error(res.data?.message || "Attendance report failed");
  }
  return res.data.data;
}

export function useAttendanceReport() {
  const isLoading = ref(false);
  const error = ref("");
  const dateFrom = ref(null);
  const dateTo = ref(null);
  const summary = ref(emptySummary());
  const students = ref([]);
  const studentsAbsent = ref([]);
  const studentsPermission = ref([]);

  function reset() {
    dateFrom.value = null;
    dateTo.value = null;
    summary.value = emptySummary();
    students.value = [];
    studentsAbsent.value = [];
    studentsPermission.value = [];
    error.value = "";
  }

  async function load(filters = {}) {
    isLoading.value = true;
    error.value = "";
    try {
      const data = await fetchAttendanceReport(filters);
      dateFrom.value = data.date_from;
      dateTo.value = data.date_to;
      summary.value = { ...emptySummary(), ...(data.summary || {}) };
      students.value = data.students || [];
      studentsAbsent.value = data.students_absent || [];
      studentsPermission.value = data.students_permission || [];
      return data;
    } catch (err) {
      if (err?.code === "ERR_CANCELED") return null;
      error.value = err?.message || "Attendance report failed";
      reset();
      return null;
    } finally {
      isLoading.value = false;
    }
  }

  return {
    isLoading,
    error,
    dateFrom,
    dateTo,
    summary,
    students,
    studentsAbsent,
    studentsPermission,
    load,
    reset,
  };
}
