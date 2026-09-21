# Attendance session flow

AM / PM classes stay as they were (by subject). Full Day classes take roll **twice per day**. Teachers do **not** pick AM/PM — the API fills `session`. First save copies to **every subject in that session** from the schedule. Later they can pick one subject to update only that one.

---

## Teacher flow

```
Pick Grade + Class + Date
        │
        ├─ Morning class (shift AM)
        │     optional Subject → Save
        │     no subject = all subjects that day
        │     API stores session = AM
        │
        ├─ Afternoon class (shift PM)
        │     same as Morning, session = PM
        │
        └─ Full Day class (shift FULL)
              API picks session from time (no AM/PM dropdown)
                    │
                    ├─ before lunch (11:00)     → Morning
                    ├─ lunch, morning not saved → Morning
                    ├─ lunch, morning saved     → Afternoon
                    └─ after lunch (14:00)      → Afternoon
              Subject list = only this session’s periods
              first Save (Subject empty)
                    morning  → 4 Monday morning subjects
                    afternoon → 2 Monday afternoon subjects
              later: pick one Subject → Save updates that subject only
```

No extra Session dropdown. The chip **Morning attendance / Afternoon attendance** is a label only.

The small Morning / Afternoon chips are **status**. Tap them only to open a missed session later.

---

## Example (Monday Full Day)

| When | Schedule | First save (Subject empty) | Later |
|------|----------|----------------------------|--------|
| Morning | 4 subjects | 4 rows per student, `session = AM` | Pick Math → update Math only |
| Afternoon | 2 subjects | 2 rows per student, `session = PM` | Pick Khmer → update Khmer only |

One student on Monday = **6 rows** (4 AM + 2 PM). Morning never overwrites afternoon.

---

## What is stored

Table `attendances` (old columns + `session`):

| Field | AM / PM class | Full Day |
|-------|----------------|----------|
| `subject_id` | that subject, or all if none picked | that session’s subjects (all if none picked, one if picked) |
| `session` | `AM` or `PM` from class shift | `AM` or `PM` from clock |
| unique idea | student + class + date + subject + session | same |

---

## API

Same routes as before.

| Method | URL | What it does |
|--------|-----|----------------|
| POST | `attendance-list` | Load students + saved marks for class/date |
| POST | `attendance-store` | Save the sheet |

Body (list + store):

- `class_id`, `date`, `day_id` — same as before
- `subject_id` — optional. **Empty** = all subjects in this session. **Set** = that subject only
- `session` — optional `AM` / `PM`; omit so the server auto-picks
- `rows` — store only

List extra response:

- `session` — `AM` or `PM` in use
- `is_full_day`
- `session_submitted` — `{ AM: true, PM: false }` (true if any **subject** row exists for that session)
- `subjects` — Full Day: only morning or only afternoon subjects
- students `by_subject[subjectId]` — cells per subject

---

## Backend functions (`AttendanceController`)

| Function | Short |
|----------|--------|
| `getAttendanceData` | Load the sheet (students, this-session periods, saved marks) |
| `store` | Save. No subject = all session subjects. With subject = that one |
| `saveSubjectRows` | Insert/update one student for one subject + session |
| `normalizeAttendanceFlags` | Present / late / permission rules (same as Vue) |
| `resolveSession` | AM/PM from class shift; Full Day from clock (or override) |
| `isFullDay` | Class shift code is `FULL` |
| `shiftCode` | `AM` / `PM` / `FULL` from `class.shift` |
| `breakTimes` | Lunch window (default 11:00–14:00) |
| `filterPeriodsBySession` | Keep morning or afternoon periods only |
| `periodBelongsToSession` | Is this period AM or PM? |
| `applySessionTimeFilter` | Same filter in SQL |
| `sessionSubmittedMap` | Did this Full Day class already save AM / PM subjects today? |

---

## Frontend functions (`CheckAttendance.vue`)

| Function | Short |
|----------|--------|
| `loadAttendance` | POST `attendance-list` and fill the table |
| `saveAttendance` | POST `attendance-store` (`subject_id` null = all this session) |
| `isoWeekday` | Date → day_id 1–7 |
| `formatDateApi` | Date → `Y-m-d` |
| `buildRowsForSubject` | Rows keyed by subject |
| `applyEditableRowsForSubject` | Show that subject’s sheet |
| `selectSession` | Catch-up: open Morning or Afternoon |
| `togglePresent` / `toggleLate` / `togglePermission` | Cell clicks |

---

## Auto session (Full Day)

App timezone is `Asia/Phnom_Penh`. Lunch comes from shift `break_start` / `break_end` (seeder: 11:00–14:00).

| Now | Session saved |
|-----|----------------|
| `< 11:00` | AM |
| `11:00–14:00` and morning not saved | AM |
| `11:00–14:00` and morning saved | PM |
| `>= 14:00` | PM |

AM-only / PM-only: **never** use the clock. Session = class shift.

---

## Files

- `API/database/migrations/2026_09_21_091800_add_session_to_attendances_table.php` — add `session`, backfill AM/PM
- `API/app/Models/School/Attendance.php` — `$fillable`
- `API/app/Http/Controllers/Api/School/AttendanceController.php` — auto session + save-all subjects in session
- `WEB/src/views/school/Attendance/CheckAttendance.vue` — Subject still shown; Full Day list is this session only
- `WEB/src/plugins/i18n/locales/en.json` / `km.json`

Not changed: routes, shifts, class form, schedule.

---

## How to run

```bash
cd API && php artisan migrate
```

---

## Quick test

1. **Morning class** — same as before: pick class + date (+ subject), save.
2. **Afternoon class** — same as before.
3. **Full Day morning** — Subject empty, label Morning, save. DB: 4 rows/student, `session = AM`, each morning subject.
4. **Pick one morning subject** — change marks, save. Only that subject updates.
5. **Same class afternoon** — Subject empty, save. DB: 2 more rows/student, `session = PM`. Morning rows stay.
