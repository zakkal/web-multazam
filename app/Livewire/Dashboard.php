<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Santri;
use App\Models\Ustadz;
use App\Models\Setoran;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $periodFilter = 'current';

    public function render()
    {
        $now = now();
        $isCurrent = $this->periodFilter === 'current';
        
        $month = $isCurrent ? $now->month : ($now->month == 1 ? 12 : $now->month - 1);
        $year = $isCurrent ? $now->year : ($now->month == 1 ? $now->year - 1 : $now->year);

        $totalSantri = Santri::count();
        $totalUstadz = Ustadz::count();
        $totalHalaqah = Santri::distinct('kelas_halaqah')->count('kelas_halaqah');

        $totalBarisCurrent = Setoran::whereMonth('tanggal', $month)
            ->whereYear('tanggal', $year)
            ->sum('jumlah_baris');
        
        $totalHalaman = floor($totalBarisCurrent / 15);

        // Ranking terbaik berdasarkan jumlah baris
        $topSantri = Santri::withSum(['setorans' => function($q) use ($month, $year) {
            $q->whereMonth('tanggal', $month)->whereYear('tanggal', $year);
        }], 'jumlah_baris')
        ->orderBy('setorans_sum_jumlah_baris', 'desc')
        ->take(10)
        ->get();

        // Butuh perhatian (paling sedikit menyetor di bulan ini)
        $needAttention = Santri::withSum(['setorans' => function($q) use ($month, $year) {
            $q->whereMonth('tanggal', $month)->whereYear('tanggal', $year);
        }], 'jumlah_baris')
        ->orderBy('setorans_sum_jumlah_baris', 'asc')
        ->take(10)
        ->get();

        $monthName = \Carbon\Carbon::createFromDate($year, $month, 1)->translatedFormat('F Y');

        return view('livewire.dashboard', [
            'totalSantri' => $totalSantri,
            'totalUstadz' => $totalUstadz,
            'totalHalaqah' => $totalHalaqah,
            'totalBaris' => $totalBarisCurrent,
            'totalHalaman' => $totalHalaman,
            'topSantri' => $topSantri,
            'needAttention' => $needAttention,
            'monthName' => $monthName,
        ])->layout('layouts.app');
    }
}
