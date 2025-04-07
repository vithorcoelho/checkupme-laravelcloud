<div x-data="{ loading: false }" x-on:loading-start.window="loading=true" x-on:loading-end.window="loading=false">
    <h2 class="text-lg font-semibold mb-4">Serviços e preços</h2>

    {{-- <flux:input size="sm" type="text" placeholder="Buscar serviços" class="w-full" icon="magnifying-glass"/> --}}

    <!-- Overlay bloqueador -->
    <div x-show="loading" class="absolute inset-0 bg-opacity-50 z-10 cursor-wait" x-transition.opacity></div>
    
    <div :class="{ 'opacity-50': loading }" class="transition-opacity duration-300">
        @foreach($services as $service)
            <div class="border-b py-4" wire.loading.class="opacity-50">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="font-medium">{{ $service->name }}</h3>
                        <div class="text-sm text-gray-600">
                            {{ $service->price !== null ? 'R$ ' . number_format($service->price, 2, ',', '.') : 'A consultar' }}
                        </div>
                        <a href="#" class="text-blue-500 text-sm font-medium">Ver detalhes</a>
                    </div>
                    <flux:button variant="primary" size="sm" class="text-sm">Agendar consulta</flux:button>
                </div>
            </div>
        @endforeach
    
        {{-- <a href="#" class="text-blue-500 text-sm font-medium">+3 serviço</a> --}}
    </div>
</div>