<?php

use App\Http\Controllers\Api\School\StudentController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\School\CurriculumController;
use App\Http\Controllers\Api\School\YearController;
use App\Http\Controllers\Api\School\StudentCurriculumController;
use App\Http\Controllers\Api\School\EducationLevelController;
use App\Http\Controllers\Api\School\RoomController;
use App\Http\Controllers\Api\School\GradeController;
use App\Http\Controllers\Api\School\ClassController;
use App\Http\Controllers\Api\School\ClassTypeController;
use App\Http\Controllers\Api\School\StudentClassController;
use App\Http\Controllers\Api\School\SubjectActivityTypeController;
use App\Http\Controllers\Api\School\SubjectController;
use App\Http\Controllers\Api\School\TeacherController;
use App\Http\Controllers\Api\School\GradingRuleController;
use App\Http\Controllers\Api\School\AssessmentController;
use App\Http\Controllers\Api\School\AttendanceController;
use App\Http\Controllers\Api\School\ScoreEntryController;
use App\Http\Controllers\Api\School\DayController;
use App\Http\Controllers\Api\School\FamilyController;
use App\Http\Controllers\Api\School\TeacherClassController;
use App\Http\Controllers\Api\School\StudentFamilyController;
use App\Http\Controllers\Api\School\FamilyMemberController;
use App\Http\Controllers\Api\School\MonthController;
use App\Http\Controllers\Api\School\ShiftController;
use App\Http\Controllers\Api\School\ScheduleController;
use App\Http\Controllers\Api\School\TermPeriodController;
use App\Http\Controllers\Api\School\TermPeriodListController;

Route::post('attendance-list', [AttendanceController::class, 'getAttendanceData'])->middleware('permission:view-attendance|add-attendance');
Route::post('attendance-store', [AttendanceController::class, 'store'])->middleware('permission:add-attendance|edit-attendance');
Route::post('attendance-report', [AttendanceController::class, 'report'])->middleware('permission:view-attendance');

Route::post('score-list', [ScoreEntryController::class, 'getScoreData'])->middleware('permission:view-score-entry|add-score-entry');

Route::post('term-period-lists-store', [TermPeriodListController::class, 'store'])->middleware('permission:add-term-periods');
Route::post('term-period-lists-update', [TermPeriodListController::class, 'update'])->middleware('permission:edit-term-periods');

Route::post('term-periods-store', [TermPeriodController::class, 'store'])->middleware('permission:add-term-periods');
Route::post('term-periods-list', [TermPeriodController::class, 'list'])->middleware('permission:view-term-periods');
Route::post('term-periods-show', [TermPeriodController::class, 'show']);
Route::post('term-periods-update', [TermPeriodController::class, 'update'])->middleware('permission:edit-term-periods');
Route::post('term-periods-delete', [TermPeriodController::class, 'delete'])->middleware('permission:delete-term-periods');
Route::post('term-periods-all', [TermPeriodController::class, 'all']);

Route::post("subjects-activity-type-store", [SubjectActivityTypeController::class, "store"])->middleware('permission:add-subject-activity-types');
Route::post("subjects-activity-type-list", [SubjectActivityTypeController::class, "list"])->middleware('permission:view-subject-activity-types');
Route::post("subjects-activity-type-show", [SubjectActivityTypeController::class, "show"]);
Route::post("subjects-activity-type-update", [SubjectActivityTypeController::class, "update"])->middleware('permission:edit-subject-activity-types');
Route::post("subjects-activity-type-disable", [SubjectActivityTypeController::class, "disable"])->middleware('permission:change-active-subject-activity-types');
Route::post("subjects-activity-type-delete", [SubjectActivityTypeController::class, "delete"])->middleware('permission:delete-subject-activity-types');
Route::post("subjects-activity-type-all", [SubjectActivityTypeController::class, 'all']);

Route::post("teachers-classes-store", [TeacherClassController::class, 'store'])->middleware('permission:add-teacher-classes');
Route::post("teachers-classes-list", [TeacherClassController::class, 'list'])->middleware('permission:view-teacher-classes');
Route::post("teachers-classes-show", [TeacherClassController::class, 'show']);
Route::post("teachers-classes-delete_subject", [TeacherClassController::class, 'delete_subject'])->middleware('permission:delete-teacher-classes');
Route::post("teachers-classes-update", [TeacherClassController::class, 'update'])->middleware('permission:edit-teacher-classes');
Route::post("teachers-classes-delete", [TeacherClassController::class, 'delete'])->middleware('permission:delete-teacher-classes');
Route::post("subject-class", [TeacherClassController::class, 'subjectClass']);

