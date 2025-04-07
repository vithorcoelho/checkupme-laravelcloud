<?php

namespace App\Livewire\App\Professional\Profile\Partials;

use Auth;
use Livewire\Component;

class Experiences extends Component
{
    public $experiences = [];

    public function add()
    {
        $this->experiences[] = '';
    }

    public function remove($index)
    {
        if (isset($this->experiences[$index])) {
            unset($this->experiences[$index]);
            $this->experiences = array_values($this->experiences); // Reindexa o array
        }
        $this->getUser()->userProfessional->experiences = $this->experiences;
        $this->getUser()->userProfessional->save();
        $this->experiences = $this->experiences == [] || $this->experiences == 'null' ? ['', '', ''] : $this->experiences; 
    }

    public function save()
    {
        // Validação básica do array
        $this->validate([
            'experiences' => 'required|array',
            'experiences.*' => 'nullable|string|min:3|max:100',
        ]);
        
        // Filtra entradas vazias após validação básica
        $this->experiences = array_filter($this->experiences, function ($experience) {
            return !empty(trim($experience));
        });
        
        // Verifica se há pelo menos uma experiência válida
        if (empty($this->experiences)) {
            $this->addError('experiences', 'Por favor, preencha pelo menos uma experiência válida.');
            return;
        }
        
        // Reindexar o array após filtragem
        $this->experiences = array_values($this->experiences);
        
        // Salva no banco
        $this->getUser()->userProfessional->experiences = $this->experiences;
        $this->getUser()->userProfessional->save();
        
        session()->flash('success', 'Experiências salvas com sucesso!');
    }

    public function mount(){
        $this->experiences = $this->getUser()->userProfessional->experiences;
        $this->experiences = $this->experiences == [] || $this->experiences == 'null' ? ['', '', ''] : $this->experiences; 
    }

    public function getUser(){
        return Auth::user();
    }

    public function reorder($orderedIds)
    {
        // Extrair valores planos, independente do formato
        $newOrder = [];
        
        // Cria uma cópia temporária das experiências
        $tempExperiences = $this->experiences;
        
        // Processamento seguro dos IDs ordenados
        if (is_array($orderedIds)) {
            foreach ($orderedIds as $key => $value) {
                $index = is_array($value) ? ($value['value'] ?? $value['order'] ?? $key) : $value;
                
                if (is_numeric($index) && isset($tempExperiences[$index])) {
                    $newOrder[] = $tempExperiences[$index];
                }
            }
        }
        
        // Se conseguimos extrair algum valor, atualizamos as experiências
        if (!empty($newOrder)) {
            $this->experiences = $newOrder;
        }
    }

    public function render()
    {
        return view('livewire.app.professional.profile.partials.experiences');
    }
}
