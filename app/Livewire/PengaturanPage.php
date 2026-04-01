<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Setting;
use Livewire\WithFileUploads;

class PengaturanPage extends Component
{
    use WithFileUploads;

    public $nama_pesantren;
    public $logo_pesantren;
    public $new_logo;
    public $active_theme;
    // public $scalev_checkout_url;
    // public $scalev_api_key;

    public $themes = [
        ['id' => 'emerald', 'name' => 'Emerald (Default)', 'color' => 'hsl(160, 84%, 28%)'],
        ['id' => 'ocean', 'name' => 'Ocean Blue', 'color' => 'hsl(210, 90%, 35%)'],
        ['id' => 'sunset', 'name' => 'Sunset Orange', 'color' => 'hsl(20, 90%, 48%)'],
        ['id' => 'royal', 'name' => 'Royal Purple', 'color' => 'hsl(265, 75%, 45%)'],
        ['id' => 'rose', 'name' => 'Rose Pink', 'color' => 'hsl(340, 75%, 50%)'],
        ['id' => 'slate', 'name' => 'Slate Gray', 'color' => 'hsl(215, 25%, 30%)'],
    ];

    public function mount()
    {
        $this->nama_pesantren = Setting::getValue('nama_pesantren', 'Pesantren Tahfidz Multazam');
        $this->logo_pesantren = Setting::getValue('logo_pesantren');
        $this->active_theme = Setting::getValue('theme', 'emerald');
        // $this->scalev_checkout_url = Setting::getValue('scalev_checkout_url', 'https://scalev.id/yours');
        // $this->scalev_api_key = Setting::getValue('scalev_api_key');
    }

    public function saveSettings()
    {
        Setting::setValue('nama_pesantren', $this->nama_pesantren);
        // Setting::setValue('scalev_checkout_url', $this->scalev_checkout_url);
        // Setting::setValue('scalev_api_key', $this->scalev_api_key);
        session()->flash('message', 'Pengaturan berhasil diperbarui.');
    }

    public function updatedNewLogo()
    {
        $this->validate([
            'new_logo' => 'image|max:2048', // 2MB Max
        ]);

        $path = $this->new_logo->store('logos', 'public');
        $this->logo_pesantren = '/storage/' . $path;
        Setting::setValue('logo_pesantren', $this->logo_pesantren);
        session()->flash('message', 'Logo berhasil diperbarui.');
    }

    public function setTheme($themeId)
    {
        $this->active_theme = $themeId;
        Setting::setValue('theme', $themeId);
        session()->flash('message', 'Tema berhasil diubah.');
    }

    public function resetData()
    {
        \App\Models\Setoran::truncate();
        \App\Models\Santri::truncate();
        \App\Models\Ustadz::truncate();
        \App\Models\Setting::truncate();
        
        session()->flash('message', 'Semua data telah dihapus.');
        return redirect()->to(route('dashboard'));
    }

    public function render()
    {
        return view('livewire.pengaturan-page')->layout('layouts.app');
    }
}
