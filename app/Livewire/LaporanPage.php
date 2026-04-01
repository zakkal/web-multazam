<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Santri;
use App\Models\Ustadz;
use App\Models\Setoran;

class LaporanPage extends Component
{
    public $selectedSantriId;
    public $filterMonth;
    public $filterYear;
    public $filterHalaqah = 'all';
    public $filterUstadz = 'all';

    public function mount()
    {
        $this->filterMonth = now()->month;
        $this->filterYear = now()->year;
        $santri = Santri::first();
        if ($santri) {
            $this->selectedSantriId = $santri->id;
        }
    }

    public function render()
    {
        $santriQuery = Santri::query();
        if ($this->filterHalaqah !== 'all') $santriQuery->where('kelas_halaqah', $this->filterHalaqah);
        if ($this->filterUstadz !== 'all') $santriQuery->where('ustadz_id', $this->filterUstadz);
        $santriList = $santriQuery->get();

        $selectedSantri = null;
        $stats = [];
        $dailyData = [];

        if ($this->selectedSantriId) {
            $selectedSantri = Santri::with('ustadz')->find($this->selectedSantriId);
            if ($selectedSantri) {
                $setorans = Setoran::where('santri_id', $this->selectedSantriId)->get();
                
                // Total Stats
                $totalBaris = $setorans->sum('jumlah_baris');
                $totalHalaman = floor($totalBaris / 15);
                $totalJuz = floor($totalHalaman / 20);
                
                // Current Month Stats
                $currentSetoran = $setorans->filter(function($s) {
                    return \Carbon\Carbon::parse($s->tanggal)->month == $this->filterMonth && \Carbon\Carbon::parse($s->tanggal)->year == $this->filterYear;
                });
                
                $monthBaris = $currentSetoran->sum('jumlah_baris');
                $monthHadir = $currentSetoran->whereIn('kehadiran', ['hadir', 'terlambat'])->count();
                $monthAbsen = $currentSetoran->whereIn('kehadiran', ['alpha', 'izin', 'sakit'])->count();

                $stats = [
                    'totalJuz' => $totalJuz,
                    'totalHalaman' => $totalHalaman % 20,
                    'monthBaris' => $monthBaris,
                    'monthHadir' => $monthHadir,
                    'monthAbsen' => $monthAbsen,
                    'progressPct' => min(100, ($totalJuz / 30) * 100),
                ];

                // Juz and Surat Sets
                $stats['juzList'] = $setorans->where('jenis', 'sabaq')->pluck('juz')->unique()->sort()->values();
                $stats['suratList'] = $setorans->where('jenis', 'sabaq')->pluck('surat')->unique();

                // Daily data
                for($i = 1; $i <= 31; $i++) {
                    $daySetoran = $currentSetoran->filter(function($s) use ($i) {
                        return \Carbon\Carbon::parse($s->tanggal)->day == $i;
                    });
                    
                    $dailyData[$i] = [
                        'sabaq' => $daySetoran->where('jenis', 'sabaq')->sum('jumlah_baris'),
                        'sabqi' => $daySetoran->where('jenis', 'sabqi')->sum('jumlah_baris'),
                        'manzil' => $daySetoran->where('jenis', 'manzil')->sum('jumlah_baris'),
                        'total' => $daySetoran->sum('jumlah_baris'),
                        'nilai' => $daySetoran->avg('nilai_kelancaran'),
                        'kehadiran' => $daySetoran->first()->kehadiran ?? '-',
                    ];
                }
            }
        }

        return view('livewire.laporan-page', [
            'santriList' => $santriList,
            'ustadzList' => Ustadz::all(),
            'selectedSantri' => $selectedSantri,
            'stats' => $stats,
            'dailyData' => $dailyData,
            'monthNames' => ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
        ])->layout('layouts.app');
    }
}
