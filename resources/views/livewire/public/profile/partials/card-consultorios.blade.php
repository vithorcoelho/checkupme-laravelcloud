<div x-data="{ selectedAddressId: Number({{ $addressSelectedId ?? 'null' }}) }">
    <h2 class="text-lg font-semibold mb-4">Selecione um consultório para agendar ({{ $user->addresses->count() }})</h2>

    <div class="transition-opacity duration-300 grid grid-cols-2 gap-2">
        @foreach ($user->addresses as $address)
            <button
                class="cursor-pointer flex-grow p-4 bg-gray-100 rounded-lg text-left 
                    {{ $address->id == $addressSelectedId ? 'border-accent border-2' : '' }}"
                    @click="selectedAddressId = Number({{ $address->id }});
                    $nextTick(() => console.log('Selected Address ID:', selectedAddressId));
                    $wire.dispatch('addressChanged', {{ $address }})
                    $dispatch('loading-start');">
                <div>
                    <flux:heading size="lg" class="font-bold">{{ $address->name }}</flux:heading>
                    <flux:text>{{ $address->address }} - {{ $address->city }}, {{ $address->state }}</flux:text>
                </div>
            </button>
        @endforeach
    </div>
</div>