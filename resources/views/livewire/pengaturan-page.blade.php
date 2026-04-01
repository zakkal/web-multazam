<div class="space-y-6 animate-fade-in max-w-2xl px-4 py-8 mx-auto">
    <h1 class="text-2xl font-bold text-primary tracking-tight">⚙️ Pengaturan</h1>

    @if (session()->has('message'))
        <div class="p-3 rounded-lg bg-emerald/10 border border-emerald/20 text-emerald text-sm font-medium">
            {{ session('message') }}
        </div>
    @endif

    <div class="bg-card p-6 rounded-xl border shadow-sm space-y-4">
        <h3 class="font-bold text-lg">⚙️ Identitas Pesantren</h3>
        <div class="space-y-4">
            <div>
                <label class="block text-xs font-bold text-muted-foreground uppercase tracking-wider mb-1">Nama Pesantren</label>
                <input wire:model="nama_pesantren" type="text" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-emerald/20 focus:border-emerald bg-background text-sm" placeholder="Nama pesantren...">
            </div>
            {{-- <div>
                <label class="block text-xs font-bold text-muted-foreground uppercase tracking-wider mb-1">🔗 Scalev Checkout URL</label>
                <input wire:model="scalev_checkout_url" type="text" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-emerald/20 focus:border-emerald bg-background text-sm" placeholder="Contoh: https://mystore.scalev.id/product">
            </div>
            <div>
                <label class="block text-xs font-bold text-muted-foreground uppercase tracking-wider mb-1">🔑 Scalev API Key (Opsional)</label>
                <input wire:model="scalev_api_key" type="password" class="w-full px-3 py-2 border rounded-lg focus:ring-2 focus:ring-emerald/20 focus:border-emerald bg-background text-sm" placeholder="Masukkan API Key untuk integrasi lanjutan...">
            </div> --}}
            <div class="flex justify-end pt-2">
                <button wire:click="saveSettings" class="px-6 py-2.5 bg-primary text-white rounded-lg text-sm font-bold shadow-lg shadow-primary/20 hover:bg-primary/90 transition-all active:scale-95">Simpan Semua Perubahan</button>
            </div>
        </div>
    </div>

    <div class="bg-card p-6 rounded-xl border shadow-sm space-y-4">
        <h3 class="font-bold text-lg">Logo Pesantren</h3>
        @if($logo_pesantren)
            <div class="mb-6 relative w-32 h-32 mx-auto">
                <img src="{{ $logo_pesantren }}" alt="Logo" class="w-full h-full object-cover rounded-full border shadow-lg ring-4 ring-primary/10">
                <div class="absolute inset-0 rounded-full border-4 border-primary/5"></div>
            </div>
        @endif
        <div class="relative group">
            <input wire:model="new_logo" type="file" id="logo-input" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept="image/*">
            <div class="w-full flex items-center justify-center border-2 border-dashed border-muted-foreground/30 rounded-xl p-8 group-hover:border-primary transition-all">
                <div class="text-center space-y-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mx-auto text-muted-foreground group-hover:text-primary transition-colors" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    <p class="text-sm font-medium text-muted-foreground group-hover:text-foreground">Click to upload or drag logo</p>
                    <p class="text-xs text-muted-foreground/60">SVG, PNG, JPG (max. 2MB)</p>
                </div>
            </div>
            @error('new_logo')
                <div class="mt-2 p-2 rounded bg-rose/10 border border-rose/20 text-rose text-xs font-medium">
                    {{ $message }}
                </div>
            @enderror
            <div wire:loading wire:target="new_logo" class="absolute inset-0 bg-background/80 backdrop-blur-sm flex items-center justify-center rounded-xl z-20">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-primary"></div>
            </div>
        </div>
    </div>

    <div class="bg-card p-6 rounded-xl border shadow-sm space-y-4">
        <h3 class="font-bold text-lg mb-4">Tema Warna</h3>
        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
            @foreach($themes as $theme)
                <button 
                  wire:click="setTheme('{{ $theme['id'] }}')" 
                  class="p-4 rounded-2xl border-2 transition-all text-left relative overflow-hidden group 
                    {{ $active_theme === $theme['id'] ? 'border-primary shadow-lg ring-2 ring-primary/20 bg-primary/5' : 'border-muted hover:border-primary/40 hover:bg-muted/30' }}">
                    <div class="w-full h-10 rounded-lg mb-3 shadow-inner" style="background: {{ $theme['color'] }}"></div>
                    <p class="text-sm font-bold tracking-tight">{{ $theme['name'] }}</p>
                    @if($active_theme === $theme['id'])
                        <div class="absolute top-2 right-2 text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                        </div>
                    @endif
                </button>
            @endforeach
        </div>
    </div>

    <div class="bg-card p-6 rounded-xl border border-rose/20 bg-rose/5 space-y-3">
        <h3 class="font-bold text-lg text-rose flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.876c1.27 0 2.09-1.383 1.458-2.433L13.458 5.433a1.5 1.5 0 00-2.916 0L2.542 16.567c-.632 1.05.188 2.433 1.458 2.433z"/></svg>
            Zona Bahaya
        </h3>
        <p class="text-sm text-muted-foreground">Menghapus semua data dari database. Tindakan ini tidak dapat dibatalkan.</p>
        <button onclick="confirm('Hapus semua data?') && @this.resetData()" class="px-4 py-2 bg-rose text-white rounded-lg text-sm font-bold hover:bg-rose/90 transition-all shadow-sm">Reset Semua Data</button>
    </div>
</div>
