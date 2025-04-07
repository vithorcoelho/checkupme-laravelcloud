<?php

namespace App\Livewire\App\Professional\Profile\Partials;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Specialty;

class Especializacoes extends Component
{
    public $user;
    public $availableSpecialties;
    public $selectedSpecialties = [];
    public $allSubspecialties;
    public $specialty = [];

    public $specialties = [];
    public $selectedSpecialty = null;
    public $subspecialties = [];
    public $selectedSubspecialties = [];

    public function carregarSubespecialidades($specialtyId)
    {
        // Simulando consulta no banco
        $specialties = new Specialty;
        $this->subspecialties = $specialties->find($specialtyId)->subspecialties->toArray();

        // Retorna as subespecialidades correspondentes à especialidade escolhida
        return response()->json($subespecialidadesDB[$specialtyId] ?? []);
    }

    public function updatedSelectedSpecialty($specialtyId)
    {
        $specialties = new Specialty;
        $this->subspecialties = $specialties->find($specialtyId)->subspecialties->toArray();
        $this->selectedSubspecialties = [];
    }

    public function addSubspecialtySelect()
    {
        $this->selectedSubspecialties[] = ['uid' => uniqid(),'especialidade_id' => $this->selectedSpecialty, 'subespecialidade_id' => null];
    }

    public function mount()
    {
        $this->user = Auth::user();
        $this->availableSpecialties = Specialty::select('id', 'name')->get();
        $this->specialties = Specialty::all();
        $this->selectedSpecialties = $this->user->specialties->map(function ($specialty) {
            return ['id' => $specialty->id];
        })->toArray();
    }

    public function saveSpecialties()
    {
        $specialtyIds = array_filter(array_column($this->selectedSpecialties, 'id'));

        $this->user->specialties()->sync(   $specialtyIds);

        session()->flash('message', 'Especialidades atualizadas com sucesso!');
    }

    public function render()
    {
        return view('livewire.app.professional.profile.partials.especializacoes');
    }
}
