<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuestionController;
use App\Http\Livewire\QuizFeedback;


Route::get('/', [QuizController::class, 'index']);
Route::get('/quiz/{quiz}', [QuizController::class, 'show']);
Route::get('/quiz/create', [QuizController::class, 'create'])->name('quizzes.create');
Route::post('/quiz/store', [QuizController::class, 'store'])->name('quizzes.store');
Route::get('/quiz/{quiz}', [QuizController::class, 'show'])->name('quizzes.show');
Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
Route::resource('quizzes', QuizController::class)->except(['update']);
Route::post('quizzes/{quiz}', [QuizController::class, 'update'])->name('quizzes.update');
Route::post('quizzes/{quiz}/finish', [QuizController::class, 'finish'])->name('quizzes.finish');
Route::post('quizzes/{quiz}/submit', [QuizController::class, 'submit'])->name('quizzes.submit');
Route::resource('quizzes', QuizController::class);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


