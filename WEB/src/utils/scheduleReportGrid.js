import { SCHEDULE_REPORT_CONFIG } from "@/config/scheduleReport";

export function timeToMinutes(value) {
  if (!value) return 0;
  const [h, m] = String(value).split(":").map(Number);

  return h * 60 + (m || 0);
}

export function minutesToTime(totalMin) {
  const h = Math.floor(totalMin / 60);
  const m = totalMin % 60;

  return `${String(h).padStart(2, "0")}:${String(m).padStart(2, "0")}`;
}

function alignDown(minutes, slotMinutes) {
  return Math.floor(minutes / slotMinutes) * slotMinutes;
}

function alignUp(minutes, slotMinutes) {
  return Math.ceil(minutes / slotMinutes) * slotMinutes;
}

/** Largest break-only rectangle from (row, col); marks cells covered. */
function mergeBreakRegions(rows, mergeBreakCells) {
  if (!mergeBreakCells || !rows.length) return;

  const rowCount = rows.length;
  const colCount = rows[0].dayCells.length;
  const covered = Array.from({ length: rowCount }, () =>
    Array(colCount).fill(false),
  );

  const isBreakAt = (r, c) => rows[r].dayCells[c].isBreak;

  for (let r = 0; r < rowCount; r++) {
    for (let c = 0; c < colCount; c++) {
      if (covered[r][c] || !isBreakAt(r, c)) continue;

      let colspan = 1;

      while (
        c + colspan < colCount &&
        isBreakAt(r, c + colspan) &&
        !covered[r][c + colspan]
      ) {
        colspan++;
      }

      let rowspan = 1;

      while (r + rowspan < rowCount) {
        let rowOk = true;

        for (let dc = 0; dc < colspan; dc++) {
          if (!isBreakAt(r + rowspan, c + dc) || covered[r + rowspan][c + dc]) {
            rowOk = false;
            break;
          }
        }

        if (!rowOk) break;
        rowspan++;
      }

      const origin = rows[r].dayCells[c];

      origin.skip = false;
      origin.rowspan = rowspan;
      origin.colspan = colspan;

      for (let dr = 0; dr < rowspan; dr++) {
        for (let dc = 0; dc < colspan; dc++) {
          covered[r + dr][c + dc] = true;

          if (dr === 0 && dc === 0) continue;

          const cell = rows[r + dr].dayCells[c + dc];

          cell.skip = true;
          cell.rowspan = 1;
          cell.colspan = 1;
        }
      }
    }
  }
}

/**
 * @param {Array} schedules API rows with day_id, start, end, subject, day
 * @param {(item: object) => string} labelFor subject/day label
 * @param {typeof SCHEDULE_REPORT_CONFIG} [config]
 */
export function buildScheduleReportGrid(
  schedules,
  labelFor,
  config = SCHEDULE_REPORT_CONFIG,
) {
  const {
    slotMinutes,
    defaultHourStart,
    defaultHourEnd,
    mergeBreakCells,
  } = config;

  if (!schedules.length) {
    return { days: [], rows: [] };
  }

  const days = [];
  const dayIds = new Set();

  for (const period of schedules) {
    if (dayIds.has(period.day_id)) continue;
    dayIds.add(period.day_id);
    days.push(period.day || { id: period.day_id });
  }

  days.sort((a, b) => Number(a.id) - Number(b.id));

  let minStart = Infinity;
  let maxEnd = -Infinity;

  for (const period of schedules) {
    minStart = Math.min(minStart, timeToMinutes(period.start));
    maxEnd = Math.max(maxEnd, timeToMinutes(period.end));
  }

  const gridStart = alignDown(
    Number.isFinite(minStart) ? minStart : defaultHourStart * 60,
    slotMinutes,
  );
  const gridEnd = alignUp(
    maxEnd > 0 ? maxEnd : defaultHourEnd * 60,
    slotMinutes,
  );

  const periodsByDay = new Map();

  for (const period of schedules) {
    if (!periodsByDay.has(period.day_id))
      periodsByDay.set(period.day_id, []);

    periodsByDay.get(period.day_id).push({
      startMin: timeToMinutes(period.start),
      endMin: timeToMinutes(period.end),
      text: labelFor(period.subject),
    });
  }

  const rows = [];

  for (let startMin = gridStart; startMin < gridEnd; startMin += slotMinutes) {
    const endMin = startMin + slotMinutes;
    const dayCells = days.map((day) => {
      const list = periodsByDay.get(day.id) || [];
      const period = list.find(
        (p) => p.startMin < endMin && p.endMin > startMin,
      );

      return {
        dayId: day.id,
        text: period?.text ?? "",
        isBreak: !period,
        skip: false,
        rowspan: 1,
        colspan: 1,
      };
    });

    rows.push({
      key: `${startMin}-${endMin}`,
      start: minutesToTime(startMin),
      end: minutesToTime(endMin),
      dayCells,
    });
  }

  mergeBreakRegions(rows, mergeBreakCells);

  return { days, rows };
}
