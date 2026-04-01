<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sabaq Sabqi Manzil — Solusi Management Tahfidz Modern</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    @php
        $nama_pesantren = \App\Models\Setting::getValue('nama_pesantren', 'Sabaq Sabqi Manzil');
        $logo = \App\Models\Setting::getValue('logo_pesantren');
    @endphp
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-nav { background: rgba(255, 255, 255, 0.7); backdrop-filter: blur(20px); border-bottom: 1px solid rgba(0, 0, 0, 0.05); }
        .gradient-text { background: linear-gradient(135deg, #059669 0%, #0d9488 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent; }
        .hero-gradient { background: radial-gradient(circle at top right, rgba(16, 185, 129, 0.15), transparent), radial-gradient(circle at bottom left, rgba(20, 184, 166, 0.2), transparent); }
        .btn-primary { background: #059669; color: white !important; transition: all 0.3s ease; box-shadow: 0 10px 25px -5px rgba(5, 150, 105, 0.3); }
        .btn-primary:hover { background: #047857; transform: translateY(-2px); box-shadow: 0 15px 30px -5px rgba(5, 150, 105, 0.4); }
        .floating { animation: floating 3s ease-in-out infinite; }
        @keyframes floating { 
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
    </style>
</head>
<body class="antialiased bg-white text-gray-900 overflow-x-hidden hero-gradient">
    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 glass-nav">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center gap-5">
                <div class="h-10 w-10 rounded-full bg-emerald-600 flex items-center justify-center text-white overflow-hidden shadow-lg shadow-emerald-600/20">
                    @if($logo)
                        <img src="{{ $logo }}" alt="Logo" class="w-full h-full object-cover">
                    @else
                        📖
                    @endif
                </div>
                <span class="text-xl font-black tracking-widest text-emerald-900 uppercase">{{ $nama_pesantren }}</span>
            </div>
            <div class="hidden md:flex items-center gap-10">
                <a href="#fitur" class="text-xs font-bold text-gray-500 hover:text-emerald-700 uppercase tracking-widest transition-colors">Fitur</a>
                <a href="#solusi" class="text-xs font-bold text-gray-500 hover:text-emerald-700 uppercase tracking-widest transition-colors">Solusi</a>
                <a href="{{ route('dashboard') }}" class="px-7 py-3 btn-primary rounded-full text-xs font-black uppercase tracking-widest">Masuk Dashboard</a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-40 pb-24 px-6">
        <div class="max-w-5xl mx-auto text-center space-y-8 animate-in fade-in slide-in-from-bottom-10 duration-1000">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-emerald-50 text-emerald-700 text-xs font-bold uppercase tracking-widest border border-emerald-100">
                ✨ Masa Depan Management Tahfidz
            </div>
            <h1 class="text-5xl md:text-7xl font-extrabold text-gray-900 leading-[1.1] tracking-tighter">
                Kelola Progres <span class="gradient-text">Hafalan Quran</span> Lebih Terstruktur & Modern
            </h1>
            <p class="text-lg md:text-xl text-gray-500 max-w-2xl mx-auto leading-relaxed">
                Platform management khusus untuk lembaga Tahfidz Quran. Monitoring sabaq, sabqi, dan manzil santri jadi lebih mudah dalam satu dashboard elegan.
            </p>
            <div class="pt-6 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('dashboard') }}" class="w-full sm:w-auto px-12 py-5 btn-primary rounded-2xl font-black text-lg uppercase tracking-widest">
                    Mulai Sekarang — Gratis
                </a>
                <a href="#fitur" class="w-full sm:w-auto px-12 py-5 bg-white text-emerald-700 border-2 border-emerald-100 rounded-2xl font-black text-lg uppercase tracking-widest hover:bg-emerald-50 transition-all">
                    Lihat Fitur
                </a>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section id="fitur" class="py-24 bg-gray-50 relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 space-y-4">
                <h2 class="text-3xl md:text-4xl font-extrabold">Fitur Unggulan Kami</h2>
                <p class="text-gray-500 max-w-xl mx-auto">Dirancang untuk memudahkan Ustadz dan Pengurus Pesantren dalam memantau setiap baris hafalan santri.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="p-8 bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="h-14 w-14 rounded-2xl bg-emerald-100 text-emerald-600 flex items-center justify-center text-2xl mb-6">📉</div>
                    <h3 class="text-xl font-bold mb-3">Dashboard Real-time</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Pantau statistik harian, top ranking hafalan, dan santri yang membutuhkan perhatian khusus secara instan.</p>
                </div>
                <div class="p-8 bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="h-14 w-14 rounded-2xl bg-teal-100 text-teal-600 flex items-center justify-center text-2xl mb-6">📝</div>
                    <h3 class="text-xl font-bold mb-3">Input Setoran Cepat</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Interface input yang fokus untuk memudahkan ustadz memasukkan data sabaq, sabqi, dan manzil dalam hitungan detik.</p>
                </div>
                <div class="p-8 bg-white rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="h-14 w-14 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center text-2xl mb-6">📊</div>
                    <h3 class="text-xl font-bold mb-3">Laporan Otomatis</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">Ekspor laporan progres bulanan santri untuk wali murid dengan format yang rapi dan profesional.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <section id="solusi" class="py-24 px-6 overflow-hidden">
        <div class="max-w-5xl mx-auto bg-gray-900 rounded-[3rem] p-12 md:p-20 relative text-center text-white space-y-8">
            <div class="absolute inset-0 opacity-20 pointer-events-none" style="background-image: radial-gradient(circle at 1px 1px, #10b981 1px, transparent 0); background-size: 32px 32px;"></div>
            <h2 class="text-4xl md:text-5xl font-extrabold tracking-tight">Siap Untuk <span class="text-emerald-400">Digitalisasi</span> Pesantren Anda?</h2>
            <p class="text-gray-400 text-lg max-w-xl mx-auto">
                Bergabunglah dengan puluhan pesantren lainnya yang telah menggunakan {{ $nama_pesantren }} untuk mengelola data hafalan santri dengan lebih efisien.
            </p>
            <div class="pt-4">
                <a href="{{ route('dashboard') }}" class="px-12 py-4 bg-emerald-500 text-white rounded-2xl font-bold text-lg shadow-2xl shadow-emerald-500/40 hover:bg-emerald-400 transition-all">
                    Mulai Sekarang Secara Gratis 🚀
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-12 border-t border-gray-100 text-center">
        <p class="text-sm font-bold text-gray-400">&copy; {{ date('Y') }} Sabaq Sabqi Manzil. Crafted for Excellence.</p>
    </footer>
</body>
</html>
