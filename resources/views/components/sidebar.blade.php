@php
$menuItems = [
    ['title' => "Dashboard", 'url' => route('dashboard'), 'icon' => 'layout-dashboard', 'color' => 'text-emerald', 'active' => request()->routeIs('dashboard')],
    ['title' => "Data Santri", 'url' => route('santri'), 'icon' => 'users', 'color' => 'text-card-blue', 'active' => request()->routeIs('santri')],
    ['title' => "Data Ustadz", 'url' => route('ustadz'), 'icon' => 'user-cog', 'color' => 'text-amber', 'active' => request()->routeIs('ustadz')],
    ['title' => "Input Setoran", 'url' => route('setoran'), 'icon' => 'book-open', 'color' => 'text-rose', 'active' => request()->routeIs('setoran')],
    ['title' => "Laporan", 'url' => route('laporan'), 'icon' => 'file-bar-chart', 'color' => 'text-purple', 'active' => request()->routeIs('laporan')],
    // ['title' => "Pembayaran", 'url' => route('pembayaran'), 'icon' => 'credit-card', 'color' => 'text-indigo-500', 'active' => request()->routeIs('pembayaran')],
    ['title' => "Pengaturan", 'url' => route('pengaturan'), 'icon' => 'settings', 'color' => 'text-teal', 'active' => request()->routeIs('pengaturan')],
];
$logo = \App\Models\Setting::getValue('logo_pesantren');
@endphp

<aside class="w-72 bg-sidebar border-r border-sidebar-border h-screen flex flex-col fixed lg:static left-0 top-0 z-50 transition-transform duration-300 -translate-x-full lg:translate-x-0 shadow-2xl lg:shadow-none">
    <div class="p-6 pb-2 border-b border-sidebar-border group">
        <div class="flex items-center gap-6">
            <a href="{{ route('dashboard') }}" class="h-14 w-14 rounded-full bg-white/10 border border-white/20 flex items-center justify-center overflow-hidden transition-all hover:scale-110 active:scale-95 duration-300 shadow-xl relative ring-2 ring-primary/20 group/logo">
                <div class="absolute inset-0 bg-primary/5 group-hover/logo:bg-primary/10 transition-colors"></div>
                @if($logo)
                    <img src="{{ $logo }}" alt="Logo" class="relative w-full h-full object-cover rounded-full shadow-inner">
                @else
                    <span class="text-3xl relative">📖</span>
                @endif
            </a>
            <div class="flex-1 min-w-0">
                <div class="flex items-center justify-between">
                    <h2 class="text-[12px] font-black text-sidebar-foreground truncate tracking-widest uppercase leading-none mb-1">Sabaq Tahfidz</h2>
                    <a href="{{ route('home') }}" target="_blank" class="p-1.5 rounded-lg bg-white/5 hover:bg-white/10 text-sidebar-foreground/50 hover:text-primary transition-all group/external" title="Buka Landing Page">
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="group-hover/external:translate-x-0.5 group-hover/external:-translate-y-0.5 transition-transform"><path d="M15 3h6v6"/><path d="M10 14 21 3"/><path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/></svg>
                    </a>
                </div>
                <div class="flex items-center gap-1.5 opacity-60">
                    <span class="h-1 w-1 rounded-full bg-primary animate-pulse"></span>
                    <p class="text-[9px] text-sidebar-foreground font-bold tracking-widest uppercase truncate">Management System</p>
                </div>
            </div>
        </div>
    </div>

    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto custom-scrollbar">
        @foreach($menuItems as $item)
            <a href="{{ $item['url'] }}" 
               class="flex items-center group px-4 py-3 text-sm font-bold rounded-xl transition-all duration-200 
               {{ $item['active'] 
                  ? 'bg-primary text-primary-foreground shadow-lg shadow-primary/20 translate-x-1' 
                  : 'text-sidebar-foreground/70 hover:text-sidebar-foreground hover:bg-sidebar-accent/50' }}">
                <span class="mr-4 transition-transform group-hover:scale-110 {{ $item['active'] ? 'text-primary-foreground' : $item['color'] }}">
                    @if($item['icon'] == 'layout-dashboard')
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="7" height="9" x="3" y="3" rx="1"/><rect width="7" height="5" x="14" y="3" rx="1"/><rect width="7" height="9" x="14" y="12" rx="1"/><rect width="7" height="5" x="3" y="16" rx="1"/></svg>
                    @elseif($item['icon'] == 'users')
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M22 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                    @elseif($item['icon'] == 'user-cog')
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    @elseif($item['icon'] == 'book-open')
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M2 3h6a4 4 0 0 1 4 4v14a3 3 0 0 0-3-3H2z"/><path d="M22 3h-6a4 4 0 0 0-4 4v14a3 3 0 0 1 3-3h7z"/></svg>
                    @elseif($item['icon'] == 'file-bar-chart')
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M15 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7Z"/><path d="M14 2v4a2 2 0 0 0 2 2h4"/><path d="M8 18v-2"/><path d="M12 18v-4"/><path d="M16 18v-6"/></svg>
                    @elseif($item['icon'] == 'credit-card')
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="14" x="2" y="5" rx="2"/><line x1="2" x2="22" y1="10" y2="10"/></svg>
                    @elseif($item['icon'] == 'settings')
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M12.22 2h-.44a2 2 0 0 0-2 2v.18a2 2 0 0 1-1 1.73l-.43.25a2 2 0 0 1-2 0l-.15-.08a2 2 0 0 0-2.73.73l-.22.38a2 2 0 0 0 .73 2.73l.15.1a2 2 0 0 1 1 1.72v.51a2 2 0 0 1-1 1.74l-.15.09a2 2 0 0 0-.73 2.73l.22.38a2 2 0 0 0 2.73.73l.15-.08a2 2 0 0 1 2 0l.43.25a2 2 0 0 1 1 1.73V20a2 2 0 0 0 2 2h.44a2 2 0 0 0 2-2v-.18a2 2 0 0 1 1-1.73l.43-.25a2 2 0 0 1 2 0l.15.08a2 2 0 0 0 2.73-.73l.22-.39a2 2 0 0 0-.73-2.73l-.15-.08a2 2 0 0 1-1-1.74V13a2 2 0 0 1 1-1.74l.15-.09a2 2 0 0 0 .73-2.73l-.22-.38a2 2 0 0 0-2.73-.73l-.15.08a2 2 0 0 1-2 0l-.43-.25a2 2 0 0 1-1-1.73V4a2 2 0 0 0-2-2z"/><circle cx="12" cy="12" r="3"/></svg>
                    @endif
                </span>
                <span class="tracking-tight">{{ $item['title'] }}</span>
            </a>
        @endforeach
    </nav>

    <div class="p-6 border-t border-sidebar-border">
        <div class="bg-muted/50 rounded-2xl p-4 border border-muted flex items-center gap-3">
            <div class="h-10 w-10 rounded-full bg-primary/20 flex items-center justify-center font-bold text-primary">A</div>
            <div class="flex-1 min-w-0">
                <p class="text-xs font-bold text-foreground truncate">Administrator</p>
                <p class="text-[10px] text-muted-foreground truncate">admin@tahfidz.com</p>
            </div>
        </div>
    </div>
</aside>
