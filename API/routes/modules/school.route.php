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
use App\Http\Controllers\Api\School\StudentClassController;
use App\Http\Controllers\Api\School\SubjectActivityTypeController;
use App\Http\Controllers\Api\School\SubjectController;
use App\Http\Controllers\Api\School\TeacherController;


Route::post("subjects-activity-type-store", [SubjectActivityTypeController::class, "store"]);
Route::post("subjects-activity-type-list", [SubjectActivityTypeController::class, "list"]);
Route::post("subjects-activity-type-show", [SubjectActivityTypeController::class, "show"]);
Route::post("subjects-activity-type-update", [SubjectActivityTypeController::class, "update"]);
Route::post("subjects-activity-type-disable", [SubjectActivityTypeController::class, "disable"]);
Route::post("subjects-activity-type-delete", [SubjectActivityTypeController::class, "delete"]);
Route::post("subjects-activity-type-all", [SubjectActivityTypeController::class, 'all']);



Route::post("subjects-store", [SubjectController::class, "store"]);
Route::post("subjects-list", [SubjectController::class, "list"]);
Route::post("subjects-show", [SubjectController::class, "show"]);
Route::post("subjects-update", [SubjectController::class, "update"]);
Route::post("subjects-disable", [SubjectController::class, "disable"]);
Route::post("subjects-delete", [SubjectController::class, "delete"]);
Route::post("subjects-all", [SubjectController::class, 'all']);

Route::post("students-store", [StudentController::class, "store"]);
Route::post("students-list", [StudentController::class, "list"]);
Route::post("students-show", [StudentController::class, "show"]);
Route::post("students-update", [StudentController::class, "update"]);
Route::post("students-disable", [StudentController::class, "disable"]);
Route::post("students-delete", [StudentController::class, "delete"]);

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
