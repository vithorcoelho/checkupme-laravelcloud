<div class="grid gap-4">
    @if($user->userProfessional->about_me)
        <div>
            <flux:heading size="xl" class="text-base font-semibold mb-2">Sobre mim</flux:heading>
            <flux:text size="lg" class="text-base">{!! nl2br(e($user->userProfessional->about_me)) !!}</flux:text>
        </div>
    @endif

    @if($user->userProfessional->experiences)
        <div>
            <h2 class="text-base font-semibold mb-2 mt-2">Experiências</h2>
            @foreach ($user->userProfessional->experiences as $experience)
                <flux:text class="mt-2">
                    <li>{{ $experience }}</li>
                </flux:text>
            @endforeach
        </div>
    @endif

    @if($user->userProfessional->graduations)
        <div>
            <h2 class="text-base font-semibold mb-2 mt-2">Formação</h2>
            @foreach ($user->userProfessional->graduations as $graduation)
                <flux:text class="mt-2">
                    <li>{{ $graduation }}</li>
                </flux:text>
            @endforeach
        </div>
    @endif
</div>