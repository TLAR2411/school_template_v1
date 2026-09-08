# Student, Branch & Curriculum Design

## Goal

- One student = one person (do not create student info again for another branch/curriculum)
- Support transfer Branch A → Branch B
- Support studying 2 programs at once (e.g. Khmer @ A + English @ B)
- Curriculum on create is **optional**
- Branch admin and curriculum admin can filter students in their scope
- Branch B / English admin can find an existing student and enroll later (no duplicate student)

---

## Core rule

| Table | Meaning | Branch field | Role of branch |
|-------|---------|--------------|----------------|
| `students` | Who they are (name, DOB, phone, card id…) | `branch_id` | **Home / first registered branch** (set on create) |
| `curriculums` | What programs exist (Khmer, English…) | — | Master data only |
| `student_curriculums` | **Enrollment** = student + curriculum + branch + dates | `branch_id` | **Where they actually study** for that curriculum |

**Do not create `student_branch`.**

- `students.branch_id` = where the student was first registered (always set on create)
- `student_curriculums.branch_id` = real study place per curriculum (list, transfer, multi-branch, curriculum admin)

Home branch ≠ current enrollments. Use both.

---

## Recommended columns

### `students`

- personal fields (name, DOB, phone, card id, …)
- `branch_id` ← **home / first registered branch** (required on create)
- `is_active`, `is_graduated`, audit fields, …

### `student_curriculums`

- `student_id`
- `curriculum_id`      ← required when enrolled; create form may skip this
- `branch_id`          ← study branch for this enrollment
- `start_date`
- `end_date`           ← null = still current
- `status`             ← active / transferred / completed / withdrawn
- `is_active`
- audit fields (`created_by`, `updated_by`, `deleted_by`, `deleted_at`, timestamps)

Optional uniqueness: one **active** row per `(student_id, curriculum_id, branch_id)`.

---

## Create student — curriculum optional

On create, **always** set `students.branch_id` = current branch.

| Curriculum on form? | What to save | Who auto-sees the student |
|---------------------|--------------|---------------------------|
| **Yes** (e.g. English) | `students` + enrollment (`English` + branch) | English curriculum admin (and that branch’s list via enrollment) |
| **No** | `students` only (`branch_id` = home branch) | Not on curriculum lists yet; curriculum admin must **enroll later** |

### Path A — Assign curriculum when creating

1. Branch A admin fills student info **and** picks English (or Khmer).
2. System creates `students` (`branch_id = A`) + `student_curriculums` (English + Branch A).
3. English admin **automatically** sees that student — no second enroll.

### Path B — Create student info only (no curriculum yet)

1. Branch A admin creates student only → `students.branch_id = A`.
2. How we know the branch with no enrollment: **`students.branch_id`**.
3. Student is **not** on English/Khmer curriculum lists yet.
4. English admin **searches** → **Enroll** English + Branch A (new `student_curriculums` row).
5. After that, English admin sees them.

**Rule:** curriculum can wait; **home branch cannot** wait. Always save `students.branch_id` at create.

---

## Cases

### Case 1 — First time at school (with curriculum)

1. Create `students` with `branch_id = A`
2. Create `student_curriculums` (curriculum + branch + start_date)

Example: StudentA → home Branch A, enrolled Khmer @ Branch A

### Case 2 — First time, no curriculum yet

1. Create `students` with `branch_id = A` only
2. Later: add enrollment when curriculum is known

### Case 3 — Transfer Branch A → Branch B (same curriculum)

Do **not** rely on changing only `students.branch_id` for transfer truth. Close old enrollment, open new one.

1. End Khmer @ Branch A (`end_date`, `is_active = false`, status = transferred)
2. Create Khmer @ Branch B (`start_date`, active)
3. Keep `students.branch_id` as **home/first** branch (usually leave as A), unless product wants to update “current home”

### Case 4 — Add second curriculum / second branch later

Do **not** create student again. Add enrollment only.

Example: already Khmer @ A, later add English @ B:

| student | curriculum | branch | active |
|---------|------------|--------|--------|
| StudentA | Khmer | A | yes |
| StudentA | English | B | yes |

`students.branch_id` stays home (e.g. A). Study places live on enrollments.

### Case 5 — How Branch B / other admin finds existing student

- Normal **study list** for Branch B = active enrollments at B  
  (StudentA is **not** on that list until enrolled at B)
- Branch A can still find “registered but not enrolled” via `students.branch_id = A`
- Before create: **search school-wide** by `student_card_id` / phone / name+DOB
- If found → **Enroll** (new `student_curriculums` only)
- If not found → create student (`branch_id` = current) ± first enrollment

Admin rule: *Always search first. Never duplicate the same person.*

---

## Curriculum admin + branch admin filtering

Each curriculum can have its own admin (Khmer admin, English admin). Filter on **enrollments**.

| Who logs in | Student list filter |
|-------------|---------------------|
| Branch A admin (study list) | active `student_curriculums.branch_id = A` |
| Branch A admin (registered, no curriculum yet) | `students.branch_id = A` and no active enrollment (optional screen) |
| Khmer curriculum admin | active `student_curriculums.curriculum_id = Khmer` |
| English curriculum admin | active `student_curriculums.curriculum_id = English` |
| Branch A + Khmer admin | `branch_id = A` **and** `curriculum_id = Khmer` |

Decide product scope for curriculum admins:

- **School-wide:** that curriculum at all branches
- **Branch + curriculum:** that curriculum only at their branch(es) ← safer default

Example: StudentA has Khmer@A and English@B

