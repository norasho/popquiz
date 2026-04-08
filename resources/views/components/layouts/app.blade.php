@php $locale = session('locale', 'en'); $isRtl = $locale === 'ar'; @endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#030712">
    <title>PopQuiz 🎯</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700;900&family=Zain:wght@400;700;900&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        body, input, button, textarea { font-family: 'Nunito', sans-serif; }
        select { font-family: 'Zain', sans-serif; }
        @if($isRtl)
        body, input, button, textarea, select { font-family: 'Zain', sans-serif; }
        @endif
    </style>
</head>
<body class="bg-gray-950 text-white antialiased min-h-screen">
    <nav class="border-b border-gray-800 nav-blur sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 h-14 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2 font-black text-xl tracking-tight shrink-0">
                <span class="text-2xl">🎯</span>
                <span class="bg-gradient-to-r from-violet-400 to-pink-400 bg-clip-text text-transparent">PopQuiz</span>
            </a>
            <div class="flex items-center gap-2 text-sm text-gray-400">
                <a href="{{ route('home') }}" class="hidden sm:block hover:text-white transition-colors">{{ __('ui.browse') }}</a>
                <a href="{{ route('locale.switch', 'en') }}"
                   class="px-2.5 py-1 rounded-full text-xs font-bold transition-all {{ $locale === 'en' ? 'bg-violet-600 text-white' : 'bg-gray-800 text-gray-400 hover:text-white' }}">
                    EN
                </a>
                <a href="{{ route('locale.switch', 'ar') }}"
                   class="px-2.5 py-1 rounded-full text-xs font-bold transition-all font-arabic {{ $locale === 'ar' ? 'bg-violet-600 text-white' : 'bg-gray-800 text-gray-400 hover:text-white' }}">
                    عربي
                </a>
                <a href="{{ route('quiz.create') }}" class="bg-violet-600 hover:bg-violet-500 text-white px-3 py-1.5 rounded-full font-semibold transition-colors text-xs sm:text-sm sm:px-4">
                    <span class="hidden sm:inline">{{ __('ui.create_quiz') }}</span>
                    <span class="sm:hidden">+</span>
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-3 sm:px-4 py-4 sm:py-8">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
