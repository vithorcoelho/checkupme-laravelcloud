<?php

use App\Models\User;
use App\Models\Specialty;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use App\Services\UserProfessionalService;

new #[Layout('components.layouts.auth.split')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';
    public string $specialty_id = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
            'specialty_id' => ['required', 'string', 'max:255', 'exists:' . Specialty::class . ',id'],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        // Insere a especialidade        
        $user->specialties()->attach($validated['specialty_id']);

        // Cria um perfil profissional o nome do usuário no perfil profissional
        $user->updateOrCreateUserProfessional(
            [
                'first_name' => strtok($validated['name'], ' '),
                'slug' => UserProfessionalService::generateSlug()
            ]
        );

        // Assina a role professional
        $user->assignRole('profissional');

        // Realiza o login
        Auth::login($user);

        $this->redirectIntended(route('profile', absolute: false), navigate: true);
    }
}; ?>

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Criar uma conta')" :description="__('Informe suas credenciais para criar uma conta')" />

    <!-- Session Status -->
    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="register" class="flex flex-col gap-6">
        <!-- Name -->
        <flux:input size="sm" wire:model="name" :label="__('Nome')" type="text" required autofocus autocomplete="name"
            :placeholder="__('Nome completo')" />

        <!-- Email Address -->
        <flux:input size="sm" wire:model="email" :label="__('E-mail')" type="email" required autocomplete="email"
            placeholder="email@example.com" />

        <!-- Password -->
        <flux:input size="sm" wire:model="password" :label="__('Senha')" type="password" required
            autocomplete="new-password" :placeholder="__('Senha')" />

        <!-- Confirm Password -->
        <flux:input size="sm" wire:model="password_confirmation" :label="__('Confirmar senha')" type="password" required
            autocomplete="new-password" :placeholder="__('Confirmar senha')" />

        <!-- Specialty Select -->
        <flux:select wire:model="specialty_id" :label="__('Especialidade')" required size="sm">
            <flux:select.option value="" disabled>{{ __('Selecione uma especialidade') }}</flux:select.option>
            @foreach (Specialty::all() as $specialty)
                <flux:select.option :value="$specialty->id">{{ $specialty->name }}</flux:select.option>
            @endforeach
        </flux:select>

        <div class="flex items-center justify-end">
            <flux:button size="sm" type="submit" variant="primary" class="w-full">
                {{ __('Criar conta') }}
            </flux:button>
        </div>
    </form>

    <div class="space-x-1 text-center text-sm text-zinc-600 dark:text-zinc-400">
        {{ __('Já tem uma conta?') }}
        <flux:link :href="route('login')" wire:navigate>{{ __('Entrar') }}</flux:link>
    </div>
</div>