<?php

use App\Models\Quiz;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/locale/{locale}', function (string $locale) {
    if (in_array($locale, ['en', 'ar'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('locale.switch');

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/quiz/create', function () {
    return view('quiz.create');
})->name('quiz.create');

Route::get('/quiz/{quiz}/play', function (Quiz $quiz) {
    return view('quiz.play', compact('quiz'));
})->name('quiz.play');

// API for quiz creation form (Alpine.js powered)
Route::post('/api/quizzes', function (Request $request) {
    $validated = $request->validate([
        'title'                    => 'required|string|max:255',
        'description'              => 'nullable|string',
        'category'                 => 'required|string',
        'difficulty'               => 'required|in:easy,medium,hard',
        'cover_emoji'              => 'required|string',
        'time_limit_per_question'  => 'required|integer|min:5|max:120',
        'questions'                => 'required|array|min:1',
        'questions.*.text'         => 'required|string',
        'questions.*.points'       => 'required|integer|min:10',
        'questions.*.hint'         => 'nullable|string',
        'questions.*.answers'      => 'required|array|min:2',
        'questions.*.answers.*.text'       => 'required|string',
        'questions.*.answers.*.is_correct' => 'required|boolean',
    ]);

    $quiz = \App\Models\Quiz::create([
        'title'                   => $validated['title'],
        'description'             => $validated['description'] ?? null,
        'category'                => $validated['category'],
        'difficulty'              => $validated['difficulty'],
        'cover_emoji'             => $validated['cover_emoji'],
        'time_limit_per_question' => $validated['time_limit_per_question'],
        'is_public'               => true,
    ]);

    foreach ($validated['questions'] as $order => $qData) {
        $question = $quiz->questions()->create([
            'question_text' => $qData['text'],
            'points'        => $qData['points'],
            'hint'          => $qData['hint'] ?? null,
            'order'         => $order,
        ]);

        foreach ($qData['answers'] as $aOrder => $aData) {
            $question->answers()->create([
                'answer_text' => $aData['text'],
                'is_correct'  => (bool) $aData['is_correct'],
                'order'       => $aOrder,
            ]);
        }
    }

    return response()->json(['id' => $quiz->id]);
});
