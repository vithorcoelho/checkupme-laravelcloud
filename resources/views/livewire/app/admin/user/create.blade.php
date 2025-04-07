<x-layouts.app :title="__('Usuarios')">
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex-1 max-md:pt-6 self-stretch">
            <div>
                <flux:heading size="xl" level="1">Criar usuário</flux:heading>
                <flux:subheading size="lg" class="mb-6">Crie um novo usuário do tipo paciente, profissional ou clínica</flux:subheading>
                <flux:separator variant="subtle" class="mb-3"/>
            </div>

            <div class="mt-4">
                <livewire:app.admin-users.usuario-form-create/>
            </div>
        </div>
    </div>
</x-layouts.app>