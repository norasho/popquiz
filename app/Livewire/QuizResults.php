<?php

namespace App\Livewire;

use App\Models\UserResult;
use Livewire\Component;

class QuizResults extends Component
{
    public int $resultId;

    public ?UserResult $result = null;

    public string $locale = 'en';

    public function mount(int $resultId): void
    {
        $this->resultId = $resultId;
        $this->result = UserResult::with('quiz')->findOrFail($resultId);
        $this->locale = session('locale', 'en');
        app()->setLocale($this->locale);
    }

    public function getBadgesProperty(): array
    {
        $badges = [];
        $pct = $this->result->percentage;
        $avgTime = $this->result->correct_count + $this->result->wrong_count > 0
            ? round($this->result->time_taken / ($this->result->correct_count + $this->result->wrong_count))
            : 0;

        if ($pct === 100) {
            $badges[] = ['icon' => 'ph-fill ph-crown', 'color' => 'brand-green', 'bg' => 'brand-green/20', 'title' => __('ui.badge_perfect'), 'desc' => __('ui.badge_perfect_desc')];
        }
        if ($pct >= 90) {
            $badges[] = ['icon' => 'ph-fill ph-shield-check', 'color' => 'brand-black', 'bg' => 'brand-green/20', 'title' => __('ui.badge_master'), 'desc' => __('ui.badge_master_desc')];
        }
        if ($avgTime <= 5 && $avgTime > 0) {
            $badges[] = ['icon' => 'ph-fill ph-lightning', 'color' => 'brand-purple', 'bg' => 'brand-purple/10', 'title' => __('ui.badge_speed'), 'desc' => __('ui.badge_speed_desc')];
        }
        if ($this->result->time_taken <= 120) {
            $badges[] = ['icon' => 'ph-fill ph-timer', 'color' => 'brand-purple', 'bg' => 'brand-purple/10', 'title' => __('ui.badge_quick'), 'desc' => __('ui.badge_quick_desc')];
        }

        return $badges;
    }

    public function getAvgTimeProperty(): int
    {
        $total = $this->result->correct_count + $this->result->wrong_count;

        return $total > 0 ? (int) round($this->result->time_taken / $total) : 0;
    }

    public function render()
    {
        return view('livewire.quiz-results', [
            'badges' => $this->badges,
            'avgTime' => $this->avgTime,
        ]);
    }
}
