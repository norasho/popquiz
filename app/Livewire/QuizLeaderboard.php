<?php

namespace App\Livewire;

use App\Models\Quiz;
use App\Models\UserResult;
use Livewire\Component;

class QuizLeaderboard extends Component
{
    public int $quizId;

    public ?Quiz $quiz = null;

    public string $currentPlayerId = '';

    public string $locale = 'en';

    public function mount(int $quizId): void
    {
        $this->quizId = $quizId;
        $this->quiz = Quiz::findOrFail($quizId);
        $this->currentPlayerId = session('player_id', '');
        $this->locale = session('locale', 'en');
        app()->setLocale($this->locale);
    }

    public function getLeaderboardProperty()
    {
        return UserResult::where('quiz_id', $this->quizId)
            ->orderByDesc('score')
            ->limit(50)
            ->get();
    }

    public function getChampionProperty()
    {
        return $this->leaderboard->first();
    }

    public function render()
    {
        return view('livewire.quiz-leaderboard', [
            'leaderboard' => $this->leaderboard,
            'champion' => $this->champion,
        ]);
    }
}
