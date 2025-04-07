<div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex-1 max-md:pt-6 self-stretch">
            <div>
                <flux:heading size="xl" level="1">{{ $userAddress->name }}</flux:heading>
                <flux:subheading size="lg" class="mb-6">
                    {{ "{$userAddress->address}, {$userAddress->city}, {$userAddress->state}" }}</flux:subheading>
                <flux:separator variant="subtle" class="mb-3" />
            </div>
        </div>

        <div class="mt-4 max-w-[1000px]">
            <x-tailwind.form-box transparent title="Tipo de endereço"
                subtitle="Selecione o tipo de endereço que deseja adicionar." class="mb-12">
                <flux:radio.group wire:model="form.type" variant="segmented">
                    <flux:radio label="Consultório presencial" icon="home" value="presencial" />
                    <flux:radio label="Consultório online" icon="video-camera" value="online" />
                </flux:radio.group>
            </x-tailwind.form-box>

            <x-tailwind.form-box title="Onde você atende" subtitle="Digite o endereço do seu consultório."
                class="mb-12">
                <div class="space-y-6">
                    <flux:input size="sm" wire:model="form.name" label="Nome do consultório*" class="max-w-full"
                        value="{{ $form['name'] }}" />

                    <div class="grid grid-cols-4 gap-4">
                        <flux:input size="sm" wire:model="form.zip_code" label="CEP"
                        value="{{ $form['zip_code'] }}"/>

                        <div class="col-span-3">
                            <flux:input size="sm" wire:model="form.address" label="Endereço*" value="{{ $form['address'] }}"/>
                        </div>

                        <flux:input size="sm" wire:model="form.city" label="Cidade*" value="{{ $form['city'] }}"/>
                        <flux:input size="sm" wire:model="form.state" label="Estado*" value="{{ $form['state'] }}"/>

                        <div class="col-span-2">
                            <flux:input size="sm" wire:model="form.website" label="Site" badge="Opcional" value="{{ $form['website'] }}"/>
                        </div>

                        <flux:input size="sm" wire:model="form.phone" label="Telefone principal*" value="{{ $form['phone'] }}" />
                        <flux:input size="sm" wire:model="form.secundary_phone" label="Telefone secundário" value="{{ $form['secundary_phone'] }}"  />
                    </div>
                </div>

                <div class="mt-4">
                    <flux:checkbox.group wire:model="form.accessibility" label="O local conta com acessibilidade para:">
                        <input type="hidden" value="[]">
                        <flux:checkbox label="Cadeirantes" value="cadeirantes" class="mt-4" />
                        <flux:checkbox label="Grávidas" value="gravidas" />
                        <flux:checkbox label="Deficientes visuais" value="deficientes_visuais" />
                        <flux:checkbox label="Deficiêntes auditiva" value="deficientes_auditivos" />
                    </flux:checkbox.group>
                </div>
            </x-tailwind.form-box>

            <x-tailwind.form-box title="Descrição do local" class="mb-12">
                <flux:textarea wire:model="form.description" rows="4"
                    label="Você pode adicionar informações complementares para facilitar o acesso de seus pacientes ao seu consultório " />
            </x-tailwind.form-box>

            <x-tailwind.form-box title="Métodos de pagamento" class="mb-12">
                <flux:checkbox.group wire:model="form.payment_methods">
                    <flux:checkbox label="Dinheiro" value="cash" />
                    <flux:checkbox label="Cartão de Débito" value="debit_card" />
                    <flux:checkbox label="Cartão de Crédito" value="credit_card" />
                    <flux:checkbox label="Boleto" value="billet" />
                </flux:checkbox.group>
            </x-tailwind.form-box>

            <div>
                <x-tailwind.form-box title="Serviços" class="mb-12">
                    <div class="flex-1 flex flex-col">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            <div class="w-full">
                                <flux:input size="sm" wire:model="service.name" label="Nome do serviço" />
                            </div>
                            <div class="w-5/12">
                                <flux:input size="sm" wire:model="service.price" label="Preço" />
                            </div>
                        </div>
                        <div class="w-full">
                            <flux:textarea wire:model="service.description" rows="2"
                                label="Descrição do serviço" />
                        </div>
                    </div>

                    <flux:button wire:click="addService" icon="plus" size="sm" variant="primary"
                        class="mt-4">Adicionar e salvar</flux:button>

                        <div>
                        <ul id="servicesList">
                            @foreach ($addedServices as $index => $addedService)
                                <li class="border-b py-2 flex items-center dark:bg-zinc-900" data-index="{{ $index }}">
                                    <div class="mr-4 p-2 cursor-move drag-handle">
                                        <flux:icon.chevron-up-down />
                                    </div>
                                    <div class="flex-1">
                                        <span class="font-semibold">Nome:</span>
                                        {{ $addedService->name ?? 'N/A' }}<br>
                                        <span class="font-semibold">Preço:</span>
                                        {{ $addedService->price ?? 'N/A' }}<br>
                                        <span class="font-semibold">Descrição:</span>
                                        {{ $addedService->description ?? 'N/A' }}
                                    </div>
                                    <flux:button wire:click="removeService({{ $index }})" icon="trash"
                                        size="sm" variant="danger" class="ml-2">
                                        Excluir
                                    </flux:button>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </x-tailwind.form-box>
            </div>

            <x-tailwind.form-box title="Convênios médicos">
                <flux:radio.group wire:model="form.agreement">
                    <flux:radio label="Não aceito convênios, apenas pacientes particulares" value="particular" />
                    <flux:radio label="Aceito ambos, pacientes com convênio e pacientes particulares"
                        value="ambos" />
                    <flux:radio label="Aceito apenas pacientes com convênio" value="convenio" />
                </flux:radio.group>
            </x-tailwind.form-box>

            <div class="mt-4 mb-4">
                <div class="flex justify-end">
                    <flux:button wire:click="save" variant="primary">Salvar alterações</flux:button>
                </div>
            </div>
        </div>
    </div>
</div>

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
