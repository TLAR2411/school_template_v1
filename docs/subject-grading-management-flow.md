# Subject & Grading Management Flow

## Goal

- Manage subjects with parent / child (example: Language Art → Reading, Listening, Writing, Speaking)
- Configure grading per subject using activity types (Homework, Work, Exam, …)
- Support different max scores by class type (Social vs Science) for the same subject
- Keep it dynamic: a subject may have only Exam, or Homework + Work + Exam

---

## Core tables

| Table | Meaning | Role |
|-------|---------|------|
| `subjects` | What is taught | Parent or child (`parent_id`) |
| `subject_activity_type` | Category of score | Homework (H), Work (W), Exam (E), Attendance, Participation |
| `class_type` | Stream | Science, Social, General |
| `grading_rules` | How one subject is scored | Per grade + subject + activity (+ optional class type) |
| `assessments` | Score slots under a rule | H1–H10, W1–W10, Exam, … |

**Do not duplicate subjects for Social / Science.**  
Same subject (Math), different `class_type_id` on `grading_rules`.

---

## Important rules

1. **Create stores only the subject you pick**  
   Creating rules for Language Art does **not** auto-create rules for Reading / Listening / …

2. **Parent and child are separate**  
   Each subject has its own `grading_rules` rows (`subject_id`).

3. **List always returns the tree**  
   Parent + children. If a child has no rules yet → `grading_rules: []`, `has_grading: false`.

4. **Dynamic activities**  
   - Child with only Exam → fine  
   - Child with Homework + Exam later → still fine  
   No forced copy from parent.

5. **Class type (grade 11 / 12)**  
   Same subject, different max score by stream:
   - Math + Social → max 75  
   - Math + Science → max 120  

---

## UI tabs (Subject page)

| Tab | Purpose |
|-----|---------|
| Subjects | CRUD subjects + link parent / child |
| Subject Setting | Create / list grading rules + assessments by grade |
| Subject Activity | CRUD activity types (Homework, Work, Exam, …) |

---

## Create flow (first time)

```
1. Select Grade (required)
   Optional: Year, Term, Class Type
2. Select Subject (parent or child)
3. Add one or more rules:
   - Activity type (Homework / Work / Exam …)
   - max_score
   - percentage
   - assessment_count (ex: 10 → H1…H10)
4. Save
   → insert grading_rules for that subject only
   → insert assessments under each rule
5. Children are NOT created automatically
```

### Example: Language Art first time

User configures **parent only**:

| Activity | Max | % | Assessments |
|----------|-----|---|-------------|
| Homework | 100 | 10 | H1–H10 |
| Work | 100 | 10 | W1–W10 |
| Exam | 40 | 100 | Exam |

Reading / Listening / Writing / Speaking still have **no** grading rules.

### Example: add child later

User selects **Reading** and adds Exam max 25.  
Only Reading gets a new rule. Other children stay empty until configured.

### Example: Math grade 12 Social / Science

Same `subject_id` = Math, two rules:

| Class type | Activity | Max |
|------------|----------|-----|
| Social | Exam | 75 |
| Science | Exam | 120 |

---

## List flow

```
1. Filter by grade_id (+ year_id / term_id if used)
2. Load parent subjects (parent_id = null)
3. For each parent:
   - load children
   - load grading_rules for parent (filtered by grade/year/term)
   - load grading_rules for each child
   - load activity type + assessments on each rule
4. Return tree JSON
```

Use **Eloquent eager load** (`with`), not manual joins, because the response is nested.

### Pseudo query

```php
Subject::query()
    ->whereNull('parent_id')
    ->whereCurriculum($curId)
    ->with([
        'children.gradingRules' => fn ($q) => $q
            ->where('grade_id', $gradeId)
            ->with(['activityType', 'assessments', 'classType']),
        'gradingRules' => fn ($q) => $q
            ->where('grade_id', $gradeId)
            ->with(['activityType', 'assessments', 'classType']),
    ])
    ->get();
```

---

## Score formula (later)

For one assessment score (example Homework):

```
weighted = student_score * percentage / max_score
```

Example: score 80, percentage 10, max 100 → `80 * 10 / 100 = 8`

When entering scores for a class:

```
Use grading_rule where:
  grade_id     = class.grade_id
  subject_id   = selected subject
  class_type_id = class.class_type_id   (or null / General fallback)
  year / term match
```

---

## Recommended model relations

```
Subject
  parent()
  children()
  gradingRules()

GradingRule
  subject()
  activityType()   // subject_activity_type
  classType()
  assessments()

Assessment
  gradingRule()
  subject()
```

