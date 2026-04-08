<div
    wire:poll.10000ms="ping"
    x-data="{
        timer: null,
        timeLeft: @entangle('timeLeft'),
        phase: @entangle('phase'),
        paused: false,
        totalElapsed: 0,
        elapsedTimer: null,

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

        startElapsedTimer() {
            this.totalElapsed = 0;
            clearInterval(this.elapsedTimer);
            this.elapsedTimer = setInterval(() => {
                if (!this.paused) this.totalElapsed++;
            }, 1000);
        },

        pauseQuiz() {
            this.paused = true;
            this.stopTimer();
        },

        resumeQuiz() {
            this.paused = false;
            this.startTimer(this.timeLeft);
        },

        get timerColor() {
            if (this.timeLeft > 15) return 'text-green-400';
            if (this.timeLeft > 5) return 'text-yellow-400';
            return 'text-red-400 animate-pulse';
        },

        get timerBarColor() {
            if (this.timeLeft > 15) return 'bg-green-500';
            if (this.timeLeft > 5) return 'bg-yellow-500';
            return 'bg-red-500';
        },

        get timerPct() {
            return this.timeLeft > 0 ? (this.timeLeft / {{ $quiz->time_limit_per_question }}) * 100 : 0;
        },

        get elapsedFormatted() {
            const m = Math.floor(this.totalElapsed / 60);
            const s = this.totalElapsed % 60;
            return String(m).padStart(2, '0') + ':' + String(s).padStart(2, '0');
        },

        get accuracyPct() {
            const total = {{ $correctCount }} + {{ $wrongCount }};
            return total > 0 ? Math.round(({{ $correctCount }} / total) * 100) : 100;
        }
    }"
    @timer-start.window="startTimer($event.detail.seconds)"
    @timer-stop.window="stopTimer()"
    dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}"
    class="max-w-2xl mx-auto space-y-4 sm:space-y-6">

    {{-- INTRO PHASE --}}
    @if($phase === 'intro')
        <div class="bg-white rounded-[2.5rem] p-5 sm:p-8 text-center space-y-5 sm:space-y-6">
            <div class="text-5xl sm:text-6xl">{{ $quiz->cover_emoji }}</div>
            <div>
                <h1 class="text-2xl sm:text-3xl font-extrabold text-brand-black mb-2">{{ $quiz->title }}</h1>
                <p class="text-gray-400 text-sm sm:text-base">{{ $quiz->description }}</p>
            </div>
            <div class="grid grid-cols-3 gap-2 sm:gap-4 text-sm">
                <div class="bg-gray-50 rounded-2xl p-3">
                    <div class="text-2xl font-extrabold text-brand-purple">{{ $quiz->questions->count() }}</div>
                    <div class="text-gray-400">{{ __('ui.questions') }}</div>
                </div>
                <div class="bg-gray-50 rounded-2xl p-3">
                    <div class="text-2xl font-extrabold text-brand-purple">{{ $quiz->time_limit_per_question }}s</div>
                    <div class="text-gray-400">{{ __('ui.per_question') }}</div>
                </div>
                <div class="bg-gray-50 rounded-2xl p-3">
                    <div class="text-2xl font-extrabold text-brand-green">{{ $totalPossible }}</div>
                    <div class="text-gray-400">{{ __('ui.max_points') }}</div>
                </div>
            </div>
            <div class="bg-gray-50 rounded-2xl p-4 {{ $locale === 'ar' ? 'text-right' : 'text-left' }} text-sm text-gray-500 space-y-1">
                <p>{{ __('ui.tip_speed') }}</p>
                <p>{{ __('ui.tip_timeout') }}</p>
                <p>{{ __('ui.tip_leaderboard') }}</p>
            </div>
            <div class="flex items-center justify-center gap-3">
                <span class="text-2xl">{{ $playerEmoji }}</span>
                <div class="{{ $locale === 'ar' ? 'text-right' : 'text-left' }}">
                    <span class="text-lg font-semibold block text-brand-black">{{ $playerName }}</span>
                    <span class="text-xs text-gray-400 font-mono tracking-widest">#{{ $playerShortId }}</span>
                </div>
            </div>
            <div class="flex gap-3">
                <button wire:click="leaveQuiz"
                    class="flex-1 bg-gray-100 hover:bg-gray-200 text-gray-500 hover:text-brand-black font-bold py-4 rounded-2xl transition-all active:scale-95">
                    {{ __('ui.home') }}
                </button>
                <button wire:click="startQuiz" x-on:click="startElapsedTimer()"
                    class="flex-[3] bg-brand-green hover:brightness-105 text-brand-black font-extrabold py-4 rounded-2xl text-lg transition-all active:scale-95">
                    {{ __('ui.start_quiz') }}
                </button>
            </div>
        </div>
    @endif

    {{-- QUESTION PHASE --}}
    @if($phase === 'question' && $currentQuestion)
        {{-- Progress bar --}}
        <div class="flex items-center gap-3">
            <button x-on:click="pauseQuiz()" class="text-gray-400 hover:text-white transition-colors shrink-0" title="Pause">
                <i class="ph ph-pause text-lg"></i>
            </button>
            <span class="text-sm text-gray-400 font-mono">{{ $currentIndex + 1 }}/{{ $quiz->questions->count() }}</span>
            <div class="flex-1 bg-white/10 rounded-full h-2 overflow-hidden">
                <div class="bg-brand-purple h-2 rounded-full transition-all"
                    style="width: {{ (($currentIndex) / $quiz->questions->count()) * 100 }}%"></div>
            </div>
            <span class="text-sm font-bold text-brand-green">{{ $score }} {{ __('ui.pts') }}</span>
        </div>

        {{-- Timer --}}
        <div class="bg-white/5 border border-white/10 rounded-[2rem] p-4">
            <div class="flex items-center justify-between mb-2">
                <span class="text-xs text-gray-500 uppercase tracking-widest font-bold">{{ __('ui.time_left') }}</span>
                <span class="font-extrabold text-3xl font-mono" :class="timerColor" x-text="timeLeft"></span>
            </div>
            <div class="bg-white/10 rounded-full h-3 overflow-hidden">
                <div class="h-3 rounded-full transition-all duration-1000"
                    :class="timerBarColor"
                    :style="`width: ${timerPct}%`"></div>
            </div>
        </div>

        {{-- Question card --}}
        <div class="bg-white rounded-[2.5rem] p-5 sm:p-7 space-y-5 sm:space-y-6 shadow-xl">
            <div class="flex items-start justify-between gap-4">
                <h2 class="text-xl font-extrabold text-brand-black leading-snug">{{ $currentQuestion['text'] }}</h2>
                <span class="shrink-0 text-xs font-extrabold text-brand-purple bg-brand-purple/10 px-3 py-1.5 rounded-full">
                    {{ $currentQuestion['points'] }} {{ __('ui.pts') }}
                </span>
            </div>

            @if($currentQuestion['hint'])
                <p class="text-sm text-gray-400 italic"><i class="ph ph-lightbulb text-brand-green"></i> {{ $currentQuestion['hint'] }}</p>
            @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                @foreach($currentQuestion['answers'] as $answer)
                    <button wire:click="selectAnswer({{ $answer['id'] }})"
                        class="{{ $locale === 'ar' ? 'text-right' : 'text-left' }} p-4 rounded-2xl border-2 font-semibold transition-all active:scale-95
                            border-gray-200 bg-gray-50 hover:border-brand-purple hover:bg-brand-purple/5 text-brand-black">
                        {{ $answer['text'] }}
                    </button>
                @endforeach
            </div>
        </div>

        @include('livewire.partials.active-players', ['activePlayers' => $activePlayers])

        {{-- PAUSE OVERLAY --}}
        <template x-teleport="body">
            <div x-show="paused" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
                class="fixed inset-0 bg-black/60 backdrop-blur-md z-[100] flex flex-col items-center justify-center p-6" style="display: none;">
                <div class="w-full max-w-sm flex flex-col gap-8">
                    <div class="flex flex-col items-center text-center gap-4">
                        <div class="w-24 h-24 rounded-full bg-brand-green flex items-center justify-center shadow-[0_0_40px_rgba(204,245,73,0.3)]">
                            <i class="ph-fill ph-pause text-5xl text-brand-black"></i>
                        </div>
                        <div>
                            <h2 class="text-4xl font-extrabold text-white tracking-tight">{{ __('ui.quiz_paused') }}</h2>
                            <p class="text-gray-400 font-medium mt-1">{{ __('ui.pause_subtitle') }}</p>
                        </div>
                    </div>

                    <div class="w-full bg-white/5 border border-white/10 rounded-[2.5rem] p-6 flex justify-around">
                        <div class="flex flex-col items-center">
                            <span class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">{{ __('ui.current') }}</span>
                            <span class="text-white text-2xl font-extrabold">Q{{ $currentIndex + 1 }}/{{ $quiz->questions->count() }}</span>
                        </div>
                        <div class="w-px h-10 bg-white/10 self-center"></div>
                        <div class="flex flex-col items-center">
                            <span class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">{{ __('ui.accuracy') }}</span>
                            <span class="text-brand-green text-2xl font-extrabold" x-text="accuracyPct + '%'"></span>
                        </div>
                        <div class="w-px h-10 bg-white/10 self-center"></div>
                        <div class="flex flex-col items-center">
                            <span class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">{{ __('ui.time') }}</span>
                            <span class="text-white text-2xl font-extrabold" x-text="elapsedFormatted"></span>
                        </div>
                    </div>

                    <div class="flex flex-col gap-4">
                        <button x-on:click="resumeQuiz()"
                            class="w-full h-16 bg-brand-green rounded-[1.25rem] flex items-center justify-center gap-3 hover:scale-[1.02] active:scale-[0.98] transition-all">
                            <i class="ph-fill ph-play text-xl text-brand-black"></i>
                            <span class="text-brand-black font-extrabold text-lg">{{ __('ui.resume_quiz') }}</span>
                        </button>
                        <div class="grid grid-cols-2 gap-4">
                            <button wire:click="restartQuiz" x-on:click="paused = false; startElapsedTimer()"
                                class="h-16 bg-white/10 border border-white/10 rounded-[1.25rem] flex items-center justify-center gap-2 hover:bg-white/20 transition-colors">
                                <i class="ph ph-arrows-clockwise text-white text-lg"></i>
                                <span class="text-white font-bold">{{ __('ui.restart') }}</span>
                            </button>
                            <button wire:click="leaveQuiz"
                                class="h-16 bg-white/10 border border-white/10 rounded-[1.25rem] flex items-center justify-center gap-2 hover:bg-red-500/20 hover:border-red-500/30 transition-colors">
                                <i class="ph ph-sign-out text-white text-lg"></i>
                                <span class="text-white font-bold">{{ __('ui.quit') }}</span>
                            </button>
                        </div>
                    </div>

                    <p class="text-center text-gray-500 text-sm font-medium px-4">
                        {{ __('ui.auto_save_notice') }}
                    </p>
                </div>
            </div>
        </template>
    @endif

    {{-- RESULT PHASE --}}
    @if($phase === 'result' && $currentQuestion)
        @php $lastDetail = end($answerDetails); @endphp
        <div class="flex items-center gap-3">
            <span class="text-sm text-gray-400 font-mono">{{ $currentIndex + 1 }}/{{ $quiz->questions->count() }}</span>
            <div class="flex-1 bg-white/10 rounded-full h-2 overflow-hidden">
                <div class="bg-brand-purple h-2 rounded-full transition-all"
                    style="width: {{ (($currentIndex + 1) / $quiz->questions->count()) * 100 }}%"></div>
            </div>
            <span class="text-sm font-bold text-brand-green">{{ $score }} {{ __('ui.pts') }}</span>
        </div>

        <div class="bg-white border-2 rounded-[2.5rem] p-5 sm:p-7 space-y-5 shadow-xl {{ $isCorrect ? 'border-green-400' : 'border-red-400' }}">
            <div class="text-center">
                @if($isCorrect)
                    <div class="w-16 h-16 rounded-full bg-green-100 flex items-center justify-center mx-auto mb-3">
                        <i class="ph-fill ph-check-circle text-green-500 text-4xl"></i>
                    </div>
                    <h2 class="text-2xl font-extrabold text-green-600">{{ __('ui.correct') }}</h2>
                    <p class="text-green-500 font-semibold">+{{ $lastDetail['points_earned'] }} {{ __('ui.pts') }}</p>
                @else
                    <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-3">
                        <i class="ph-fill ph-x-circle text-red-500 text-4xl"></i>
                    </div>
                    <h2 class="text-2xl font-extrabold text-red-500">{{ __('ui.wrong') }}</h2>
                    <p class="text-gray-400 text-sm">{{ __('ui.correct_answer_was') }}</p>
                    <p class="text-brand-black font-bold text-lg mt-1">{{ $lastDetail['correct'] }}</p>
                @endif
            </div>

            <div class="bg-gray-50 rounded-2xl p-4 space-y-2 text-sm">
                <div class="flex justify-between text-gray-400">
                    <span>{{ __('ui.your_answer') }}</span>
                    <span class="{{ $isCorrect ? 'text-green-600' : 'text-red-500' }} font-semibold">{{ $lastDetail['selected'] }}</span>
                </div>
                <div class="flex justify-between text-gray-400">
                    <span>{{ __('ui.time_used') }}</span>
                    <span class="text-brand-black font-semibold">{{ $lastDetail['time_used'] }}s</span>
                </div>
                <div class="flex justify-between text-gray-400">
                    <span>{{ __('ui.running_score') }}</span>
                    <span class="text-brand-purple font-bold">{{ $score }} / {{ $totalPossible }}</span>
                </div>
            </div>

            <button wire:click="nextQuestion"
                class="w-full bg-brand-green hover:brightness-105 text-brand-black font-extrabold py-4 rounded-2xl transition-all active:scale-95">
                {{ $currentIndex + 1 >= $quiz->questions->count() ? __('ui.see_results') : __('ui.next_question') }}
            </button>
        </div>

        @include('livewire.partials.active-players', ['activePlayers' => $activePlayers])
    @endif
</div>
