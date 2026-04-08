<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'title'                            => 'required|string|max:255',
            'description'                      => 'nullable|string',
            'category'                         => 'required|string',
            'difficulty'                       => 'required|in:easy,medium,hard',
            'cover_emoji'                      => 'required|string',
            'time_limit_per_question'          => 'required|integer|min:5|max:120',
            'questions'                        => 'required|array|min:1',
            'questions.*.text'                 => 'required|string',
            'questions.*.points'               => 'required|integer|min:10',
            'questions.*.hint'                 => 'nullable|string',
            'questions.*.answers'              => 'required|array|min:2',
            'questions.*.answers.*.text'       => 'required|string',
            'questions.*.answers.*.is_correct' => 'required|boolean',
        ]);

        $quiz = Quiz::create([
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
    }
}
