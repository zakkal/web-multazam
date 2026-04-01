<div class="p-8 max-w-4xl mx-auto space-y-8 animate-fade-in">
    <div class="text-center space-y-4">
        <h1 class="text-4xl font-extrabold text-primary tracking-tight">💳 Pembayaran Scalev</h1>
        <p class="text-muted-foreground text-lg max-w-xl mx-auto italic">Bayar biaya pendidikan atau donasi dengan mudah melalui integrasi Scalev yang aman dan terpercaya.</p>
    </div>

    <div class="bg-card rounded-3xl border-2 border-primary/10 shadow-2xl overflow-hidden group hover:border-primary/30 transition-all duration-500">
        <div class="grid md:grid-cols-2">
            <div class="p-10 space-y-6 flex flex-col justify-center">
                <div class="space-y-4">
                    <div class="inline-flex items-center px-3 py-1 rounded-full bg-emerald/10 text-emerald text-xs font-bold uppercase tracking-wider">Metode Pembayaran Instan</div>
                    <h2 class="text-3xl font-bold">Lanjutkan ke Checkout</h2>
                    <p class="text-muted-foreground">Anda akan diarahkan ke halaman pembayaran eksternal yang dikelola oleh Scalev untuk menyelesaikan transaksi Anda.</p>
                </div>
                
                <ul class="space-y-3">
                    <li class="flex items-center text-sm font-medium">
                        <svg class="h-5 w-5 text-emerald mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        Mendukung berbagai kanal pembayaran
                    </li>
                    <li class="flex items-center text-sm font-medium">
                        <svg class="h-5 w-5 text-emerald mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        Keamanan tingkat tinggi terjamin
                    </li>
                    <li class="flex items-center text-sm font-medium">
                        <svg class="h-5 w-5 text-emerald mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        Konfirmasi pembayaran otomatis
                    </li>
                </ul>

                <div class="pt-4">
                    <button wire:click="redirectToScalev" class="w-full flex items-center justify-center gap-3 px-8 py-4 bg-primary text-white rounded-2xl font-bold text-lg shadow-xl shadow-primary/20 hover:scale-105 hover:bg-primary/90 active:scale-95 transition-all">
                        <span>Bayar Sekarang</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </button>
                    <p class="text-[10px] text-muted-foreground text-center mt-4">Anda akan membuka URL: <span class="font-mono">{{ $checkoutUrl }}</span></p>
                </div>
            </div>
            <div class="bg-primary/5 p-12 hidden md:flex items-center justify-center relative overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute inset-0" style="background-image: radial-gradient(circle at 2px 2px, currentColor 1px, transparent 0); background-size: 24px 24px;"></div>
                </div>
                <div class="relative z-10 text-9xl">💳</div>
            </div>
        </div>
    </div>
</div>
