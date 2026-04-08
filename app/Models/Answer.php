<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Answer extends Model
{
    protected $fillable = ['question_id', 'answer_text', 'answer_text_ar', 'is_correct', 'order'];

    protected $casts = [
        'is_correct' => 'boolean',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function getAnswerTextAttribute($value): string
    {
        if (app()->getLocale() === 'ar' && $this->answer_text_ar) {
            return $this->answer_text_ar;
        }

        return $value;
    }
}
