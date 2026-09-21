import { toKhmerLunarDate } from "khmer-chhankitek-calendar";

const todayIso = () => {
  const now = new Date();
  const month = String(now.getMonth() + 1).padStart(2, "0");
  const day = String(now.getDate()).padStart(2, "0");

  return `${now.getFullYear()}-${month}-${day}`;
};

/**
 * Khmer lunar + Gregorian labels for a report date picker.
 * `date` is `YYYY-MM-DD` from AppDateTimePicker.
 */
export function formatReportDate(date = todayIso()) {
  const iso = date || todayIso();

  try {
    const result = toKhmerLunarDate(iso);

    return {
      iso,
      lunar: result.lunarDateText,
      gregorian: result.gregorianDateText,
      full: result.fullText,
    };
  } catch {
    return { iso, lunar: "", gregorian: iso, full: iso };
  }
}

export { todayIso };
