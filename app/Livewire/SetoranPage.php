<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Santri;
use App\Models\Ustadz;
use App\Models\Setoran;
use App\Helpers\QuranHelper;
use Livewire\WithPagination;

class SetoranPage extends Component
{
    use WithPagination;

    public $activeTab = 'sabaq';
    public $filterKelas = 'all';
    public $filterUstadz = 'all';
    
    public $isOpen = false;
    public $santri_id, $juz = 1, $surat = 'Al-Fatihah', $ayat_mulai = 1, $ayat_selesai = 7, $jumlah_baris = 5, $catatan = '', $kehadiran = 'hadir', $nilai_kelancaran = 100;

    protected $rules = [
        'santri_id' => 'required',
        'juz' => 'required|integer|min:1|max:30',
        'surat' => 'required|string',
        'ayat_mulai' => 'required|integer|min:1',
        'ayat_selesai' => 'required|integer|min:1',
        'jumlah_baris' => 'required|integer|min:0',
        'catatan' => 'nullable|string',
        'kehadiran' => 'required|string',
        'nilai_kelancaran' => 'required|integer|min:0|max:100',
    ];

    public function render()
    {
        $query = Setoran::query()
            ->with('santri.ustadz')
            ->where('jenis', $this->activeTab);

        if ($this->filterKelas !== 'all') {
            $query->whereHas('santri', function($q) {
                $q->where('kelas', $this->filterKelas);
            });
        }

        if ($this->filterUstadz !== 'all') {
            $query->whereHas('santri', function($q) {
                $q->where('ustadz_id', $this->filterUstadz);
            });
        }

        $tabSetoran = $query->latest('tanggal')->latest('id')->paginate(20);
        
        $santriSelect = Santri::query();
        if ($this->filterKelas !== 'all') $santriSelect->where('kelas', $this->filterKelas);
        if ($this->filterUstadz !== 'all') $santriSelect->where('ustadz_id', $this->filterUstadz);

        return view('livewire.setoran-page', [
            'tabSetoran' => $tabSetoran,
            'santriList' => $santriSelect->get(),
            'ustadzList' => Ustadz::all(),
            'daftarSurat' => QuranHelper::$daftarSurat,
        ])->layout('layouts.app');
    }

    public function create()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function store()
    {
        $this->validate();

        Setoran::create([
            'santri_id' => $this->santri_id,
            'tanggal' => now()->toDateString(),
            'jenis' => $this->activeTab,
            'juz' => $this->juz,
            'surat' => $this->surat,
            'ayat_mulai' => $this->ayat_mulai,
            'ayat_selesai' => $this->ayat_selesai,
            'jumlah_baris' => $this->jumlah_baris,
            'catatan' => $this->catatan,
            'kehadiran' => $this->kehadiran,
            'nilai_kelancaran' => $this->nilai_kelancaran,
        ]);

        session()->flash('message', 'Setoran ' . $this->activeTab . ' berhasil ditambahkan.');
        $this->closeModal();
    }

    public function setTab($tab)
    {
        $this->activeTab = $tab;
        $this->resetPage();
    }
}
