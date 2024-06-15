<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ExaminationController;
use App\Http\Controllers\ExamQuestionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ExamResponseController;




Route::get('/', function () {
    return view('welcome');
});

Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
Route::get('/add', [CourseController::class, 'add'])->name('courses.add');
Route::post('/store', [CourseController::class, 'store'])->name('courses.store');
Route::get('/edit/{course}', [CourseController::class, 'edit'])->name('courses.edit');
Route::delete('/destroy/{course}', [CourseController::class, 'destroy'])->name('courses.destroy');
Route::put('/update/{course}', [CourseController::class, 'update'])->name('courses.update');
Route::get('/search/{id}', [CourseController::class, 'search'])->name('courses.search');
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/index/{course}/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
Route::get('/create/{course}', [QuizController::class, 'create'])->name('quizzes.create');
Route::post('/store/{course}', [QuizController::class, 'store'])->name('quizzes.store');


Route::get('/quizzes/{quiz}/questions/create', [QuestionController::class, 'create'])->name('questions.create');
Route::post('/quizzes/{quiz}/questions', [QuestionController::class, 'store'])->name('questions.store');
Route::get('/quizzes/{quiz}/questions', [QuestionController::class, 'index'])->name('questions.index');

Route::get('/examinations/{course_id}', [ExaminationController::class, 'index'])->name('examinations.index');
Route::get('/examinations/create/{course_id}', [ExaminationController::class, 'create'])
    ->name('examinations.create');
Route::post('/examinations', [ExaminationController::class, 'store'])->name('examinations.store');

Route::get('/examinations/{examination_id}/questions', [ExamQuestionController::class, 'index'])->name('Examquestions.index');

Route::get('/examinations/{examination_id}/questions/create', [ExamQuestionController::class, 'create'])->name('examquestions.create');
Route::post('/examinations/{examination_id}/questions', [ExamQuestionController::class, 'store'])->name('examquestions.store');
Route::post('/examinations/{examination_id}/submit', [ExaminationController::class, 'submit'])->name('examinations.submit');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

Route::get('/exam-responses/{notification}', [ExamResponseController::class, 'show'])->name('exam.responses.show');



