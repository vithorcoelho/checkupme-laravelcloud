<?php

namespace App\Livewire\App\Professional\Profile\Partials;
use Illuminate\Support\Facades\Auth;

use Livewire\Component;

class SocialNetworks extends Component
{
    public $socials = [];

    public function getUser(){
        return Auth::user();
    }

    public function mount()
    {
        if ($this->getUser()->userProfessional) {
            $this->socials = $this->getUser()->userProfessional->social_networks ?? [];  
        }
    }

    public function saveSocials()
    {
        $this->validate(['socials.*' => 'min:3|max:50|alpha_num']); // Feedback padrão usando tradução pt-br
        $this->getUser()->userProfessional->update(['social_networks' => $this->socials]);
    }

    public function render()
    {
        return view('livewire.app.professional.profile.partials.social-networks');
    }
}
