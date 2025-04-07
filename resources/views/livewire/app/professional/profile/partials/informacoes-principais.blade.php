<div>
    <div class="grid grid-cols-1 gap-x-6 gap-y-12 sm:grid-cols-4">
        <div>
            <h2 class="text-base/7 font-semibold text-gray-900">Informações principais</h2>
            <p class="mt-1 text-sm/6 text-gray-600">Adicione informações básicas que serão vistas nas buscas do site
            </p>
        </div>

        <div class="bg-white shadow-xs rounded-lg px-6 py-8 col-span-3">
            <form wire:submit="updateOrCreate">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-6">
                        <div class="flex items-center gap-4">
                            <img src="{{ $avatarUrl ?? 'https://fakeimg.pl/300/' }}" alt="Avatar" class="h-25 w-25 rounded-full object-cover">
                            <div class="flex gap-2">
                                <input type="file" wire:model="avatar" class="hidden" id="avatar-upload">
                                <label for="avatar-upload" class="inline-flex items-center rounded-md bg-white border border-gray-300 px-3 py-2 text-sm font-semibold text-black shadow-xs hover:bg-gray-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-300 cursor-pointer">
                                    <flux:icon.arrow-up-tray class="h-5 w-5 mr-2" />
                                    Upload Foto
                                </label>
                                <button type="button" wire:click="$set('avatar', null)" class="inline-flex items-center rounded-md bg-white border border-gray-300 px-3 py-2 text-sm font-semibold text-black shadow-xs hover:bg-gray-100 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-gray-300">
                                    <flux:icon.trash class="h-5 w-5 mr-2" />
                                    Remover Foto
                                </button>
                            </div>
                        </div>
                        <div wire:loading wire:target="avatar" class="text-sm text-gray-500">Carregando...</div>
                        @error('avatar') <span class="text-sm text-red-600">{{ $message }}</span> @enderror
                    </div>

                    <div class="sm:col-span-1">
                        <x-tailwind.select-menu name="title" label="Titulo">
                            <option value="">--</option>
                            <option value="Dr">Dr.</option>
                            <option value="Dra">Dra.</option>
                            <option value="Prof">Prof.</option>
                        </x-tailwind.select-menu>
                    </div>

                    <div class="sm:col-span-3">
                        <x-tailwind.input-text name="first_name" label="Nome" />
                    </div>

                    <div class="sm:col-span-2">
                        <x-tailwind.input-text name="last_name" label="Sobrenome" />
                    </div>

                    <div class="sm:col-span-6">
                        <x-tailwind.textarea name="about_me" label="Sobre mim"/>
                    </div>

                    <div class="sm:col-span-6">
                        <x-tailwind.select-menu name="gender" label="Gênero (opcional)">
                            <option value="">--</option>
                            <option value="masculino">Masculino</option>
                            <option value="feminino">Feminino</option>
                            <option value="outro">Outro</option>
                        </x-tailwind.select-menu>
                    </div>
                    <div class="inline-flex col-span-6 items-center gap-2">
                        <button type="submit" wire:loading.attr="disabled"
                            wire:loading.class="opacity-50 cursor-not-allowed"
                            class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Salvar</button>
                        </div>
                </div>
            </form>
        </div>
    </div>
</div>
