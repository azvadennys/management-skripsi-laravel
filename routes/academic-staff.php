<?php

use App\Http\Controllers\AcademicStaff\AssessmentComponentController;
use App\Http\Controllers\AcademicStaff\AssessmentScheduleController;
use App\Http\Controllers\AcademicStaff\ExportController;
use App\Http\Controllers\AcademicStaff\ThesisRequirementController;
use App\Http\Controllers\AcademicStaff\UserController;
use App\Http\Controllers\HomeController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AcademicStaff\FacultyController;
use App\Http\Controllers\AcademicStaff\ImportController;
use App\Http\Controllers\AcademicStaff\LecturerController;
use App\Http\Controllers\AcademicStaff\ScienceFieldController;
use App\Http\Controllers\AcademicStaff\StudentController;
use App\Http\Controllers\AcademicStaff\StudyProgramController;
use App\Http\Controllers\AcademicStaff\SubmissionThesisRequirementController;

Route::middleware('role:' . User::ACADEMIC_STAFF)
    ->prefix('academic-staff')
    ->group(function () {
        Route::get('/', [HomeController::class, 'index'])->name('academic-staff.index');

        //DATA MASTER
        Route::group([
            'prefix' => 'master',
        ], function () {
            Route::resource('faculties', FacultyController::class)->except(['create', 'edit', 'show']);
            Route::resource('study-programs', StudyProgramController::class)->except(['create', 'edit', 'show']);

            Route::get('lecturers/import', [ImportController::class, 'getImportLecturer'])->name('lecturers.import');
            Route::post('lecturers/import', [ImportController::class, 'processImportLecturer'])->name('lecturers.import');
            Route::get('lecturers/export', [ExportController::class, 'lecturer'])->name('lecturers.export');
            Route::resource('lecturers', LecturerController::class);

            Route::get('students/import', [ImportController::class, 'getImportStudent'])->name('students.import');
            Route::post('students/import', [ImportController::class, 'processImportStudent'])->name('students.import');
            Route::resource('students', StudentController::class);

            Route::get('science-fields/import', [ImportController::class, 'getImportScienceField'])->name('science-fields.import');
            Route::post('science-fields/import', [ImportController::class, 'processImportScienceField'])->name('science-fields.import');
            Route::resource('science-fields', ScienceFieldController::class)->except(['create', 'edit', 'show']);
        });

        //DATA SKRIPSI
        Route::get('/thesis-requirements/submission/{id}', [
            SubmissionThesisRequirementController::class, 'show'
        ])->name('thesis-requirement.submission.show');

        Route::post('/thesis-requirements/submit-response/{id}', [
            SubmissionThesisRequirementController::class, 'submitResponse'
        ])->name('thesis-requirement.submit-response');

        Route::resource('thesis-requirements', ThesisRequirementController::class);

        //PENJADWALAN
        Route::prefix('assessment-schedules')
            ->name('assessment-schedules.')
            ->group(function () {
                Route::get('create', [AssessmentScheduleController::class, 'create'])->name('create');
                Route::get('/{type?}', [AssessmentScheduleController::class, 'index'])->name('index');
                Route::post('/', [AssessmentScheduleController::class, 'store'])->name('store');
                Route::get('{schedule}', [AssessmentScheduleController::class, 'show'])->name('show');
                Route::get('{schedule}/edit', [AssessmentScheduleController::class, 'edit'])->name('edit');
                Route::put('{schedule}', [AssessmentScheduleController::class, 'update'])->name('update');
                Route::delete('{schedule}', [AssessmentScheduleController::class, 'destroy'])->name('delete');
            });
        //        Route::resource('assessment-schedules', AssessmentScheduleController::class)
        //        ->except('index');


        Route::resource('assessment-components', AssessmentComponentController::class);

        Route::resource('users', UserController::class);
    });
