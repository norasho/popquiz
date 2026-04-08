<?php

namespace Database\Seeders;

use App\Models\Answer;
use App\Models\Question;
use App\Models\Quiz;
use Illuminate\Database\Seeder;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $quizzes = [
            [
                'title' => 'Oddly Specific Facts',
                'title_ar' => 'حقائق غريبة بشكل مثير',
                'description' => 'Questions most people have never thought to ask — but will never forget after.',
                'description_ar' => 'أسئلة لم يفكر فيها معظم الناس يوماً — لكنهم لن ينسوها بعد ذلك.',
                'category' => 'general',
                'difficulty' => 'hard',
                'cover_emoji' => '🤔',
                'time_limit_per_question' => 22,
                'questions' => [
                    ['text' => 'What color is a polar bear\'s skin (beneath its fur)?', 'text_ar' => 'ما هو لون جلد الدب القطبي تحت فرائه؟', 'points' => 120, 'hint' => 'Not white', 'hint_ar' => 'ليس أبيض', 'answers' => [
                        ['text' => 'Black',        'text_ar' => 'أسود',       'correct' => true],
                        ['text' => 'Pink',         'text_ar' => 'وردي',       'correct' => false],
                        ['text' => 'Grey',         'text_ar' => 'رمادي',      'correct' => false],
                        ['text' => 'Translucent',  'text_ar' => 'شفاف',       'correct' => false],
                    ]],
                    ['text' => 'A group of flamingos is called a what?', 'text_ar' => 'كيف يُسمى تجمع طيور الفلامنغو؟', 'points' => 120, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Flamboyance',  'text_ar' => 'فلامبويانس',  'correct' => true],
                        ['text' => 'Flutter',      'text_ar' => 'رفيف',        'correct' => false],
                        ['text' => 'Blush',        'text_ar' => 'احمرار',      'correct' => false],
                        ['text' => 'Flock',        'text_ar' => 'قطيع',        'correct' => false],
                    ]],
                    ['text' => 'Which organ can regrow itself after being cut by up to 75%?', 'text_ar' => 'أي عضو يمكنه إعادة نمو نفسه بعد استئصال ما يصل إلى 75٪ منه؟', 'points' => 150, 'hint' => 'It processes what you drink', 'hint_ar' => 'يعالج ما تشربه', 'answers' => [
                        ['text' => 'Liver',     'text_ar' => 'الكبد',     'correct' => true],
                        ['text' => 'Kidney',    'text_ar' => 'الكلية',    'correct' => false],
                        ['text' => 'Lung',      'text_ar' => 'الرئة',     'correct' => false],
                        ['text' => 'Pancreas',  'text_ar' => 'البنكرياس', 'correct' => false],
                    ]],
                    ['text' => 'What is the dot above a lowercase "i" or "j" called?', 'text_ar' => 'ما اسم النقطة فوق حرف "i" أو "j" الصغير؟', 'points' => 150, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Tittle',     'text_ar' => 'تيتل',      'correct' => true],
                        ['text' => 'Serif',      'text_ar' => 'سيريف',     'correct' => false],
                        ['text' => 'Diacritic',  'text_ar' => 'علامة تشكيل', 'correct' => false],
                        ['text' => 'Glyph',      'text_ar' => 'غليف',      'correct' => false],
                    ]],
                    ['text' => 'How many hearts does an octopus have?', 'text_ar' => 'كم عدد قلوب الأخطبوط؟', 'points' => 120, 'hint' => 'More than one', 'hint_ar' => 'أكثر من واحد', 'answers' => [
                        ['text' => '3', 'text_ar' => '٣', 'correct' => true],
                        ['text' => '2', 'text_ar' => '٢', 'correct' => false],
                        ['text' => '4', 'text_ar' => '٤', 'correct' => false],
                        ['text' => '1', 'text_ar' => '١', 'correct' => false],
                    ]],
                    ['text' => 'In which country did the croissant actually originate?', 'text_ar' => 'في أي دولة نشأ الكرواسون في الأصل؟', 'points' => 150, 'hint' => 'Not France', 'hint_ar' => 'ليست فرنسا', 'answers' => [
                        ['text' => 'Austria',      'text_ar' => 'النمسا',    'correct' => true],
                        ['text' => 'Belgium',      'text_ar' => 'بلجيكا',    'correct' => false],
                        ['text' => 'Switzerland',  'text_ar' => 'سويسرا',    'correct' => false],
                        ['text' => 'Hungary',      'text_ar' => 'المجر',     'correct' => false],
                    ]],
                    ['text' => 'What percentage of the Earth\'s water is fresh water?', 'text_ar' => 'ما نسبة المياه العذبة من إجمالي مياه الأرض؟', 'points' => 150, 'hint' => 'Much less than you think', 'hint_ar' => 'أقل بكثير مما تتوقع', 'answers' => [
                        ['text' => '3%',  'text_ar' => '٣٪',   'correct' => true],
                        ['text' => '10%', 'text_ar' => '١٠٪',  'correct' => false],
                        ['text' => '25%', 'text_ar' => '٢٥٪',  'correct' => false],
                        ['text' => '1%',  'text_ar' => '١٪',   'correct' => false],
                    ]],
                    ['text' => 'Which animal cannot jump?', 'text_ar' => 'أي حيوان لا يستطيع القفز؟', 'points' => 120, 'hint' => 'The largest land animal', 'hint_ar' => 'أكبر حيوان بري', 'answers' => [
                        ['text' => 'Elephant',  'text_ar' => 'الفيل',      'correct' => true],
                        ['text' => 'Hippo',     'text_ar' => 'فرس النهر',  'correct' => false],
                        ['text' => 'Rhino',     'text_ar' => 'وحيد القرن', 'correct' => false],
                        ['text' => 'Sloth',     'text_ar' => 'الكسلان',    'correct' => false],
                    ]],
                    ['text' => 'The Eiffel Tower grows taller in summer by approximately how much?', 'text_ar' => 'بكم يرتفع برج إيفل تقريباً في فصل الصيف؟', 'points' => 150, 'hint' => 'Metal expands in heat', 'hint_ar' => 'المعادن تتمدد بالحرارة', 'answers' => [
                        ['text' => '15 cm',   'text_ar' => '١٥ سم',     'correct' => true],
                        ['text' => '2 cm',    'text_ar' => '٢ سم',      'correct' => false],
                        ['text' => '1 meter', 'text_ar' => '١ متر',     'correct' => false],
                        ['text' => '50 cm',   'text_ar' => '٥٠ سم',     'correct' => false],
                    ]],
                    ['text' => 'What is the name of the phobia of long words?', 'text_ar' => 'ما اسم الرهاب من الكلمات الطويلة؟', 'points' => 200, 'hint' => 'Ironically, the word itself is very long', 'hint_ar' => 'المفارقة أن الكلمة نفسها طويلة جداً', 'answers' => [
                        ['text' => 'Hippopotomonstrosesquippedaliophobia', 'text_ar' => 'هيبوبوتومونستروسيسكويبيداليوفوبيا', 'correct' => true],
                        ['text' => 'Logophobia',  'text_ar' => 'لوغوفوبيا',  'correct' => false],
                        ['text' => 'Lexiphobia',  'text_ar' => 'ليكسيفوبيا', 'correct' => false],
                        ['text' => 'Verbophobia', 'text_ar' => 'فيربوفوبيا', 'correct' => false],
                    ]],
                    ['text' => 'How many legs does a spider have?', 'text_ar' => 'كم عدد أرجل العنكبوت؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => '8',  'text_ar' => '٨',  'correct' => true],
                        ['text' => '6',  'text_ar' => '٦',  'correct' => false],
                        ['text' => '10', 'text_ar' => '١٠', 'correct' => false],
                        ['text' => '12', 'text_ar' => '١٢', 'correct' => false],
                    ]],
                    ['text' => 'What is the hardest natural substance on Earth?', 'text_ar' => 'ما أصلب مادة طبيعية على وجه الأرض؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Diamond',   'text_ar' => 'الماس',     'correct' => true],
                        ['text' => 'Quartz',    'text_ar' => 'الكوارتز',  'correct' => false],
                        ['text' => 'Titanium',  'text_ar' => 'التيتانيوم', 'correct' => false],
                        ['text' => 'Obsidian',  'text_ar' => 'الأوبسيديان', 'correct' => false],
                    ]],
                    ['text' => 'How many colors are in a rainbow?', 'text_ar' => 'كم عدد ألوان قوس قزح؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => '7', 'text_ar' => '٧', 'correct' => true],
                        ['text' => '6', 'text_ar' => '٦', 'correct' => false],
                        ['text' => '8', 'text_ar' => '٨', 'correct' => false],
                        ['text' => '5', 'text_ar' => '٥', 'correct' => false],
                    ]],
                    ['text' => 'What is the tallest animal in the world?', 'text_ar' => 'ما أطول حيوان في العالم؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Giraffe',   'text_ar' => 'الزرافة',    'correct' => true],
                        ['text' => 'Elephant',  'text_ar' => 'الفيل',      'correct' => false],
                        ['text' => 'Ostrich',   'text_ar' => 'النعامة',    'correct' => false],
                        ['text' => 'Moose',     'text_ar' => 'الموظ',      'correct' => false],
                    ]],
                    ['text' => 'How many planets are in our solar system?', 'text_ar' => 'كم عدد الكواكب في مجموعتنا الشمسية؟', 'points' => 100, 'hint' => 'Pluto was reclassified in 2006', 'hint_ar' => 'أُعيد تصنيف بلوتو عام ٢٠٠٦', 'answers' => [
                        ['text' => '8',  'text_ar' => '٨',  'correct' => true],
                        ['text' => '9',  'text_ar' => '٩',  'correct' => false],
                        ['text' => '7',  'text_ar' => '٧',  'correct' => false],
                        ['text' => '10', 'text_ar' => '١٠', 'correct' => false],
                    ]],
                    ['text' => 'What is the most spoken language in the world by native speakers?', 'text_ar' => 'ما أكثر اللغات المتحدثة في العالم من حيث الناطقين بها لغةً أم؟', 'points' => 120, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Mandarin Chinese', 'text_ar' => 'الصينية الماندارينية', 'correct' => true],
                        ['text' => 'English',          'text_ar' => 'الإنجليزية',           'correct' => false],
                        ['text' => 'Spanish',          'text_ar' => 'الإسبانية',            'correct' => false],
                        ['text' => 'Hindi',            'text_ar' => 'الهندية',              'correct' => false],
                    ]],
                    ['text' => 'What is the only mammal capable of true flight?', 'text_ar' => 'ما الثديي الوحيد القادر على الطيران الحقيقي؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Bat',      'text_ar' => 'الخفاش',     'correct' => true],
                        ['text' => 'Squirrel', 'text_ar' => 'السنجاب',    'correct' => false],
                        ['text' => 'Flying fox', 'text_ar' => 'الثعلب الطائر', 'correct' => false],
                        ['text' => 'Sugar glider', 'text_ar' => 'السنجاب السكري', 'correct' => false],
                    ]],
                    ['text' => 'How long does it take light from the Sun to reach Earth?', 'text_ar' => 'كم يستغرق الضوء للانتقال من الشمس إلى الأرض؟', 'points' => 150, 'hint' => 'Between 8 and 9 minutes', 'hint_ar' => 'بين ٨ و٩ دقائق', 'answers' => [
                        ['text' => 'About 8 minutes',  'text_ar' => 'حوالي ٨ دقائق',       'correct' => true],
                        ['text' => 'About 1 minute',   'text_ar' => 'حوالي دقيقة واحدة',   'correct' => false],
                        ['text' => 'About 1 hour',     'text_ar' => 'حوالي ساعة',           'correct' => false],
                        ['text' => 'About 24 minutes', 'text_ar' => 'حوالي ٢٤ دقيقة',      'correct' => false],
                    ]],
                    ['text' => 'Which blood type is known as the universal donor?', 'text_ar' => 'أي فصيلة دم تُعرف بالمتبرع العالمي؟', 'points' => 120, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'O negative', 'text_ar' => 'O سالب', 'correct' => true],
                        ['text' => 'A positive', 'text_ar' => 'A موجب', 'correct' => false],
                        ['text' => 'AB positive', 'text_ar' => 'AB موجب', 'correct' => false],
                        ['text' => 'B negative', 'text_ar' => 'B سالب', 'correct' => false],
                    ]],
                    ['text' => 'What is the fear of spiders called?', 'text_ar' => 'ما اسم الرهاب من العناكب؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Arachnophobia', 'text_ar' => 'رهاب العناكب',   'correct' => true],
                        ['text' => 'Agoraphobia',   'text_ar' => 'رهاب الأماكن المفتوحة', 'correct' => false],
                        ['text' => 'Acrophobia',    'text_ar' => 'رهاب الارتفاعات', 'correct' => false],
                        ['text' => 'Claustrophobia', 'text_ar' => 'رهاب الأماكن المغلقة', 'correct' => false],
                    ]],
                    ['text' => 'How many bones does an adult human body have?', 'text_ar' => 'كم عدد عظام جسم الإنسان البالغ؟', 'points' => 120, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => '206', 'text_ar' => '٢٠٦', 'correct' => true],
                        ['text' => '182', 'text_ar' => '١٨٢', 'correct' => false],
                        ['text' => '250', 'text_ar' => '٢٥٠', 'correct' => false],
                        ['text' => '300', 'text_ar' => '٣٠٠', 'correct' => false],
                    ]],
                    ['text' => 'What is the chemical symbol for gold?', 'text_ar' => 'ما الرمز الكيميائي للذهب؟', 'points' => 100, 'hint' => 'From the Latin "aurum"', 'hint_ar' => 'من الكلمة اللاتينية "أوروم"', 'answers' => [
                        ['text' => 'Au', 'text_ar' => 'Au', 'correct' => true],
                        ['text' => 'Go', 'text_ar' => 'Go', 'correct' => false],
                        ['text' => 'Gd', 'text_ar' => 'Gd', 'correct' => false],
                        ['text' => 'Ag', 'text_ar' => 'Ag', 'correct' => false],
                    ]],
                ],
            ],
            [
                'title' => 'Deep Cut Tech',
                'title_ar' => 'تقنية من العيار الثقيل',
                'description' => 'Beyond "what does CPU stand for" — real nerdy trivia for the curious.',
                'description_ar' => 'أبعد من "ماذا يعني CPU" — معلومات تقنية حقيقية للمهتمين.',
                'category' => 'technology',
                'difficulty' => 'hard',
                'cover_emoji' => '💾',
                'time_limit_per_question' => 25,
                'questions' => [
                    ['text' => 'Which Unix command is used to display the first 10 lines of a file by default?', 'text_ar' => 'أي أمر Unix يعرض الأسطر العشرة الأولى من الملف افتراضياً؟', 'points' => 120, 'hint' => 'The opposite of tail', 'hint_ar' => 'عكس الأمر tail', 'answers' => [
                        ['text' => 'head',  'text_ar' => 'head',  'correct' => true],
                        ['text' => 'top',   'text_ar' => 'top',   'correct' => false],
                        ['text' => 'peek',  'text_ar' => 'peek',  'correct' => false],
                        ['text' => 'front', 'text_ar' => 'front', 'correct' => false],
                    ]],
                    ['text' => 'What does the "S" in HTTPS stand for?', 'text_ar' => 'ماذا يعني حرف "S" في HTTPS؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Secure',     'text_ar' => 'آمن (Secure)',     'correct' => true],
                        ['text' => 'Safe',       'text_ar' => 'سالم (Safe)',      'correct' => false],
                        ['text' => 'Standard',   'text_ar' => 'قياسي (Standard)', 'correct' => false],
                        ['text' => 'Structured', 'text_ar' => 'منظم (Structured)', 'correct' => false],
                    ]],
                    ['text' => 'What was the first computer virus ever created, released in 1971?', 'text_ar' => 'ما كان أول فيروس حاسوبي تم إنشاؤه عام ١٩٧١؟', 'points' => 200, 'hint' => 'It spread via ARPANET', 'hint_ar' => 'انتشر عبر شبكة ARPANET', 'answers' => [
                        ['text' => 'Creeper',    'text_ar' => 'كريبر (Creeper)',    'correct' => true],
                        ['text' => 'Morris',     'text_ar' => 'موريس (Morris)',     'correct' => false],
                        ['text' => 'Elk Cloner', 'text_ar' => 'إلك كلونر',          'correct' => false],
                        ['text' => 'Brain',      'text_ar' => 'براين (Brain)',       'correct' => false],
                    ]],
                    ['text' => 'Which company owns Android?', 'text_ar' => 'أي شركة تمتلك نظام أندرويد؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Google',    'text_ar' => 'جوجل',    'correct' => true],
                        ['text' => 'Samsung',   'text_ar' => 'سامسونج', 'correct' => false],
                        ['text' => 'Qualcomm',  'text_ar' => 'كوالكوم', 'correct' => false],
                        ['text' => 'Meta',      'text_ar' => 'ميتا',    'correct' => false],
                    ]],
                    ['text' => 'In CSS, what property controls the stacking order of overlapping elements?', 'text_ar' => 'في CSS، أي خاصية تتحكم في ترتيب تكديس العناصر المتداخلة؟', 'points' => 150, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'z-index',     'text_ar' => 'z-index',     'correct' => true],
                        ['text' => 'stack-order', 'text_ar' => 'stack-order', 'correct' => false],
                        ['text' => 'layer',       'text_ar' => 'layer',       'correct' => false],
                        ['text' => 'depth',       'text_ar' => 'depth',       'correct' => false],
                    ]],
                    ['text' => 'What does RAM stand for?', 'text_ar' => 'ماذا يعني اختصار RAM؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Random Access Memory',    'text_ar' => 'ذاكرة الوصول العشوائي', 'correct' => true],
                        ['text' => 'Rapid Application Memory', 'text_ar' => 'ذاكرة التطبيقات السريعة', 'correct' => false],
                        ['text' => 'Read and Modify',         'text_ar' => 'قراءة وتعديل',          'correct' => false],
                        ['text' => 'Runtime Allocation Module', 'text_ar' => 'وحدة تخصيص وقت التشغيل', 'correct' => false],
                    ]],
                    ['text' => 'Which programming language was created by Guido van Rossum?', 'text_ar' => 'أي لغة برمجة أنشأها غيدو فان روسوم؟', 'points' => 120, 'hint' => 'Named after a British comedy group', 'hint_ar' => 'سُميت باسم فرقة كوميدية بريطانية', 'answers' => [
                        ['text' => 'Python', 'text_ar' => 'بايثون', 'correct' => true],
                        ['text' => 'Ruby',   'text_ar' => 'روبي',   'correct' => false],
                        ['text' => 'Perl',   'text_ar' => 'بيرل',   'correct' => false],
                        ['text' => 'Swift',  'text_ar' => 'سويفت',  'correct' => false],
                    ]],
                    ['text' => 'What is the default port for MySQL?', 'text_ar' => 'ما المنفذ الافتراضي لـ MySQL؟', 'points' => 150, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => '3306', 'text_ar' => '٣٣٠٦', 'correct' => true],
                        ['text' => '5432', 'text_ar' => '٥٤٣٢', 'correct' => false],
                        ['text' => '1433', 'text_ar' => '١٤٣٣', 'correct' => false],
                        ['text' => '8080', 'text_ar' => '٨٠٨٠', 'correct' => false],
                    ]],
                    ['text' => 'What year was the first iPhone released?', 'text_ar' => 'في أي عام صدر أول هاتف آيفون؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => '2007', 'text_ar' => '٢٠٠٧', 'correct' => true],
                        ['text' => '2005', 'text_ar' => '٢٠٠٥', 'correct' => false],
                        ['text' => '2008', 'text_ar' => '٢٠٠٨', 'correct' => false],
                        ['text' => '2006', 'text_ar' => '٢٠٠٦', 'correct' => false],
                    ]],
                    ['text' => 'The term "bug" in programming was popularized when a real insect was found inside which machine?', 'text_ar' => 'شاع مصطلح "bug" في البرمجة بعد العثور على حشرة حقيقية داخل أي جهاز؟', 'points' => 200, 'hint' => 'A moth was taped into the logbook', 'hint_ar' => 'تم لصق عثة في سجل الجهاز', 'answers' => [
                        ['text' => 'Harvard Mark II', 'text_ar' => 'هارفارد مارك II', 'correct' => true],
                        ['text' => 'ENIAC',           'text_ar' => 'إنياك ENIAC',     'correct' => false],
                        ['text' => 'IBM 701',         'text_ar' => 'آي بي إم 701',    'correct' => false],
                        ['text' => 'UNIVAC',          'text_ar' => 'يونيفاك UNIVAC',  'correct' => false],
                    ]],
                    ['text' => 'What does "Wi-Fi" stand for?', 'text_ar' => 'ماذا يعني اختصار Wi-Fi؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'It doesn\'t stand for anything — it\'s a brand name', 'text_ar' => 'لا يعني شيئاً — هو مجرد اسم تجاري', 'correct' => true],
                        ['text' => 'Wireless Fidelity',  'text_ar' => 'دقة لاسلكية',     'correct' => false],
                        ['text' => 'Wide Frequency',     'text_ar' => 'تردد واسع',        'correct' => false],
                        ['text' => 'Wireless Fiber',     'text_ar' => 'ألياف لاسلكية',    'correct' => false],
                    ]],
                    ['text' => 'What does "www" stand for in a web address?', 'text_ar' => 'ماذا يعني اختصار "www" في عنوان الويب؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'World Wide Web',    'text_ar' => 'الشبكة العنكبوتية العالمية', 'correct' => true],
                        ['text' => 'World Web Waypoint', 'text_ar' => 'نقطة الويب العالمية',       'correct' => false],
                        ['text' => 'Wide Web Window',   'text_ar' => 'نافذة الويب الواسعة',       'correct' => false],
                        ['text' => 'Worldwide Weblink', 'text_ar' => 'رابط الويب العالمي',        'correct' => false],
                    ]],
                    ['text' => 'Which company makes the iPhone?', 'text_ar' => 'أي شركة تصنع هاتف آيفون؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Apple',   'text_ar' => 'آبل',    'correct' => true],
                        ['text' => 'Samsung', 'text_ar' => 'سامسونج', 'correct' => false],
                        ['text' => 'Google',  'text_ar' => 'جوجل',   'correct' => false],
                        ['text' => 'Sony',    'text_ar' => 'سوني',   'correct' => false],
                    ]],
                    ['text' => 'What is the most popular social media platform in the world by monthly users?', 'text_ar' => 'ما أكثر منصات التواصل الاجتماعي شعبيةً في العالم من حيث المستخدمين الشهريين؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Facebook',  'text_ar' => 'فيسبوك',  'correct' => true],
                        ['text' => 'YouTube',   'text_ar' => 'يوتيوب',  'correct' => false],
                        ['text' => 'Instagram', 'text_ar' => 'إنستغرام', 'correct' => false],
                        ['text' => 'TikTok',    'text_ar' => 'تيك توك', 'correct' => false],
                    ]],
                    ['text' => 'What does "USB" stand for?', 'text_ar' => 'ماذا يعني اختصار USB؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Universal Serial Bus',    'text_ar' => 'ناقل تسلسلي عالمي',        'correct' => true],
                        ['text' => 'Unified System Bridge',   'text_ar' => 'جسر النظام الموحد',        'correct' => false],
                        ['text' => 'Universal Storage Board', 'text_ar' => 'لوحة التخزين العالمية',    'correct' => false],
                        ['text' => 'Universal Sync Bus',      'text_ar' => 'ناقل المزامنة العالمي',    'correct' => false],
                    ]],
                    ['text' => 'Which search engine has the highest market share worldwide?', 'text_ar' => 'أي محرك بحث يمتلك أعلى حصة في السوق العالمي؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Google',     'text_ar' => 'جوجل',      'correct' => true],
                        ['text' => 'Bing',       'text_ar' => 'بينج',      'correct' => false],
                        ['text' => 'Yahoo',      'text_ar' => 'ياهو',      'correct' => false],
                        ['text' => 'DuckDuckGo', 'text_ar' => 'داك داك جو', 'correct' => false],
                    ]],
                    ['text' => 'What does "SQL" stand for?', 'text_ar' => 'ماذا يعني اختصار SQL؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Structured Query Language',  'text_ar' => 'لغة الاستعلام الهيكلية',   'correct' => true],
                        ['text' => 'Sequential Query Language',  'text_ar' => 'لغة الاستعلام التسلسلية',  'correct' => false],
                        ['text' => 'Simple Query Language',      'text_ar' => 'لغة الاستعلام البسيطة',    'correct' => false],
                        ['text' => 'Standard Query Logic',       'text_ar' => 'منطق الاستعلام القياسي',   'correct' => false],
                    ]],
                    ['text' => 'Which programming language is most commonly used for iOS app development?', 'text_ar' => 'أي لغة برمجة تُستخدم في الغالب لتطوير تطبيقات iOS؟', 'points' => 120, 'hint' => 'Developed by Apple in 2014', 'hint_ar' => 'طورتها آبل عام ٢٠١٤', 'answers' => [
                        ['text' => 'Swift',      'text_ar' => 'سويفت',      'correct' => true],
                        ['text' => 'Kotlin',     'text_ar' => 'كوتلن',      'correct' => false],
                        ['text' => 'Objective-C', 'text_ar' => 'أوبجكتيف-C', 'correct' => false],
                        ['text' => 'Java',       'text_ar' => 'جافا',       'correct' => false],
                    ]],
                    ['text' => 'What does "HTTP" stand for?', 'text_ar' => 'ماذا يعني اختصار HTTP؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'HyperText Transfer Protocol',  'text_ar' => 'بروتوكول نقل النص التشعبي',    'correct' => true],
                        ['text' => 'HyperText Transmission Protocol', 'text_ar' => 'بروتوكول إرسال النص التشعبي', 'correct' => false],
                        ['text' => 'High Transfer Text Protocol',  'text_ar' => 'بروتوكول نقل النص العالي',    'correct' => false],
                        ['text' => 'Hybrid Text Transfer Protocol', 'text_ar' => 'بروتوكول نقل النص الهجين',    'correct' => false],
                    ]],
                    ['text' => 'In Git, what command is used to save changes to the local repository?', 'text_ar' => 'في Git، أي أمر يُستخدم لحفظ التغييرات في المستودع المحلي؟', 'points' => 120, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'git commit', 'text_ar' => 'git commit', 'correct' => true],
                        ['text' => 'git push',   'text_ar' => 'git push',   'correct' => false],
                        ['text' => 'git save',   'text_ar' => 'git save',   'correct' => false],
                        ['text' => 'git store',  'text_ar' => 'git store',  'correct' => false],
                    ]],
                    ['text' => 'Which company developed the JavaScript programming language?', 'text_ar' => 'أي شركة طورت لغة البرمجة JavaScript؟', 'points' => 120, 'hint' => 'Created in 10 days in 1995', 'hint_ar' => 'أُنشئت في ١٠ أيام عام ١٩٩٥', 'answers' => [
                        ['text' => 'Netscape',  'text_ar' => 'نتسكيب',   'correct' => true],
                        ['text' => 'Microsoft', 'text_ar' => 'مايكروسوفت', 'correct' => false],
                        ['text' => 'Sun',       'text_ar' => 'سن',        'correct' => false],
                        ['text' => 'Apple',     'text_ar' => 'آبل',       'correct' => false],
                    ]],
                ],
            ],
            [
                'title' => 'Forgotten Geography',
                'title_ar' => 'جغرافيا منسية',
                'description' => 'Not capitals and continents — the places textbooks skip.',
                'description_ar' => 'ليست عواصم وقارات — أماكن تتجاهلها الكتب المدرسية.',
                'category' => 'geography',
                'difficulty' => 'medium',
                'cover_emoji' => '🗺️',
                'time_limit_per_question' => 20,
                'questions' => [
                    ['text' => 'Which country has the most time zones?', 'text_ar' => 'أي دولة لديها أكبر عدد من المناطق الزمنية؟', 'points' => 150, 'hint' => 'Not Russia or the USA', 'hint_ar' => 'ليست روسيا ولا الولايات المتحدة', 'answers' => [
                        ['text' => 'France',  'text_ar' => 'فرنسا',              'correct' => true],
                        ['text' => 'Russia',  'text_ar' => 'روسيا',              'correct' => false],
                        ['text' => 'USA',     'text_ar' => 'الولايات المتحدة',   'correct' => false],
                        ['text' => 'UK',      'text_ar' => 'المملكة المتحدة',    'correct' => false],
                    ]],
                    ['text' => 'What is the only country that borders both the Atlantic and Indian Oceans?', 'text_ar' => 'ما الدولة الوحيدة التي تطل على المحيطين الأطلسي والهندي معاً؟', 'points' => 150, 'hint' => 'Located at the southern tip of Africa', 'hint_ar' => 'تقع في الطرف الجنوبي لأفريقيا', 'answers' => [
                        ['text' => 'South Africa', 'text_ar' => 'جنوب أفريقيا', 'correct' => true],
                        ['text' => 'Mozambique',   'text_ar' => 'موزمبيق',       'correct' => false],
                        ['text' => 'Angola',       'text_ar' => 'أنغولا',        'correct' => false],
                        ['text' => 'Namibia',      'text_ar' => 'ناميبيا',       'correct' => false],
                    ]],
                    ['text' => 'Which sea is the saltiest body of water on Earth?', 'text_ar' => 'أي بحر هو أملح مسطح مائي على وجه الأرض؟', 'points' => 150, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Dead Sea',    'text_ar' => 'البحر الميت',   'correct' => true],
                        ['text' => 'Red Sea',     'text_ar' => 'البحر الأحمر',  'correct' => false],
                        ['text' => 'Caspian Sea', 'text_ar' => 'بحر قزوين',     'correct' => false],
                        ['text' => 'Salton Sea',  'text_ar' => 'بحر سالتون',    'correct' => false],
                    ]],
                    ['text' => 'What is the smallest country in South America by area?', 'text_ar' => 'ما أصغر دولة في أمريكا الجنوبية من حيث المساحة؟', 'points' => 150, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Suriname', 'text_ar' => 'سورينام', 'correct' => true],
                        ['text' => 'Uruguay',  'text_ar' => 'أوروغواي', 'correct' => false],
                        ['text' => 'Ecuador',  'text_ar' => 'الإكوادور', 'correct' => false],
                        ['text' => 'Guyana',   'text_ar' => 'غيانا',   'correct' => false],
                    ]],
                    ['text' => 'Istanbul sits on which two continents?', 'text_ar' => 'على أي قارتين تقع مدينة إسطنبول؟', 'points' => 120, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Europe and Asia',        'text_ar' => 'أوروبا وآسيا',        'correct' => true],
                        ['text' => 'Europe and Africa',      'text_ar' => 'أوروبا وأفريقيا',     'correct' => false],
                        ['text' => 'Asia and Africa',        'text_ar' => 'آسيا وأفريقيا',       'correct' => false],
                        ['text' => 'Europe and Middle East', 'text_ar' => 'أوروبا والشرق الأوسط', 'correct' => false],
                    ]],
                    ['text' => 'Which African country was never colonized by a European power?', 'text_ar' => 'أي دولة أفريقية لم تُستعمر قط من قبل قوة أوروبية؟', 'points' => 200, 'hint' => 'It defeated Italy at the Battle of Adwa in 1896', 'hint_ar' => 'هزمت إيطاليا في معركة عدوة عام ١٨٩٦', 'answers' => [
                        ['text' => 'Ethiopia', 'text_ar' => 'إثيوبيا', 'correct' => true],
                        ['text' => 'Liberia',  'text_ar' => 'ليبيريا', 'correct' => false],
                        ['text' => 'Egypt',    'text_ar' => 'مصر',     'correct' => false],
                        ['text' => 'Somalia',  'text_ar' => 'الصومال', 'correct' => false],
                    ]],
                    ['text' => 'What is the name of the largest desert in the world?', 'text_ar' => 'ما اسم أكبر صحراء في العالم؟', 'points' => 150, 'hint' => 'It\'s not the Sahara', 'hint_ar' => 'ليست الصحراء الكبرى', 'answers' => [
                        ['text' => 'Antarctic Desert', 'text_ar' => 'الصحراء القطبية الجنوبية', 'correct' => true],
                        ['text' => 'Sahara Desert',    'text_ar' => 'الصحراء الكبرى',           'correct' => false],
                        ['text' => 'Arabian Desert',   'text_ar' => 'الصحراء العربية',          'correct' => false],
                        ['text' => 'Gobi Desert',      'text_ar' => 'صحراء جوبي',               'correct' => false],
                    ]],
                    ['text' => 'The Mariana Trench is located in which ocean?', 'text_ar' => 'في أي محيط يقع خندق ماريانا؟', 'points' => 120, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Pacific Ocean',  'text_ar' => 'المحيط الهادئ',    'correct' => true],
                        ['text' => 'Atlantic Ocean', 'text_ar' => 'المحيط الأطلسي',   'correct' => false],
                        ['text' => 'Indian Ocean',   'text_ar' => 'المحيط الهندي',    'correct' => false],
                        ['text' => 'Arctic Ocean',   'text_ar' => 'المحيط المتجمد الشمالي', 'correct' => false],
                    ]],
                    ['text' => 'What is the capital of Australia?', 'text_ar' => 'ما عاصمة أستراليا؟', 'points' => 100, 'hint' => 'Not Sydney', 'hint_ar' => 'ليست سيدني', 'answers' => [
                        ['text' => 'Canberra',  'text_ar' => 'كانبيرا',   'correct' => true],
                        ['text' => 'Sydney',    'text_ar' => 'سيدني',     'correct' => false],
                        ['text' => 'Melbourne', 'text_ar' => 'ملبورن',    'correct' => false],
                        ['text' => 'Brisbane',  'text_ar' => 'بريزبين',   'correct' => false],
                    ]],
                    ['text' => 'How many countries are in Africa?', 'text_ar' => 'كم عدد دول القارة الأفريقية؟', 'points' => 120, 'hint' => 'More than 50', 'hint_ar' => 'أكثر من ٥٠', 'answers' => [
                        ['text' => '54', 'text_ar' => '٥٤', 'correct' => true],
                        ['text' => '48', 'text_ar' => '٤٨', 'correct' => false],
                        ['text' => '60', 'text_ar' => '٦٠', 'correct' => false],
                        ['text' => '44', 'text_ar' => '٤٤', 'correct' => false],
                    ]],
                    ['text' => 'Which country is both a continent and a country?', 'text_ar' => 'أي دولة تُعدّ قارة ودولة في آنٍ واحد؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Australia',   'text_ar' => 'أستراليا',   'correct' => true],
                        ['text' => 'Greenland',   'text_ar' => 'غرينلاند',   'correct' => false],
                        ['text' => 'Antarctica',  'text_ar' => 'أنتاركتيكا', 'correct' => false],
                        ['text' => 'New Zealand', 'text_ar' => 'نيوزيلندا',  'correct' => false],
                    ]],
                    ['text' => 'What is the capital of Canada?', 'text_ar' => 'ما عاصمة كندا؟', 'points' => 100, 'hint' => 'Not Toronto', 'hint_ar' => 'ليست تورنتو', 'answers' => [
                        ['text' => 'Ottawa',    'text_ar' => 'أوتاوا',   'correct' => true],
                        ['text' => 'Toronto',   'text_ar' => 'تورنتو',   'correct' => false],
                        ['text' => 'Vancouver', 'text_ar' => 'فانكوفر',  'correct' => false],
                        ['text' => 'Montreal',  'text_ar' => 'مونتريال', 'correct' => false],
                    ]],
                    ['text' => 'Which country has the longest coastline in the world?', 'text_ar' => 'أي دولة تمتلك أطول ساحل بحري في العالم؟', 'points' => 120, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Canada',    'text_ar' => 'كندا',      'correct' => true],
                        ['text' => 'Russia',    'text_ar' => 'روسيا',     'correct' => false],
                        ['text' => 'Norway',    'text_ar' => 'النرويج',   'correct' => false],
                        ['text' => 'Australia', 'text_ar' => 'أستراليا',  'correct' => false],
                    ]],
                    ['text' => 'What is the smallest country in the world?', 'text_ar' => 'ما أصغر دولة في العالم؟', 'points' => 100, 'hint' => 'It\'s inside Rome', 'hint_ar' => 'تقع داخل مدينة روما', 'answers' => [
                        ['text' => 'Vatican City',   'text_ar' => 'الفاتيكان',   'correct' => true],
                        ['text' => 'Monaco',         'text_ar' => 'موناكو',      'correct' => false],
                        ['text' => 'San Marino',     'text_ar' => 'سان مارينو', 'correct' => false],
                        ['text' => 'Liechtenstein',  'text_ar' => 'ليختنشتاين', 'correct' => false],
                    ]],
                    ['text' => 'What is the largest ocean on Earth?', 'text_ar' => 'ما أكبر محيط على وجه الأرض؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Pacific Ocean',  'text_ar' => 'المحيط الهادئ',  'correct' => true],
                        ['text' => 'Atlantic Ocean', 'text_ar' => 'المحيط الأطلسي', 'correct' => false],
                        ['text' => 'Indian Ocean',   'text_ar' => 'المحيط الهندي',  'correct' => false],
                        ['text' => 'Arctic Ocean',   'text_ar' => 'المحيط المتجمد الشمالي', 'correct' => false],
                    ]],
                    ['text' => 'Which country has the largest population in the world?', 'text_ar' => 'أي دولة تمتلك أكبر عدد من السكان في العالم؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'India',  'text_ar' => 'الهند',  'correct' => true],
                        ['text' => 'China',  'text_ar' => 'الصين',  'correct' => false],
                        ['text' => 'USA',    'text_ar' => 'الولايات المتحدة', 'correct' => false],
                        ['text' => 'Brazil', 'text_ar' => 'البرازيل', 'correct' => false],
                    ]],
                    ['text' => 'What is the longest river in the world?', 'text_ar' => 'ما أطول نهر في العالم؟', 'points' => 120, 'hint' => 'Flows through northeastern Africa', 'hint_ar' => 'يجري عبر شمال شرق أفريقيا', 'answers' => [
                        ['text' => 'Nile',    'text_ar' => 'النيل',    'correct' => true],
                        ['text' => 'Amazon',  'text_ar' => 'الأمازون', 'correct' => false],
                        ['text' => 'Yangtze', 'text_ar' => 'اليانغتسي', 'correct' => false],
                        ['text' => 'Mississippi', 'text_ar' => 'المسيسيبي', 'correct' => false],
                    ]],
                    ['text' => 'Which mountain is the tallest in the world?', 'text_ar' => 'أي جبل هو الأعلى في العالم؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Mount Everest', 'text_ar' => 'جبل إيفرست', 'correct' => true],
                        ['text' => 'K2',            'text_ar' => 'K2',          'correct' => false],
                        ['text' => 'Kangchenjunga', 'text_ar' => 'كانغتشينجونغا', 'correct' => false],
                        ['text' => 'Mont Blanc',    'text_ar' => 'مون بلان',    'correct' => false],
                    ]],
                    ['text' => 'Which country has the most natural lakes in the world?', 'text_ar' => 'أي دولة تمتلك أكبر عدد من البحيرات الطبيعية في العالم؟', 'points' => 150, 'hint' => 'Over 60% of the world\'s lakes are here', 'hint_ar' => 'تضم أكثر من ٦٠٪ من بحيرات العالم', 'answers' => [
                        ['text' => 'Canada',    'text_ar' => 'كندا',     'correct' => true],
                        ['text' => 'Russia',    'text_ar' => 'روسيا',    'correct' => false],
                        ['text' => 'Finland',   'text_ar' => 'فنلندا',   'correct' => false],
                        ['text' => 'Sweden',    'text_ar' => 'السويد',   'correct' => false],
                    ]],
                ],
            ],
            [
                'title' => 'Food Science & Myths',
                'title_ar' => 'علم الطعام وأساطيره',
                'description' => 'Things you thought you knew about food — and the surprising truth.',
                'description_ar' => 'أشياء ظننت أنك تعرفها عن الطعام — والحقيقة المفاجئة.',
                'category' => 'food',
                'difficulty' => 'medium',
                'cover_emoji' => '🍽️',
                'time_limit_per_question' => 20,
                'questions' => [
                    ['text' => 'Technically speaking, is a tomato a fruit or a vegetable?', 'text_ar' => 'من الناحية العلمية، هل الطماطم فاكهة أم خضروات؟', 'points' => 100, 'hint' => 'Botanically, not culinarily', 'hint_ar' => 'من المنظور النباتي لا الطهي', 'answers' => [
                        ['text' => 'Fruit',      'text_ar' => 'فاكهة',        'correct' => true],
                        ['text' => 'Vegetable',  'text_ar' => 'خضروات',       'correct' => false],
                        ['text' => 'Both legally', 'text_ar' => 'كلاهما قانونياً', 'correct' => false],
                        ['text' => 'Neither',    'text_ar' => 'لا هذا ولا ذاك', 'correct' => false],
                    ]],
                    ['text' => 'Wasabi served in most sushi restaurants outside Japan is actually made from what?', 'text_ar' => 'مم يُصنع الواسابي في معظم مطاعم السوشي خارج اليابان؟', 'points' => 150, 'hint' => 'Look at the ingredients', 'hint_ar' => 'انظر إلى قائمة المكونات', 'answers' => [
                        ['text' => 'Horseradish and food coloring', 'text_ar' => 'الفجل الحار وصبغة الطعام', 'correct' => true],
                        ['text' => 'Mustard and spinach',           'text_ar' => 'الخردل والسبانخ',           'correct' => false],
                        ['text' => 'Ginger paste',                  'text_ar' => 'معجون الزنجبيل',            'correct' => false],
                        ['text' => 'Dried wasabi powder',           'text_ar' => 'مسحوق الواسابي المجفف',    'correct' => false],
                    ]],
                    ['text' => 'Which spice is more expensive by weight than gold?', 'text_ar' => 'أي بهار يفوق الذهب ثمناً بالوزن؟', 'points' => 150, 'hint' => 'Used in paella and risotto', 'hint_ar' => 'يُستخدم في البايلا والريزوتو', 'answers' => [
                        ['text' => 'Saffron',   'text_ar' => 'الزعفران', 'correct' => true],
                        ['text' => 'Vanilla',   'text_ar' => 'الفانيليا', 'correct' => false],
                        ['text' => 'Cardamom',  'text_ar' => 'الهيل',    'correct' => false],
                        ['text' => 'Truffle',   'text_ar' => 'الكمأة',   'correct' => false],
                    ]],
                    ['text' => 'What gives red wine its red color?', 'text_ar' => 'ما الذي يمنح النبيذ الأحمر لونه؟', 'points' => 120, 'hint' => 'It\'s in the grape skin', 'hint_ar' => 'يوجد في قشر العنب', 'answers' => [
                        ['text' => 'Anthocyanins from grape skins',      'text_ar' => 'الأنثوسيانين من قشر العنب',     'correct' => true],
                        ['text' => 'Tannins from the barrel',            'text_ar' => 'العفص من البرميل',               'correct' => false],
                        ['text' => 'Natural grape pigment in the juice', 'text_ar' => 'صبغة العنب الطبيعية في العصير', 'correct' => false],
                        ['text' => 'Oxidation during fermentation',      'text_ar' => 'الأكسدة أثناء التخمر',          'correct' => false],
                    ]],
                    ['text' => 'Dry pasta was reportedly invented by which ancient civilization?', 'text_ar' => 'أي حضارة قديمة يُنسب إليها اختراع المعكرونة الجافة؟', 'points' => 150, 'hint' => 'Not Italian', 'hint_ar' => 'ليست إيطالية', 'answers' => [
                        ['text' => 'Chinese', 'text_ar' => 'الصينية',  'correct' => true],
                        ['text' => 'Roman',   'text_ar' => 'الرومانية', 'correct' => false],
                        ['text' => 'Arab',    'text_ar' => 'العربية',  'correct' => false],
                        ['text' => 'Greek',   'text_ar' => 'اليونانية', 'correct' => false],
                    ]],
                    ['text' => 'What causes the burning sensation when eating chili peppers?', 'text_ar' => 'ما الذي يسبب الإحساس بالحرقة عند تناول الفلفل الحار؟', 'points' => 120, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Capsaicin', 'text_ar' => 'الكابسايسين', 'correct' => true],
                        ['text' => 'Piperine',  'text_ar' => 'البيبيرين',   'correct' => false],
                        ['text' => 'Allicin',   'text_ar' => 'الأليسين',    'correct' => false],
                        ['text' => 'Solanine',  'text_ar' => 'السولانين',   'correct' => false],
                    ]],
                    ['text' => 'Honey is the only natural food that never spoils — what makes this possible?', 'text_ar' => 'العسل هو الغذاء الطبيعي الوحيد الذي لا يفسد — ما الذي يجعل ذلك ممكناً؟', 'points' => 150, 'hint' => 'Related to moisture content and pH', 'hint_ar' => 'مرتبط بمحتوى الرطوبة ودرجة الحموضة', 'answers' => [
                        ['text' => 'Low water activity and natural hydrogen peroxide', 'text_ar' => 'انخفاض نشاط الماء وبيروكسيد الهيدروجين الطبيعي', 'correct' => true],
                        ['text' => 'High sugar content alone',                        'text_ar' => 'ارتفاع محتوى السكر وحده',                          'correct' => false],
                        ['text' => 'Bee enzymes that act as preservatives',           'text_ar' => 'إنزيمات النحل التي تعمل كمواد حافظة',              'correct' => false],
                        ['text' => 'It crystallizes and seals itself',                'text_ar' => 'يتبلور ويختم نفسه',                                 'correct' => false],
                    ]],
                    ['text' => 'What percentage of the world\'s vanilla flavor is actually synthetic?', 'text_ar' => 'ما نسبة نكهة الفانيليا في العالم التي هي في الواقع اصطناعية؟', 'points' => 150, 'hint' => 'Vanillin can be made from wood pulp', 'hint_ar' => 'يمكن صنع الفانيلين من لب الخشب', 'answers' => [
                        ['text' => 'Over 99%',     'text_ar' => 'أكثر من ٩٩٪',   'correct' => true],
                        ['text' => 'About 50%',    'text_ar' => 'حوالي ٥٠٪',     'correct' => false],
                        ['text' => 'Around 75%',   'text_ar' => 'نحو ٧٥٪',       'correct' => false],
                        ['text' => 'Less than 20%', 'text_ar' => 'أقل من ٢٠٪',    'correct' => false],
                    ]],
                    ['text' => 'What is the most consumed beverage in the world after water?', 'text_ar' => 'ما أكثر المشروبات استهلاكاً في العالم بعد الماء؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Tea',   'text_ar' => 'الشاي',   'correct' => true],
                        ['text' => 'Coffee', 'text_ar' => 'القهوة',  'correct' => false],
                        ['text' => 'Beer',  'text_ar' => 'البيرة',  'correct' => false],
                        ['text' => 'Milk',  'text_ar' => 'الحليب',  'correct' => false],
                    ]],
                    ['text' => 'Which country is the largest producer of coffee in the world?', 'text_ar' => 'أي دولة هي أكبر منتج للقهوة في العالم؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Brazil',   'text_ar' => 'البرازيل',  'correct' => true],
                        ['text' => 'Colombia', 'text_ar' => 'كولومبيا', 'correct' => false],
                        ['text' => 'Ethiopia', 'text_ar' => 'إثيوبيا',  'correct' => false],
                        ['text' => 'Vietnam',  'text_ar' => 'فيتنام',   'correct' => false],
                    ]],
                    ['text' => 'What food is known as the "king of fruits" in Southeast Asia?', 'text_ar' => 'ما الفاكهة المعروفة بـ"ملك الفواكه" في جنوب شرق آسيا؟', 'points' => 120, 'hint' => 'Famous for its strong smell', 'hint_ar' => 'مشهورة برائحتها القوية', 'answers' => [
                        ['text' => 'Durian',   'text_ar' => 'الدوريان', 'correct' => true],
                        ['text' => 'Mango',    'text_ar' => 'المانغو',  'correct' => false],
                        ['text' => 'Jackfruit', 'text_ar' => 'الجاك فروت', 'correct' => false],
                        ['text' => 'Papaya',   'text_ar' => 'البابايا', 'correct' => false],
                    ]],
                    ['text' => 'Which vitamin does the human body produce when exposed to sunlight?', 'text_ar' => 'أي فيتامين يُنتجه جسم الإنسان عند التعرض لأشعة الشمس؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Vitamin D',   'text_ar' => 'فيتامين د',  'correct' => true],
                        ['text' => 'Vitamin C',   'text_ar' => 'فيتامين ج',  'correct' => false],
                        ['text' => 'Vitamin A',   'text_ar' => 'فيتامين أ',  'correct' => false],
                        ['text' => 'Vitamin B12', 'text_ar' => 'فيتامين ب١٢', 'correct' => false],
                    ]],
                    ['text' => 'What is the main ingredient in traditional guacamole?', 'text_ar' => 'ما المكون الرئيسي في صلصة الغواكامولي التقليدية؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Avocado',   'text_ar' => 'الأفوكادو',  'correct' => true],
                        ['text' => 'Lime',      'text_ar' => 'الليمون',    'correct' => false],
                        ['text' => 'Tomato',    'text_ar' => 'الطماطم',    'correct' => false],
                        ['text' => 'Jalapeño',  'text_ar' => 'الخلاليو',   'correct' => false],
                    ]],
                    ['text' => 'How many calories are in one gram of fat?', 'text_ar' => 'كم عدد السعرات الحرارية في جرام واحد من الدهون؟', 'points' => 120, 'hint' => 'More than protein or carbs', 'hint_ar' => 'أكثر من البروتين أو الكربوهيدرات', 'answers' => [
                        ['text' => '9',  'text_ar' => '٩',  'correct' => true],
                        ['text' => '4',  'text_ar' => '٤',  'correct' => false],
                        ['text' => '7',  'text_ar' => '٧',  'correct' => false],
                        ['text' => '12', 'text_ar' => '١٢', 'correct' => false],
                    ]],
                    ['text' => 'Which nut is used to make marzipan?', 'text_ar' => 'أي مكسرات تُستخدم في صنع المارزيبان؟', 'points' => 120, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Almond',   'text_ar' => 'اللوز',    'correct' => true],
                        ['text' => 'Cashew',   'text_ar' => 'الكاجو',   'correct' => false],
                        ['text' => 'Pistachio', 'text_ar' => 'الفستق',   'correct' => false],
                        ['text' => 'Walnut',   'text_ar' => 'الجوز',    'correct' => false],
                    ]],
                    ['text' => 'What gas makes fizzy drinks fizzy?', 'text_ar' => 'أي غاز يجعل المشروبات الغازية فوّارة؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Carbon dioxide', 'text_ar' => 'ثاني أكسيد الكربون', 'correct' => true],
                        ['text' => 'Oxygen',         'text_ar' => 'الأكسجين',           'correct' => false],
                        ['text' => 'Nitrogen',       'text_ar' => 'النيتروجين',          'correct' => false],
                        ['text' => 'Hydrogen',       'text_ar' => 'الهيدروجين',          'correct' => false],
                    ]],
                    ['text' => 'Which country is the world\'s largest producer of olive oil?', 'text_ar' => 'أي دولة هي أكبر منتج لزيت الزيتون في العالم؟', 'points' => 120, 'hint' => 'Mediterranean country', 'hint_ar' => 'دولة متوسطية', 'answers' => [
                        ['text' => 'Spain',  'text_ar' => 'إسبانيا', 'correct' => true],
                        ['text' => 'Italy',  'text_ar' => 'إيطاليا', 'correct' => false],
                        ['text' => 'Greece', 'text_ar' => 'اليونان', 'correct' => false],
                        ['text' => 'Turkey', 'text_ar' => 'تركيا',   'correct' => false],
                    ]],
                    ['text' => 'What is the main ingredient in hummus?', 'text_ar' => 'ما المكون الرئيسي في الحمص؟', 'points' => 100, 'hint' => null, 'hint_ar' => null, 'answers' => [
                        ['text' => 'Chickpeas', 'text_ar' => 'حبوب الحمص', 'correct' => true],
                        ['text' => 'Lentils',   'text_ar' => 'العدس',      'correct' => false],
                        ['text' => 'Peas',      'text_ar' => 'البازلاء',   'correct' => false],
                        ['text' => 'Beans',     'text_ar' => 'الفاصولياء', 'correct' => false],
                    ]],
                    ['text' => 'How long can an unopened bottle of white wine typically be stored?', 'text_ar' => 'كم تدوم زجاجة النبيذ الأبيض غير المفتوحة عادةً؟', 'points' => 150, 'hint' => 'Shorter than red wine', 'hint_ar' => 'أقل من النبيذ الأحمر', 'answers' => [
                        ['text' => '1–2 years',  'text_ar' => 'سنة إلى سنتين',    'correct' => true],
                        ['text' => '10–20 years', 'text_ar' => '١٠ إلى ٢٠ سنة',   'correct' => false],
                        ['text' => '5–7 years',  'text_ar' => '٥ إلى ٧ سنوات',   'correct' => false],
                        ['text' => '6 months',   'text_ar' => '٦ أشهر',           'correct' => false],
                    ]],
                ],
            ],
        ];

        foreach ($quizzes as $quizData) {
            $questions = $quizData['questions'];
            unset($quizData['questions']);

            $quiz = Quiz::create($quizData);

            foreach ($questions as $order => $qData) {
                $answers = $qData['answers'];

                $question = Question::create([
                    'quiz_id' => $quiz->id,
                    'question_text' => $qData['text'],
                    'question_text_ar' => $qData['text_ar'],
                    'points' => $qData['points'],
                    'hint' => $qData['hint'],
                    'hint_ar' => $qData['hint_ar'],
                    'order' => $order,
                ]);

                foreach ($answers as $aOrder => $aData) {
                    Answer::create([
                        'question_id' => $question->id,
                        'answer_text' => $aData['text'],
                        'answer_text_ar' => $aData['text_ar'],
                        'is_correct' => $aData['correct'],
                        'order' => $aOrder,
                    ]);
                }
            }
        }
    }
}
