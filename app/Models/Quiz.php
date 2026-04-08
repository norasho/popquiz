<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Quiz extends Model
{
    protected $fillable = [
        'title', 'title_ar', 'description', 'description_ar', 'category',
        'time_limit_per_question', 'is_public', 'difficulty', 'cover_emoji', 'created_by',
    ];

    protected $casts = [
        'is_public' => 'boolean',
    ];

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class)->orderBy('order');
    }

    public function userResults(): HasMany
    {
        return $this->hasMany(UserResult::class);
    }

    public function getTotalPointsAttribute(): int
    {
        return $this->questions->sum('points');
    }

    public function getDifficultyColorAttribute(): string
    {
        return match ($this->difficulty) {
            'easy'   => 'text-green-400 bg-green-400/10 border-green-400/30',
            'hard'   => 'text-red-400 bg-red-400/10 border-red-400/30',
            default  => 'text-yellow-400 bg-yellow-400/10 border-yellow-400/30',
        };
    }
}
