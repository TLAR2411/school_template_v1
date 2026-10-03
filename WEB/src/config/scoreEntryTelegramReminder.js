/**
 * Score Entry Status → Telegram reminders
 *
 * Customize message layout and send behavior here (one file).
 * Wording / translations: WEB/src/plugins/i18n/locales/en.json & km.json
 *   keys: "Score entry reminder", "Incomplete assignments", etc.
 */

export const SCORE_ENTRY_TELEGRAM_CONFIG = {
  /** Delay between each teacher when bulk sending (Telegram rate limits). */
  sendDelayMs: 300,

  /** Include lines in the message header (when data exists). */
  showMonth: true,
  showCutoffDay: true,
  showCloseDate: true,

  /** Prefix for each class/subject line. */
  assignmentBullet: "• ",

  /**
   * Format one incomplete row. Edit this function to change line shape only.
   * @param {object} row — status list row (class/subject names, progress, status)
   * @param {object} helpers — { label, statusLabel }
   */
  formatAssignmentLine(row, { label, statusLabel }) {
    const cls = label(row.class_name_en, row.class_name_kh);
    const sub = label(row.subject_name_en, row.subject_name_kh);
    return `${cls} — ${sub}: ${row.scored_students}/${row.total_students} (${statusLabel(row.status)})`;
  },
};

/**
 * Build plain-text message for one teacher (sent via telegram-connection/send-message).
 *
 * @param {object} options
 * @param {function} options.t — vue-i18n t()
 * @param {function} options.label — (en, kh) => display string
 * @param {function} options.statusLabel — (status) => translated status
 * @param {Array} options.incompleteRows — missing/partial rows for this teacher in current list
 * @param {string} [options.monthName]
 * @param {number|null} [options.cutoffDay]
 * @param {string|null} [options.closeDate]
 */
export function buildScoreEntryTelegramMessage({
  t,
  label,
  statusLabel,
  incompleteRows,
  monthName = "",
  cutoffDay = null,
  closeDate = null,
}) {
  const cfg = SCORE_ENTRY_TELEGRAM_CONFIG;
  const lines = [];

  lines.push(t("Score entry reminder"));

  if (cfg.showMonth && monthName) {
    lines.push(`${t("Month")}: ${monthName}`);
  }
  if (cfg.showCutoffDay && cutoffDay != null) {
    lines.push(`${t("Current cutoff day")}: ${cutoffDay}`);
  }
  if (cfg.showCloseDate && closeDate) {
    lines.push(`${t("Deadline")}: ${closeDate}`);
  }

  lines.push("");
  lines.push(`${t("Incomplete assignments")}:`);

  for (const row of incompleteRows) {
    lines.push(
      cfg.assignmentBullet +
        cfg.formatAssignmentLine(row, { label, statusLabel }),
    );
  }

  lines.push("");
  lines.push(t("Please complete score entry for the items above."));

  return lines.join("\n");
}
