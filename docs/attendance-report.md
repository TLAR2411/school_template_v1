# Attendance report

Optional filters: **class**, **one date**, **date range**, **month**, **session**.  
Counts **present / late / permission / absent** (one mark per student + day + session).

---

## Month filter uses school year

`month_id` is resolved with **`X-Year-Id`** (`years.start_date` / `end_date`), not “today’s calendar year”.

Example: year `2026-01-01` … `2026-12-31` + January → `2026-01-01` … `2026-01-31`.

If the wrong year appears, check/update:

```sql
SELECT id, name, start_date, end_date FROM years;
UPDATE years SET name = '2026 - 2027', start_date = '2026-01-01', end_date = '2026-12-31' WHERE id = 1;
```

---

## Short commands (CLI)

```bash
cd API

# one day
php artisan attendance:report --class=12 --date=2026-09-24

# range
php artisan attendance:report --class=12 --from=2026-09-01 --to=2026-09-24

# month (months.id + year id from header / --year)
php artisan attendance:report --class=12 --month=9 --year=1

# all classes, morning only, full JSON
php artisan attendance:report --date=2026-09-24 --session=AM --json
```

---

## API

`POST /api/web/attendance-report`  
Permission: `view-attendance`  
Headers: `X-Branch-Id`, `X-Curriculum-id`, `X-Year-Id` (same as other school APIs)

```json
{ "class_id": 12, "date": "2026-09-24" }
{ "class_id": 12, "date_from": "2026-09-01", "date_to": "2026-09-24" }
{ "class_id": 12, "month_id": 9 }
{ "session": "AM" }
```

All fields optional. Date priority: `date` → `date_from`/`date_to` → `month_id` + year → current month.

**Rules**
- No class selected + date range → students from **all classes** in that range (Class A on day 1 + Class B on day 2 both show)
- Only students who have rows in `attendances` are returned (no empty enrolled list)
- Counts are per **student + class** (same student in two classes = two rows)

Response:

```json
{
  "status": true,
  "data": {
    "date_from": "2026-09-01",
    "date_to": "2026-09-24",
    "summary": { "present": 180, "late": 12, "permission": 4, "absent": 20, "total": 216 },
    "students": [
      {
        "student_id": 5,
        "class_id": 12,
        "name_en": "Sok Dara",
        "name_kh": "សុខ ដារ៉ា",
        "present": 18,
        "late": 1,
        "permission": 0,
        "absent": 2,
        "total": 21
      }
    ],
    "students_absent": [
      {
        "student_id": 5,
        "class_id": 12,
        "date": "2026-09-10",
        "session": "AM",
        "name_en": "Sok Dara",
        "name_kh": "សុខ ដារ៉ា",
        "gender": "M",
        "class_name_en": "11 A",
        "class_name_kh": "11 A"
      }
    ],
    "students_permission": [
      {
        "student_id": 8,
        "class_id": 12,
        "date": "2026-09-12",
        "session": "PM",
        "name_en": "Chan Srey",
        "name_kh": "ចាន់ ស្រី",
        "gender": "F",
        "class_name_en": "11 A",
        "class_name_kh": "11 A"
      }
    ]
  }
}
```

- `students` — every student with **counts** for the period  
- `students_absent` — each **absent session** (student + date + session)  
- `students_permission` — each **permission session** (student + date + session)

---

## UI layout

- **Desktop:** summary cards + table (color counts)
- **Phone:** summary cards (2-column) + one card per student with Present / Late / Permission / Absent pills — no tiny table scroll

## Frontend — drop-in component

```vue
<script setup>
import AttendanceReport from "@/views/school/Attendance/AttendanceReport.vue";
</script>

<template>
  <!-- full page with filters -->
  <AttendanceReport />

  <!-- locked to one class (Teacher Action) -->
  <AttendanceReport :class-id="12" lock-class :is-back="false" />

  <!-- month preset -->
  <AttendanceReport period="month" :month-id="9" />

  <!-- range, no filter bar -->
  <AttendanceReport
    period="range"
    date-from="2026-09-01"
    date-to="2026-09-24"
    hide-filters
  />
</template>
```

Props:

| Prop | Default | Meaning |
|------|---------|---------|
| `classId` | `null` | Pre-select class |
| `lockClass` | `false` | Hide grade/class pickers |
| `period` | `"date"` | `date` \| `range` \| `month` |
| `date` / `dateFrom` / `dateTo` / `monthId` | — | Initial period values |
| `session` | `null` | `AM` \| `PM` |
| `hideFilters` | `false` | Hide filter bar |
| `autoLoad` | `true` | Load on mount |
| `isBack` | `true` | Show back button |

Call from parent:

```vue
<script setup>
const reportRef = ref(null);
// later:
reportRef.value?.search();
</script>

<template>
  <AttendanceReport ref="reportRef" />
</template>
```

---

## Frontend — composable only

```js
import {
  useAttendanceReport,
  fetchAttendanceReport,
} from "@/composables/useAttendanceReport";

const { load, summary, students, studentsAbsent, studentsPermission } =
  useAttendanceReport();

await load({ class_id: 12, date: "2026-09-24" });
// studentsAbsent / studentsPermission = each session event with date
```

---

## Where it opens

- School menu → **Attendance Report** (`/school/Attendance/report`)
- Teacher Action → **Attendance Report** tab

---

## Customize later (short map)

| Want to change | File | Edit this |
|----------------|------|-----------|
| Present / late / absent rules | `API/app/Services/School/AttendanceReportService.php` | `statusOf()` |
| Extra filters (teacher, approved…) | same | `sessionQuery()` |
| Month + academic year | same | `resolveDates()` / `monthRange()` |
| API request fields | `AttendanceController::report()` | `$request->validate([...])` |
| CLI flags | `API/app/Console/Commands/AttendanceReport.php` | `$signature` |
| Filter UI / stat cards | `WEB/src/views/school/Attendance/AttendanceReport.vue` | `PERIODS`, `STATS`, `payload()` |
| Request body keys | `WEB/src/composables/useAttendanceReport.js` | `toReportPayload()` |
| Menu link | `WEB/src/navigation/vertical/school/index.js` | Attendance Report item |
| i18n labels | `WEB/src/plugins/i18n/locales/en.json` + `km.json` | `"Attendance Report"`, … |

Count rule today: **permission → late → absent → present**.  
If any subject that session is absent → session counts as absent (`MIN(is_present)`).

---

## Files

| Layer | Path |
|-------|------|
| Service | `API/app/Services/School/AttendanceReportService.php` |
| Controller | `API/app/Http/Controllers/Api/School/AttendanceController.php` → `report()` |
| Route | `API/routes/modules/school.route.php` → `attendance-report` |
| CLI | `API/app/Console/Commands/AttendanceReport.php` |
| Tests | `API/tests/Unit/AttendanceReportServiceTest.php` |
| Composable | `WEB/src/composables/useAttendanceReport.js` |
| Component | `WEB/src/views/school/Attendance/AttendanceReport.vue` |
| Page | `WEB/src/pages/school/Attendance/report.vue` |
