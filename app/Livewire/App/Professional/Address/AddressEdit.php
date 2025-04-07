<?php

namespace App\Livewire\App\Professional\Address;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AddressEdit extends Component
{
    public $userAddress;
    public $form = [];
    public $service = [];
    public $addedServices = [];

    public function mount($address_id)
    {
        $this->userAddress = Auth::user()->addresses->find($address_id);

        $this->form = $this->userAddress->only([
            'name',
            'address',
            'city',
            'state',
            'zip_code',
            'type',
            'phone',
            'payment_methods',
            'accessibility',
            'secundary_phone',
            'description',
            'website',
            'agreement'
        ]);

        $this->loadServices();
    }

    public function save()
    {
        $this->validate([
            'form.name' => 'required|string|max:255',
            'form.address' => 'required|string|max:255',
            'form.city' => 'required|string|max:255',
            'form.state' => 'required|string|max:255',
            'form.zip_code' => 'string|max:20',
            'form.type' => 'required',
            'form.phone' => 'required|string|max:20',
            'form.payment_methods' => 'nullable|array',
            'form.accessibility' => 'nullable|array',
            'form.secundary_phone' => 'nullable|string|max:20',
            'form.description' => 'nullable|string|max:1000',
            'form.website' => 'nullable|string|url',
            'form.agreement' => 'nullable|boolean',
        ]);

        $this->userAddress->update($this->form);
    }

    private function loadServices()
    {
        $this->addedServices = $this->userAddress->services()
            ->orderBy('order')
            ->get()
            ->map(fn($service) => (object)[
                'id' => $service->id,
                'name' => $service->name,
                'price' => $service->price,
                'description' => $service->description,
                'order' => $service->order,
            ])->toArray();
    }

    public function addService()
    {
        $this->validate([
            'service.name' => 'required',
            'service.price' => 'required|numeric',
        ]);

        // Cria o serviço no banco sem dar submit
        $this->userAddress->services()->create([
            'name' => $this->service['name'],
            'price' => $this->service['price'],
            'user_id' => auth()->id(),
            'address_id' => $this->userAddress->id,
            'description' => $this->service['description'] ?? null,
            'order' => count($this->addedServices) + 1,
        ]);

        // Recarrega os serviços do banco de dados
        $this->loadServices();

        // Limpa o formulário
        $this->service = [];
    }

    public function updateOrder($order)
    {
        if (count($order) === count($this->addedServices)) {
            foreach ($order as $newOrder => $index) {
                if (isset($this->addedServices[$index])) {
                    $service = $this->userAddress->services()->find($this->addedServices[$index]->id);
                    if ($service) {
                        $service->update(['order' => $newOrder + 1]);
                    }
                }
            }

            $this->loadServices();
        }
    }

    public function removeService($index)
    {
        if (isset($this->addedServices[$index])) {
            $serviceId = $this->addedServices[$index]->id;

            $this->userAddress->services()->where('id', $serviceId)->delete();
            $this->userAddress->services()->where('order', '>', $this->addedServices[$index]->order)
                ->decrement('order');

            unset($this->addedServices[$index]);
            $this->addedServices = array_values($this->addedServices);
        }
    }

    public function render()
    {
        return view('livewire.app.professional.address.address-edit');
    }
}