Route::post("subjects-store", [SubjectController::class, "store"])->middleware('permission:add-subjects');
Route::post("subjects-list", [SubjectController::class, "list"])->middleware('permission:view-subjects');
Route::post("subjects-show", [SubjectController::class, "show"]);
Route::post("subjects-update", [SubjectController::class, "update"])->middleware('permission:edit-subjects');
Route::post("subjects-disable", [SubjectController::class, "disable"])->middleware('permission:change-active-subjects');
Route::post("subjects-delete", [SubjectController::class, "delete"])->middleware('permission:delete-subjects');
Route::post("subjects-all", [SubjectController::class, 'all']);
Route::post("subejects-by-day", [SubjectController::class, 'subjectByDay']);

Route::post("students-store", [StudentController::class, "store"])->middleware('permission:add-students');
Route::post("students-list", [StudentController::class, "list"])->middleware('permission:view-students');
Route::post("students-show", [StudentController::class, "show"]);
Route::post("students-update", [StudentController::class, "update"])->middleware('permission:edit-students');
Route::post("students-disable", [StudentController::class, "disable"])->middleware('permission:change-active-students');
Route::post("students-delete", [StudentController::class, "delete"])->middleware('permission:delete-students');
Route::post("students-delete-many", [StudentController::class, "deleteMany"])->middleware('permission:delete-students');
Route::post("students-all", [StudentController::class, "all"]);

Route::post("curriculums-store", [CurriculumController::class, "store"])->middleware('permission:add-curriculums');
Route::post("curriculums-list", [CurriculumController::class, "list"])->middleware('permission:view-curriculums');
Route::post("curriculums-show", [CurriculumController::class, "show"]);
Route::post("curriculums-update", [CurriculumController::class, "update"])->middleware('permission:edit-curriculums');
Route::post("curriculums-all", [CurriculumController::class, "all"]);
Route::post("curriculums-disable", [CurriculumController::class, "disable"])->middleware('permission:change-active-curriculums');
Route::post("curriculums-delete", [CurriculumController::class, "delete"])->middleware('permission:delete-curriculums');

Route::post("years-store", [YearController::class, "store"])->middleware('permission:add-years');
Route::post("years-list", [YearController::class, "list"])->middleware('permission:view-years');
Route::post("years-show", [YearController::class, "show"]);
Route::post("years-update", [YearController::class, "update"])->middleware('permission:edit-years');
Route::post("years-all", [YearController::class, "all"]);
Route::post("years-disable", [YearController::class, "disable"])->middleware('permission:change-active-years');
Route::post("years-delete", [YearController::class, "delete"])->middleware('permission:delete-years');

Route::post("student-not-yet-enroll", [StudentCurriculumController::class, "studentNotYetEnrollCurriculum"])->middleware('permission:enroll-students');
Route::post("student-enroll-store", [StudentCurriculumController::class, "store"])->middleware('permission:enroll-students');
Route::post("student-enroll-list", [StudentCurriculumController::class, "list"])->middleware('permission:view-students');

Route::post("education-levels-store", [EducationLevelController::class, "store"])->middleware('permission:add-education-levels');
Route::post("education-levels-list", [EducationLevelController::class, "list"])->middleware('permission:view-education-levels');
Route::post("education-levels-show", [EducationLevelController::class, "show"]);
Route::post("education-levels-update", [EducationLevelController::class, "update"])->middleware('permission:edit-education-levels');
Route::post("education-levels-all", [EducationLevelController::class, "all"]);
Route::post("education-levels-disable", [EducationLevelController::class, "disable"])->middleware('permission:change-active-education-levels');
Route::post("education-levels-delete", [EducationLevelController::class, "delete"])->middleware('permission:delete-education-levels');

Route::post("rooms-store", [RoomController::class, "store"])->middleware('permission:add-rooms');
Route::post("rooms-list", [RoomController::class, "list"])->middleware('permission:view-rooms');
Route::post("rooms-show", [RoomController::class, "show"]);
Route::post("rooms-update", [RoomController::class, "update"])->middleware('permission:edit-rooms');
Route::post("rooms-all", [RoomController::class, "all"]);
Route::post("rooms-disable", [RoomController::class, "disable"])->middleware('permission:change-active-rooms');
Route::post("rooms-delete", [RoomController::class, "delete"])->middleware('permission:delete-rooms');

Route::post("grades-store", [GradeController::class, "store"])->middleware('permission:add-grades');
Route::post("grades-list", [GradeController::class, "list"])->middleware('permission:view-grades');
Route::post("grades-show", [GradeController::class, "show"]);
Route::post("grades-update", [GradeController::class, "update"])->middleware('permission:edit-grades');
Route::post("grades-all", [GradeController::class, "all"]);
Route::post("grades-disable", [GradeController::class, "disable"])->middleware('permission:change-active-grades');
Route::post("grades-delete", [GradeController::class, "delete"])->middleware('permission:delete-grades');

