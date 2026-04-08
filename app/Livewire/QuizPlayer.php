<?php

namespace App\Livewire;

use App\Models\Quiz;
use App\Models\QuizSession;
use App\Models\UserResult;
use Illuminate\Support\Str;
use Livewire\Component;

class QuizPlayer extends Component
{
    public int $quizId;

    public ?Quiz $quiz = null;

    public string $playerId = '';

    public string $playerShortId = '';

    public string $playerName = '';

    public string $playerEmoji = '🎯';

    public string $phase = 'intro';

    public int $currentIndex = 0;

    public ?int $selectedAnswerId = null;

    public bool $hasAnswered = false;

    public bool $isCorrect = false;

    public int $timeLeft = 30;

    public int $startedAt = 0;

    public int $score = 0;

    public int $totalPossible = 0;

    public int $correctCount = 0;

    public int $wrongCount = 0;

    public int $quizStartedAt = 0;

    public array $answerDetails = [];

    public string $locale = 'en';

    public function mount(int $quizId): void
    {
        $this->quizId = $quizId;
        $this->quiz = Quiz::with(['questions.answers'])->findOrFail($quizId);
        $this->quiz->setRelation('questions', $this->quiz->questions->shuffle()->values());
        $this->playerName = session('player_name', 'Player');
        $this->playerEmoji = session('player_emoji', '🎯');
        $this->totalPossible = $this->quiz->questions->sum('points');
        $this->locale = session('locale', 'en');
        app()->setLocale($this->locale);

        // Assign or restore a stable UUID and short ID for this player
        if (! session('player_id')) {
            session(['player_id' => (string) Str::uuid()]);
            session(['player_short_id' => strtoupper(Str::random(5))]);
        }
        $this->playerId = session('player_id');
        $this->playerShortId = session('player_short_id', strtoupper(substr(session('player_id'), 0, 5)));
    }

    public function leaveQuiz(): void
    {
        $this->cleanupSession();
        $this->redirectRoute('home');
    }

    // ── Session tracking ──────────────────────────────────────────

    private function upsertSession(): void
    {
        QuizSession::updateOrCreate(
            ['player_id' => $this->playerId, 'quiz_id' => $this->quizId],
            [
                'player_short_id' => $this->playerShortId,
                'player_name' => $this->playerName,
                'player_emoji' => $this->playerEmoji,
                'current_index' => $this->currentIndex,
                'score' => $this->score,
                'phase' => $this->phase,
                'last_seen_at' => now(),
            ]
        );
    }

    private function cleanupSession(): void
    {
        QuizSession::where('player_id', $this->playerId)
            ->where('quiz_id', $this->quizId)
            ->delete();
    }

    public function ping(): void
    {
        if ($this->phase !== 'intro' && $this->phase !== 'finished') {
            $this->upsertSession();
        }
    }

    // ── Game flow ─────────────────────────────────────────────────

    public function startQuiz(): void
    {
        $this->phase = 'question';
        $this->quizStartedAt = time();
        $this->upsertSession();
        $this->loadQuestion();
    }

    public function loadQuestion(): void
    {
        $this->selectedAnswerId = null;
        $this->hasAnswered = false;
        $this->isCorrect = false;
        $q = $this->quiz->questions[$this->currentIndex];
        $this->timeLeft = $q->effective_time_limit;
        $this->startedAt = time();
        $this->dispatch('timer-start', seconds: $this->timeLeft);
    }

    public function selectAnswer(int $answerId): void
    {
        if ($this->hasAnswered) {
            return;
        }

        $this->hasAnswered = true;
        $this->selectedAnswerId = $answerId;
        $this->dispatch('timer-stop');

        $question = $this->quiz->questions[$this->currentIndex];
        $answer = $question->answers->firstWhere('id', $answerId);
        $correct = $question->answers->firstWhere('is_correct', true);

        $this->isCorrect = $answer?->is_correct ?? false;

        $timeUsed = time() - $this->startedAt;
        $pointsEarned = 0;

        if ($this->isCorrect) {
            $ratio = max(0, 1 - ($timeUsed / $question->effective_time_limit));
            $bonus = (int) ($question->points * 0.5 * $ratio);
            $pointsEarned = $question->points + $bonus;
            $this->score += $pointsEarned;
            $this->correctCount++;
        } else {
            $this->wrongCount++;
        }

        $this->answerDetails[] = $this->buildAnswerDetail($question, $answer, $correct, $pointsEarned, $timeUsed);
        $this->phase = 'result';
        $this->upsertSession();
    }

