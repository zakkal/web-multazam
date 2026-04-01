<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Ustadz;
use Livewire\WithPagination;

class UstadzPage extends Component
{
    use WithPagination;

    public $search = '';
    
    public $ustadzId;
    public $nama, $jenis_kelamin = 'L', $no_wa, $asal_pondok;
    
    public $isEditing = false;
    public $isOpen = false;

    protected $rules = [
        'nama' => 'required|string|max:255',
        'jenis_kelamin' => 'required|in:L,P',
        'no_wa' => 'nullable|string',
        'asal_pondok' => 'nullable|string',
    ];

    public function render()
    {
        $query = Ustadz::query();

        if ($this->search) {
            $query->where('nama', 'like', '%' . $this->search . '%');
        }

        $ustadzList = $query->latest()->paginate(10);

        return view('livewire.ustadz-page', [
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
        $ustadz = Ustadz::findOrFail($id);
        $this->ustadzId = $id;
        $this->nama = $ustadz->nama;
        $this->jenis_kelamin = $ustadz->jenis_kelamin;
        $this->no_wa = $ustadz->no_wa;
        $this->asal_pondok = $ustadz->asal_pondok;

        $this->isOpen = true;
        $this->isEditing = true;
    }

    public function store()
    {
        $this->validate();

        Ustadz::updateOrCreate(['id' => $this->ustadzId], [
            'nama' => $this->nama,
            'jenis_kelamin' => $this->jenis_kelamin,
            'no_wa' => $this->no_wa,
            'asal_pondok' => $this->asal_pondok,
        ]);

        session()->flash('message', $this->ustadzId ? 'Data Ustadz berhasil diperbarui.' : 'Ustadz baru berhasil ditambahkan.');

        $this->closeModal();
        $this->resetInputFields();
    }

    public function delete($id)
    {
        Ustadz::find($id)->delete();
        session()->flash('message', 'Ustadz berhasil dihapus.');
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    private function resetInputFields()
    {
        $this->ustadzId = null;
        $this->nama = '';
        $this->jenis_kelamin = 'L';
        $this->no_wa = '';
        $this->asal_pondok = '';
    }
}
