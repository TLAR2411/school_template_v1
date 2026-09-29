const STORAGE_KEY = "school_calendar_holidays";

export function loadHolidays() {
  try {
    const raw = localStorage.getItem(STORAGE_KEY);
    const parsed = raw ? JSON.parse(raw) : [];
    return Array.isArray(parsed) ? parsed : [];
  } catch {
    return [];
  }
}

export function saveHolidays(holidays) {
  localStorage.setItem(STORAGE_KEY, JSON.stringify(holidays));
}

export function mergeHolidays(existing, incoming) {
  const byDate = new Map();
  for (const item of existing) {
    if (item?.date) byDate.set(item.date, item);
  }
  for (const item of incoming) {
    if (!item?.date) continue;
    byDate.set(item.date, {
      date: item.date,
      name: item.name || "",
      localName: item.localName || item.local_name || "",
      type: item.type || "public_holiday",
    });
  }
  return Array.from(byDate.values()).sort((a, b) =>
    a.date.localeCompare(b.date),
  );
}
