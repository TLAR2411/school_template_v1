# Score Entry Status — Telegram reminders

Admins on **Score Entry Status** can notify teachers on Telegram about **incomplete** score entry (missing / partial) for the **current month + filters** (same rows as the table).

- **One message per teacher** (even if you select many rows for the same person).
- Message lists **all incomplete** class/subject lines for that teacher in the loaded list.
- **Bulk send** runs **step by step** with a progress dialog and **Cancel**.

---

## Use in the app

1. Open **School → Score Entry Status** (`/school/score-entry/status`).
2. Choose **Month** (and optional grade/class/status), click search.
3. Teachers with Telegram linked show a blue Telegram icon; gray = not connected.
4. **Single:** row action (Telegram icon) → queue of 1 teacher.
5. **Bulk:** check rows → **Send Telegram (N)** → dialog shows progress; **Cancel** stops after the current teacher.

Permission: `view-score-entry` or `approve-score-entry`.

---

## Setup commands

```bash
# API — DB (score settings + scores; telegram tables if not migrated yet)
cd API && php artisan migrate

# Permissions (only if score-entry permissions missing on your DB)
cd API && php artisan db:seed --class=PermissionSeeder
cd API && php artisan db:seed --class=Database\\Seeders\\Auth\\RoleSeeder

# Clear route cache after route changes (production)
cd API && php artisan route:clear && php artisan route:cache

# Run locally
cd API && php artisan serve
cd WEB && npm install && npm run dev
```

Teachers must **connect Telegram** in the app (navbar Telegram connect) before messages can be delivered.

API endpoint (one teacher per request):

`POST /api/web/telegram-connection/send-message`

```json
{ "teacher_id": 1, "message": "..." }
```

---

## Customize for next time

| What to change | Where |
|----------------|--------|
| Delay between bulk sends, bullet style, line format, show/hide month/deadline | `WEB/src/config/scoreEntryTelegramReminder.js` |
| Title, footer, UI labels (“Send Telegram”, dialog text) | `WEB/src/plugins/i18n/locales/en.json` & `km.json` |
| Page UI (buttons, table, dialog) | `WEB/src/views/school/ScoreEntry/ScoreEntryStatus.vue` |
| Who can send | `API/routes/modules/school.route.php` → `telegram-connection/send-message` middleware |
| `telegram_connected` on status rows | `API/app/Services/School/ScoreEntryStatusService.php` |
| Telegram delivery / HTML escape | `API/app/Http/Controllers/Api/App/TelegramConnectionController.php` → `sendMessageToChat` |

### Example: change assignment line

In `scoreEntryTelegramReminder.js`, edit `formatAssignmentLine`:

```javascript
formatAssignmentLine(row, { label, statusLabel }) {
  const cls = label(row.class_name_en, row.class_name_kh);
  const sub = label(row.subject_name_en, row.subject_name_kh);
  return `[${statusLabel(row.status)}] ${cls} / ${sub} (${row.scored_students}/${row.total_students})`;
},
```

### Example: slower bulk send

```javascript
sendDelayMs: 800,
```

### Example: shorter message (no deadline lines)

```javascript
showCutoffDay: false,
showCloseDate: false,
```

After i18n edits, no build step beyond normal Vite reload. After API route edits, run `php artisan route:clear` (or `route:cache` in prod).

---

## Related docs

- Deadline & status list: [score-entry-status-deadline.md](./score-entry-status-deadline.md)
