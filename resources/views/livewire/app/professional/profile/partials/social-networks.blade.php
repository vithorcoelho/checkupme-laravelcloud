<div>
    <x-tailwind.form-box title="Redes Sociais">
        <form wire:submit="saveSocials()">
            <div class="grid gap-6">
                <flux:fieldset>
                    <flux:input.group label="Facebook">
                        <flux:input.group.prefix size="sm">https://facebook.com/
                        </flux:input.group.prefix>
                        <flux:input size="sm" wire:model="socials.facebook" />
                    </flux:input.group>
                    <flux:error name="socials.facebook" />
                </flux:fieldset>

                <flux:fieldset>
                    <flux:input.group label="Instagram">
                        <flux:input.group.prefix size="sm">https://instagram.com/
                        </flux:input.group.prefix>
                        <flux:input size="sm" wire:model="socials.instagram" />
                    </flux:input.group>
                    <flux:error name="socials.instagram" />
                </flux:fieldset>

                <flux:fieldset>
                    <flux:input.group label="LinkedIn">
                        <flux:input.group.prefix size="sm">https://linkedin.com/
                        </flux:input.group.prefix>
                        <flux:input size="sm" wire:model="socials.linkedin" />
                    </flux:input.group>
                    <flux:error name="socials.linkedin" />
                </flux:fieldset>

                <flux:fieldset>
                    <flux:input.group label="YouTube">
                        <flux:input.group.prefix size="sm">https://youtube.com/
                        </flux:input.group.prefix>
                        <flux:input size="sm" wire:model="socials.youtube" />
                    </flux:input.group>
                    <flux:error name="socials.youtube" />
                </flux:fieldset>

                <flux:fieldset>
                    <flux:input.group label="X">
                        <flux:input.group.prefix size="sm">https://x.com/</flux:input.group.prefix>
                        <flux:input size="sm" wire:model="socials.x" />
                    </flux:input.group>
                    <flux:error name="socials.x" />
                </flux:fieldset>
            </div>
            <flux:button type="submit" size="sm" variant="primary" class="mt-4">Salvar</flux:button>
        </form>
    </x-tailwind.form-box>
</div>