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

Route::post('attendance-list', [AttendanceController::class, 'getAttendanceData']);
Route::post('attendance-store', [AttendanceController::class, 'store']);

Route::post('term-period-lists-store', [TermPeriodListController::class, 'store']);
Route::post('term-period-lists-update', [TermPeriodListController::class, 'update']);


Route::post('term-periods-store', [TermPeriodController::class, 'store']);
Route::post('term-periods-list', [TermPeriodController::class, 'list']);
Route::post('term-periods-show', [TermPeriodController::class, 'show']);
Route::post('term-periods-update', [TermPeriodController::class, 'update']);
Route::post('term-periods-delete', [TermPeriodController::class, 'delete']);
Route::post('term-periods-all', [TermPeriodController::class, 'all']);

Route::post("subjects-activity-type-store", [SubjectActivityTypeController::class, "store"]);
Route::post("subjects-activity-type-list", [SubjectActivityTypeController::class, "list"]);
Route::post("subjects-activity-type-show", [SubjectActivityTypeController::class, "show"]);
Route::post("subjects-activity-type-update", [SubjectActivityTypeController::class, "update"]);
Route::post("subjects-activity-type-disable", [SubjectActivityTypeController::class, "disable"]);
Route::post("subjects-activity-type-delete", [SubjectActivityTypeController::class, "delete"]);
Route::post("subjects-activity-type-all", [SubjectActivityTypeController::class, 'all']);

Route::post("teachers-classes-store", [TeacherClassController::class, 'store']);
Route::post("teachers-classes-list", [TeacherClassController::class, 'list']);
Route::post("teachers-classes-show", [TeacherClassController::class, 'show']);
Route::post("teachers-classes-delete_subject", [TeacherClassController::class, 'delete_subject']);
Route::post("teachers-classes-update", [TeacherClassController::class, 'update']);
Route::post("teachers-classes-delete", [TeacherClassController::class, 'delete']);
Route::post("subject-class", [TeacherClassController::class, 'subjectClass']);

Route::post("subjects-store", [SubjectController::class, "store"]);
Route::post("subjects-list", [SubjectController::class, "list"]);
Route::post("subjects-show", [SubjectController::class, "show"]);
Route::post("subjects-update", [SubjectController::class, "update"]);
Route::post("subjects-disable", [SubjectController::class, "disable"]);
Route::post("subjects-delete", [SubjectController::class, "delete"]);
Route::post("subjects-all", [SubjectController::class, 'all']);
Route::post("subejects-by-day", [SubjectController::class, 'subjectByDay']);


Route::post("students-store", [StudentController::class, "store"]);
Route::post("students-list", [StudentController::class, "list"]);
Route::post("students-show", [StudentController::class, "show"]);
Route::post("students-update", [StudentController::class, "update"]);
Route::post("students-disable", [StudentController::class, "disable"]);
Route::post("students-delete", [StudentController::class, "delete"]);
Route::post("students-all", [StudentController::class, "all"]);

Route::post("curriculums-store", [CurriculumController::class, "store"]);
Route::post("curriculums-list", [CurriculumController::class, "list"]);
Route::post("curriculums-show", [CurriculumController::class, "show"]);
Route::post("curriculums-update", [CurriculumController::class, "update"]);
Route::post("curriculums-all", [CurriculumController::class, "all"]);
Route::post("curriculums-disable", [CurriculumController::class, "disable"]);
Route::post("curriculums-delete", [CurriculumController::class, "delete"]);

Route::post("years-store", [YearController::class, "store"]);
Route::post("years-list", [YearController::class, "list"]);
Route::post("years-show", [YearController::class, "show"]);
Route::post("years-update", [YearController::class, "update"]);
Route::post("years-all", [YearController::class, "all"]);
Route::post("years-disable", [YearController::class, "disable"]);
Route::post("years-delete", [YearController::class, "delete"]);


Route::post("student-not-yet-enroll", [StudentCurriculumController::class, "studentNotYetEnrollCurriculum"]);
Route::post("student-enroll-store", [StudentCurriculumController::class, "store"]);
Route::post("student-enroll-list", [StudentCurriculumController::class, "list"]);

