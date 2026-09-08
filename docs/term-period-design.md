# Term Period & Score Setting Design

## Goal

- Support different schools with different term styles
- Some schools share the same terms for all curricula (do not create again and again)
- Some schools have different terms per curriculum (e.g. Khmer vs English)
- Always store real dates on term periods (`start_date`, `end_date`)
- Optional Khmer-style score months per grade (like old `semester_setting`)
- Term shape depends on the **school**, not on the curriculum name

---

## Core rule

| Table | Meaning | Role |
|-------|---------|------|
| `years` | Academic year | Parent calendar for the school year |
| `term_periods` | When a term/semester runs | Shared (`curriculum_id` null) or per curriculum |
| `term_score_settings` | How one grade scores in one term | Like old `semester_setting` |
| `term_score_months` | Study months + exam month list | Like old `setting_semester_list` (auto-created) |

**Do not mix calendar and score formula in one table.**

- `term_periods` = when the term runs (all schools)
- `term_score_settings` + `term_score_months` = how to calculate score (only if school needs monthly + exam)

### Old → new names

| Old | New |
|-----|-----|
| `semester_setting` | `term_score_settings` |
| `setting_semester_list` / CSV months | `term_score_months` (one row per month) |
| (no clear term date table) | `term_periods` |

---

## Recommended columns

### `years` (already exists)

- `name`
- `start_date`
- `end_date`
- `is_active`
- audit fields (`created_by`, `updated_by`, `deleted_by`, `deleted_at`, timestamps)

### `term_periods`

- `year_id` ← required
- `curriculum_id` ← **nullable**; `null` = shared for all curricula
- `name` ← `Semester 1`, `Term 1`, …
- `sequence` ← order (1, 2, 3…)
- `start_date` ← always required
- `end_date` ← always required
- `is_active`
- audit fields

**Lookup rule for a curriculum:**

1. If that curriculum has its own term rows → use those
2. Else → use shared rows (`curriculum_id` is null)

### `term_score_settings`

- `year_id`
- `term_period_id` ← which Semester / Term
- `curriculum_id` ← usually Khmer
- `grade_id` ← old `edu_id` (Grade 1, Grade 6…)
- `branch_id` ← nullable (old `campus_id`, if campus differs)
- `formula_type` ← e.g. `((sum study months) + exam) / 2`
- `is_active`
- audit fields

One row = one grade + one term in one year.

### `term_score_months`

- `term_score_setting_id` ← parent setting
- `month` ← 1–12 (Jan–Dec)
- `calendar_year` ← nullable (useful when Dec is previous year)
- `role` ← `study` or `exam`
- `sort_order`
- timestamps optional

**No CSV** like `"12,1,2"`. One month = one row.

---

## Create flow — correct order

```
Year
 └── Term Periods          ← create first (calendar)
       └── Score Setting   ← optional (Khmer-style)
             └── Score Months (auto from checked months)
```

1. Create **Year**
2. Create **Term Periods**
3. Create **Term Score Setting** (only if school needs monthly + exam score)
4. System **auto-creates** `term_score_months` from checked months

English / date-only schools can stop after step 2.

---

## Path A — Shared terms (do not create again)

Same calendar for Khmer + English (or all curricula).

1. Create year
2. Create term periods with `curriculum_id = null`
3. Example:
   - Term 1 · `2026-01-20` → `2026-03-20`
   - Term 2 · `2026-03-21` → `2026-05-20`
   - Term 3 · `2026-05-21` → `2026-07-20`
4. All curricula use these terms — no second create

**Rule:** prefer shared terms first.

---

## Path B — Different terms per curriculum

Khmer and English calendars are not the same.

1. Create year
2. Create Khmer terms with `curriculum_id = Khmer`
   - Semester 1 · `2026-01-01` → `2026-04-30`
   - Semester 2 · `2026-05-01` → `2026-08-31`
3. Create English terms with `curriculum_id = English`
   - Term 1 · `2026-01-20` → `2026-03-20`
   - Term 2 · `2026-03-21` → `2026-05-20`

Only use this path when calendars really differ.

---

## Path C — Khmer score setting (like old form)

School needs monthly scores + semester exam formula.

**Prerequisite:** Year + Term Period already exist.

1. Open **Create Score Setting** (like old Create Semester Settings)
2. Pick Year + Term (Semester 1) + Grade (Education Level) + Curriculum
3. Check month list (study months + exam month)
4. Save:
   - Insert `term_score_settings`
   - Auto-loop months → insert `term_score_months`

Same as old: **create parent → auto create list**.