    public function timeUp(): void
    {
        if ($this->hasAnswered) {
            return;
        }

        $this->hasAnswered = true;
        $this->selectedAnswerId = null;
        $this->isCorrect = false;
        $this->dispatch('timer-stop');

        $question = $this->quiz->questions[$this->currentIndex];
        $correct = $question->answers->firstWhere('is_correct', true);
        $this->wrongCount++;

        $this->answerDetails[] = $this->buildAnswerDetail($question, null, $correct, 0, $question->effective_time_limit);
        $this->phase = 'result';
        $this->upsertSession();
    }

    private function buildAnswerDetail($question, $answer, $correct, int $pointsEarned, int $timeUsed): array
    {
        return [
            'question' => $question->question_text,
            'selected' => $answer ? $answer->answer_text : __('ui.time_up'),
            'correct' => $correct?->answer_text ?? '',
            'is_correct' => $this->isCorrect,
            'points_earned' => $pointsEarned,
            'time_used' => $timeUsed,
        ];
    }

    public function nextQuestion(): void
    {
        $this->currentIndex++;

        if ($this->currentIndex >= $this->quiz->questions->count()) {
            $this->finishQuiz();
        } else {
            $this->phase = 'question';
            $this->upsertSession();
            $this->loadQuestion();
        }
    }

    public function finishQuiz(): void
    {
        $timeTaken = time() - $this->quizStartedAt;

        $result = UserResult::create([
            'quiz_id' => $this->quizId,
            'player_id' => $this->playerId,
            'player_name' => $this->playerName,
            'player_emoji' => $this->playerEmoji,
            'score' => $this->score,
            'total_possible' => $this->totalPossible,
            'correct_count' => $this->correctCount,
            'wrong_count' => $this->wrongCount,
            'time_taken' => $timeTaken,
            'answer_details' => $this->answerDetails,
            'completed_at' => now(),
        ]);

        $this->cleanupSession();
        $this->redirectRoute('quiz.results', ['result' => $result->id]);
    }

    public function restartQuiz(): void
    {
        $this->currentIndex = 0;
        $this->score = 0;
        $this->correctCount = 0;
        $this->wrongCount = 0;
        $this->answerDetails = [];
        $this->quiz->setRelation('questions', $this->quiz->questions->shuffle()->values());
        $this->totalPossible = $this->quiz->questions->sum('points');
        $this->phase = 'question';
        $this->quizStartedAt = time();
        $this->upsertSession();
        $this->loadQuestion();
    }

    // ── Computed properties ───────────────────────────────────────

    public function getCurrentQuestionProperty(): ?array
    {
        $q = $this->quiz->questions[$this->currentIndex] ?? null;
        if (! $q) {
            return null;
        }

        return [
            'id' => $q->id,
            'text' => $q->question_text,
            'hint' => $q->hint,
            'points' => $q->points,
            'time_limit' => $q->effective_time_limit,
            'answers' => $q->answers->map(fn ($a) => [
                'id' => $a->id,
                'text' => $a->answer_text,
                'is_correct' => $a->is_correct,
            ])->toArray(),
        ];
    }

    public function getActivePlayersProperty()
    {
        return QuizSession::activePlayers($this->quizId);
    }

    public function getLeaderboardProperty()
    {
        return UserResult::where('quiz_id', $this->quizId)
            ->orderByDesc('score')
            ->limit(10)
            ->get();
    }

    public function getPercentageProperty(): int
    {
        if ($this->totalPossible === 0) {
            return 0;
        }

        return (int) round(($this->score / $this->totalPossible) * 100);
    }

    public function getGradeProperty(): string
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

    public function render()
    {
        return view('livewire.quiz-player', [
            'currentQuestion' => $this->currentQuestion,
            'activePlayers' => $this->activePlayers,
            'leaderboard' => $this->leaderboard,
            'percentage' => $this->percentage,
            'grade' => $this->grade,
            'playerShortId' => $this->playerShortId,
        ]);
    }
}
