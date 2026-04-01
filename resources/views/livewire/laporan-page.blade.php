<div class="space-y-4 animate-fade-in px-4 py-6">
    <div class="flex items-center justify-between flex-wrap gap-3">
        <h1 class="text-2xl font-bold text-primary tracking-tight">📋 Laporan Bulanan Tahfidz</h1>
        <button onclick="window.print()" class="inline-flex items-center px-4 py-2 border border-muted-foreground/30 rounded-lg text-sm font-medium hover:bg-muted transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            Cetak / PDF
        </button>
    </div>

    <div class="flex gap-3 flex-wrap bg-card p-4 rounded-xl border shadow-sm">
        <select wire:model.live="filterMonth" class="px-3 py-2 border rounded-lg focus:ring-2 focus:ring-emerald/20 focus:border-emerald bg-background text-sm">
            @foreach($monthNames as $i => $m) <option value="{{ $i + 1 }}">{{ $m }}</option> @endforeach
        </select>
        <select wire:model.live="filterHalaqah" class="w-40 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-emerald/20 focus:border-emerald bg-background text-sm">
            <option value="all">Semua Halaqah</option>
            @foreach(["Halaqah A","Halaqah B","Halaqah C","Halaqah D","Halaqah E"] as $h) <option value="{{ $h }}">{{ $h }}</option> @endforeach
        </select>
        <select wire:model.live="filterUstadz" class="w-48 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-emerald/20 focus:border-emerald bg-background text-sm">
            <option value="all">Semua Ustadz</option>
            @foreach($ustadzList as $u) <option value="{{ $u->id }}">{{ $u->nama }}</option> @endforeach
        </select>
        <select wire:model.live="selectedSantriId" class="w-56 px-3 py-2 border rounded-lg focus:ring-2 focus:ring-emerald/20 focus:border-emerald bg-background text-sm">
            <option value="">-- Pilih Santri --</option>
            @foreach($santriList as $s) <option value="{{ $s->id }}">{{ $s->nama }}</option> @endforeach
        </select>
    </div>

    @if($selectedSantri)
    <div id="printable-area" class="space-y-6">
        <div class="bg-card p-6 rounded-xl border shadow-sm">
            <h2 class="text-xl font-bold text-primary">{{ $selectedSantri->nama }}</h2>
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-3 text-sm">
                <div class="flex flex-col"><span class="text-muted-foreground text-xs">Kelas</span><span class="font-medium">{{ $selectedSantri->kelas }}</span></div>
                <div class="flex flex-col"><span class="text-muted-foreground text-xs">Halaqah</span><span class="font-medium">{{ $selectedSantri->kelas_halaqah }}</span></div>
                <div class="flex flex-col"><span class="text-muted-foreground text-xs">Ustadz</span><span class="font-medium">{{ $selectedSantri->ustadz->nama ?? '-' }}</span></div>
                <div class="flex flex-col"><span class="text-muted-foreground text-xs">NISN</span><span class="font-medium">{{ $selectedSantri->nisn ?? '-' }}</span></div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-card p-5 rounded-xl border shadow-sm">
                <h3 class="text-xs font-bold text-muted-foreground uppercase tracking-wider mb-2">Progress Total</h3>
                <p class="text-2xl font-bold text-primary">{{ $stats['totalJuz'] }} Juz, {{ $stats['totalHalaman'] }} Hal</p>
                <div class="h-2 bg-muted rounded-full mt-3 overflow-hidden">
                    <div class="h-full bg-primary" style="width: {{ $stats['progressPct'] }}%"></div>
                </div>
                <p class="text-[10px] text-muted-foreground mt-1">{{ number_format($stats['progressPct'], 1) }}% dari target 30 juz</p>
            </div>
            <div class="bg-card p-5 rounded-xl border shadow-sm text-card-blue">
                <h3 class="text-xs font-bold text-muted-foreground uppercase tracking-wider mb-2">Bulan Ini</h3>
                <p class="text-2xl font-bold">{{ number_format($stats['monthBaris']) }} <span class="text-xs font-normal">baris</span></p>
                <p class="text-xs text-muted-foreground mt-1">Total setoran bulan {{ $monthNames[$filterMonth - 1] }}</p>
            </div>
            <div class="bg-card p-5 rounded-xl border shadow-sm">
                <h3 class="text-xs font-bold text-muted-foreground uppercase tracking-wider mb-2">Kehadiran</h3>
                <p class="text-2xl font-bold text-emerald">{{ $stats['monthHadir'] }} <span class="text-xs font-normal text-muted-foreground">Hadir</span></p>
                <p class="text-sm font-semibold text-rose">{{ $stats['monthAbsen'] }} <span class="text-xs font-normal text-muted-foreground">Absen</span></p>
            </div>
        </div>

        <div class="bg-card rounded-xl border shadow-sm overflow-hidden">
            <div class="px-6 py-4 border-b bg-muted/30">
                <h3 class="font-bold">📅 Rincian Harian — {{ $monthNames[$filterMonth-1] }} {{ $filterYear }}</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead class="bg-muted/50 border-b">
                        <tr>
                            <th class="px-4 py-2 border-r">Tgl</th>
                            <th class="px-4 py-2 border-r">Sabaq</th>
                            <th class="px-4 py-2 border-r">Sabqi</th>
                            <th class="px-4 py-2 border-r">Manzil</th>
                            <th class="px-4 py-2 border-r bg-primary/5">Total</th>
                            <th class="px-4 py-2 border-r">Nilai</th>
                            <th class="px-4 py-2">Kehadiran</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y">
                        @foreach($dailyData as $day => $data)
                        <tr class="{{ $data['total'] > 0 ? 'bg-background' : 'bg-muted/20' }}">
                            <td class="px-4 py-2 border-r font-medium">{{ $day }}</td>
                            <td class="px-4 py-2 border-r">{{ $data['sabaq'] ?: '-' }}</td>
                            <td class="px-4 py-2 border-r">{{ $data['sabqi'] ?: '-' }}</td>
                            <td class="px-4 py-2 border-r">{{ $data['manzil'] ?: '-' }}</td>
                            <td class="px-4 py-2 border-r bg-primary/5 font-bold">{{ $data['total'] ?: '-' }}</td>
                            <td class="px-4 py-2 border-r font-semibold">{{ $data['nilai'] ? number_format($data['nilai'], 0) : '-' }}</td>
                            <td class="px-4 py-2">
                                @if($data['kehadiran'] !== '-')
                                <span class="px-1.5 py-0.5 rounded-md text-[10px] uppercase font-bold
                                    {{ $data['kehadiran'] === 'hadir' ? 'bg-emerald/10 text-emerald' : 'bg-rose/10 text-rose' }}">
                                    {{ $data['kehadiran'] }}
                                </span>
                                @else
                                -
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @else
    <div class="bg-card p-12 rounded-xl border border-dashed text-center">
        <p class="text-muted-foreground italic">Silakan pilih santri untuk melihat laporan</p>
    </div>
    @endif

    <style>
        @media print {
            aside, header, .bg-card.p-4, button { display: none !important; }
            #printable-area { margin: 0; padding: 0; }
            .static-container { width: 100% !important; }
        }
    </style>
</div>
