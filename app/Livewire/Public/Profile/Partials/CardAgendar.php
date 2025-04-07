<?php

namespace App\Livewire\Public\Profile\Partials;

use Livewire\Component;

class CardAgendar extends Component
{
    public $user; // Recebe do componente pai ProfileIndex
    protected $listeners = ['addressChanged']; // Escuta o evento do componente CardAddress
    public $addressSelectedId; // Endereço selecionado

    public function addressChanged($id)
    {
        $this->addressSelectedId = $id;

        // Dispara um evento de loading-end para o Alpine finalizar o loading
        $this->dispatch('loading-end');
    }
}
