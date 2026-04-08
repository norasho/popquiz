@php $locale = session('locale', 'en'); $isRtl = $locale === 'ar'; @endphp
<!DOCTYPE html>
<html lang="{{ $locale }}" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0c0c0c">
    <title>PopQuiz</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Zain:wght@400;700;900&display=swap" rel="stylesheet">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <style>
        body, input, button, textarea { font-family: 'Inter', sans-serif; }
        select { font-family: 'Zain', sans-serif; }
        @if($isRtl)
        body, input, button, textarea, select { font-family: 'Zain', sans-serif; }
        @endif
    </style>
</head>
<body class="bg-brand-dark text-white antialiased min-h-screen">
    <header class="w-full px-4 sm:px-6 py-4 sm:py-5 flex items-center justify-between max-w-2xl mx-auto">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            <div class="w-6 h-6 rounded-full bg-brand-green"></div>
            <h1 class="text-xl font-bold tracking-tight text-white">PopQuiz</h1>
        </a>
        <div class="flex items-center gap-2">
            <a href="{{ route('locale.switch', 'en') }}"
               class="px-2.5 py-1 rounded-full text-xs font-bold transition-all {{ $locale === 'en' ? 'bg-brand-purple text-white' : 'bg-white/10 text-gray-400 hover:text-white' }}">
                EN
            </a>
            <a href="{{ route('locale.switch', 'ar') }}"
               class="px-2.5 py-1 rounded-full text-xs font-bold transition-all font-arabic {{ $locale === 'ar' ? 'bg-brand-purple text-white' : 'bg-white/10 text-gray-400 hover:text-white' }}">
                عربي
            </a>
            <a href="{{ route('quiz.create') }}" class="w-10 h-10 rounded-full border border-white/10 flex items-center justify-center text-white hover:bg-white/10 transition-colors">
                <i class="ph ph-plus text-lg"></i>
            </a>
        </div>
    </header>

    <main class="max-w-2xl mx-auto px-3 sm:px-4 pb-4 sm:pb-8">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
