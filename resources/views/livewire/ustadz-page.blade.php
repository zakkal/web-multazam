<div class="space-y-4 animate-fade-in px-4 py-6">
    <div class="flex items-center justify-between flex-wrap gap-3">
        <h1 class="text-2xl font-bold text-primary tracking-tight">👨‍🏫 Data Ustadz Pengampu</h1>
        <button wire:click="create()" class="inline-flex items-center px-4 py-2 bg-primary text-white font-semibold rounded-lg shadow-sm hover:bg-primary/90 transition-all">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Tambah Ustadz
        </button>
    </div>

    @if (session()->has('message'))
        <div class="p-3 rounded-lg bg-emerald/10 border border-emerald/20 text-emerald text-sm font-medium">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-card border rounded-xl shadow-sm overflow-hidden overflow-x-auto">
        <table class="w-full text-left border-collapse text-sm">
            <thead class="bg-muted/50 border-b">
                <tr>
                    <th class="px-4 py-3 font-semibold text-muted-foreground w-12">No</th>
                    <th class="px-4 py-3 font-semibold text-muted-foreground">Nama Ustadz</th>
                    <th class="px-4 py-3 font-semibold text-muted-foreground">Jenis Kelamin</th>
                    <th class="px-4 py-3 font-semibold text-muted-foreground">No. WhatsApp</th>
                    <th class="px-4 py-3 font-semibold text-muted-foreground">Asal Pondok Pesantren</th>
                    <th class="px-4 py-3 font-semibold text-muted-foreground w-24 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @forelse($ustadzList as $index => $ustadz)
                <tr class="hover:bg-muted/30 transition-colors">
                    <td class="px-4 py-3 text-muted-foreground">{{ $index + 1 }}</td>
                    <td class="px-4 py-3 font-medium">{{ $ustadz->nama }}</td>
                    <td class="px-4 py-3">{{ $ustadz->jenis_kelamin === 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                    <td class="px-4 py-3">
                        @if($ustadz->no_wa)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $ustadz->no_wa) }}" target="_blank" class="text-emerald hover:underline">{{ $ustadz->no_wa }}</a>
                        @else
                        -
                        @endif
                    </td>
                    <td class="px-4 py-3 text-muted-foreground">{{ $ustadz->asal_pondok ?? '-' }}</td>
                    <td class="px-4 py-3 text-center">
                        <div class="flex items-center justify-center gap-1">
                            <button wire:click="edit({{ $ustadz->id }})" class="p-1.5 text-muted-foreground hover:text-primary hover:bg-muted rounded-md transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/></svg>
                            </button>
                            <button onclick="confirm('Yakin ingin menghapus?') || event.stopImmediatePropagation()" wire:click="delete({{ $ustadz->id }})" class="p-1.5 text-muted-foreground hover:text-destructive hover:bg-destructive/10 rounded-md transition-all">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-8 text-center text-muted-foreground italic">Tidak ada data ustadz ditemukan</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $ustadzList->links() }}
    </div>

    {{-- Form Modal --}}
    @if($isOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50 backdrop-blur-sm">
            <div class="bg-card w-full max-w-lg rounded-xl shadow-2xl border animate-in fade-in zoom-in duration-200">
                <div class="p-4 border-b flex justify-between items-center">
                    <h3 class="text-lg font-bold">{{ $isEditing ? 'Edit Ustadz' : 'Tambah Ustadz Baru' }}</h3>
                    <button wire:click="closeModal()" class="text-muted-foreground hover:text-foreground">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Nama</label>
                        <input wire:model="nama" type="text" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-emerald/20 focus:border-emerald bg-background text-sm">
                        @error('nama') <span class="text-destructive text-xs">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Jenis Kelamin</label>
                        <select wire:model="jenis_kelamin" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-emerald/20 focus:border-emerald bg-background text-sm">
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">No. WhatsApp</label>
                        <input wire:model="no_wa" type="text" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-emerald/20 focus:border-emerald bg-background text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium mb-1">Asal Pondok Pesantren</label>
                        <input wire:model="asal_pondok" type="text" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-emerald/20 focus:border-emerald bg-background text-sm">
                    </div>
                </div>
                <div class="p-4 border-t flex justify-end gap-3">
                    <button wire:click="closeModal()" class="px-4 py-2 text-sm font-medium text-muted-foreground hover:bg-muted rounded-lg transition-all">Batal</button>
                    <button wire:click="store()" class="px-4 py-2 text-sm font-medium bg-primary text-white rounded-lg hover:bg-primary/90 transition-all">Simpan</button>
                </div>
            </div>
        </div>
    @endif
</div>
