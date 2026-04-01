<div class="space-y-6 animate-fade-in px-4 py-6">
    <div class="flex items-center justify-between flex-wrap gap-4">
        <h1 class="page-header text-2xl font-bold text-primary tracking-tight">📊 Dashboard Tahfidz</h1>
        <select wire:model.live="periodFilter" class="w-48 px-3 py-2 border rounded-lg shadow-sm focus:ring-2 focus:ring-emerald/20 focus:border-emerald bg-background text-sm">
            <option value="current">Bulan Berjalan</option>
            <option value="previous">Bulan Lalu</option>
        </select>
    </div>

    <!-- 4 Dynamic Stat Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
        <div class="stat-card stat-card-emerald">
            <p class="text-sm opacity-80">Total Santri</p>
            <p class="text-3xl font-bold mt-1 tracking-tight">{{ number_format($totalSantri) }}</p>
        </div>
        <div class="stat-card stat-card-blue">
            <p class="text-sm opacity-80">Total Ustadz</p>
            <p class="text-3xl font-bold mt-1 tracking-tight">{{ number_format($totalUstadz) }}</p>
        </div>
        <div class="stat-card stat-card-amber">
            <p class="text-sm opacity-80">Kelas Halaqah</p>
            <p class="text-3xl font-bold mt-1 tracking-tight">{{ number_format($totalHalaqah) }}</p>
        </div>
        <div class="stat-card stat-card-rose">
            <p class="text-sm opacity-80">Total Baris ({{ $monthName }})</p>
            <p class="text-3xl font-bold mt-1 tracking-tight">{{ number_format($totalBaris) }}</p>
            <p class="text-xs opacity-70 mt-1">≈ {{ $totalHalaman }} halaman</p>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <!-- Rankings card -->
        <div class="rounded-xl border bg-card p-6 shadow-sm border-emerald/10">
            <h3 class="font-bold text-lg mb-4 flex items-center text-emerald">
                <span class="mr-2">🏆</span> Top 10 Hafalan Terbaik ({{ $monthName }})
            </h3>
            <div class="space-y-2">
                @forelse($topSantri as $index => $santri)
                    @if($santri->setorans_sum_jumlah_baris > 0)
                    <div class="flex items-center justify-between p-3 rounded-lg bg-muted/30 border border-transparent hover:border-emerald/20 transition-all">
                        <div class="flex items-center gap-3">
                            <span class="font-bold text-xs w-6 {{ $index < 3 ? 'text-amber' : 'text-emerald' }}">#{{ $index + 1 }}</span>
                            <span class="text-sm font-medium text-foreground">{{ $santri->nama }}</span>
                        </div>
                        <span class="text-xs font-semibold px-2 py-1 rounded bg-emerald/10 text-emerald">
                            {{ number_format($santri->setorans_sum_jumlah_baris) }} baris 
                        </span>
                    </div>
                    @endif
                @empty
                    <p class="text-xs text-muted-foreground italic p-4 text-center">Belum ada data setoran bulan ini</p>
                @endforelse
            </div>
        </div>

        <!-- Attention card -->
        <div class="rounded-xl border bg-card p-6 shadow-sm border-rose/10">
            <h3 class="font-bold text-lg mb-4 flex items-center text-rose">
                <span class="mr-2">⚠️</span> Butuh Perhatian (Setoran Terendah)
            </h3>
            <div class="space-y-2">
                @forelse($needAttention as $index => $santri)
                    <div class="flex items-center justify-between p-3 rounded-lg bg-muted/30 border border-transparent hover:border-rose/20 transition-all">
                        <div class="flex items-center gap-3">
                            <span class="font-bold text-xs w-6 text-rose">#{{ $index + 1 }}</span>
                            <span class="text-sm font-medium text-foreground">{{ $santri->nama }}</span>
                        </div>
                        <span class="text-xs font-semibold px-2 py-1 rounded bg-rose/10 text-rose">
                            {{ number_format($santri->setorans_sum_jumlah_baris ?? 0) }} baris
                        </span>
                    </div>
                @empty
                    <p class="text-xs text-muted-foreground italic p-4 text-center">Belum ada data</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