---

## Example JSON

### 1) Create — parent Language Art (first time)

**Request**

```json
{
  "grade_id": 7,
  "year_id": 1,
  "term_id": 1,
  "subject_id": 10,
  "class_type_id": null,
  "rules": [
    {
      "subject_activity_type_id": 1,
      "max_score": 100,
      "percentage": 10,
      "assessment_count": 10
    },
    {
      "subject_activity_type_id": 2,
      "max_score": 100,
      "percentage": 10,
      "assessment_count": 10
    },
    {
      "subject_activity_type_id": 3,
      "max_score": 40,
      "percentage": 100,
      "assessment_count": 1
    }
  ]
}
```

> Activity type IDs example: `1 = Homework`, `2 = Work`, `3 = Exam`.

**Stored result (concept)**

```json
{
  "grading_rules": [
    {
      "id": 1,
      "grade_id": 7,
      "subject_id": 10,
      "class_type_id": null,
      "subject_activity_type_id": 1,
      "max_score": 100,
      "percentage": 10
    },
    {
      "id": 2,
      "grade_id": 7,
      "subject_id": 10,
      "class_type_id": null,
      "subject_activity_type_id": 2,
      "max_score": 100,
      "percentage": 10
    },
    {
      "id": 3,
      "grade_id": 7,
      "subject_id": 10,
      "class_type_id": null,
      "subject_activity_type_id": 3,
      "max_score": 40,
      "percentage": 100
    }
  ],
  "assessments": [
    { "id": 1, "ass_name": "H1", "grading_rule_id": 1, "subject_id": 10, "max_score": 100 },
    { "id": 2, "ass_name": "H2", "grading_rule_id": 1, "subject_id": 10, "max_score": 100 },
    { "id": 10, "ass_name": "H10", "grading_rule_id": 1, "subject_id": 10, "max_score": 100 },
    { "id": 11, "ass_name": "W1", "grading_rule_id": 2, "subject_id": 10, "max_score": 100 },
    { "id": 20, "ass_name": "W10", "grading_rule_id": 2, "subject_id": 10, "max_score": 100 },
    { "id": 21, "ass_name": "Exam", "grading_rule_id": 3, "subject_id": 10, "max_score": 40 }
  ]
}
```

Children are **not** inserted.

---

### 2) List — after parent create only

**Request**

```json
{
  "grade_id": 7,
  "year_id": 1,
  "term_id": 1
}
```

**Response**

```json
{
  "status": true,
  "data": [
    {
      "id": 10,
      "name_en": "Language Art",
      "name_kh": "ភាសា",
      "parent_id": null,
      "has_grading": true,
      "grading_rules": [
        {
          "id": 1,
          "max_score": 100,
          "percentage": 10,
          "class_type_id": null,
          "activity": {
            "id": 1,
            "name_en": "Homework",
            "name_kh": "កិច្ចការផ្ទះ",
            "symbol": "H"
          },
          "assessments": [
            { "id": 1, "ass_name": "H1", "max_score": 100 },
            { "id": 2, "ass_name": "H2", "max_score": 100 },
            { "id": 10, "ass_name": "H10", "max_score": 100 }
          ]
        },
        {
          "id": 2,
          "max_score": 100,
          "percentage": 10,
          "class_type_id": null,
          "activity": {
            "id": 2,
            "name_en": "Work",
            "symbol": "W"
          },
          "assessments": [
            { "id": 11, "ass_name": "W1", "max_score": 100 },
            { "id": 20, "ass_name": "W10", "max_score": 100 }
          ]
        },
        {
          "id": 3,
          "max_score": 40,
          "percentage": 100,
          "class_type_id": null,
          "activity": {
            "id": 3,
            "name_en": "Exam",
            "symbol": "E"
          },
          "assessments": [
            { "id": 21, "ass_name": "Exam", "max_score": 40 }
          ]
        }
      ],
      "children": [
        {
          "id": 11,
          "name_en": "Reading",
          "parent_id": 10,
          "has_grading": false,
          "grading_rules": []
        },
        {
          "id": 12,
          "name_en": "Listening",
          "parent_id": 10,
          "has_grading": false,
          "grading_rules": []
        },
        {
          "id": 13,
          "name_en": "Writing",
          "parent_id": 10,
          "has_grading": false,
          "grading_rules": []
        },
        {
          "id": 14,
          "name_en": "Speaking",
          "parent_id": 10,
          "has_grading": false,
          "grading_rules": []
        }
      ]
    }
  ]
}
```

