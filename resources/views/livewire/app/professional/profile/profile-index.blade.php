<div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex-1 max-md:pt-6 self-stretch">
            <div>
                @php
                    $hour = now()->hour;
                    if ($hour < 12) {
                        $greeting = 'Bom dia';
                    } elseif ($hour < 18) {
                        $greeting = 'Boa tarde';
                    } else {
                        $greeting = 'Boa noite';
                    }
                @endphp
                <flux:heading size="xl" level="1">{{ $greeting }}, {{ auth()->user()->name }}</flux:heading>
                <flux:subheading size="lg" class="mb-6">Editar seu perfil é essencial para que as pessoas te encontrem
                    mais facilmente e compreendam quem você é. </flux:subheading>
                <flux:separator variant="subtle" class="mb-3" />
            </div>

            <div class="mt-4 max-w-[900px]">

                @if($dataProfile->userProfessional->completed_at == null)
                    <flux:callout variant="secondary" icon="information-circle" heading="Complete o seu perfil para torná-lo público"/>
                @elseif(!$dataProfile->userProfessional->is_public)
                    <flux:callout color="blue" icon="check-circle" heading="Seu perfil será analisado e publicado em breve" class="mb-4"/>
                    
                    <flux:button class="cursor-pointer" icon="eye" href="{{ route('public.profile', $dataProfile->userProfessional->slug) }}" size="sm"  target="_blank">
                        @if($dataProfile->userProfessional->is_public)
                            Ver perfil
                        @else
                            Ver perfil (prévia)
                        @endif
                    </flux:button>
                @endif

                <div class="gap-12 mt-6 grid grid-cols-1">
                    <livewire:app.professional.profile.partials.informacoes-principais />
                    <livewire:app.professional.profile.partials.especializacoes />
                    <livewire:app.professional.profile.partials.fotos-videos />
                    <livewire:app.professional.profile.partials.social-networks />
                    <livewire:app.professional.profile.partials.experiences />
                    <livewire:app.professional.profile.partials.graduations />
                </div>
            </div>
        </div>
    </div>
</div>