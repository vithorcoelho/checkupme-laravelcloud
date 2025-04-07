<div>
    <x-tailwind.form-box title="Formação acadêmica" subtitle="Descreva suas graduações, pós-graduações, especializações e etc">
        <div>
            <div class="grid gap-4" wire:sortable="reorder">
                @foreach ($graduations as $index => $experiencia)
                    <div class="flex items-center gap-4" wire:sortable.item="{{ $index }}" wire:key="graduations-{{ $index }}">
                        <div wire:sortable.handle class="cursor-move text-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <flux:input.group>
                                <flux:input size="sm" wire:model="graduations.{{ $index }}" placeholder="ex.: Medicina (Universidade de São Paulo)  "/>
                            </flux:input.group>
                            <flux:error name="experiencies.{{ $index }}" />
                        </div>
                        <flux:button icon="x-mark" size="sm" type="button" wire:click="remove({{ $index }})" class="text-red-500"/>
                    </div>
                @endforeach
            </div>

            <div class="mt-4 flex justify-between">
                <div>
                    <flux:button type="button" size="sm" variant="primary" wire:click="save">
                        Salvar
                    </flux:button>
                </div>

                @if(count($graduations) < 6)
                    <div>
                        <flux:button type="button" size="sm" wire:click="add" icon="plus">
                            Adicionar Formação
                        </flux:button>
                    </div>
                @endif
            </div>

            @if (session()->has('message'))
                <div class="mt-4 text-green-500">
                    {{ session('message') }}
                </div>
            @endif
        </div>
    </x-tailwind.form-box>
</div>