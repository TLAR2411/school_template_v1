# Score Entry Status & Deadline

One admin page to:

1. Set a **single cutoff day** (e.g. `26`) for the school year + curriculum  
2. Track which **class / subject / teacher** still need monthly scores  

Teachers cannot save scores for a month after that month’s cutoff day — even later (Option A).

---

## User flow

```
Score Entry Status (admin)
  → chip shows current cutoff (e.g. day 28)
  → [Edit deadline] dialog → change day → Save
  → pick Month → see Missing / Partial / Done
  → Open → Score Entry (class + month prefilled)

Score Entry (teacher)
  → before close date → can save
  → after close date → locked (admin with approve can still save)
```

Example with cutoff `26`:

| Date | January scores | February scores |
|------|----------------|-----------------|
| 26 Jan | OK | — |
| 27 Jan | Locked | — |
| 1 Feb | Locked | OK |
| 27 Feb | Locked | Locked |

---

## Commands

```bash
# API — create table
cd API && php artisan migrate

# Optional — refresh permissions/roles if needed
cd API && php artisan db:seed --class=PermissionSeeder
cd API && php artisan db:seed --class=Database\\Seeders\\Auth\\RoleSeeder
```

---

## Database

Table: `score_entry_settings`

| Column | Meaning |
|--------|---------|
| `year_id` | School year |
| `cur_id` | Curriculum (Khmer, …) |
| `branch_id` | Optional branch |
| `cutoff_day` | Day of month `1–31` (one value for all months) |
| `is_active` | Soft on/off |

Unique scope: `(year_id, cur_id, branch_id)`.

Migration:

`API/database/migrations/2026_10_01_150000_create_score_entry_settings_table.php`

---

## API

| POST | Permission | Purpose |
|------|------------|---------|
| `score-entry-setting-show` | view / approve score-entry | Load cutoff |
| `score-entry-setting-store` | approve / edit score-entry | Save cutoff day |
| `score-entry-status-list` | view / approve score-entry | Missing teacher/subject list |
| `score-list` | view / add | Also returns `can_edit` + `window` |
| `score-store` | add / edit | **403** after cutoff (unless approve) |

### Status list body

```json
{
  "month_id": 1,
  "grade_id": null,
  "class_id": null,
  "status": "missing"
}
```

`status`: `missing` | `partial` | `done` | `all`

### Status meaning

| Status | Rule |
|--------|------|
| `missing` | 0 students have a score for that subject |
| `partial` | some students scored, not all |
| `done` | every active enrolled student has a score |

Teacher comes from `teacher_class` (subject or parent subject).

---

## Frontend

| Path | Role |
|------|------|
| `/school/score-entry/status` | Admin page (deadline + tracker) |
| Menu: **Score Entry Status** | Hidden for teacher role |

Files:

- `WEB/src/pages/school/ScoreEntry/status.vue`
- `WEB/src/views/school/ScoreEntry/ScoreEntryStatus.vue`
- Khmer entry respects lock: `WEB/src/views/school/ScoreEntry/ScoreEntryKhmer.vue`

---

## Backend files

- `API/app/Models/School/ScoreEntrySetting.php`
- `API/app/Services/School/ScoreEntryDeadlineService.php`
- `API/app/Services/School/ScoreEntryStatusService.php`
- `API/app/Http/Controllers/Api/School/ScoreEntryStatusController.php`
- Lock checks in `ScoreEntryController` (`store`, `saveMonthHeader`, `getScoreData`)

---

## Notes

- Cutoff uses the school year’s calendar month mapping (same idea as attendance month range).
- Feb with cutoff `30` uses the last day of February.
- Admin override permission: `approve-score-entry` (or admin/superadmin/developer role).
- English term scores are not locked by this month cutoff (Khmer monthly entry only).
