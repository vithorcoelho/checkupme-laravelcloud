<div x-data="{ loading: false }" x-on:loading-start.window="loading=true" x-on:loading-end.window="loading=false">
    <livewire:public.profile.partials.card-perfil-topo :user="$user" />

    <!-- Overlay bloqueador -->
    <div x-show="loading" class="absolute inset-0 bg-opacity-50 z-10 cursor-wait" x-transition.opacity></div>

    <div :class="{ 'opacity-50 pointer-events-none select-none': loading }" class="z-0 transition-opacity duration-300">
        <div class="mt-4">
            <flux:heading level="2" class="flex font-bold mb-2">Endereço</flux:heading>

            <div x-data="addressSelect" x-init="initialize()" x-on:click.away="closeDropdown">
                <div class="w-full py-3 px-4 border rounded-md cursor-pointer" x-on:click="toggleDropdown">
                    <flux:text x-text="selectedAddress ? selectedAddress.name : ''"></flux:text>
                    <flux:text x-text="selectedAddress.address + ', ' + selectedAddress.city"></flux:text>
                </div>
                <div x-show="dropdownOpen"  style="width: calc(100% - 32px);" class="absolute w-full bg-white rounded-lg border mt-1 z-10" x-transition>
                    <flux:input type="text" placeholder="Buscar endereço..." class="w-full p-2" x-model="searchTerm" x-ref="searchInput"/>
                    <div class="max-h-40 overflow-y-auto">
                        <template x-for="address in filteredAddresses" :key="address.id">
                            <div 
                                class="p-2 cursor-pointer hover:bg-gray-100" 
                                x-on:click="selectAddress(address)">
                                <flux:text>
                                    <span x-text="address.name"></span>
                                </flux:text>
                                <flux:text>
                                    <span x-text="address.address + ', ' + address.city"></span>
                                </flux:text>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-2">
            <flux:heading level="2" class="flex font-bold mb-2">
                Serviço:
            </flux:heading>
            <flux:select class="w-full">
                @foreach($user->services as $service)
                    <flux:select.option value="{{ $service->id }}">
                        {{ $service->name }}
                    </flux:select.option>
                @endforeach
            </flux:select>
        </div>

        <flux:button icon="whatsapp" variant="primary" class="mt-4 w-full">Agendar agora</flux:button>
    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('addressSelect', () => ({
            searchTerm: '',
            addresses: @json($user->addresses),
            selectedAddress: null,
            dropdownOpen: false,
            initialize() {
                this.$watch('$wire.addressSelectedId', (newId) => {
                    this.selectedAddress = this.addresses.find(address => address.id === newId) || null;
                });
                this.selectedAddress = this.addresses.find(address => address.id === @json($addressSelectedId)) || null;
            },
            toggleDropdown() {
                this.dropdownOpen = !this.dropdownOpen;
                if (this.dropdownOpen) {
                    this.$nextTick(() => this.$refs.searchInput.focus());
                }
            },
            closeDropdown() {
                this.dropdownOpen = false;
            },
            selectAddress(address) {
                this.selectedAddress = address;
                this.closeDropdown();

                // Atualiza o atributo Livewire no backend
                @this.set('addressSelectedId', address.id);

                // Dispara o evento para atualizar outros componentes
                @this.dispatch('addressChanged', address);

                // Dispara o evento para atualizar outros componentes
                @this.dispatch('loading-start', 'true');
            },
            normalizeString(str) {
                return str
                    .normalize("NFD")
                    .replace(/[\u0300-\u036f]/g, "")
                    .replace(/\s+/g, " ")
                    .trim()
                    .toLowerCase();
            },
            get filteredAddresses() {
                if (!this.searchTerm.trim()) {
                    return this.addresses;
                }
                const normalizedSearchTerm = this.normalizeString(this.searchTerm);
                return this.addresses.filter(address => 
                    this.normalizeString(address.name).includes(normalizedSearchTerm) ||
                    this.normalizeString(address.address).includes(normalizedSearchTerm) ||
                    this.normalizeString(address.city).includes(normalizedSearchTerm) ||
                    this.normalizeString(address.state).includes(normalizedSearchTerm)
                );
            }
        }));
    });
</script>