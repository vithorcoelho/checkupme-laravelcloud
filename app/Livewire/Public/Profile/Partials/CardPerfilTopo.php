<?php

namespace App\Livewire\Public\Profile\Partials;

use Livewire\Component;

class CardPerfilTopo extends Component
{
    public $user;
    public $professional;
    
    public function mount()
    {
        $this->professional = $this->user->userProfessional;
    }
}
