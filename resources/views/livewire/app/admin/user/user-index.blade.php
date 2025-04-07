<div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex-1 max-md:pt-6 self-stretch">
            <div>
                <flux:heading size="xl" level="1">Usuários</flux:heading>
                <flux:subheading size="lg" class="mb-6">Gerencie todos os usuários do CheckUpMe</flux:subheading>
                <flux:separator variant="subtle" class="mb-3" />
            </div>

            <div class="mt-4">
                <a wire:navigate href="{{ route('usuarios.create') }}">
                    <flux:button size="sm" variant="primary" href="">Novo usuário</flux:button>
                </a>
                <livewire:app.admin.user.usuario-table />
            </div>
        </div>
    </div>
</div>