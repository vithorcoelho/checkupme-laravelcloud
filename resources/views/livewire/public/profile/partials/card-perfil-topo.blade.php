<div>
    <div class="flex flex-row gap-4">
        <div class="">
            <img src="{{ url("storage/{$user->userProfessional->avatar}") }}" alt="{{ $user->userProfessional->full_name }}"
                class="w-32 h-32 object-cover rounded-lg" />
            {{-- <flux:icon.check-circle variant="solid" class="text-emerald-600 w-5 h-5 fill ml-2" /> --}}
        </div>
        <div class="flex-grow">
            <div class="flex justify-between items-start">
                <div>
                    <div class="flex items-center">
                        <h1 class="text-lg font-semibold">
                            {{ $user->userProfessional->title }}
                            {{ $professional->full_name }}
                        </h1>

                    </div>
                    <flux:text class="text-gray-600 mt-2 mb-1">
                        {{ $user->specialties->pluck('name')->join(', ')}}
                    </flux:text>

                    @if($addresses = $user->addresses->sortBy('order')->first())
                        <flux:text class="text-gray-600 mb-1">
                            {{ $addresses->city}} ({{ $addresses->state}})
                            @if($user->addresses->count() > 1)
                                <span class="underline">+{{ $user->addresses->count() - 1 }}
                                    {{ $user->addresses->count() > 1 ? 'endereços' : 'endereço' }}
                                </span>
                            @endif
                        </flux:text>
                    @endif

                    @if($user->userProfessional->registers)
                        <p class="text-gray-600 mb-1">Registros: </p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>