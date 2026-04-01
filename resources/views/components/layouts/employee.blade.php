<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? config('app.name') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @livewireStyles
</head>

<body class="bg-background-2 bg-white text-black dark:bg-neutral-900 dark:text-white">
    <main>
        @include('components.navbar.employee-navbar')
        @include('components.header.employee-header')
        <div
            class="min-h-screen flex flex-col bg-white border border-gray-200 shadow-xs rounded-lg dark:bg-neutral-800 dark:border-neutral-700">
            <!-- Body -->
            <div class="flex-1 flex flex-col overflow-y-auto">
                {{ $slot }}
            </div>
        </div>
    </main>

    @livewireScripts
</body>

</html>
