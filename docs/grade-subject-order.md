# Grade subject order (score entry columns)

Staff can set the **subject column order once per grade**. Every class in that grade uses the same format on Khmer score entry.

---

## Why

| Approach | Result |
|----------|--------|
| Per class / localStorage | Each device / class different — not what staff need |
| **Per grade in database** | Class 7A, 7B, 7C all show the same subject column order |

---

## User flow

```
Score Entry (Khmer)
  → pick Class (has a grade) + Month → Search
  → columns come from API already ordered for that grade
  → [Reorder subjects]
        drag or ↑↓ parents and children
        Done → saves to DB for this grade
  → open another class in the same grade → same column order
```

Hint in the dialog: *Order applies to all classes in this grade*.

---

## Database

Table: `grade_subject_orders`

| Column | Meaning |
|--------|---------|
| `grade_id` | Grade this order belongs to |
| `subject_id` | Parent or child subject |
| `sort` | Display order (0, 1, 2, …) |
| `cur_id` | Curriculum (from request header) |
| `branch_id` | Optional branch |

Unique: `(grade_id, subject_id, cur_id)`.

Parents and children are both rows. Parent vs child is resolved via `subjects.parent_id` when reading.

Migration:

`API/database/migrations/2026_09_30_160000_create_grade_subject_orders_table.php`

```bash
cd API && php artisan migrate
```

---

## API

| Method | URL | Permission | What it does |
|--------|-----|------------|--------------|
| POST | `grade-subject-order-show` | view/add score-entry | Load saved order for a grade |
| POST | `grade-subject-order-store` | add/edit score-entry | Replace order for a grade |
| POST | `score-list` | view/add score-entry | Returns subjects **already sorted** for the class’s grade |

### Store body

```json
{
  "grade_id": 3,
  "parents": [10, 12, 11],
  "children": {
    "12": [120, 121]
  }
}
```

### Show response `data`

```json
{
  "grade_id": 3,
  "parents": [10, 12, 11],
  "children": {
    "12": [120, 121]
  }
}
```

Controller: `API/app/Http/Controllers/Api/School/GradeSubjectOrderController.php`  
Model: `API/app/Models/School/GradeSubjectOrder.php`  
Apply on list: `ScoreEntryController::applyGradeSubjectOrder()`

---

## Frontend

File: `WEB/src/views/school/ScoreEntry/ScoreEntryKhmer.vue`

- Reorder dialog (drag + arrows) — local preview while open
- **Done** (or close) → `POST grade-subject-order-store` with the class’s `grade_id`
- No `localStorage` for this anymore
- Next `score-list` load uses DB order

---

## Rules to remember

1. Order is **by grade**, not by class or month.
2. Changing order in one class updates columns for **all classes in that grade** (same curriculum).
3. Subjects with no saved order keep default API order (`orderBy id`).
4. Teachers still only see subjects they teach; order is applied after that filter.
5. English score entry is separate and does not use this table yet.

---

## Quick test

1. Run migration.
2. Score Entry → Grade/Class A + Month → Reorder (e.g. put ផែនដី first) → Done.
3. Switch to another class in the **same grade** → Search → columns should match.
4. Switch to a class in a **different grade** → order should not follow grade A.
