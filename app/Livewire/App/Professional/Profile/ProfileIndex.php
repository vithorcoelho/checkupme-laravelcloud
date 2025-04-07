<?php

namespace App\Livewire\App\Professional\Profile;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Editar Perfil')]

class ProfileIndex extends Component
{
    private $user;
    public $dataProfile = [];

    public function mount()
    {
        $this->user = auth()->user();
        
        $this->dataProfile = $this->user->load(['userProfessional', 'specialties']);

        $this->completedVerify();
    }

    public function completedVerify(): bool{
        
        if($this->dataProfile->userProfessional->completed_at){
            return true;
        }

        $has_specialty = count($this->dataProfile->specialties) ?? false;

        $has_empty = collect($this->dataProfile->userProfessional
            ->only('first_name', 'last_name', 'title', 'graduations'))
            ->contains(function ($value) {
            return empty($value);
        });

        if($has_empty || !$has_specialty){
            return false;
        }

        $this->user->userProfessional->completed_at = now();
        $this->user->userProfessional->save();

        return true;        
    }
}
