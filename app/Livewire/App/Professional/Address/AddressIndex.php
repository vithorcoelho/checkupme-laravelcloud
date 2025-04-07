<?php

namespace App\Livewire\App\Professional\Address;

use Livewire\Attributes\Title;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

#[Title('Endereços')]

class AddressIndex extends Component
{
    public $addresses = [];
    public function mount()
    {
        $this->addresses = Auth::user()->addresses()->select('id', 'name', 'address', 'city', 'state')->get();
    }

    public function render()
    {
        return view('livewire.app.professional.address.address-index');
    }
}
