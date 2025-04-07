<div>
    <form wire:submit="create" class="max-w-[1200px] mt-10">
        <div class="grid grid-cols-1 gap-x-6 gap-y-12 sm:grid-cols-4">
            <div>
                <h2 class="text-base/7 font-semibold text-gray-900">Credenciais da conta</h2>
                <p class="mt-1 text-sm/6 text-gray-600">Informações principais da conta, você ainda não está criando o perfil</p>
            </div>
            <div class="bg-white shadow-xs rounded-lg px-6 py-8 col-span-3">
                <div class="grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    <div class="sm:col-span-3">
                        <x-tailwind.input-text id="name" name="name" label="Nome*"/>
                    </div>
                    <div class="sm:col-span-4">
                        <x-tailwind.input-email id="email" name="email" label="E-mail*"/>
                    </div>
                    <div class="sm:col-span-2">
                        <x-tailwind.input-text id="phone_number" name="phone_number" label="Telefone*"/>
                    </div>
                    <div class="sm:col-span-3">
                        <x-tailwind.input-checkbox name="email_verified_at" label="Exigir verificação de e-mail (recomendado)"/>
                    </div>
                    <div class="sm:col-span-2">
                        <x-tailwind.input-checkbox name="is_active" label="Status"/>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6 col-span-3">
            <button type="submit" wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Cadastrar</button>
        </div>
    </form>
</div>
