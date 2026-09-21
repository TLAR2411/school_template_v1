import { PRIMARY_MAX_GRADE } from "@/config/report";
import { SCHEDULE_REPORT_CONFIG } from "@/config/scheduleReport";
import { buildScheduleReportGrid } from "@/utils/scheduleReportGrid";
import { api } from "@/utils/api.js";
import { useSettingStore } from "@/stores/settingStore.js";

export function useScheduleReportData() {
  const route = useRoute();
  const { locale } = useI18n();
  const setting = useSettingStore();

  const classInfo = ref(null);
  const schedules = ref([]);
  const teachers = ref([]);
  const isLoading = ref(false);
  const reportDate = ref(todayIso());

  const localized = (item, fallback = "") =>
    (locale.value === "km" ? item?.name_kh : item?.name_en) ||
    item?.name_en ||
    item?.name_kh ||
    fallback;

  const khmerDate = computed(() => formatReportDate(reportDate.value));

  const className = computed(() => localized(classInfo.value));

  const gradeLevel = computed(
    () =>
      Number(
        classInfo.value?.grade?.grade_level ?? classInfo.value?.grade_level,
      ) || 0,
  );

  const educationLevel = computed(() => {
    const grade = classInfo.value?.grade;

    return grade?.education_level || grade?.educationLevel || null;
  });

  const isPrimary = computed(() => {
    const symbol = String(educationLevel.value?.symbol || "").toUpperCase();

    if (symbol === "S" || symbol === "H") return false;
    if (gradeLevel.value > PRIMARY_MAX_GRADE) return false;

    return true;
  });

  const classTeacher = computed(
    () =>
      teachers.value.find((teacher) => teacher.is_classload) ||
      teachers.value[0] ||
      null,
  );

  const listedTeachers = computed(() =>
    isPrimary.value
      ? classTeacher.value
        ? [classTeacher.value]
        : []
      : teachers.value,
  );

  const teacherLine = (teacher) => {
    const name = localized(teacher);
    const subjects = (teacher.subjects || [])
      .map((subject) => localized(subject))
      .filter(Boolean)
      .join(" · ");
    const details = [subjects, teacher.phone].filter(Boolean).join(" · ");

    return details ? `${name} (${details})` : name;
  };

  const scheduleGrid = computed(() =>
    buildScheduleReportGrid(
      schedules.value,
      (subject) => localized(subject),
      SCHEDULE_REPORT_CONFIG,
    ),
  );

  const days = computed(() => scheduleGrid.value.days);
  const scheduleRows = computed(() => scheduleGrid.value.rows);

  const scheduleTableStyle = computed(() => ({
    "--schedule-subject-align": SCHEDULE_REPORT_CONFIG.subjectAlign,
    "--schedule-break-bg": SCHEDULE_REPORT_CONFIG.breakCellBackground,
  }));

  const loadReport = async () => {
    const classId = route.query.class_id;
    if (!classId) return;

    isLoading.value = true;
    try {
      const [classRes, scheduleRes, teacherRes] = await Promise.all([
        api.post("classes-show", { id: classId }),
        api.post("schedules-list", { class_id: classId }),
        api.post("teachers-classes-list", { class_id: classId }),
      ]);

      classInfo.value = classRes.data?.data || null;
      schedules.value = scheduleRes.data?.data || [];
      teachers.value = teacherRes.data?.data || [];
    } finally {
      isLoading.value = false;
    }
  };

  return {
    setting,
    classInfo,
    schedules,
    teachers,
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
  };
}
