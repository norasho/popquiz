<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Question extends Model
{
    protected $fillable = [
        'quiz_id', 'question_text', 'question_text_ar', 'order', 'points', 'time_limit', 'hint', 'hint_ar',
    ];

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function answers(): HasMany
    {
        return $this->hasMany(Answer::class)->orderBy('order');
    }

    public function getCorrectAnswerAttribute(): ?Answer
    {
        return $this->answers->firstWhere('is_correct', true);
    }

    public function getEffectiveTimeLimitAttribute(): int
    {
        return $this->time_limit ?? $this->quiz->time_limit_per_question;
    }

    public function getQuestionTextAttribute($value): string
    {
        if (app()->getLocale() === 'ar' && $this->question_text_ar) {
            return $this->question_text_ar;
        }

        return $value;
    }

    public function getHintAttribute($value): ?string
    {
        if (app()->getLocale() === 'ar' && $this->hint_ar) {
            return $this->hint_ar;
        }

        return $value;
    }
}
