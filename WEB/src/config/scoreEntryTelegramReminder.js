/**
 * Score Entry Status → Telegram reminders
 *
 * Customize message layout and send behavior here (one file).
 * Wording / translations: WEB/src/plugins/i18n/locales/en.json & km.json
 *   keys: "Score entry reminder", "Score entry greeting", "Month", "Deadline",
 *         "Open score entry app", etc.
 */

export const SCORE_ENTRY_TELEGRAM_CONFIG = {
  /** Delay between each teacher when bulk sending (Telegram rate limits). */
  sendDelayMs: 300,

  /** Month is shown on the title line, e.g. "📌 Reminder ខែ: តុលា". */
  showMonth: true,
  showCutoffDay: false,
  showCloseDate: true,

  /** Prefix for each class line. */
  classBullet: "▫️ ",

  /** Prefix for each subject line under a class (em-spaces keep the indent in Telegram). */
  subjectIndent: "\u2003\u2003",
  subjectBullet: "– ",

  /**
   * Button shown under the message.
   *  - type "url":     opens the link in the phone's browser (may open the installed PWA).
   *  - type "web_app": opens inside Telegram as a Mini App (HTTPS required).
   * Telegram only accepts public HTTPS URLs here.
   */
  button: {
    enabled: true,
    type: "url", // "url" | "web_app"
    url: "https://dewey.disreportcard.com/school/ClassGrid", // TODO: replace with your PWA URL
  },

  /**
   * Format one subject line (class name is printed once above it).
   * @param {object} row — status list row
   * @param {object} helpers — { label, statusLabel }
   */
  formatSubjectLine(row, { label, statusLabel }) {
    const sub = label(row.subject_name_en, row.subject_name_kh);
    return `${sub}: ${row.scored_students}/${row.total_students} (${statusLabel(row.status)})`;
  },
};

/**
 * Build plain-text message for one teacher (sent via telegram-connection/send-message).
 *
 * @param {object} options
 * @param {function} options.t — vue-i18n t()
 * @param {function} options.label — (en, kh) => display string
 * @param {function} options.statusLabel — (status) => translated status
 * @param {Array} options.incompleteRows — missing/partial rows for this teacher
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

  // Title (+ month on the same line)
  let title = t("Score entry reminder");
  if (cfg.showMonth && monthName) {
    title += ` ${t("Month")}: ${monthName}`;
  }
  lines.push(title);

  // Greeting
  lines.push("");
  lines.push(t("Score entry greeting"));

  // Group rows by class, keeping original order
  const byClass = new Map();
  for (const row of incompleteRows) {
    const cls = label(row.class_name_en, row.class_name_kh);
    if (!byClass.has(cls)) byClass.set(cls, []);
    byClass.get(cls).push(row);
  }

  for (const [cls, rows] of byClass) {
    lines.push(cfg.classBullet + cls);
    for (const row of rows) {
      lines.push(
        cfg.subjectIndent +
        cfg.subjectBullet +
        cfg.formatSubjectLine(row, { label, statusLabel }),
      );
    }
  }

  // Cutoff / deadline
  const footer = [];
  if (cfg.showCutoffDay && cutoffDay != null) {
    footer.push(`${t("Current cutoff day")}: ${cutoffDay}`);
  }
  if (cfg.showCloseDate && closeDate) {
    footer.push(`${t("Deadline")}: ${closeDate}`);
  }
  if (footer.length) {
    lines.push("");
    lines.push(...footer);
  }

  // Closing
  lines.push(t("Please complete score entry for the items above."));

  return lines.join("\n");
}

/**
 * Build the Telegram `reply_markup` (inline button) for the reminder.
 * Send it together with the text, and have the backend forward it to
 * Telegram's sendMessage as `reply_markup`.
 *
 * @param {object} options
 * @param {function} options.t — vue-i18n t()
 * @returns {object|null} reply_markup, or null when the button is disabled
 */
export function buildScoreEntryTelegramButton({ t }) {
  const btn = SCORE_ENTRY_TELEGRAM_CONFIG.button;
  if (!btn?.enabled || !btn.url) return null;

  const button =
    btn.type === "web_app"
      ? { text: t("Open score entry app"), web_app: { url: btn.url } }
      : { text: t("Open score entry app"), url: btn.url };

  return { inline_keyboard: [[button]] };
}