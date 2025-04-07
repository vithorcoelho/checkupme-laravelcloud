<div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex-1 max-md:pt-6 self-stretch">
            <div>
                <flux:heading size="xl" level="1">Endereços</flux:heading>
                <flux:subheading size="lg" class="mb-6">Adicione aqui os endereços dos consultórios onde você
                    atende seus pacientes</flux:subheading>
                <flux:separator variant="subtle" class="mb-3" />
            </div>

            {{ $teste ?? '' }}
            <div class="mt-4">
                <div class="col-span-6 sm:col-span-4 mb-4">
                    <div class="flex">
                        <a href="{{ route('addresses.create') }}" wire:navigate>
                            <flux:button icon="plus" size="sm" class="">
                                Adicionar novo endereço
                            </flux:button>
                        </a>
                    </div>
                </div>

                @foreach ($addresses as $address)
                    <div
                        class="flex items-center justify-between p-6 rounded-lg shadow-sm mb-4 bg-white dark:bg-zinc-900">
                        <div class="pr-4 cursor-move">
                            <flux:icon.chevron-up-down />
                        </div>

                        <div class="flex flex-col flex-1">
                            <flux:heading size="lg">{{ $address->name }}</flux:heading>
                            <flux:text>{{ $address->address }}</flux:text>
                            <flux:text>{{ $address->city }}, {{ $address->state }}</flux:text>
                        </div>

                        <!-- Right side: Action buttons -->
                        <div class="flex gap-3 max-sm:flex-col">
                            <flux:button wire:navigate href="{{ route('addresses.edit', $address->id) }}" size="sm" >Editar</flux:button>
                            <flux:button size="sm" wire:click="goTo" variant="primary">Ativar endereço</flux:button>
                            <flux:icon.trash size="sm" lass="text-red-500"/>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
