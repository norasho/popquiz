<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserResult extends Model
{
    protected $fillable = [
        'quiz_id', 'player_id', 'player_name', 'player_emoji', 'score', 'total_possible',
        'correct_count', 'wrong_count', 'time_taken', 'answer_details', 'completed_at',
    ];

    protected $casts = [
        'answer_details' => 'array',
        'completed_at' => 'datetime',
    ];

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    public function getPercentageAttribute(): int
    {
        if ($this->total_possible === 0) {
            return 0;
        }

        return (int) round(($this->score / $this->total_possible) * 100);
    }

    public function getGradeAttribute(): string
    {
        $pct = $this->percentage;
        if ($pct >= 90) {
            return 'S';
        }
        if ($pct >= 80) {
            return 'A';
        }
        if ($pct >= 70) {
            return 'B';
        }
        if ($pct >= 60) {
            return 'C';
        }
        if ($pct >= 50) {
            return 'D';
        }

        return 'F';
    }

    public function getFormattedTimeAttribute(): string
    {
        $m = intdiv($this->time_taken, 60);
        $s = $this->time_taken % 60;

        return $m > 0 ? "{$m}m {$s}s" : "{$s}s";
    }
}
