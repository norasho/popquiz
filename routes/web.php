<?php

use App\Http\Controllers\QuizController;
use App\Models\Quiz;
use Illuminate\Support\Facades\Route;

Route::get('/locale/{locale}', function (string $locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('locale.switch');

Route::get('/', fn() => view('home'))->name('home');
Route::get('/quiz/create', fn() => view('quiz.create'))->name('quiz.create');
Route::get('/quiz/{quiz}/play', fn(Quiz $quiz) => view('quiz.play', compact('quiz')))->name('quiz.play');

Route::post('/api/quizzes', [QuizController::class, 'store']);
