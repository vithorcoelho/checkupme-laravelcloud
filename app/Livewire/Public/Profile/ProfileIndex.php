<?php

namespace App\Livewire\Public\Profile;

use Livewire\Component;
use App\Models\User;
use App\Models\UserProfessional;

use Livewire\Attributes\Title;
use Livewire\Attributes\Layout;

#[Title('Perfil')]

#[Layout('components.layouts.public')]

// A única responsabilidade desse componente pai é verificar se o slug existe e se o perfil é público
// O user é passado para o componente filho

class ProfileIndex extends Component
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

    public function mount($slug)
    {
        $this->user = User::whereHas('userProfessional', function ($query) use ($slug) {
            $query->where('slug', $slug);
        })->first();

        if (!$this->user) {
            abort(404); 
        }

        // Verifica se o perfil é público ou se pertence ao usuário que estiver logado
        if (!$this->user->userProfessional->is_public && (!auth()->user() || $this->user->userProfessional->user_id !== auth()->user()->id)) {
            abort(404);
        }
    }
}
