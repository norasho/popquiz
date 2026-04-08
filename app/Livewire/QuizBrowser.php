<?php

namespace App\Livewire;

use App\Models\Quiz;
use Illuminate\Support\Str;
use Livewire\Component;

class QuizBrowser extends Component
{
    public string $playerName = '';

    public string $playerEmoji = '🎯';

    public string $playerShortId = '';

    public string $search = '';

    public string $category = '';

    public string $difficulty = '';

    public int $questionCount = 15;

    public ?int $selectedQuizId = null;

    public string $selectedTopic = '';

    public string $locale = 'en';

    public bool $showPlayerModal = false;

    public array $emojis = ['🎯', '🦊', '🐱', '🐶', '🐸', '🦄', '🐙', '🦖'];

    public function mount(): void
    {
        $this->locale = session('locale', 'en');
        app()->setLocale($this->locale);
        $this->playerName = session('player_name', '');

        if (! session('player_id')) {
            session(['player_id' => (string) Str::uuid()]);
            session(['player_short_id' => strtoupper(Str::random(5))]);
        }
        $this->playerShortId = session('player_short_id');
    }

    public function selectTopic(string $cat): void
    {
        $this->selectedTopic = $this->selectedTopic === $cat ? '' : $cat;
        $this->category = $this->selectedTopic;
        $this->selectFirstMatchingQuiz();
    }

    public function setDifficulty(string $diff): void
    {
        $this->difficulty = $this->difficulty === $diff ? '' : $diff;
        $this->selectFirstMatchingQuiz();
    }

    private function selectFirstMatchingQuiz(): void
    {
        $quiz = Quiz::where('is_public', true)
            ->when($this->category, fn ($q) => $q->where('category', $this->category))
            ->when($this->difficulty, fn ($q) => $q->where('difficulty', $this->difficulty))
            ->first();
        $this->selectedQuizId = $quiz?->id;
    }

    public function startQuiz(): void
    {
        if (! $this->playerName) {
            $this->showPlayerModal = true;

            return;
        }

        if (! $this->selectedQuizId) {
            $this->selectFirstMatchingQuiz();
        }

        $this->validate(
            [
                'playerName' => 'required|min:2|max:20',
                'selectedQuizId' => 'required|exists:quizzes,id',
            ],
            $this->locale === 'ar' ? [
                'playerName.required' => 'حقل اسم اللاعب مطلوب.',
                'playerName.min' => 'يجب أن يتكون الاسم من حرفين على الأقل.',
                'playerName.max' => 'يجب ألا يتجاوز الاسم 20 حرفاً.',
                'selectedQuizId.required' => 'يرجى اختيار اختبار.',
            ] : []
        );

        session(['player_name' => $this->playerName, 'player_emoji' => $this->playerEmoji, 'player_short_id' => $this->playerShortId]);
        $this->redirectRoute('quiz.play', ['quiz' => $this->selectedQuizId]);
    }

    public function savePlayer(): void
    {
        $this->validate([
            'playerName' => 'required|min:2|max:20',
        ]);
        session(['player_name' => $this->playerName, 'player_emoji' => $this->playerEmoji]);
        $this->showPlayerModal = false;
    }

    public function selectEmoji(string $emoji): void
    {
        $this->playerEmoji = $emoji;
    }

    public function getQuizzesProperty()
    {
        return Quiz::where('is_public', true)
            ->when($this->search, fn ($q) => $q->where('title', 'like', "%{$this->search}%"))
            ->when($this->category, fn ($q) => $q->where('category', $this->category))
            ->when($this->difficulty, fn ($q) => $q->where('difficulty', $this->difficulty))
            ->withCount('questions')
            ->latest()
            ->get();
    }

    public function getCategoriesProperty(): array
    {
        return Quiz::where('is_public', true)
            ->distinct()
            ->pluck('category')
            ->toArray();
    }

    public function getEstTimeProperty(): int
    {
        $count = min($this->questionCount, 25);

        return max(1, (int) round($count * 0.5));
    }

    public function getEstXpProperty(): int
    {
        return $this->questionCount * 30;
    }

    public function render()
    {
        return view('livewire.quiz-browser', [
            'quizzes' => $this->quizzes,
            'categories' => $this->categories,
            'emojis' => $this->emojis,
            'estTime' => $this->estTime,
            'estXp' => $this->estXp,
        ]);
    }
}
