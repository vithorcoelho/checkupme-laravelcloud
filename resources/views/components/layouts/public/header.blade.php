<div class="bg-emerald-600">
    <div class="max-w-6xl mx-auto px-4 py-4 flex items-center justify-between">

        <div class="flex items-center space-x-4">
            <!-- Logo -->
            <div class="flex items-center">
                <img src="https://checkupme.com.br/teste-2022/img/logo_1.png" alt="Logo" class="h-7">
            </div>

            <!-- Navigation Links (Desktop) -->
            <nav class="hidden md:flex items-center gap-4 ml-4">
                <flux:link href="{{ route('home') }}">
                    <flux:text class="rounded-md px-3 py-2 text-sm text-white font-medium">
                        especialistas
                    </flux:text>
                </flux:link>

                <flux:link href="{{ route('home') }}">
                    <flux:text class="rounded-md px-3 py-2 text-sm text-white font-medium">
                        clinicas
                    </flux:text>
                </flux:link>

                <flux:link href="{{ route('home') }}">
                    <flux:text class="rounded-md px-3 py-2 text-sm text-white font-medium">
                        exames
                    </flux:text>
                </flux:link>
            </nav>
        </div>

        <!-- Authentication Buttons (Desktop) -->
        <div class="hidden md:flex items-center gap-4">
            @auth
                <flux:button size="sm" href="{{ route('dashboard') }}">
                    minha conta
                </flux:button>
            @else
                <flux:button size="sm" href="{{ route('login') }}">
                    login
                </flux:button>

                <flux:button size="sm" href="{{ route('register') }}">
                    cadastrar-se
                </flux:button>
            @endauth
        </div>

        <!-- Mobile Menu Button -->
        <div class="md:hidden">
            <button id="mobile-menu-button" class="text-white focus:outline-none">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden px-6 pb-4">
        <nav class="flex flex-col gap-4">
            <flux:link href="{{ route('home') }}" class="text-gray-700 hover:text-gray-900">Início</flux:link>
            <flux:link href="{{ route('home') }}" class="text-gray-700 hover:text-gray-900">Sobre</flux:link>
            <flux:link href="{{ route('home') }}" class="text-gray-700 hover:text-gray-900">Serviços</flux:link>
            <flux:link href="{{ route('home') }}" class="text-gray-700 hover:text-gray-900">Contato</flux:link>
        </nav>
        <div class="flex flex-col gap-4 mt-4">
            @auth
                <flux:button href="{{ route('dashboard') }}">
                    Minha Conta
                </flux:button>
            @else
                <flux:button href="{{ route('login') }}">
                    Login
                </flux:button>

                <flux:button href="{{ route('register') }}">
                    Cadastrar-se
                </flux:button>
            @endauth
        </div>
    </div>
</div>

<div class="search-bar bg-gray-200 py-4">
    <div class="max-w-6xl mx-auto px-4">
        <livewire:public.searchbar />
    </div>
</div>

<script>
    document.getElementById('mobile-menu-button').addEventListener('click', function () {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    });
</script>