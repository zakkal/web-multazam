<!DOCTYPE html>
@php
    $activeTheme = \App\Models\Setting::getValue('theme', 'emerald');
@endphp
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="{{ $activeTheme }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Sabaq Sabqi Manzil') }}</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="antialiased bg-background text-foreground">
        <div class="min-h-screen flex w-full">
            <!-- Sidebar -->
            <x-sidebar />

            <div class="flex-1 flex flex-col min-w-0">
                <header class="h-16 flex items-center border-b bg-card/80 backdrop-blur-md px-6 sticky top-0 z-40 transition-shadow hover:shadow-sm">
                    <button class="mr-4 lg:hidden p-2 hover:bg-muted rounded-lg transition-all" id="sidebar-toggle">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-menu"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
                    </button>
                    <div class="flex-1">
                        <h1 class="text-sm font-bold text-muted-foreground uppercase tracking-widest font-heading lg:block hidden">
                            {{ \App\Models\Setting::getValue('nama_pesantren', 'Sabaq Sabqi Manzil — Sistem Tahfidz') }}
                        </h1>
                        <h1 class="text-lg font-bold text-primary font-heading lg:hidden block">Sabaq Tahfidz</h1>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="h-8 w-8 rounded-full bg-primary/10 border border-primary/20 flex items-center justify-center text-primary font-bold text-xs uppercase">
                            Admin
                        </div>
                    </div>
                </header>
                <main class="flex-1 overflow-auto bg-background/50">
                    <div class="max-w-[1400px] mx-auto min-h-full">
                        {{ $slot }}
                    </div>
                </main>
                <footer class="p-4 text-center text-[10px] text-muted-foreground border-t bg-card/30">
                    &copy; {{ date('Y') }} Sabaq Sabqi Manzil. Developed with premium aesthetics.
                </footer>
            </div>
        </div>

        @livewireScripts
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const toggle = document.getElementById('sidebar-toggle');
                const sidebar = document.querySelector('aside');
                if (toggle && sidebar) {
                    toggle.addEventListener('click', (e) => {
                        e.stopPropagation();
                        sidebar.classList.toggle('-translate-x-full');
                    });
                    
                    document.addEventListener('click', (e) => {
                        if (!sidebar.contains(e.target) && !toggle.contains(e.target) && !sidebar.classList.contains('-translate-x-full')) {
                            sidebar.classList.add('-translate-x-full');
                        }
                    });
                }
            });

            // Listen for theme changes from Livewire or local updates
            window.addEventListener('theme-updated', event => {
                document.documentElement.setAttribute('data-theme', event.detail.theme);
            });
        </script>
    </body>
</html>