- Branch A list → sees StudentA (Khmer)
- Branch B list → sees StudentA (English)
- Khmer admin → sees StudentA
- English admin → sees StudentA
- Branch A + English only → does **not** see them (no English@A)

If created **with** English → English admin auto-sees.  
If created **without** curriculum → English admin searches and enrolls.

User access to curriculum: similar to `user_branches`, e.g. `user_curriculums` (`user_id`, `curriculum_id`), or role + assigned curriculum(s).

---

## UI / forms

### Form 1 — Add Student (first time)

Same form:

- Personal info → `students`
- **Always** set home `students.branch_id` = current branch
- Curriculum = **optional**
  - If filled → also create `student_curriculums` (curriculum + branch + start date)
  - If empty → student only; enroll later

### Form / action 2 — Add enrollment (later)

On existing student (search or detail):

- Pick curriculum + branch
- Insert new `student_curriculums` row only
- Do not recreate student

### Form / action 3 — Transfer

- Select student + current enrollment
- New branch (+ maybe same curriculum)
- System closes old enrollment row + opens new row

### Screens

| Screen | Behavior |
|--------|----------|
| Study / enrollment list | Filter by active `student_curriculums` (branch and/or curriculum by admin scope) |
| Registered without curriculum | Optional: `students.branch_id` = current and no active enrollment |
| Search before enroll | Search all students in school (not only own branch/curriculum) |
| Student detail | Show home branch + all enrollments (active + history) |

---

## Filter queries

### Branch A — students studying at A

```sql
SELECT DISTINCT s.*
FROM students s
JOIN student_curriculums sc ON sc.student_id = s.id
WHERE sc.branch_id = :branchA
  AND sc.is_active = true;
```

### Branch A — registered at A but not enrolled yet

```sql
SELECT s.*
FROM students s
WHERE s.branch_id = :branchA
  AND NOT EXISTS (
    SELECT 1 FROM student_curriculums sc
    WHERE sc.student_id = s.id AND sc.is_active = true
  );
```

### English curriculum admin

```sql
SELECT DISTINCT s.*
FROM students s
JOIN student_curriculums sc ON sc.student_id = s.id
WHERE sc.curriculum_id = :englishId
  AND sc.is_active = true;
  -- optional: AND sc.branch_id IN (:allowedBranches)
```

---

## What NOT to do

- Do not use **only** `students.branch_id` for multi-branch, transfer, or “who studies where”
- Do not create a second `students` row for the same person at another branch
- Do not overwrite enrollment branch/curriculum in place when transferring (close + open)
- Do not rely on a separate `student_branch` table (redundant / can get out of sync)
- Do not expect curriculum admin to see a student who has **no** enrollment yet (they must search + enroll)

---

## Step-by-step build checklist

### 1. Database

- [ ] Add `branch_id` to `students` (home / first registered branch)
- [ ] Keep `curriculums` as master data
- [ ] Update `student_curriculums`: add `branch_id`, `start_date`, `end_date` (and optional `status`)
- [ ] Make `student_card_id` unique if used for lookup (recommended)
- [ ] Optional: `user_curriculums` for curriculum admin access

### 2. Models / relations

- [ ] `Student` belongsTo home `Branch`; hasMany `StudentCurriculum`
- [ ] `StudentCurriculum` belongsTo `Student`, `Curriculum`, `Branch`
- [ ] Scopes: filter by enrollment branch and/or curriculum; optional “registered without enrollment”

### 3. APIs

- [ ] `POST /students` — create student with home `branch_id`; enrollment only if curriculum provided (transaction)
- [ ] `GET /students` — list by branch/curriculum scope (enrollments; optional registered-only)
- [ ] `GET /students/search` — school-wide search (card/phone/name) for enroll flow
- [ ] `POST /students/{id}/enrollments` — add curriculum/branch later
- [ ] `POST /enrollments/{id}/transfer` — close old + open new at new branch

### 4. Frontend

- [ ] Add Student form = personal + home branch (current) + **optional** curriculum
- [ ] Student detail = home branch + enrollments + “Add enrollment”
- [ ] Enroll flow = search existing student first, then enroll
- [ ] Transfer action on an active enrollment
- [ ] Branch / curriculum lists use enrollment filters

### 5. Permissions

- [ ] Reuse existing branch access (`manage_branch` / selected branch)
- [ ] Add curriculum access for curriculum admins
- [ ] List scoped by branch and/or curriculum; search-for-enroll allowed wider (same school)

### 6. Test scenarios

- [ ] Create StudentA at Branch A **with** English → English admin sees StudentA
- [ ] Create StudentB at Branch A **without** curriculum → English admin does not see until enroll
- [ ] English admin searches StudentB → enroll English @ A → then visible
- [ ] Branch B list does not show StudentA until enrollment at B
- [ ] Branch B searches StudentA → enroll English @ B
- [ ] Khmer @ A + English @ B both work on one student
- [ ] Transfer Khmer A → B keeps history on enrollments
- [ ] Duplicate student with same card id is blocked

---

## Quick mental model

```
Student (1 person)
  ├── branch_id = home / first registered branch (e.g. A)
  └── Enrollments (many) — real study places
        ├── Khmer  @ Branch A  (active or ended)
        └── English @ Branch B (active or ended)
```

- Identity once  
- Home branch on create (always)  
- Curriculum optional on create  
- Enrollments many times  
- Study branch + curriculum live on enrollment  
- Curriculum admin sees students via enrollment; if none yet → search + enroll  
