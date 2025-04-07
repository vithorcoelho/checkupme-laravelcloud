<?php

namespace App\Livewire\App\Professional\Address;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Attributes\On;
use Livewire\Component;

#[Title('Novo endereço')]
class AddressCreate extends Component
{
    // Campos obrigatórios
    public $name, $address, $city, $state, $reference, $zip_code, $type, $phone;

    // Campos opcionais
    public $payment_methods, $accessibility, $audience, $secundary_phone, $description, $website, $agreement;

    public $formServices = [];

    public function save()
    {
        $this->validate([
            'name' => 'required|min:3|max:100',
            'address' => 'required|min:3|max:100',
            'zip_code' => 'required|min:8|max:10',
            'city' => 'required|min:3|max:50',
            'state' => 'required|min:2|max:2',
            'type' => 'required|in:presencial,online',
            'phone' => 'required|min:10|max:20',
            'agreement' => 'required|in:particular,ambos,convenios',
        ]);
        
        $address = Auth::user()->addresses()->create([
            'user_id' => auth()->id(),
            'name' => $this->name,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code,
            'description' => $this->description,
            'type' => $this->type,
            'payment_methods' => $this->payment_methods,
            'accessibility' => $this->accessibility,
            'phone' => $this->phone,
            'secundary_phone' => $this->secundary_phone,
            'website' => $this->website,
            'is_active' => false,
        ]);

        $this->formServices = collect($this->formServices)->map(function($service) use ($address) {
            return array_merge($service, [
                'user_id' => auth()->id(),
                'address_id' => $address->id,
                'order' => array_search($service, $this->formServices),
            ]);
        })->toArray();

        $address->services()->createMany($this->formServices);

        session()->flash('success', 'Endereço cadastrado com sucesso!');
        return redirect()->route('addresses.index');
    }
    public function mount()
    {
        $this->type = 'presencial';
    }

    #[On('service-added')]
    public function handleServiceAdded($services)
    {
        $this->formServices = $services;
    }

    #[On('services-updated')]
    public function handleServicesUpdated($services)
    {
        $this->formServices = $services;
    }

    #[On('service-removed')]
    public function handleServiceRemoved($services)
    {
        $this->formServices = $services;
    }

    public function render()
    {
        return view('livewire.app.professional.address.address-create');
    }
}
