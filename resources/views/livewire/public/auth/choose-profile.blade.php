<?php

use Livewire\Volt\Component;

new class extends Component {
    
}; ?>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('components.layouts.app.head', ['title' => __('Criar uma conta')])

<body>
    <div class="flex flex-col gap-6">

        <x-auth-session-status class="text-center" :status="session('status')" />

        <!-- Escolha um perfil -->
        <div class="flex justify-center">
            <div class="flex flex-col items-center justify-center w-[300px] h-screen -mt-8">
                <div class="flex flex-col gap-2">
                    <h2 class="text-2xl text-center">{{ __('Criar uma conta') }}</h2>
                    <span class="text-sm text-center text-gray-500">{{ __('Escolha o perfil que deseja criar') }}</span>
                </div>

                <div class="mt-4 w-full">
                    <flux:button icon="user" href="{{ route('register.pacient') }}" class="w-full">
                    {{ __('Paciente') }}
                    </flux:button>
                </div>

                <div class="mt-4 w-full">
                    <flux:button icon="user" href="{{ route('register.professional') }}" class="w-full">
                    {{ __('Médico') }}
                    </flux:button>
                </div>

                <div class="mt-4 w-full">
                    <flux:button icon="user" href="" class="w-full">
                    {{ __('Clínica') }}
                    </flux:button>
                </div>
            </div>
        </div>
    </div>
</body>

@fluxScripts
</html>