Route::post("education-levels-store", [EducationLevelController::class, "store"]);
Route::post("education-levels-list", [EducationLevelController::class, "list"]);
Route::post("education-levels-show", [EducationLevelController::class, "show"]);
Route::post("education-levels-update", [EducationLevelController::class, "update"]);
Route::post("education-levels-all", [EducationLevelController::class, "all"]);
Route::post("education-levels-disable", [EducationLevelController::class, "disable"]);
Route::post("education-levels-delete", [EducationLevelController::class, "delete"]);

Route::post("rooms-store", [RoomController::class, "store"]);
Route::post("rooms-list", [RoomController::class, "list"]);
Route::post("rooms-show", [RoomController::class, "show"]);
Route::post("rooms-update", [RoomController::class, "update"]);
Route::post("rooms-all", [RoomController::class, "all"]);
Route::post("rooms-disable", [RoomController::class, "disable"]);
Route::post("rooms-delete", [RoomController::class, "delete"]);

Route::post("grades-store", [GradeController::class, "store"]);
Route::post("grades-list", [GradeController::class, "list"]);
Route::post("grades-show", [GradeController::class, "show"]);
Route::post("grades-update", [GradeController::class, "update"]);
Route::post("grades-all", [GradeController::class, "all"]);
Route::post("grades-disable", [GradeController::class, "disable"]);
Route::post("grades-delete", [GradeController::class, "delete"]);

Route::post("classes-store", [ClassController::class, "store"]);
Route::post("classes-list", [ClassController::class, "list"]);
Route::post("classes-show", [ClassController::class, "show"]);
Route::post("classes-update", [ClassController::class, "update"]);
Route::post("classes-all", [ClassController::class, "all"]);
Route::post("classes-disable", [ClassController::class, "disable"]);
Route::post("classes-delete", [ClassController::class, "delete"]);
Route::post("classes-detail", [ClassController::class, 'detail']);

Route::post("classes-type-all", [ClassTypeController::class, 'all']);


Route::post("teachers-store", [TeacherController::class, "store"]);
Route::post("teachers-list", [TeacherController::class, "list"]);
Route::post("teachers-show", [TeacherController::class, "show"]);
Route::post("teachers-update", [TeacherController::class, "update"]);
Route::post("teachers-all", [TeacherController::class, "all"]);
Route::post("teachers-disable", [TeacherController::class, "disable"]);
Route::post("teachers-delete", [TeacherController::class, "delete"]);

Route::post("student-not-yet-enroll-class", [StudentClassController::class, "studentNotYetEnrollClass"]);
Route::post("student-class-store", [StudentClassController::class, "store"]);
Route::post("student-class-list", [StudentClassController::class, "list"]);

Route::post("grading-rules-list", [GradingRuleController::class, "list"]);
Route::post('grading-rules-store', [GradingRuleController::class, "store"]);
Route::post('grading-rules-delete', [GradingRuleController::class, 'delete']);
Route::post("grading-rules-subjects", [GradingRuleController::class, "subject_grade"]);

Route::post('assessments-store', [AssessmentController::class, 'store']);
Route::post('assessments-delete', [AssessmentController::class, 'delete']);


Route::post('families-store', [FamilyController::class, 'store']);
Route::post('families-list', [FamilyController::class, 'list']);
Route::post('families-show', [FamilyController::class, 'show']);
Route::post('families-update', [FamilyController::class, 'update']);

Route::post('student-family-store', [StudentFamilyController::class, 'store']);
Route::post('student-family-delete', [StudentFamilyController::class, 'delete']);

Route::post('family-members-show', [FamilyMemberController::class, 'show']);
Route::post('family-members-store', [FamilyMemberController::class, 'store']);
Route::post('family-members-update', [FamilyMemberController::class, 'update']);
Route::post('family-members-delete', [FamilyMemberController::class, 'delete']);



Route::post('schedules-list', [ScheduleController::class, 'list']);
Route::post('schedules-store', [ScheduleController::class, 'store']);
Route::post('schedules-show', [ScheduleController::class, 'show']);
Route::post('schedules-update', [ScheduleController::class, 'update']);
Route::post('schedules-delete', [ScheduleController::class, 'delete']);


Route::post('days-all', [DayController::class, 'all']);

Route::post('shift-all', [ShiftController::class, 'all']);
Route::post('months-all', [MonthController::class, 'all']);
