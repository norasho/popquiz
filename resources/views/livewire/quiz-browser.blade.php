<div class="flex flex-col gap-6 pb-32" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">

    {{-- Hero card --}}
    <section class="w-full bg-brand-green rounded-[2.5rem] p-6 flex flex-col shadow-lg">
        <div class="flex items-center gap-1.5 text-brand-black">
            <i class="ph-fill ph-sparkle text-sm"></i>
            <span class="text-sm font-semibold tracking-wide">{{ __('ui.ready_challenge') }}</span>
        </div>
        <h2 class="text-[2rem] sm:text-[2.2rem] font-extrabold text-brand-black tracking-tight leading-[1.1] mt-2">{{ __('ui.start_new_session') }}</h2>
    </section>

    {{-- Config card --}}
    <section class="w-full bg-white rounded-[2.5rem] p-6 sm:p-7 flex flex-col shadow-xl gap-8">

        {{-- Topic selection --}}
        <div class="flex flex-col gap-4">
            <div class="flex items-center justify-between">
                <span class="text-gray-500 text-xs font-bold tracking-widest uppercase">{{ __('ui.select_topic') }}</span>
                <span wire:click="selectTopic('')" class="text-brand-purple text-xs font-bold cursor-pointer">{{ __('ui.view_all') }}</span>
            </div>
            <div class="grid grid-cols-2 gap-3">
                @php
                    $iconMap = [
                        'technology' => 'bi bi-laptop',
                        'geography' => 'bi bi-globe-americas',
                        'food' => 'bi bi-egg-fried',
                        'science' => 'bi bi-flask',
                        'history' => 'bi bi-hourglass-split',
                        'sports' => 'bi bi-trophy-fill',
                        'entertainment' => 'bi bi-film',
                        'general' => 'bi bi-grid-fill',
                    ];
                @endphp
                @foreach($categories as $cat)
                    @php $isSelected = $selectedTopic === $cat; @endphp
                    <button wire:click="selectTopic('{{ $cat }}')"
                        class="flex flex-col gap-3 p-4 rounded-3xl border-2 transition-all text-left {{ $locale === 'ar' ? 'text-right' : '' }}
                            {{ $isSelected ? 'bg-brand-black border-transparent' : 'bg-gray-50 border-transparent hover:border-gray-200' }}">
                        <i class="{{ $iconMap[$cat] ?? 'bi bi-grid-fill' }} text-2xl {{ $isSelected ? 'text-brand-green' : 'text-gray-400' }}"></i>
                        <span class="font-bold text-sm {{ $isSelected ? 'text-white' : 'text-brand-black' }}">{{ __('ui.cat_' . $cat) }}</span>
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Difficulty --}}
        <div class="flex flex-col gap-4">
            <span class="text-gray-500 text-xs font-bold tracking-widest uppercase">{{ __('ui.difficulty_level') }}</span>
            <div class="flex p-1 bg-gray-100 rounded-2xl">
                @foreach(['easy', 'medium', 'hard'] as $diff)
                    <button wire:click="setDifficulty('{{ $diff }}')"
                        class="flex-1 py-3 text-center text-xs font-bold rounded-xl transition-all
                            {{ $difficulty === $diff ? 'text-brand-black bg-white shadow-sm' : 'text-gray-500' }}">
                        {{ __('ui.' . $diff) }}
                    </button>
                @endforeach
            </div>
        </div>

        {{-- Question count slider --}}
        <div class="flex flex-col gap-4">
            <div class="flex items-center justify-between">
                <span class="text-gray-500 text-xs font-bold tracking-widest uppercase">{{ __('ui.question_count') }}</span>
                <span class="text-brand-black font-extrabold text-sm">{{ $questionCount }}</span>
            </div>
            <div class="relative">
                <input type="range" wire:model.live="questionCount" min="5" max="25" step="5"
                    class="w-full h-2 bg-gray-100 rounded-full appearance-none cursor-pointer accent-brand-purple
                        [&::-webkit-slider-thumb]:appearance-none [&::-webkit-slider-thumb]:w-5 [&::-webkit-slider-thumb]:h-5
                        [&::-webkit-slider-thumb]:bg-white [&::-webkit-slider-thumb]:border-4 [&::-webkit-slider-thumb]:border-brand-purple
                        [&::-webkit-slider-thumb]:rounded-full [&::-webkit-slider-thumb]:shadow-md">
            </div>
            <div class="flex justify-between px-1">
                @foreach([5, 10, 15, 20, 25] as $val)
                    <span class="text-[10px] font-bold {{ $questionCount == $val ? 'text-brand-purple' : 'text-gray-400' }}">{{ $val }}</span>
                @endforeach
            </div>
        </div>

        {{-- Est Time & XP --}}
        <div class="pt-6 border-t border-gray-100 flex items-center justify-between">
            <div class="flex flex-col">
                <span class="text-gray-400 text-[10px] font-bold uppercase tracking-wider">{{ __('ui.est_time') }}</span>
                <span class="text-brand-black font-extrabold">{{ $estTime }} {{ __('ui.mins') }}</span>
            </div>
            <div class="flex flex-col {{ $locale === 'ar' ? 'text-left' : 'text-right' }}">
                <span class="text-gray-400 text-[10px] font-bold uppercase tracking-wider">{{ __('ui.xp_reward') }}</span>
                <span class="text-brand-black font-extrabold">{{ $estXp }} {{ __('ui.pts') }}</span>
            </div>
        </div>
    </section>

    {{-- Bottom bar --}}
    <x-bottom-bar>
        <div class="flex flex-col">
            <span class="text-white/60 text-[10px] font-bold uppercase">{{ __('ui.selected') }}</span>
            <span class="text-white font-extrabold text-sm">
                {{ $selectedTopic ? __('ui.cat_' . $selectedTopic) : __('ui.all_categories') }}
            </span>
        </div>
        <div class="flex items-center gap-3">
            <div class="{{ $locale === 'ar' ? 'ml-2 text-left' : 'mr-2 text-right' }}">
                <span class="block text-white font-bold text-xs">{{ __('ui.start_quiz_action') }}</span>
            </div>
            <button wire:click="startQuiz"
                class="w-[3.25rem] h-[3.25rem] bg-brand-black rounded-full flex items-center justify-center text-white hover:bg-gray-900 transition-all shadow-sm group active:scale-95">
                <i class="ph ph-caret-right text-2xl font-bold group-hover:translate-x-0.5 transition-transform {{ $locale === 'ar' ? 'rotate-180' : '' }}"></i>
            </button>
        </div>
    </x-bottom-bar>

    {{-- Player name modal --}}
    @if($showPlayerModal)
    <div class="fixed inset-0 bg-black/60 backdrop-blur-md z-[100] flex items-center justify-center p-6">
        <div class="bg-white rounded-[2.5rem] p-6 sm:p-8 w-full max-w-sm space-y-5">
            <h2 class="text-2xl font-extrabold text-brand-black">{{ __('ui.your_player') }}</h2>
            <div class="flex gap-3 flex-wrap">
                @foreach($emojis as $e)
                    <button wire:click="selectEmoji('{{ $e }}')"
                        class="text-2xl w-11 h-11 rounded-xl border-2 transition-all {{ $playerEmoji === $e ? 'border-brand-purple bg-brand-purple/10 scale-110' : 'border-gray-200 hover:border-gray-300' }}">
                        {{ $e }}
                    </button>
                @endforeach
            </div>
            <input wire:model.live="playerName" type="text" placeholder="{{ __('ui.name_placeholder') }}"
                class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 text-brand-black placeholder-gray-400 focus:outline-none focus:border-brand-purple transition-colors"
                dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
            @error('playerName') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
            <button wire:click="savePlayer"
                class="w-full bg-brand-green text-brand-black font-extrabold py-4 rounded-2xl hover:brightness-105 transition-all active:scale-95">
                {{ __('ui.save_continue') }}
            </button>
        </div>
    </div>
    @endif

    @error('selectedQuizId')
        <div class="fixed top-20 left-1/2 -translate-x-1/2 bg-red-500 text-white px-4 py-2 rounded-2xl text-sm font-bold z-50 shadow-lg">
            {{ __('ui.no_quizzes') }}
        </div>
    @enderror
</div>
