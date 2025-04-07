<div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex-1 max-md:pt-6 self-stretch">
            <div>
                <flux:heading size="xl" level="1">Cadastrar novo endereço</flux:heading>
                <flux:subheading size="lg" class="mb-6">No CheckUpMe você pode cadastrar múltiplos consultórios
                </flux:subheading>
                <flux:separator variant="subtle" class="mb-3" />
            </div>
        </div>

        <div class="mt-4 max-w-[1000px]">
            <x-tailwind.form-box transparent title="Tipo de endereço"
                subtitle="Selecione o tipo de endereço que deseja adicionar." class="mb-12">
                <flux:radio.group wire:model="type" variant="segmented">
                    <flux:radio label="Consultório presencial" icon="home" checked value="presencial" />
                    <flux:radio label="Consultório online" icon="video-camera" value="online" />
                </flux:radio.group>
            </x-tailwind.form-box>

            <x-tailwind.form-box title="Onde você atende" subtitle="Digite o endereço do seu consultório.">
                <div class="grid space-y-2 space-x-4 grid-cols-4">
                    <flux:fieldset class="col-span-4">
                        <flux:input.group label="Nome do consultório*">
                            <flux:input size="sm" wire:model="name" />
                        </flux:input.group>
                        <flux:error name="name" />
                    </flux:fieldset>

                    <flux:fieldset>
                        <flux:input.group  label="CEP*">
                            <flux:input size="sm" wire:model="zip_code"/>
                        </flux:input.group>
                        <flux:error name="zip_code" />
                    </flux:fieldset>

                    <flux:fieldset class="col-span-3">
                        <flux:input.group label="Endereço*">
                            <flux:input size="sm" wire:model="address" />
                        </flux:input.group>
                        <flux:error name="address" />
                    </flux:fieldset>

                    <flux:fieldset class="col-span-1">
                        <flux:input.group label="Estado*">
                            <flux:input size="sm" wire:model="state"/>
                        </flux:input.group>
                        <flux:error name="state" />
                    </flux:fieldset>

                    <flux:fieldset class="col-span-1" >
                        <flux:input.group label="Cidade*">
                            <flux:input size="sm" wire:model="city"/>
                        </flux:input.group>
                        <flux:error name="city" />
                    </flux:fieldset>

                    <flux:fieldset class="col-span-2">
                        <flux:input.group label="Site" badge="Opcional">
                            <flux:input size="sm" wire:model="website"/>
                        </flux:input.group>
                        <flux:error name="website" />
                    </flux:fieldset>

                    <flux:fieldset class="col-span-2">
                        <flux:input.group label="Telefone principal*">
                            <flux:input size="sm" wire:model="phone" />
                        </flux:input.group>
                        <flux:error name="phone" />
                    </flux:fieldset>

                    <flux:fieldset class="col-span-2">
                        <flux:input.group label="Telefone secundário" badge="Opcional">
                            <flux:input size="sm" wire:model="secundary_phone" />
                        </flux:input.group>
                        <flux:error name="secundary_phone" />
                    </flux:fieldset>
                </div>

                <div class="mt-4">
                    <flux:checkbox.group wire:model="accessibility" label="O local conta com acessibilidade para:">
                        <flux:checkbox label="Cadeirantes" value="cadeirantes" class="mt-4" />
                        <flux:checkbox label="Grávidas" value="gravidas" />
                        <flux:checkbox label="Deficientes visuais" value="deficientes_visuais" />
                        <flux:checkbox label="Deficiêntes auditiva" value="deficientes_auditivos" />
                    </flux:checkbox.group>
                </div>
            </x-tailwind.form-box>

            <x-tailwind.form-box title="Descrição do local" class="mb-12">
                <flux:textarea wire:model="description" rows="4"
                    label="Você pode adicionar informações complementares para facilitar o acesso de seus pacientes ao seu consultório " />
            </x-tailwind.form-box>

            <x-tailwind.form-box title="Métodos de pagamento" class="mb-12">
                <flux:checkbox.group wire:model="payment_methods">
                    <flux:checkbox label="Dinheiro" value="cash" />
                    <flux:checkbox label="Cartão de Débito" value="debit_card" />
                    <flux:checkbox label="Cartão de Crédito" value="credit_card" />
                    <flux:checkbox label="Boleto" value="billet" />
                </flux:checkbox.group>
            </x-tailwind.form-box>

            <livewire:app.professional.address.partials.form-services />

            <x-tailwind.form-box title="Convênios médicos">
                <flux:radio.group wire:model="agreement">
                    <flux:radio label="Não aceito convênios, apenas pacientes particulares" value="particular" />
                    <flux:radio label="Aceito ambos, pacientes com convênio e pacientes particulares" value="ambos" />
                    <flux:radio label="Aceito apenas pacientes com convênio" value="convenio" />
                </flux:radio.group>
            </x-tailwind.form-box>

            <div class="mt-4 mb-4">
                <div class="flex justify-end">
                    <flux:button wire:click="save" variant="primary">Cadastrar endereço</flux:button>
                </div>
            </div>
        </div>
    </div>
</div>