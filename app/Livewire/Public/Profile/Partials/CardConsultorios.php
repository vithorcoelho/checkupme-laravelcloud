<?php

namespace App\Livewire\Public\Profile\Partials;

use Livewire\Component;

class CardConsultorios extends Component
{
    public $user;
    protected $listeners = ['addressChanged']; // Escuta o evento do componente CardAddress
    public $addressSelectedId;

    public function addressChanged($id)
    {
        $this->addressSelectedId = $id;

        // Dispara um evento de loading-end para o Alpine finalizar o loading
        $this->dispatch('loading-end');
    }
}
