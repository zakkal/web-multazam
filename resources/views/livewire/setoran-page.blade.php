<div class="space-y-4 animate-fade-in px-4 py-6">
    <div class="flex items-center justify-between flex-wrap gap-3">
        <h1 class="text-2xl font-bold text-primary tracking-tight">📖 Input Setoran Tahfidz</h1>
        <button wire:click="create()" class="inline-flex items-center px-4 py-2 bg-primary text-white font-semibold rounded-lg shadow-sm hover:bg-primary/90 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Setoran
        </button>
    </div>

    @if (session()->has('message'))
        <div class="p-3 rounded-lg bg-emerald/10 border border-emerald/20 text-emerald text-sm font-medium">
            {{ session('message') }}
        </div>
    @endif

    <div class="flex gap-3 flex-wrap">
        <select wire:model.live="filterKelas" class="w-40 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald/20 focus:border-emerald bg-background text-sm">
            <option value="all">Semua Kelas</option>
            @foreach([7,8,9,10,11,12] as $k) <option value="{{ $k }}">Kelas {{ $k }}</option> @endforeach
        </select>
        <select wire:model.live="filterUstadz" class="w-56 px-3 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald/20 focus:border-emerald bg-background text-sm">
            <option value="all">Semua Ustadz</option>
            @foreach($ustadzList as $u) <option value="{{ $u->id }}">{{ $u->nama }}</option> @endforeach
        </select>
    </div>

    <div class="flex border-b border-muted">
        @foreach(['sabaq' => 'Sabaq', 'sabqi' => 'Sabqi', 'manzil' => 'Manzil'] as $key => $label)
            <button wire:click="setTab('{{ $key }}')" 
               class="px-6 py-2.5 text-sm font-semibold transition-all border-b-2 {{ $activeTab === $key ? 'border-primary text-primary bg-primary/5' : 'border-transparent text-muted-foreground hover:text-foreground' }}">
                {{ $label }}
            </button>
        @endforeach
    </div>

    <div class="bg-card border rounded-xl shadow-sm overflow-hidden overflow-x-auto mt-4">
        <table class="w-full text-left border-collapse text-sm">
            <thead class="bg-muted/50 border-b">
                <tr>
                    <th class="px-4 py-3 font-semibold text-muted-foreground">Tanggal</th>
                    <th class="px-4 py-3 font-semibold text-muted-foreground">Santri</th>
                    <th class="px-4 py-3 font-semibold text-muted-foreground">Juz</th>
                    <th class="px-4 py-3 font-semibold text-muted-foreground">Surat</th>
                    <th class="px-4 py-3 font-semibold text-muted-foreground">Ayat</th>
                    <th class="px-4 py-3 font-semibold text-muted-foreground">Baris</th>
                    <th class="px-4 py-3 font-semibold text-muted-foreground">Kehadiran</th>
                    <th class="px-4 py-3 font-semibold text-muted-foreground">Nilai</th>
                    <th class="px-4 py-3 font-semibold text-muted-foreground">Catatan</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($tabSetoran as $setoran)
                <tr class="hover:bg-muted/30 transition-colors">
                    <td class="px-4 py-3 text-muted-foreground whitespace-nowrap">{{ $setoran->tanggal }}</td>
                    <td class="px-4 py-3 font-medium">{{ $setoran->santri->nama ?? '-' }}</td>
                    <td class="px-4 py-3">{{ $setoran->juz }}</td>
                    <td class="px-4 py-3">{{ $setoran->surat }}</td>
                    <td class="px-4 py-3 text-muted-foreground">{{ $setoran->ayat_mulai }}-{{ $setoran->ayat_selesai }}</td>
                    <td class="px-4 py-3">{{ $setoran->jumlah_baris }}</td>
                    <td class="px-4 py-3">
                        @php
                            $colors = ['hadir' => 'emerald', 'izin' => 'blue', 'terlambat' => 'amber', 'alpha' => 'rose', 'sakit' => 'purple'];
                            $color = $colors[$setoran->kehadiran] ?? 'slate';
                        @endphp
                        <span class="inline-flex items-center rounded-full px-2 py-0.5 text-xs font-semibold bg-{{ $color }}/10 text-{{ $color }}">
                            {{ ucfirst($setoran->kehadiran) }}
                        </span>
                    </td>
                    <td class="px-4 py-3 font-semibold {{ $setoran->nilai_kelancaran < 80 ? 'text-rose' : 'text-primary' }}">
                        {{ $setoran->nilai_kelancaran }}
                    </td>
                    <td class="px-4 py-3 text-muted-foreground max-w-[150px] truncate" title="{{ $setoran->catatan }}">{{ $setoran->catatan ?? '-' }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="9" class="px-4 py-8 text-center text-muted-foreground italic">Tidak ada data setoran ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $tabSetoran->links() }}
    </div>

    @if($isOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
            <div class="bg-card w-full max-w-lg rounded-xl shadow-2xl border animate-in fade-in zoom-in duration-200">
                <div class="p-4 border-b flex justify-between items-center">
                    <h3 class="text-lg font-bold uppercase tracking-wider">Input Setoran {{ $activeTab }}</h3>
                    <button wire:click="closeModal()" class="text-muted-foreground hover:text-foreground transition-all">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="p-6 space-y-4 max-h-[70vh] overflow-y-auto">
                    <div>
                        <label class="block text-sm font-medium mb-1">Pilih Santri</label>
                        <select wire:model="santri_id" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-emerald/20 focus:border-emerald bg-background text-sm">
                            <option value="">-- Pilih Santri --</option>
                            @foreach($santriList as $s) <option value="{{ $s->id }}">{{ $s->nama }} (Kelas {{ $s->kelas }})</option> @endforeach
                        </select>
                        @error('santri_id') <span class="text-destructive text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Juz</label>
                            <select wire:model="juz" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-emerald/20 focus:border-emerald bg-background text-sm">
                                @for($i = 1; $i <= 30; $i++) <option value="{{ $i }}">Juz {{ $i }}</option> @endfor
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Surat</label>
                            <select wire:model="surat" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-emerald/20 focus:border-emerald bg-background text-sm">
                                @foreach($daftarSurat as $surah) <option value="{{ $surah['nama'] }}">{{ $surah['nama'] }}</option> @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Ayat Mulai</label>
                            <input wire:model="ayat_mulai" type="number" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-emerald/20 focus:border-emerald bg-background text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Ayat Selesai</label>
                            <input wire:model="ayat_selesai" type="number" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-emerald/20 focus:border-emerald bg-background text-sm">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Baris</label>
                            <input wire:model="jumlah_baris" type="number" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-emerald/20 focus:border-emerald bg-background text-sm">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Kehadiran</label>
                            <select wire:model="kehadiran" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-emerald/20 focus:border-emerald bg-background text-sm">
                                <option value="hadir">Hadir</option>
                                <option value="izin">Izin</option>
                                <option value="terlambat">Terlambat</option>
                                <option value="alpha">Alpha</option>
                                <option value="sakit">Sakit</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Nilai Kelancaran ({{ $nilai_kelancaran }})</label>
                            <input wire:model="nilai_kelancaran" type="range" min="0" max="100" class="w-full h-8 accent-primary">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Catatan</label>
                        <textarea wire:model="catatan" rows="3" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-emerald/20 focus:border-emerald bg-background text-sm" placeholder="Catatan tambahan..."></textarea>
                    </div>
                </div>
                <div class="p-4 border-t flex justify-end gap-3">
                    <button wire:click="closeModal()" class="px-4 py-2 text-sm font-medium text-muted-foreground hover:bg-muted rounded-lg transition-all">Batal</button>
                    <button wire:click="store()" class="px-4 py-2 text-sm font-medium bg-primary text-white rounded-lg hover:bg-primary/90 transition-all shadow-md">Simpan Setoran</button>
                </div>
            </div>
        </div>
    @endif
</div>
