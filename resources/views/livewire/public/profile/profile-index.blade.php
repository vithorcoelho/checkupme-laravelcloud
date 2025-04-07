<div class="max-w-6xl mx-auto p-4 grid grid-cols-1 lg:grid-cols-12 gap-6">
    <div class="col-span-12">
        {{-- Deve ser substituido por um atributo que recebe o status e a mensagem para caso haja outras mensagens
        importantes --}}
        @if($user->userProfessional->is_public == false)
            <flux:callout variant="warning" icon="exclamation-circle"
                heading="Esta página é uma prévia, seu perfil ainda está sendo analisado será publicado em breve" />
        @endif
    </div>

    <div class="lg:col-span-5">
        <div class="bg-white rounded-lg shadow-sm p-4 sticky top-4">
            <livewire:public.profile.partials.card-agendar :user="$user"  :addressSelectedId="$addressSelectedId"/>
        </div>
    </div>

    <div class="lg:col-span-7 grid gap-6 relative">

        <div class="bg-white rounded-lg shadow-sm p-4">
            <livewire:public.profile.partials.card-galeria-fotos :user="$user" />
        </div>

        <div class="bg-white rounded-lg shadow-sm p-4">
            <livewire:public.profile.partials.card-sobre-mim :user="$user" />
        </div>

        <div class="bg-white rounded-lg shadow-sm p-4">
            <livewire:public.profile.partials.card-consultorios :user="$user" :addressSelectedId="$addressSelectedId"/>
        </div>

        <div class="bg-white rounded-lg shadow-sm p-4">
            <livewire:public.profile.partials.card-servicos :user="$user" />
        </div>
    </div>


</div>