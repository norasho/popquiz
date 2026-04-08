<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuizSession extends Model
{
    protected $fillable = [
        'player_id', 'player_short_id', 'quiz_id', 'player_name', 'player_emoji',
        'current_index', 'score', 'phase', 'last_seen_at',
    ];

    protected $casts = [
        'last_seen_at' => 'datetime',
    ];

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class);
    }

    /** Players active within the last 90 seconds. */
    public static function activePlayers(int $quizId): \Illuminate\Database\Eloquent\Collection
    {
        return static::where('quiz_id', $quizId)
            ->where('last_seen_at', '>=', now()->subSeconds(90))
            ->where('phase', '!=', 'finished')
            ->orderByDesc('score')
            ->get();
    }
}
