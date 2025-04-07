<?php

namespace App\Livewire\App\Professional\Profile\Partials;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Graduations extends Component
{
    public $graduations = [];

    public function add()
    {
        $this->graduations[] = '';
    }

    public function remove($index)
    {
        if (isset($this->graduations[$index])) {
            unset($this->graduations[$index]);
            $this->graduations = array_values($this->graduations); // Reindexa o array
        }
        $this->getUser()->userProfessional->graduations = $this->graduations;
        $this->getUser()->userProfessional->save();
        $this->graduations = $this->graduations == [] || $this->graduations == 'null' ? ['', '', ''] : $this->graduations; 
    }

    public function save()
    {
        // Validação básica do array
        $this->validate([
            'graduations' => 'required|array',
            'graduations.*' => 'nullable|string|min:3|max:100',
        ]);
        
        // Filtra entradas vazias após validação básica
        $this->graduations = array_filter($this->graduations, function ($experience) {
            return !empty(trim($experience));
        });
        
        // Verifica se há pelo menos uma experiência válida
        if (empty($this->graduations)) {
            $this->addError('graduations', 'Por favor, preencha pelo menos uma experiência válida.');
            return;
        }
        
        // Reindexar o array após filtragem
        $this->graduations = array_values($this->graduations);
        
        // Salva no banco
        $this->getUser()->userProfessional->graduations = $this->graduations;
        $this->getUser()->userProfessional->save();
        
        session()->flash('success', 'Experiências salvas com sucesso!');
    }

    public function mount(){
        $this->graduations = $this->getUser()->userProfessional->graduations;
        $this->graduations = $this->graduations == [] || $this->graduations == 'null' ? ['', '', ''] : $this->graduations; 
    }

    public function getUser(){
        return Auth::user();
    }

    public function reorder($orderedIds)
    {
        // Extrair valores planos, independente do formato
        $newOrder = [];
        
        // Cria uma cópia temporária das experiências
        $tempgraduations = $this->graduations;
        
        // Processamento seguro dos IDs ordenados
        if (is_array($orderedIds)) {
            foreach ($orderedIds as $key => $value) {
                $index = is_array($value) ? ($value['value'] ?? $value['order'] ?? $key) : $value;
                
                if (is_numeric($index) && isset($tempgraduations[$index])) {
                    $newOrder[] = $tempgraduations[$index];
                }
            }
        }
        
        // Se conseguimos extrair algum valor, atualizamos as experiências
        if (!empty($newOrder)) {
            $this->graduations = $newOrder;
        }
    }

    public function render()
    {
        return view('livewire.app.professional.profile.partials.graduations');
    }
}
