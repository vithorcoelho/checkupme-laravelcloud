<?php

namespace App\Livewire\Public\Profile\Partials;

use Livewire\Component;


class CardServicos extends Component
{
    public $user; // Recebe do componente pai ProfileIndex
    public $services;
    protected $listeners = ['addressChanged'];

    public function addressChanged($id)
    {
        $this->services = $this->user->services->where('user_address_id', $id);
        $this->dispatch('loading-end');
    }

    public function mount()
    {
        $this->services = $this->user->services->where('user_address_id', $this->user->addresses->first()->id);
    }
}
