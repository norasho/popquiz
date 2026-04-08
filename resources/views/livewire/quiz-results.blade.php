<div dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}" class="flex flex-col gap-6 pb-32">
    {{-- Finished subtitle --}}
    <div class="w-full px-2 pb-5 border-b border-white/10 flex items-center gap-2 text-base">
        <i class="ph ph-check-circle text-brand-green text-xl"></i>
        <span class="font-bold text-white tracking-wide">{{ __('ui.finished') }}:</span>
        <span class="text-gray-400 font-medium">{{ $result->quiz->title }}</span>
    </div>

    {{-- Score card --}}
    <section class="w-full bg-brand-green rounded-[2.5rem] p-6 flex flex-col items-center text-center shadow-lg">
        <div class="flex items-center gap-1.5 text-brand-black mb-2">
            <i class="ph-fill ph-trophy text-sm"></i>
            <span class="text-sm font-semibold tracking-wide uppercase">{{ __('ui.final_score') }}</span>
        </div>
        <div class="flex items-baseline gap-1">
            <h2 class="text-[4rem] font-extrabold text-brand-black tracking-tighter leading-none">{{ $result->percentage }}</h2>
            <span class="text-2xl font-bold text-brand-black/60">%</span>
        </div>
        <p class="text-brand-black font-bold mt-4 text-lg">
            @if($result->percentage >= 90) {{ __('ui.title_master') }}
            @elseif($result->percentage >= 70) {{ __('ui.title_great') }}
            @elseif($result->percentage >= 50) {{ __('ui.title_good') }}
            @else {{ __('ui.title_try_again') }}
            @endif
        </p>
    </section>

    {{-- Stats grid --}}
    <section class="w-full grid grid-cols-2 gap-4">
        <div class="bg-white/5 border border-white/10 rounded-[2rem] p-5 flex flex-col items-center">
            <span class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">{{ __('ui.correct_label') }}</span>
            <span class="text-3xl font-extrabold text-brand-green">{{ $result->correct_count }}</span>
            <span class="text-gray-500 text-sm font-medium">{{ __('ui.of') }} {{ $result->correct_count + $result->wrong_count }}</span>
        </div>
        <div class="bg-white/5 border border-white/10 rounded-[2rem] p-5 flex flex-col items-center">
            <span class="text-gray-400 text-xs font-bold uppercase tracking-widest mb-1">{{ __('ui.avg_time') }}</span>
            <span class="text-3xl font-extrabold text-white">{{ $avgTime }}s</span>
            <span class="text-gray-500 text-sm font-medium">{{ __('ui.per_question') }}</span>
        </div>
    </section>

    {{-- Badges --}}
    @if(count($badges) > 0)
    <section class="w-full bg-white rounded-[2.5rem] p-6 flex flex-col shadow-xl">
        <h3 class="text-xl font-extrabold text-brand-black mb-6 flex items-center gap-2">
            <i class="ph ph-medal text-brand-purple"></i>
            {{ __('ui.badges_earned') }}
        </h3>
        <div class="flex flex-col gap-4">
            @foreach($badges as $badge)
            <div class="flex items-center gap-4 p-4 rounded-2xl bg-gray-50">
                <div class="w-12 h-12 rounded-full bg-{{ $badge['bg'] }} flex items-center justify-center">
                    <i class="{{ $badge['icon'] }} text-{{ $badge['color'] }} text-2xl"></i>
                </div>
                <div>
                    <h4 class="text-brand-black font-bold">{{ $badge['title'] }}</h4>
                    <p class="text-gray-500 text-xs">{{ $badge['desc'] }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- Answer breakdown --}}
    <section class="w-full bg-white rounded-[2.5rem] p-6 flex flex-col shadow-xl">
        <h3 class="text-xl font-extrabold text-brand-black mb-6 flex items-center gap-2">
            <i class="ph ph-list-checks text-brand-purple"></i>
            {{ __('ui.answer_breakdown') }}
        </h3>
        <div class="flex flex-col gap-3">
            @foreach($result->answer_details as $detail)
            <div class="flex items-start gap-3 p-3 rounded-2xl {{ $detail['is_correct'] ? 'bg-green-50 border border-green-200' : 'bg-red-50 border border-red-200' }}">
                <i class="{{ $detail['is_correct'] ? 'ph-fill ph-check-circle text-green-500' : 'ph-fill ph-x-circle text-red-500' }} text-lg shrink-0 mt-0.5"></i>
                <div class="flex-1 min-w-0">
                    <p class="text-sm text-brand-black font-medium leading-snug">{{ $detail['question'] }}</p>
                    @if(!$detail['is_correct'])
                        <p class="text-xs text-gray-500 mt-0.5">{{ __('ui.correct_label') }}: <span class="text-green-600 font-semibold">{{ $detail['correct'] }}</span></p>
                    @endif
                </div>
                <span class="text-xs font-bold shrink-0 {{ $detail['is_correct'] ? 'text-green-600' : 'text-red-500' }}">
                    +{{ $detail['points_earned'] }}
                </span>
            </div>
            @endforeach
        </div>
    </section>

    {{-- Bottom bar --}}
    <x-bottom-bar>
        <a href="{{ route('home') }}" class="text-white opacity-80 hover:opacity-100 transition-opacity p-2 flex items-center gap-2">
            <i class="ph ph-house text-2xl"></i>
            <span class="font-bold text-sm">{{ __('ui.home_short') }}</span>
        </a>
        <div class="flex items-center gap-3">
            <a href="{{ route('quiz.leaderboard', $result->quiz_id) }}" class="w-[3.25rem] h-[3.25rem] bg-white rounded-full flex items-center justify-center text-brand-black hover:bg-gray-100 transition-colors shadow-sm">
                <i class="ph ph-trophy text-2xl"></i>
            </a>
            <a href="{{ route('quiz.play', $result->quiz_id) }}" class="w-[3.25rem] h-[3.25rem] bg-white rounded-full flex items-center justify-center text-brand-black hover:bg-gray-100 transition-colors shadow-sm">
                <i class="ph ph-arrow-counter-clockwise text-2xl"></i>
            </a>
            <a href="{{ route('home') }}" class="px-6 h-[3.25rem] bg-brand-black rounded-full flex items-center justify-center text-white hover:bg-gray-900 transition-colors shadow-sm gap-2">
                <span class="font-extrabold text-sm tracking-tight">{{ __('ui.next_quiz') }}</span>
                <i class="ph ph-caret-right text-xl font-bold {{ $locale === 'ar' ? 'rotate-180' : '' }}"></i>
            </a>
        </div>
    </x-bottom-bar>
</div>
