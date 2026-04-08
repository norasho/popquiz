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
        <h1 class="text-2xl sm:text-3xl font-extrabold text-white mb-5 sm:mb-8">{{ $isAr ? 'إنشاء اختبار' : 'Create a Quiz' }}</h1>

        {{-- Quiz Details --}}
        <div class="bg-white rounded-[2.5rem] p-5 sm:p-7 space-y-4 mb-4 sm:mb-6">
            <h2 class="font-extrabold text-lg text-brand-black">{{ $isAr ? 'تفاصيل الاختبار' : 'Quiz Details' }}</h2>

            <div class="flex gap-3 flex-wrap">
                <template x-for="e in emojis" :key="e">
                    <button type="button" @click="cover_emoji = e"
                        :class="cover_emoji === e ? 'border-brand-purple bg-brand-purple/10 scale-110' : 'border-gray-200'"
                        class="text-2xl w-11 h-11 rounded-xl border-2 transition-all" x-text="e"></button>
                </template>
            </div>

            <input x-model="title" type="text" placeholder="{{ $isAr ? 'عنوان الاختبار…' : 'Quiz title…' }}"
                class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 text-brand-black placeholder-gray-400 focus:outline-none focus:border-brand-purple">

            <textarea x-model="description" rows="2" placeholder="{{ $isAr ? 'وصف مختصر…' : 'Short description…' }}"
                class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 text-brand-black placeholder-gray-400 focus:outline-none focus:border-brand-purple resize-none"></textarea>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                <div>
                    <label class="text-xs text-gray-400 font-bold mb-1 block font-arabic">{{ $isAr ? 'الفئة' : 'Category' }}</label>
                    <select x-model="category" class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-3 py-2.5 text-brand-black focus:outline-none focus:border-brand-purple font-arabic">
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
                    <label class="text-xs text-gray-400 font-bold mb-1 block">{{ $isAr ? 'الصعوبة' : 'Difficulty' }}</label>
                    <select x-model="difficulty" class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-3 py-2.5 text-brand-black focus:outline-none focus:border-brand-purple font-arabic">
                        <option value="easy">{{ $isAr ? 'سهل' : 'Easy' }}</option>
                        <option value="medium">{{ $isAr ? 'متوسط' : 'Medium' }}</option>
                        <option value="hard">{{ $isAr ? 'صعب' : 'Hard' }}</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs text-gray-400 font-bold mb-1 block">{{ $isAr ? 'ثانية/سؤال' : 'Seconds/Question' }}</label>
                    <input x-model="time_limit" type="number" min="5" max="120"
                        class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-3 py-2.5 text-brand-black focus:outline-none focus:border-brand-purple">
                </div>
            </div>
        </div>

        {{-- Questions --}}
        <div class="space-y-4 mb-6">
            <template x-for="(q, qi) in questions" :key="qi">
                <div class="bg-white rounded-[2.5rem] p-5 sm:p-7 space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="font-bold text-sm text-brand-purple" x-text="`{{ $isAr ? 'سؤال' : 'Question' }} ${qi + 1}`"></span>
                        <button type="button" @click="removeQuestion(qi)" x-show="questions.length > 1"
                            class="text-red-400 hover:text-red-500 text-xs font-bold">{{ $isAr ? 'حذف' : 'Remove' }}</button>
                    </div>

                    <input x-model="q.text" type="text" placeholder="{{ $isAr ? 'نص السؤال…' : 'Question text…' }}"
                        class="w-full bg-gray-50 border border-gray-200 rounded-2xl px-4 py-3 text-brand-black placeholder-gray-400 focus:outline-none focus:border-brand-purple">

                    <div class="grid grid-cols-2 gap-3">
                        <input x-model="q.hint" type="text" placeholder="{{ $isAr ? 'تلميح (اختياري)…' : 'Hint (optional)…' }}"
                            class="bg-gray-50 border border-gray-200 rounded-2xl px-3 py-2.5 text-brand-black placeholder-gray-400 focus:outline-none focus:border-brand-purple text-sm">
                        <input x-model="q.points" type="number" min="10" max="1000" placeholder="{{ $isAr ? 'النقاط' : 'Points' }}"
                            class="bg-gray-50 border border-gray-200 rounded-2xl px-3 py-2.5 text-brand-black focus:outline-none focus:border-brand-purple text-sm">
                    </div>

                    <div class="space-y-2">
                        <p class="text-xs text-gray-400 font-bold">{{ $isAr ? 'الإجابات — انقر على الدائرة لتحديد الصحيحة' : 'Answers — click the circle to mark correct' }}</p>
                        <template x-for="(a, ai) in q.answers" :key="ai">
                            <div class="flex items-center gap-3">
                                <button type="button" @click="setCorrect(qi, ai)"
                                    :class="a.is_correct ? 'bg-brand-green border-brand-green' : 'border-gray-300'"
                                    class="w-5 h-5 rounded-full border-2 shrink-0 transition-colors"></button>
                                <input x-model="a.text" type="text" :placeholder="`{{ $isAr ? 'إجابة' : 'Answer' }} ${ai + 1}`"
                                    class="flex-1 bg-gray-50 border border-gray-200 rounded-2xl px-3 py-2 text-brand-black placeholder-gray-400 focus:outline-none focus:border-brand-purple text-sm">
                            </div>
                        </template>
                    </div>
                </div>
            </template>
        </div>

        <div class="flex gap-3 pb-8">
            <button type="button" @click="addQuestion"
                class="flex-1 bg-white/10 border border-white/10 hover:bg-white/20 text-white font-bold py-3.5 rounded-2xl transition-colors">
                {{ $isAr ? '+ إضافة سؤال' : '+ Add Question' }}
            </button>
            <button type="button" @click="submit"
                class="flex-1 bg-brand-green hover:brightness-105 text-brand-black font-extrabold py-3.5 rounded-2xl transition-all active:scale-95">
                {{ $isAr ? 'نشر الاختبار' : 'Publish Quiz' }}
            </button>
        </div>
    </div>
</x-layouts.app>