Route::post("classes-store", [ClassController::class, "store"])->middleware('permission:add-classes');
Route::post("classes-list", [ClassController::class, "list"])->middleware('permission:view-classes');
Route::post("classes-show", [ClassController::class, "show"]);
Route::post("classes-update", [ClassController::class, "update"])->middleware('permission:edit-classes');
Route::post("classes-all", [ClassController::class, "all"]);
Route::post("classes-disable", [ClassController::class, "disable"])->middleware('permission:change-active-classes');
Route::post("classes-delete", [ClassController::class, "delete"])->middleware('permission:delete-classes');
Route::post("classes-detail", [ClassController::class, 'detail'])->middleware('permission:view-classes');
Route::post("classes-teacher", [ClassController::class, 'teacherClass'])->middleware('permission:view-classes');

Route::post("classes-type-all", [ClassTypeController::class, 'all']);

Route::post("teachers-store", [TeacherController::class, "store"])->middleware('permission:add-teachers');
Route::post("teachers-import", [TeacherController::class, "import"])->middleware('permission:import-teachers');
Route::post("teachers-import-template", [TeacherController::class, "importTemplate"])->middleware('permission:import-teachers');
Route::post("teachers-list", [TeacherController::class, "list"])->middleware('permission:view-teachers');
Route::post("teachers-show", [TeacherController::class, "show"]);
Route::post("teachers-update", [TeacherController::class, "update"])->middleware('permission:edit-teachers');
Route::post("teachers-all", [TeacherController::class, "all"]);
Route::post("teachers-disable", [TeacherController::class, "disable"])->middleware('permission:change-active-teachers');
Route::post("teachers-delete", [TeacherController::class, "delete"])->middleware('permission:delete-teachers');

Route::post("student-not-yet-enroll-class", [StudentClassController::class, "studentNotYetEnrollClass"])->middleware('permission:add-student-classes');
Route::post("student-class-store", [StudentClassController::class, "store"])->middleware('permission:add-student-classes');
Route::post("student-class-list", [StudentClassController::class, "list"])->middleware('permission:view-student-classes');

Route::post("grading-rules-list", [GradingRuleController::class, "list"])->middleware('permission:view-grading-rules');
Route::post('grading-rules-store', [GradingRuleController::class, "store"])->middleware('permission:add-grading-rules');
Route::post('grading-rules-delete', [GradingRuleController::class, 'delete'])->middleware('permission:delete-grading-rules');
Route::post("grading-rules-subjects", [GradingRuleController::class, "subject_grade"]);

Route::post('assessments-store', [AssessmentController::class, 'store'])->middleware('permission:add-assessments');
Route::post('assessments-delete', [AssessmentController::class, 'delete'])->middleware('permission:delete-assessments');

Route::post('families-store', [FamilyController::class, 'store'])->middleware('permission:add-families');
Route::post('families-list', [FamilyController::class, 'list'])->middleware('permission:view-families');
Route::post('families-show', [FamilyController::class, 'show']);
Route::post('families-update', [FamilyController::class, 'update'])->middleware('permission:edit-families');

Route::post('student-family-store', [StudentFamilyController::class, 'store'])->middleware('permission:edit-families');
Route::post('student-family-delete', [StudentFamilyController::class, 'delete'])->middleware('permission:edit-families');

Route::post('family-members-show', [FamilyMemberController::class, 'show']);
Route::post('family-members-store', [FamilyMemberController::class, 'store'])->middleware('permission:edit-families');
Route::post('family-members-update', [FamilyMemberController::class, 'update'])->middleware('permission:edit-families');
Route::post('family-members-delete', [FamilyMemberController::class, 'delete'])->middleware('permission:delete-families');

Route::post('schedules-list', [ScheduleController::class, 'list'])->middleware('permission:view-schedules');
Route::post('schedules-store', [ScheduleController::class, 'store'])->middleware('permission:add-schedules');
Route::post('schedules-show', [ScheduleController::class, 'show']);
Route::post('schedules-update', [ScheduleController::class, 'update'])->middleware('permission:edit-schedules');
Route::post('schedules-delete', [ScheduleController::class, 'delete'])->middleware('permission:delete-schedules');

Route::post('days-all', [DayController::class, 'all']);
Route::post('shift-all', [ShiftController::class, 'all']);
Route::post('months-all', [MonthController::class, 'all']);
