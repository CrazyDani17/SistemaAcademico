<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin')
    ),
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('classroom', 'ClassroomCrudController');
    Route::crud('professor', 'ProfessorCrudController');
    Route::crud('subject', 'SubjectCrudController');
    Route::crud('academic-year', 'AcademicYearCrudController');
    Route::crud('academic-semester', 'AcademicSemesterCrudController');
    Route::crud('academic-course', 'AcademicCourseCrudController');
    Route::crud('class-typology', 'ClassTypologyCrudController');
    Route::crud('class_typology_hour', 'ClassTypologyHourCrudController');
    Route::crud('weekday', 'WeekdayCrudController');
    Route::crud('shift', 'ShiftCrudController');
    Route::crud('class-session', 'ClassSessionCrudController');
    Route::crud('curriculum', 'CurriculumCrudController');
    Route::crud('associate-subject', 'AssociateSubjectCrudController');
    Route::crud('associate-professor', 'AssociateProfessorCrudController');
    Route::crud('schedule', 'ScheduleCrudController');
    Route::get('user/verify/{id}', 'VerifyController@verify')->name('user.verify');
    Route::get('schedule/view_schedules', 'ScheduleCrudController@list_schedules');
    Route::get('schedule/pdf/{curriculum_id}/{academic_year_id}/{academic_semester_id}', 'ScheduleCrudController@createPDF')->name('schedule.pdf');
    Route::get('schedule/excel/{curriculum_id}/{academic_year_id}/{academic_semester_id}', 'ScheduleCrudController@exportExcel')->name('schedule.excel');
    Route::post('schedule/view_schedules','ScheduleCrudController@view_schedules')->name('view_schedules');
    //Route::get('curriculum/{id}/associate_subjects', 'CurriculumCrudController@associate_subjects');
}); // this should be the absolute last line of this file

Route::get('api/academic_year', 'App\Http\Controllers\Api\AcademicYearController@index');

Route::get('api/associate_professor', 'App\Http\Controllers\Api\AssociateProfessorController@index');
Route::get('api/associate_professor/{id}', 'App\Http\Controllers\Api\AssociateProfessorController@show');

Route::get('api/class_typology', 'App\Http\Controllers\Api\ClassTypologyController@index');
Route::get('api/class_typology/{id}', 'App\Http\Controllers\Api\ClassTypologyController@show');