### Grade 1 · Semester 1

- Study: Jan, Feb, Mar
- Exam: April
- Formula example: `((Jan + Feb + Mar) + April) / 2`

### Grade 6 · Semester 1

- Study: Dec, Jan, Feb
- Exam: March
- Same formula idea, different months

Different grades can have different months — that is why score config is per grade.

---

## Cases

### Case 1 — English cares about start/end date

1. Create year
2. Create term periods with real dates
3. No score setting needed
4. Later features (attendance, fees, reports) use `start_date` / `end_date`

### Case 2 — Khmer calendar only (no score formula yet)

1. Create year
2. Create semester term periods with dates
3. Skip score tables until scoring is built

### Case 3 — Full Khmer like old project

1. Create year
2. Create Semester 1 / Semester 2 term periods
3. For each grade: create score setting + auto month list
4. Score calc uses `term_score_months` roles (`study` / `exam`)

### Case 4 — Shared terms + score only for Khmer

1. Shared term periods for whole school
2. Score settings only for Khmer grades
3. English still uses the same term dates, no month list

---

## UI / forms

### Form 1 — Year

- Name, start date, end date
- Saves to `years`

### Form 2 — Term Period

- Year
- Curriculum → optional / empty = **shared**
- Name (`Semester 1`, `Term 1`…)
- Sequence
- Start date, end date
- Saves to `term_periods`

### Form 3 — Term Score Setting (old semester form style)

Old form fields → new form:

| Old UI field | New UI field | Saves to |
|--------------|--------------|----------|
| Academic Year | Year | `term_score_settings.year_id` |
| (Semester 1 context) | Term Period | `term_score_settings.term_period_id` |
| Education Level | Grade | `term_score_settings.grade_id` |
| — | Curriculum | `term_score_settings.curriculum_id` |
| Semester Months (count) | helper only (optional) | — |
| Semester Month List | month checkboxes + exam mark | loop → `term_score_months` |

**One form, two tables on save** (parent + auto list).

Suggested menus:

1. Academic Year
2. Term Periods
3. Score Month Settings (hide if school does not use it)

Or: open a Term → tab **Score months by grade**

---

## What NOT to do

- Do not hardcode “Khmer = months” and “English = dates” in code
- Do not store months as CSV (`"12,1,2"`)
- Do not force every school to fill score settings
- Do not make admin recreate the same Term 1/2/3 for every curriculum when they are the same
- Do not put score formula only inside term period dates — keep score config separate
- Do not create score setting before term period exists

---

## Step-by-step build checklist

### 1. Database

- [ ] Keep / finish `years`
- [ ] Create `term_periods` (`year_id`, nullable `curriculum_id`, name, sequence, dates)
- [ ] Create `term_score_settings` (year, term, curriculum, grade, formula)
- [ ] Create `term_score_months` (setting, month, role, sort_order)
- [ ] Grades/levels master data available for `grade_id` (or add later)

### 2. Models / relations

- [ ] `Year` hasMany `TermPeriod`
- [ ] `TermPeriod` belongsTo `Year`, optional `Curriculum`
- [ ] `TermScoreSetting` belongsTo Year, TermPeriod, Curriculum, Grade
- [ ] `TermScoreSetting` hasMany `TermScoreMonth`
- [ ] Scope: resolve terms for curriculum (own rows, else shared)

### 3. APIs

- [ ] Year CRUD (existing)
- [ ] Term Period CRUD
- [ ] Score Setting create = setting + auto month list (transaction)
- [ ] Score Setting update = replace month list cleanly

### 4. Frontend

- [ ] Year form
- [ ] Term Period form (shared vs one curriculum)
- [ ] Score Setting form like old semester UI (create → auto list)
- [ ] Hide score menu when school does not need it

### 5. Test scenarios

- [ ] Shared terms: create once, Khmer + English both see them
- [ ] Different terms: Khmer semester dates ≠ English term dates
- [ ] English date-only: no score setting required
- [ ] Grade 1 months ≠ Grade 6 months for same semester
- [ ] Save score setting auto-creates month rows with study/exam roles

---

## Quick mental model

```
Year (1 academic year)
  └── Term Periods (many)
        ├── shared  → all curricula
        ├── Khmer   → only if calendar differs
        └── English → only if calendar differs
        
        └── Score Setting (optional, per grade)
              └── Score Months (study… + exam)  ← auto from form
```

- Year first  
- Term periods second (dates always)  
- Share terms when possible  
- Score setting only when monthly + exam formula is needed  
- Create setting → auto create month list (same as old project)  
