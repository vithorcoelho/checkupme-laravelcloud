<?php

namespace App\Livewire\App\Professional\Address\Partials;

use Livewire\Component;

class FormServices extends Component
{
    public $service = [];
    public $addedServices = [];

    public function addService(){
        $this->validate([
            'service.name' => 'required',
            'service.price' => 'required|numeric',
        ]);
        $this->addedServices[] = $this->service;
        $this->service = [];

         // Disparar evento para AddressCreate
        $this->dispatch('service-added', services: $this->addedServices);
    }

    public function updateOrder($order)
    {
        if (count($order) === count($this->addedServices)) {
            $reorderedServices = [];
            foreach ($order as $index) {
                if (isset($this->addedServices[$index])) {
                    $reorderedServices[] = $this->addedServices[$index];
                }
            }
            $this->addedServices = $reorderedServices;

            // Disparar evento para AddressCreate
            $this->dispatch('services-updated', services: $this->addedServices);
        }
    }

    public function removeService($index)
    {
        if (isset($this->addedServices[$index])) {
            unset($this->addedServices[$index]);
            $this->addedServices = array_values($this->addedServices);

            // Disparar evento para AddressCreate
            $this->dispatch('service-removed', services: $this->addedServices);
        }
    }

    public function render()
    {
        return view('livewire.app.professional.address.partials.form-services');
    }
}
