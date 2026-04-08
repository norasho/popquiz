<!DOCTYPE html>
<html lang="en" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PopQuiz 🎯</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="h-full bg-gray-950 text-white antialiased">
    <nav class="border-b border-gray-800 bg-gray-900/80 backdrop-blur-md sticky top-0 z-50">
        <div class="max-w-6xl mx-auto px-4 h-14 flex items-center justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-2 font-black text-xl tracking-tight">
                <span class="text-2xl">🎯</span>
                <span class="bg-gradient-to-r from-violet-400 to-pink-400 bg-clip-text text-transparent">PopQuiz</span>
            </a>
            <div class="flex items-center gap-4 text-sm text-gray-400">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Browse</a>
                <a href="{{ route('quiz.create') }}" class="bg-violet-600 hover:bg-violet-500 text-white px-4 py-1.5 rounded-full font-semibold transition-colors">
                    + Create Quiz
                </a>
            </div>
        </div>
    </nav>

    <main class="max-w-6xl mx-auto px-4 py-8">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
