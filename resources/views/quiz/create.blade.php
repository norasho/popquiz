@php $locale = session('locale', 'en'); $isAr = $locale === 'ar'; @endphp
<x-layouts.app>
    <div class="max-w-2xl mx-auto" dir="{{ $isAr ? 'rtl' : 'ltr' }}" x-data="{
        title: '',
        description: '',
        category: 'general',
        difficulty: 'medium',
        cover_emoji: '🧠',
        time_limit: 30,
        questions: [{ text: '', hint: '', points: 100, answers: [
            { text: '', is_correct: true },
            { text: '', is_correct: false },
            { text: '', is_correct: false },
            { text: '', is_correct: false },
        ]}],
        emojis: ['🧠','🎯','🔥','⭐','🚀','🎮','🌍','🎨','🎵','🏆','💡','🔬'],

        addQuestion() {
            this.questions.push({ text: '', hint: '', points: 100, answers: [
                { text: '', is_correct: true },
                { text: '', is_correct: false },
                { text: '', is_correct: false },
                { text: '', is_correct: false },
            ]});
        },

        removeQuestion(i) {
            if (this.questions.length > 1) this.questions.splice(i, 1);
        },

        setCorrect(qi, ai) {
            this.questions[qi].answers.forEach((a, idx) => a.is_correct = idx === ai);
        },

        async submit() {
            const res = await fetch('/api/quizzes', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content || '' },
                body: JSON.stringify({ title: this.title, description: this.description, category: this.category,
                    difficulty: this.difficulty, cover_emoji: this.cover_emoji, time_limit_per_question: this.time_limit,
                    questions: this.questions })
            });
            const data = await res.json();
            if (data.id) window.location.href = '/quiz/' + data.id + '/play';
        }
    }">
        <h1 class="text-2xl sm:text-3xl font-black mb-5 sm:mb-8">{{ $isAr ? 'إنشاء اختبار' : 'Create a Quiz' }}</h1>

        {{-- Quiz Details --}}
        <div class="bg-gray-900 border border-gray-800 rounded-2xl p-4 sm:p-6 space-y-4 mb-4 sm:mb-6">
            <h2 class="font-bold text-lg">{{ $isAr ? 'تفاصيل الاختبار' : 'Quiz Details' }}</h2>

            <div class="flex gap-3 flex-wrap">
                <template x-for="e in emojis" :key="e">
                    <button type="button" @click="cover_emoji = e"
                        :class="cover_emoji === e ? 'border-violet-500 bg-violet-500/20 scale-110' : 'border-gray-700'"
                        class="text-2xl w-11 h-11 rounded-xl border-2 transition-all" x-text="e"></button>
                </template>
            </div>

            <input x-model="title" type="text" placeholder="{{ $isAr ? 'عنوان الاختبار…' : 'Quiz title…' }}"
                class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-violet-500">

            <textarea x-model="description" rows="2" placeholder="{{ $isAr ? 'وصف مختصر…' : 'Short description…' }}"
                class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-violet-500 resize-none"></textarea>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div>
                    <label class="text-xs text-gray-400 mb-1 block font-arabic">{{ $isAr ? 'الفئة' : 'Category' }}</label>
                    <select x-model="category" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-3 py-2.5 text-white focus:outline-none focus:border-violet-500 font-arabic">
                        <option value="general">{{ $isAr ? 'عام' : 'General' }}</option>
                        <option value="science">{{ $isAr ? 'علوم' : 'Science' }}</option>
                        <option value="history">{{ $isAr ? 'تاريخ' : 'History' }}</option>
                        <option value="geography">{{ $isAr ? 'جغرافيا' : 'Geography' }}</option>
                        <option value="sports">{{ $isAr ? 'رياضة' : 'Sports' }}</option>
                        <option value="entertainment">{{ $isAr ? 'ترفيه' : 'Entertainment' }}</option>
                        <option value="technology">{{ $isAr ? 'تقنية' : 'Technology' }}</option>
                        <option value="food">{{ $isAr ? 'طعام' : 'Food' }}</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs text-gray-400 mb-1 block">{{ $isAr ? 'الصعوبة' : 'Difficulty' }}</label>
                    <select x-model="difficulty" class="w-full bg-gray-800 border border-gray-700 rounded-xl px-3 py-2.5 text-white focus:outline-none focus:border-violet-500">
                        <option value="easy">{{ $isAr ? 'سهل' : 'Easy' }}</option>
                        <option value="medium">{{ $isAr ? 'متوسط' : 'Medium' }}</option>
                        <option value="hard">{{ $isAr ? 'صعب' : 'Hard' }}</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs text-gray-400 mb-1 block">{{ $isAr ? 'ثانية/سؤال' : 'Seconds/Question' }}</label>
                    <input x-model="time_limit" type="number" min="5" max="120"
                        class="w-full bg-gray-800 border border-gray-700 rounded-xl px-3 py-2.5 text-white focus:outline-none focus:border-violet-500">
                </div>
            </div>
        </div>

        {{-- Questions --}}
        <div class="space-y-4 mb-6">
            <template x-for="(q, qi) in questions" :key="qi">
                <div class="bg-gray-900 border border-gray-800 rounded-2xl p-4 sm:p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-sm text-violet-400" x-text="`{{ $isAr ? 'سؤال' : 'Question' }} ${qi + 1}`"></span>
                        <button type="button" @click="removeQuestion(qi)" x-show="questions.length > 1"
                            class="text-red-400 hover:text-red-300 text-xs">{{ $isAr ? 'حذف' : 'Remove' }}</button>
                    </div>

                    <input x-model="q.text" type="text" placeholder="{{ $isAr ? 'نص السؤال…' : 'Question text…' }}"
                        class="w-full bg-gray-800 border border-gray-700 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:outline-none focus:border-violet-500">

                    <div class="grid grid-cols-2 gap-3">
                        <input x-model="q.hint" type="text" placeholder="{{ $isAr ? 'تلميح (اختياري)…' : 'Hint (optional)…' }}"
                            class="bg-gray-800 border border-gray-700 rounded-xl px-3 py-2.5 text-white placeholder-gray-500 focus:outline-none focus:border-violet-500 text-sm">
                        <input x-model="q.points" type="number" min="10" max="1000" placeholder="{{ $isAr ? 'النقاط' : 'Points' }}"
                            class="bg-gray-800 border border-gray-700 rounded-xl px-3 py-2.5 text-white focus:outline-none focus:border-violet-500 text-sm">
                    </div>

                    <div class="space-y-2">
                        <p class="text-xs text-gray-400">{{ $isAr ? 'الإجابات — انقر على الدائرة لتحديد الصحيحة' : 'Answers — click the circle to mark correct' }}</p>
                        <template x-for="(a, ai) in q.answers" :key="ai">
                            <div class="flex items-center gap-3">
                                <button type="button" @click="setCorrect(qi, ai)"
                                    :class="a.is_correct ? 'bg-green-500 border-green-500' : 'border-gray-600'"
                                    class="w-5 h-5 rounded-full border-2 shrink-0 transition-colors"></button>
                                <input x-model="a.text" type="text" :placeholder="`{{ $isAr ? 'إجابة' : 'Answer' }} ${ai + 1}`"
                                    class="flex-1 bg-gray-800 border border-gray-700 rounded-xl px-3 py-2 text-white placeholder-gray-500 focus:outline-none focus:border-violet-500 text-sm">
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>

        <div class="flex gap-3">
            <button type="button" @click="addQuestion"
                class="flex-1 bg-gray-800 hover:bg-gray-700 text-white font-bold py-3 rounded-xl transition-colors">
                {{ $isAr ? '+ إضافة سؤال' : '+ Add Question' }}
            </button>
            <button type="button" @click="submit"
                class="flex-1 bg-gradient-to-r from-violet-600 to-pink-600 hover:from-violet-500 hover:to-pink-500 text-white font-black py-3 rounded-xl transition-all active:scale-95">
                {{ $isAr ? 'نشر الاختبار ←' : 'Publish Quiz →' }}
            </button>
        </div>
    </div>
</x-layouts.app>
