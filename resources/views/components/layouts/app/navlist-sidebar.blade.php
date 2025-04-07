@hasrole('admin')
    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
    <flux:navlist.item icon="user" :href="route('usuarios')" :current="request()->routeIs('usuarios*')" wire:navigate>{{ __('Usuários') }}</flux:navlist.item>
@endhasrole

@hasrole(['profissional', 'clinica'])
    <flux:navlist.item icon="home" :href="route('dashboard')" :current="request()->routeIs('dashboard')" wire:navigate>{{ __('Dashboard') }}</flux:navlist.item>
    <flux:navlist.item icon="calendar">{{ __('Agenda') }}</flux:navlist.item>

    <flux:navlist.group heading="Meu perfil"{{--  expandable :expanded="false" --}} class="mt-4 text-sm/3">
        <flux:navlist.item :href="route('profile')" :current="request()->routeIs('profile')" wire:navigate>{{ __('Editar perfil') }}</flux:navlist.item>
        <flux:navlist.item :href="route('addresses.index')" :current="request()->routeIs('addresses')" wire:navigate>{{ __('Endereços') }}</flux:navlist.item>
        <flux:navlist.item>{{ __('Canais de atendimento') }}</flux:navlist.item>
    </flux:navlist.group>
@endhasrole

