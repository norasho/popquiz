<div
    wire:poll.10000ms="ping"
    x-data="{
        timer: null,
        timeLeft: @entangle('timeLeft'),
        phase: @entangle('phase'),

        startTimer(seconds) {
            clearInterval(this.timer);
            this.timeLeft = seconds;
            this.timer = setInterval(() => {
                if (this.timeLeft > 0) {
                    this.timeLeft--;
                } else {
                    clearInterval(this.timer);
                    $wire.timeUp();
                }
            }, 1000);
        },

        stopTimer() {
            clearInterval(this.timer);
        },

        get timerColor() {
            if (this.timeLeft > 15) return 'text-green-400';
            if (this.timeLeft > 5) return 'text-yellow-400';
            return 'text-red-400 animate-pulse';
        },

        get timerPct() {
            return this.timeLeft > 0 ? (this.timeLeft / {{ $quiz->time_limit_per_question }}) * 100 : 0;
        }
    }"
    @timer-start.window="startTimer($event.detail.seconds)"
    @timer-stop.window="stopTimer()"
    dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}"
    class="max-w-2xl mx-auto space-y-4 sm:space-y-6">

    {{-- INTRO PHASE --}}
    @if($phase === 'intro')
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5 sm:p-8 text-center space-y-5 sm:space-y-6">
            <div class="text-5xl sm:text-6xl">{{ $quiz->cover_emoji }}</div>
            <div>
                <h1 class="text-2xl sm:text-3xl font-black mb-2">{{ $locale === 'ar' && $quiz->title_ar ? $quiz->title_ar : $quiz->title }}</h1>
                <p class="text-gray-400 text-sm sm:text-base">{{ $locale === 'ar' && $quiz->description_ar ? $quiz->description_ar : $quiz->description }}</p>
            </div>
            <div class="grid grid-cols-3 gap-2 sm:gap-4 text-sm">
                <div class="bg-gray-800 rounded-xl p-3">
                    <div class="text-2xl font-bold text-violet-400">{{ $quiz->questions->count() }}</div>
                    <div class="text-gray-400">{{ __('ui.questions') }}</div>
                </div>
                <div class="bg-gray-800 rounded-xl p-3">
                    <div class="text-2xl font-bold text-pink-400">{{ $quiz->time_limit_per_question }}s</div>
                    <div class="text-gray-400">{{ __('ui.per_question') }}</div>
                </div>
                <div class="bg-gray-800 rounded-xl p-3">
                    <div class="text-2xl font-bold text-orange-400">{{ $totalPossible }}</div>
                    <div class="text-gray-400">{{ __('ui.max_points') }}</div>
                </div>
            </div>
            <div class="bg-gray-800/50 rounded-xl p-4 {{ $locale === 'ar' ? 'text-right' : 'text-left' }} text-sm text-gray-300 space-y-1">
                <p>{{ __('ui.tip_speed') }}</p>
                <p>{{ __('ui.tip_timeout') }}</p>
                <p>{{ __('ui.tip_leaderboard') }}</p>
            </div>
            <div class="flex items-center justify-center gap-3">
                <span class="text-2xl">{{ $playerEmoji }}</span>
                <div class="text-left">
                    <span class="text-lg font-semibold block">{{ $playerName }}</span>
                    <span class="text-xs text-white font-mono tracking-widest">#{{ $playerShortId }}</span>
                </div>
            </div>
            <div class="flex gap-3">
                <button wire:click="leaveQuiz"
                    class="flex-1 bg-gray-800 hover:bg-gray-700 text-gray-400 hover:text-white font-bold py-4 rounded-xl transition-all active:scale-95">
                    {{ __('ui.home') }}
                </button>
                <button wire:click="startQuiz"
                    class="flex-[3] bg-gradient-to-r from-violet-600 to-pink-600 hover:from-violet-500 hover:to-pink-500 text-white font-black py-4 rounded-xl text-lg transition-all active:scale-95">
                    {{ __('ui.start_quiz') }}
                </button>
            </div>
        </div>
    @endif

    {{-- QUESTION PHASE --}}
    @if($phase === 'question' && $currentQuestion)
        {{-- Progress bar --}}
        <div class="flex items-center gap-3">
            <button wire:click="leaveQuiz" class="text-gray-600 hover:text-gray-400 transition-colors text-sm shrink-0" title="{{ __('ui.home') }}">
                ✕
            </button>
            <span class="text-sm text-gray-400 font-mono">{{ $currentIndex + 1 }}/{{ $quiz->questions->count() }}</span>
            <div class="flex-1 bg-gray-800 rounded-full h-2 overflow-hidden">
                <div class="bg-violet-500 h-2 rounded-full transition-all"
                    style="width: {{ (($currentIndex) / $quiz->questions->count()) * 100 }}%"></div>
            </div>
            <span class="text-sm font-bold text-violet-400">{{ $score }} {{ __('ui.pts') }}</span>
        </div>

        {{-- Timer --}}
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-4">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs text-gray-500 uppercase tracking-widest">{{ __('ui.time_left') }}</span>
                <span class="font-black text-3xl font-mono" :class="timerColor" x-text="timeLeft"></span>
            </div>
            <div class="bg-gray-800 rounded-full h-3 overflow-hidden">
                <div class="h-3 rounded-full transition-all duration-1000"
                    :class="timeLeft > 15 ? 'bg-green-500' : timeLeft > 5 ? 'bg-yellow-500' : 'bg-red-500'"
                    :style="`width: ${timerPct}%`"></div>
            </div>
        </div>

        {{-- Question card --}}
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-4 sm:p-6 space-y-4 sm:space-y-6">
            <div class="flex items-start justify-between gap-4">
                <h2 class="text-xl font-bold leading-snug">{{ $currentQuestion['text'] }}</h2>
                <span class="shrink-0 text-xs font-black text-violet-400 bg-violet-400/10 border border-violet-400/30 px-2.5 py-1 rounded-full">
                    {{ $currentQuestion['points'] }} {{ __('ui.pts') }}
                </span>
            </div>

            @if($currentQuestion['hint'])
                <p class="text-sm text-gray-500 italic">💡 {{ $currentQuestion['hint'] }}</p>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach($currentQuestion['answers'] as $answer)
                    <button wire:click="selectAnswer({{ $answer['id'] }})"
                        class="{{ $locale === 'ar' ? 'text-right' : 'text-left' }} p-4 rounded-xl border-2 font-semibold transition-all active:scale-95
                            border-gray-700 bg-gray-800/50 hover:border-violet-500 hover:bg-violet-500/10 text-gray-200">
                        {{ $answer['text'] }}
                    </button>
                @endforeach
            </div>
        </div>

        @include('livewire.partials.active-players', ['activePlayers' => $activePlayers])
    @endif

    {{-- RESULT PHASE --}}
    @if($phase === 'result' && $currentQuestion)
        @php $lastDetail = end($answerDetails); @endphp
        <div class="flex items-center gap-3">
            <span class="text-sm text-gray-400 font-mono">{{ $currentIndex + 1 }}/{{ $quiz->questions->count() }}</span>
            <div class="flex-1 bg-gray-800 rounded-full h-2 overflow-hidden">
                <div class="bg-violet-500 h-2 rounded-full transition-all"
                    style="width: {{ (($currentIndex + 1) / $quiz->questions->count()) * 100 }}%"></div>
            </div>
            <span class="text-sm font-bold text-violet-400">{{ $score }} {{ __('ui.pts') }}</span>
        </div>

        <div class="bg-gray-900 border-2 rounded-2xl p-4 sm:p-6 space-y-4 {{ $isCorrect ? 'border-green-500' : 'border-red-500' }}">
            <div class="text-center">
                @if($isCorrect)
                    <div class="text-5xl mb-2">✅</div>
                    <h2 class="text-2xl font-black text-green-400">{{ __('ui.correct') }}</h2>
                    <p class="text-green-300 font-semibold">+{{ $lastDetail['points_earned'] }} {{ __('ui.pts') }}</p>
                @else
                    <div class="text-5xl mb-2">❌</div>
                    <h2 class="text-2xl font-black text-red-400">{{ __('ui.wrong') }}</h2>
                    <p class="text-gray-400 text-sm">{{ __('ui.correct_answer_was') }}</p>
                    <p class="text-white font-bold text-lg mt-1">{{ $lastDetail['correct'] }}</p>
                @endif
            </div>

            <div class="bg-gray-800/60 rounded-xl p-4 space-y-2 text-sm">
                <div class="flex justify-between text-gray-400">
                    <span>{{ __('ui.your_answer') }}</span>
                    <span class="{{ $isCorrect ? 'text-green-400' : 'text-red-400' }} font-semibold">{{ $lastDetail['selected'] }}</span>
                </div>
                <div class="flex justify-between text-gray-400">
                    <span>{{ __('ui.time_used') }}</span>
                    <span class="text-white">{{ $lastDetail['time_used'] }}s</span>
                </div>
                <div class="flex justify-between text-gray-400">
                    <span>{{ __('ui.running_score') }}</span>
                    <span class="text-violet-400 font-bold">{{ $score }} / {{ $totalPossible }}</span>
                </div>
            </div>

            <button wire:click="nextQuestion"
                class="w-full bg-gradient-to-r from-violet-600 to-pink-600 hover:from-violet-500 hover:to-pink-500 text-white font-black py-3.5 rounded-xl transition-all active:scale-95">
                {{ $currentIndex + 1 >= $quiz->questions->count() ? __('ui.see_results') : __('ui.next_question') }}
            </button>
        </div>

        @include('livewire.partials.active-players', ['activePlayers' => $activePlayers])
    @endif

    {{-- FINISHED PHASE --}}
    @if($phase === 'finished')
        <div class="space-y-6">
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-5 sm:p-8 text-center space-y-4">
                <div class="text-5xl sm:text-6xl">{{ $playerEmoji }}</div>
                <h2 class="text-xl sm:text-2xl font-black">{{ $playerName }}</h2>

                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full text-5xl font-black border-4
                    {{ $percentage >= 80 ? 'border-green-500 text-green-400 bg-green-500/10' :
                       ($percentage >= 50 ? 'border-yellow-500 text-yellow-400 bg-yellow-500/10' :
                       'border-red-500 text-red-400 bg-red-500/10') }}">
                    {{ $grade }}
                </div>

                <div class="text-4xl font-black text-white">{{ $score }} <span class="text-gray-500 text-xl font-normal">/ {{ $totalPossible }}</span></div>
                <div class="text-gray-400">{{ $percentage }}%</div>

                <div class="grid grid-cols-3 gap-2 sm:gap-3 text-sm mt-4">
                    <div class="bg-green-500/10 border border-green-500/30 rounded-xl p-3">
                        <div class="text-2xl font-bold text-green-400">{{ $correctCount }}</div>
                        <div class="text-gray-400">{{ __('ui.correct_label') }}</div>
                    </div>
                    <div class="bg-red-500/10 border border-red-500/30 rounded-xl p-3">
                        <div class="text-2xl font-bold text-red-400">{{ $wrongCount }}</div>
                        <div class="text-gray-400">{{ __('ui.wrong_label') }}</div>
                    </div>
                    <div class="bg-violet-500/10 border border-violet-500/30 rounded-xl p-3">
                        <div class="text-2xl font-bold text-violet-400">{{ $quiz->questions->count() }}</div>
                        <div class="text-gray-400">{{ __('ui.questions') }}</div>
                    </div>
                </div>
            </div>

            {{-- Answer breakdown --}}
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-4 sm:p-6 space-y-3">
                <h3 class="font-bold text-lg">{{ __('ui.answer_breakdown') }}</h3>
                @foreach($answerDetails as $detail)
                    <div class="flex items-start gap-3 p-3 rounded-xl {{ $detail['is_correct'] ? 'bg-green-500/5 border border-green-500/20' : 'bg-red-500/5 border border-red-500/20' }}">
                        <span class="text-lg shrink-0">{{ $detail['is_correct'] ? '✅' : '❌' }}</span>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm text-gray-300 font-medium leading-snug">{{ $detail['question'] }}</p>
                            @if(!$detail['is_correct'])
                                <p class="text-xs text-gray-500 mt-0.5">{{ __('ui.correct_label') }}: <span class="text-green-400">{{ $detail['correct'] }}</span></p>
                            @endif
                        </div>
                        <span class="text-xs font-bold shrink-0 {{ $detail['is_correct'] ? 'text-green-400' : 'text-red-400' }}">
                            +{{ $detail['points_earned'] }}
                        </span>
                    </div>
                @endforeach
            </div>

            {{-- Leaderboard --}}
            <div class="bg-gray-900 border border-gray-800 rounded-2xl p-4 sm:p-6 space-y-3">
                <h3 class="font-bold text-lg">{{ __('ui.leaderboard') }}</h3>
                @foreach($leaderboard as $i => $result)
                    <div class="flex items-center gap-3 p-3 rounded-xl {{ $i === 0 ? 'bg-yellow-500/10 border border-yellow-500/20' : 'bg-gray-800/50' }}">
                        <span class="text-lg font-black w-6 text-center {{ $i === 0 ? 'text-yellow-400' : 'text-gray-500' }}">
                            {{ $i === 0 ? '🥇' : ($i === 1 ? '🥈' : ($i === 2 ? '🥉' : $i + 1)) }}
                        </span>
                        <span class="text-xl">{{ $result->player_emoji }}</span>
                        <span class="flex-1 font-semibold text-sm truncate">{{ $result->player_name }}</span>
                        <span class="font-black text-violet-400">{{ $result->score }}</span>
                    </div>
                @endforeach
            </div>

            <div class="flex gap-3">
                <button wire:click="leaveQuiz"
                    class="flex-1 text-center bg-gray-800 hover:bg-gray-700 text-white font-bold py-3.5 rounded-xl transition-colors">
                    {{ __('ui.home') }}
                </button>
                <a href="{{ route('quiz.play', $quiz->id) }}"
                    class="flex-1 text-center bg-gradient-to-r from-violet-600 to-pink-600 hover:from-violet-500 hover:to-pink-500 text-white font-bold py-3.5 rounded-xl transition-colors">
                    {{ __('ui.play_again') }}
                </a>
            </div>
        </div>
    @endif
</div>