---

### 3) Create — child Reading (Exam only)

**Request**

```json
{
  "grade_id": 7,
  "year_id": 1,
  "term_id": 1,
  "subject_id": 11,
  "class_type_id": null,
  "rules": [
    {
      "subject_activity_type_id": 3,
      "max_score": 25,
      "percentage": 100,
      "assessment_count": 1
    }
  ]
}
```

**Child in list after save**

```json
{
  "id": 11,
  "name_en": "Reading",
  "parent_id": 10,
  "has_grading": true,
  "grading_rules": [
    {
      "id": 4,
      "max_score": 25,
      "percentage": 100,
      "class_type_id": null,
      "activity": {
        "id": 3,
        "name_en": "Exam",
        "symbol": "E"
      },
      "assessments": [
        { "id": 30, "ass_name": "Exam", "max_score": 25 }
      ]
    }
  ]
}
```

Listening / Writing / Speaking can still be empty. Later you can add Homework to Reading the same way — still dynamic.

---

### 4) Create — Math grade 12 Social + Science

**Request (Social)**

```json
{
  "grade_id": 12,
  "year_id": 1,
  "term_id": 1,
  "subject_id": 20,
  "class_type_id": 2,
  "rules": [
    {
      "subject_activity_type_id": 3,
      "max_score": 75,
      "percentage": 100,
      "assessment_count": 1
    }
  ]
}
```

**Request (Science)**

```json
{
  "grade_id": 12,
  "year_id": 1,
  "term_id": 1,
  "subject_id": 20,
  "class_type_id": 1,
  "rules": [
    {
      "subject_activity_type_id": 3,
      "max_score": 120,
      "percentage": 100,
      "assessment_count": 1
    }
  ]
}
```

> Class type IDs example: `1 = Science (Scient)`, `2 = Social`, `3 = General`.

**List fragment**

```json
{
  "id": 20,
  "name_en": "Math",
  "parent_id": null,
  "has_grading": true,
  "children": [],
  "grading_rules": [
    {
      "id": 50,
      "max_score": 75,
      "percentage": 100,
      "class_type_id": 2,
      "class_type": { "id": 2, "name_en": "Social", "name_kh": "វិទ្យាសង្គម" },
      "activity": { "id": 3, "name_en": "Exam", "symbol": "E" },
      "assessments": [
        { "id": 100, "ass_name": "Exam", "max_score": 75 }
      ]
    },
    {
      "id": 51,
      "max_score": 120,
      "percentage": 100,
      "class_type_id": 1,
      "class_type": { "id": 1, "name_en": "Scient", "name_kh": "វិទ្យាសាស្រ្ត" },
      "activity": { "id": 3, "name_en": "Exam", "symbol": "E" },
      "assessments": [
        { "id": 101, "ass_name": "Exam", "max_score": 120 }
      ]
    }
  ]
}
```

---

### 5) Update / delete (simple)

**Update one rule**

```json
{
  "id": 1,
  "max_score": 100,
  "percentage": 15
}
```

**Delete one rule** (also delete or soft-delete its assessments)

```json
{
  "id": 1
}
```

**Add more assessments to existing rule** (optional later)

```json
{
  "grading_rule_id": 1,
  "assessments": [
    { "ass_name": "H11", "max_score": 100 }
  ]
}
```

---

## Suggested API endpoints

| Method path | Purpose |
|-------------|---------|
| `grading-rules-store` | Create rule(s) + auto assessments |
| `grading-rules-list` | Tree list by grade (+ year/term) |
| `grading-rules-show` | One rule + assessments |
| `grading-rules-update` | Update max_score / percentage |
| `grading-rules-delete` | Delete rule (+ assessments) |
| `assessments-store` | Add assessment slots manually |
| `assessments-update` | Rename / change max_score |
| `assessments-delete` | Remove one assessment |

---

## Implementation checklist

1. Add Eloquent relations on `Subject`, `GradingRule`, `Assessment`
2. Implement `GradingRuleController` store / list / show / update / delete
3. Implement `AssessmentController` as needed
4. Register routes in `school.route.php`
5. Build Subject Setting UI:
   - select grade → list tree
   - Add Rule dialog (subject, activity, class type, max, %, count)
6. Later: student score table + score entry screen

---

## One-line summary

**Create = save rules for the selected subject only. List = parent tree + each child’s rules (empty if none). Class type changes max score on the same subject, not a second subject.**
