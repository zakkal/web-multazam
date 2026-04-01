<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Santri;
use App\Models\Ustadz;
use Livewire\WithPagination;

class SantriPage extends Component
{
    use WithPagination;

    public $search = '';
    public $filterKelas = 'all';
    
    public $santriId;
    public $nama, $jenis_kelamin = 'L', $kelas = 7, $kelas_halaqah = 'Halaqah A', $nisn, $ustadz_id, $orangtua, $wa_orangtua;
    
    public $isEditing = false;
    public $isOpen = false;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:L,P',
        'kelas' => 'required|integer',
        'kelas_halaqah' => 'required|string',
        'nisn' => 'nullable|string',
        'ustadz_id' => 'nullable|exists:ustadzs,id',
        'orangtua' => 'nullable|string',
        'wa_orangtua' => 'nullable|string',
    ];

    public function render()
    {
        $query = Santri::query()->with('ustadz');

        if ($this->search) {
            $query->where('nama', 'like', '%' . $this->search . '%');
        }

        if ($this->filterKelas !== 'all') {
            $query->where('kelas', $this->filterKelas);
        }

        $santriList = $query->latest()->paginate(10);
        $ustadzList = Ustadz::all();

        return view('livewire.santri-page', [
            'santriList' => $santriList,
            'ustadzList' => $ustadzList,
        ])->layout('layouts.app');
    }

    public function create()
    {
        $this->resetInputFields();
        $this->isOpen = true;
        $this->isEditing = false;
    }

    public function edit($id)
    {
        $santri = Santri::findOrFail($id);
        $this->santriId = $id;
        $this->nama = $santri->nama;
        $this->jenis_kelamin = $santri->jenis_kelamin;
        $this->kelas = $santri->kelas;
        $this->kelas_halaqah = $santri->kelas_halaqah;
        $this->nisn = $santri->nisn;
        $this->ustadz_id = $santri->ustadz_id;
        $this->orangtua = $santri->orangtua;
        $this->wa_orangtua = $santri->wa_orangtua;

        $this->isOpen = true;
        $this->isEditing = true;
    }

    public function store()
    {
        $this->validate();

        Santri::updateOrCreate(['id' => $this->santriId], [
            'nama' => $this->nama,
            'jenis_kelamin' => $this->jenis_kelamin,
            'kelas' => $this->kelas,
            'kelas_halaqah' => $this->kelas_halaqah,
            'nisn' => $this->nisn,
            'ustadz_id' => $this->ustadz_id,
            'orangtua' => $this->orangtua,
            'wa_orangtua' => $this->wa_orangtua,
        ]);

        session()->flash('message', $this->santriId ? 'Data Santri berhasil diperbarui.' : 'Santri baru berhasil ditambahkan.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Santri::find($id)->delete();
        session()->flash('message', 'Santri berhasil dihapus.');
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->santriId = null;
        $this->nama = '';
        $this->jenis_kelamin = 'L';
        $this->kelas = 7;
        $this->kelas_halaqah = 'Halaqah A';
        $this->nisn = '';
        $this->ustadz_id = null;
        $this->orangtua = '';
        $this->wa_orangtua = '';
    }
}
