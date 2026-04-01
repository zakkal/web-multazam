<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Setting;

class PaymentPage extends Component
{
    public $checkoutUrl;

    public function mount()
    {
        $this->checkoutUrl = Setting::getValue('scalev_checkout_url', 'https://scalev.id/yours');
    }

    public function redirectToScalev()
    {
        return redirect()->away($this->checkoutUrl);
    }

    public function render()
    {
        return view('livewire.payment-page')->layout('layouts.app');
    }
}
