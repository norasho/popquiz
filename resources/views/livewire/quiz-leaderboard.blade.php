<div dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}" class="flex flex-col gap-6 pb-32">
    {{-- Sub-header --}}
    <div class="w-full px-2 pb-5 border-b border-white/10 flex items-center gap-2 text-base">
        <i class="ph ph-info text-gray-300 text-xl"></i>
        <span class="font-bold text-white tracking-wide">{{ __('ui.topic') }}:</span>
        <span class="text-gray-400 font-medium">{{ $quiz->title }}</span>
    </div>

    {{-- Champion card --}}
    @if($champion)
    <section class="w-full bg-brand-green rounded-[2.5rem] p-6 flex flex-col items-center shadow-lg relative overflow-hidden">
        <div class="absolute -top-4 {{ $locale === 'ar' ? '-left-4' : '-right-4' }} w-24 h-24 bg-black/5 rounded-full"></div>
        <div class="w-20 h-20 rounded-full border-4 border-brand-black/20 p-1 mb-3 flex items-center justify-center bg-white text-4xl">
            {{ $champion->player_emoji }}
        </div>
        <div class="text-center">
            <span class="text-brand-black text-xs font-extrabold uppercase tracking-widest bg-black/10 px-3 py-1 rounded-full mb-2 inline-block">{{ __('ui.weekly_champion') }}</span>
            <h2 class="text-2xl font-extrabold text-brand-black tracking-tight leading-none">{{ $champion->player_name }}</h2>
            <div class="mt-4 flex items-center justify-center gap-2">
                <div class="bg-brand-black text-brand-green px-4 py-2 rounded-2xl font-bold text-xl">{{ $champion->percentage }}%</div>
                <div class="text-brand-black/60 font-semibold">{{ number_format($champion->score) }} {{ __('ui.pts') }}</div>
            </div>
        </div>
    </section>
    @endif

    {{-- Rankers list --}}
    <section class="w-full bg-white rounded-[2.5rem] p-6 flex flex-col shadow-xl">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-lg font-extrabold text-brand-black tracking-tight">{{ __('ui.top_rankers') }}</h3>
        </div>

        <div class="flex flex-col gap-3">
            @foreach($leaderboard as $i => $entry)
                @if($i === 0) @continue @endif {{-- Champion already shown above --}}
                @php
                    $isMe = $currentPlayerId && $entry->player_id === $currentPlayerId;
                    $rank = $i + 1;
                @endphp
                <div class="flex items-center p-4 rounded-[1.25rem] {{ $isMe ? 'bg-brand-black border border-transparent shadow-md' : 'bg-gray-50 border border-gray-100' }}">
                    <div class="w-8 font-extrabold text-lg {{ $isMe ? 'text-brand-green' : ($rank <= 3 ? 'text-brand-purple' : 'text-gray-300') }}">{{ $rank }}</div>
                    <div class="w-10 h-10 rounded-full {{ $isMe ? 'bg-gray-700 border border-white/20' : 'bg-gray-100' }} mr-3 flex items-center justify-center text-xl">
                        {{ $entry->player_emoji }}
                    </div>
                    <div class="flex-1">
                        <div class="font-bold {{ $isMe ? 'text-white' : 'text-brand-black' }}">
                            {{ $entry->player_name }}
                            @if($isMe) <span class="text-xs text-brand-green">({{ __('ui.you') }})</span> @endif
                        </div>
                        <div class="text-xs {{ $isMe ? 'text-gray-400' : 'text-gray-400' }} font-semibold">
                            {{ $entry->correct_count + $entry->wrong_count }} {{ __('ui.questions_short') }} &bull; {{ $entry->formatted_time }}
                        </div>
                    </div>
                    <div class="flex flex-col items-end">
                        <span class="{{ $isMe ? 'text-brand-green' : 'text-brand-black' }} font-extrabold">{{ $entry->percentage }}%</span>
                        <div class="flex gap-0.5 mt-1">
                            @for($dot = 0; $dot < 3; $dot++)
                                <div class="w-1.5 h-1.5 rounded-full {{ $entry->percentage >= (($dot + 1) * 33) ? 'bg-brand-green' : ($isMe ? 'bg-gray-600' : 'bg-gray-200') }}"></div>
                            @endfor
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <a href="{{ route('home') }}" class="w-full mt-6 py-4 border-2 border-dashed border-gray-200 rounded-2xl text-gray-400 font-bold text-sm hover:border-brand-purple hover:text-brand-purple transition-all text-center block">
            {{ __('ui.view_all_rankings') }}
        </a>
    </section>

    {{-- Bottom bar --}}
    <x-bottom-bar>
        <a href="{{ route('home') }}" class="text-white opacity-80 hover:opacity-100 transition-opacity p-2">
            <i class="ph ph-house text-2xl"></i>
        </a>
        <div class="flex items-center gap-3">
            <div class="w-[3.25rem] h-[3.25rem] bg-white rounded-full flex items-center justify-center text-brand-black shadow-sm">
                <i class="ph ph-trophy text-2xl"></i>
            </div>
            <a href="{{ route('quiz.play', $quiz->id) }}" class="w-[3.25rem] h-[3.25rem] bg-brand-black rounded-full flex items-center justify-center text-white hover:bg-gray-900 transition-colors shadow-sm">
                <i class="ph ph-play text-2xl font-bold"></i>
            </a>
        </div>
    </x-bottom-bar>
</div>
