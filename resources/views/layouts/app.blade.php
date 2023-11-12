<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="csrf-param" content="_token" />

        <title>Менеджер задач</title>

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                <div class="container mx-auto">
                    @if (session()->has('message'))
                        <div class="w-fit mx-auto mt-2 bg-green-500">
                            {{ session('message') }}
                        </div>
                    @endif
                    <h1 class="text-xl my-4 px-4 sm:text-3xl md:text-4xl">@yield('header')</h1>
                    <div class="px-4">
                        @yield('content')
                    </div>
                </div>
                @if (isset($slot))
                    {{ $slot }}
                @endif
            </main>
        </div>
    </body>
</html>
