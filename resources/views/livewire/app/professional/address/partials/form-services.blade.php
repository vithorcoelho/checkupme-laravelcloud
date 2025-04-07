<div>
    <x-tailwind.form-box title="Serviços" class="mb-12">
        <div class="flex-1 flex flex-col">
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                <div class="w-full">
                    <flux:input size="sm" wire:model="service.name" label="Nome do serviço"/>
                </div>
                <div class="w-5/12">
                    <flux:input size="sm" wire:model="service.price" label="Preço"/>
                </div>
            </div>
            <div class="w-full">
                <flux:textarea wire:model="service.description" rows="2" label="Descrição do serviço"/>
            </div>
        </div>

        <flux:button wire:click="addService" icon="plus" size="sm" variant="primary" class="mt-4">Adicionar serviço</flux:button>

        <div>
            <ul id="servicesList">
                @foreach($addedServices as $index => $addedService)
                    <li class="border-b py-2 flex items-center" data-index="{{ $index }}">
                        <div class="mr-2 cursor-move drag-handle">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <span class="font-semibold">ID:</span> {{ $addedService['user_id'] ?? 'N/A' }}<br>
                            <span class="font-semibold">Nome:</span> {{ $addedService['name'] ?? 'N/A' }}<br>
                            <span class="font-semibold">Preço:</span> {{ $addedService['price'] ?? 'N/A' }}<br>
                            <span class="font-semibold">Descrição:</span> {{ $addedService['description'] ?? 'N/A' }}
                        </div>
                        <flux:button wire:click="removeService({{ $index }})" icon="trash" size="sm" variant="danger" class="ml-2">
                            Excluir
                        </flux:button>
                    </li>
                @endforeach
            </ul>
        </div>
    </x-tailwind.form-box>

    @script
        <script>
            document.addEventListener('livewire:navigated', () => {

                let sortableInstance;
                const servicesList = document.getElementById('servicesList');

                function initSortable() {
                    if (servicesList) {
                        if (sortableInstance) {
                            try {
                                sortableInstance.destroy();
                            } catch (e) {
                                console.log('Debug: erro ao destruir instância Sortable', e);
                            }
                        }

                        sortableInstance = Sortable.create(servicesList, {
                            handle: '.drag-handle',
                            animation: 150,
                            ghostClass: 'bg-gray-200',
                            onEnd: function() {
                                const newOrder = Array.from(servicesList.querySelectorAll('li'))
                                    .map(li => parseInt(li.dataset.index));
                                @this.updateOrder(newOrder);
                            }
                        });
                    }
                }

                initSortable();

                document.addEventListener('livewire:update', () => {
                    setTimeout(initSortable, 100);
                });
            });
        </script>
    @endscript
</div>
