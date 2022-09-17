<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel').(isset($header) ? ' - '.$header :'' ) }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            font-display: optional
        }
    </style>

    <!-- Styles and Scripts -->
    @stack('styles')
    <script>
        window.Laravel = {csrfToken: '{{ csrf_token() }}'}
    </script>
    <script src="{{ asset('js/utils.js') }}"></script>
    @vite(['resources/css/app.css', 'resources/css/tippy.css', 'resources/js/init-alpine.js', 'resources/js/app.js'])
    @stack('scripts')

</head>

<body x-data="app" :class="{'dark': dark,}" class="font-sans antialiased overflow-x">
    <div class="min-h-screen h-full w-full transition-colors duration-500 dark:bg-slate-900 bg-slate-50">
        <x-navbar />
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-slate-1000 bg-opacity-10 backdrop-blur-sm" x-show="loading" x-transition.opacity.duration.500ms >
            <x-evertec.spinner class="w-16 h-16 spin "/>
        </div>
        <main class="xxs:px-4 lg:px-12 sm:px-6 xs:py-9">
            @if (isset($header))
            <header>
                <div class="mx-auto max-w-7xl px-6 lg:px-16 sm:px-8 leading-0 text-slate-800 dark:text-evertec-50 -intro-x relative">
                    <h2 class="text-xl font-bold md:text-3xl">{{ $header }}</h2>
                    <span class="inline-block w-24 h-0.5 transform bg-slate-900 dark:bg-evertec-200"></span>
                </div>
            </header>
            @endif
            <div class="mx-auto max-w-7xl px-6 lg:px-16 sm:px-8 pt-5">
                {{ $slot }}
            </div>
        </main>
    </div>
    <script type="module" src="{{ Vite::asset('resources/js/init-alpine.js') }}"></script>
</body>

</html>
