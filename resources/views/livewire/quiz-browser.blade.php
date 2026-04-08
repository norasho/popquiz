<div class="space-y-5 sm:space-y-8" dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
    {{-- Hero --}}
    <div class="text-center py-6 sm:py-12">
        <h1 class="text-4xl sm:text-5xl font-black mb-2 sm:mb-3 bg-gradient-to-r from-violet-400 via-pink-400 to-orange-400 bg-clip-text text-transparent">
            PopQuiz
        </h1>
        <p class="text-gray-400 text-sm sm:text-lg">{{ __('ui.tagline') }}</p>
    </div>

    {{-- Player Setup --}}
    <div class="bg-gray-900 border border-gray-800 rounded-2xl p-4 sm:p-6 max-w-xl mx-auto">
        <h2 class="font-bold text-lg mb-4 text-gray-200">{{ __('ui.your_player') }}</h2>
        <div class="flex gap-3 mb-4 flex-wrap">
            @foreach($emojis as $e)
                <button wire:click="selectEmoji('{{ $e }}')"
                    class="text-2xl w-11 h-11 rounded-xl border-2 transition-all {{ $playerEmoji === $e ? 'border-violet-500 bg-violet-500/20 scale-110' : 'border-gray-700 hover:border-gray-500' }}">
                    {{ $e }}
                </button>
            @endforeach
        </div>
        <input wire:model="playerName" type="text" placeholder="{{ __('ui.name_placeholder') }}"
            class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-violet-500 transition-colors"
            dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
        @error('playerName') <p class="text-red-400 text-sm mt-1">{{ $message }}</p> @enderror
        <p class="text-xs text-gray-600 font-mono mt-2">ID: #{{ $playerShortId }}</p>
    </div>

    {{-- Search & Filter --}}
    <div class="flex flex-col sm:flex-row gap-3">
        <input wire:model.live="search" type="text" placeholder="{{ __('ui.search_placeholder') }}"
            class="flex-1 bg-gray-900 border border-gray-800 rounded-xl px-4 py-2.5 text-white placeholder-gray-500 focus:outline-none focus:border-violet-500 transition-colors"
            dir="{{ $locale === 'ar' ? 'rtl' : 'ltr' }}">
        @php
            $catOptions = ['' => __('ui.all_categories')];
            foreach ($categories as $cat) $catOptions[$cat] = __('ui.cat_' . $cat);
        @endphp
        <div x-data="{
                open: false,
                selected: '{{ $category }}',
                options: {{ json_encode($catOptions) }},
                get label() { return this.options[this.selected] ?? Object.values(this.options)[0]; },
                choose(val) { this.selected = val; this.open = false; $wire.set('category', val); }
             }"
             @click.outside="open = false"
             class="relative">
            <button @click="open = !open" type="button"
                class="w-full flex items-center justify-between gap-2 bg-gray-900 border border-gray-800 rounded-xl px-4 py-2.5 text-white focus:outline-none focus:border-violet-500 transition-colors font-arabic min-w-40">
                <span x-text="label"></span>
                <svg class="w-3 h-3 text-gray-400 shrink-0 transition-transform" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
            </button>
            <ul x-show="open" x-transition
                class="absolute z-50 mt-1 w-full bg-gray-900 border border-gray-800 rounded-xl overflow-hidden shadow-xl font-arabic"
                :class="{{ json_encode($locale === 'ar') }} ? 'right-0' : 'left-0'">
                <template x-for="[val, label] in Object.entries(options)" :key="val">
                    <li @click="choose(val)"
                        class="px-4 py-2.5 cursor-pointer hover:bg-gray-800 transition-colors"
                        :class="selected === val ? 'text-violet-400' : 'text-white'"
                        x-text="label">
                    </li>
                </template>
            </ul>
        </div>
    </div>

    {{-- Quiz Grid --}}
    @if($quizzes->isEmpty())
        <div class="text-center py-20 text-gray-500">
            <div class="text-5xl mb-4">🔍</div>
            <p class="text-lg">{{ __('ui.no_quizzes') }}</p>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($quizzes as $quiz)
                @php $selected = $selectedQuizId === $quiz->id; @endphp
                <div wire:click="selectQuiz({{ $quiz->id }})"
                    class="cursor-pointer bg-gray-900 border-2 rounded-2xl p-5 transition-all hover:scale-[1.02] {{ $selected ? 'border-violet-500 shadow-lg shadow-violet-500/20' : 'border-gray-800 hover:border-gray-600' }}">
                    <div class="text-4xl mb-3">{{ $quiz->cover_emoji }}</div>
                    <h3 class="font-bold text-lg leading-tight mb-1">{{ $locale === 'ar' && $quiz->title_ar ? $quiz->title_ar : $quiz->title }}</h3>
                    <p class="text-gray-400 text-sm mb-3 line-clamp-2">{{ $locale === 'ar' && $quiz->description_ar ? $quiz->description_ar : $quiz->description }}</p>
                    <div class="flex items-center gap-2 flex-wrap text-xs">
                        <span class="px-2.5 py-1 rounded-full border {{ $quiz->difficulty_color }} font-semibold">
                            {{ __('ui.' . $quiz->difficulty) }}
                        </span>
                        <span class="text-gray-500">{{ $quiz->questions_count }} {{ __('ui.questions_short') }}</span>
                        <span class="text-gray-500">⏱ {{ $quiz->time_limit_per_question }}{{ __('ui.per_q') }}</span>
                        <span class="{{ $locale === 'ar' ? 'mr-auto' : 'ml-auto' }} text-gray-600 font-arabic">{{ __('ui.cat_' . $quiz->category) }}</span>
                    </div>
                    @if($selected)
                        <button wire:click.stop="startQuiz"
                            class="mt-4 w-full bg-violet-600 hover:bg-violet-500 text-white font-bold py-2.5 rounded-xl transition-colors">
                            {{ __('ui.play_now') }}
                        </button>
                        @error('playerName') <p class="text-red-400 text-xs mt-1 text-center">{{ __('ui.enter_name_first') }}</p> @enderror
                        @error('selectedQuizId') <p class="text-red-400 text-xs mt-1 text-center">{{ $message }}</p> @enderror
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>
