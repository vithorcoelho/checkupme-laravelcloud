<div>
    <div class="flex items-center justify-between mb-4">
        <flux:input icon="magnifying-glass" wire:model.live="search" placeholder="Buscar usuários..." class="mr-2" />
    </div>

    <table class="table-auto w-full border-collapse border border-gray-300">
        <thead>
            <tr class="bg-gray-100">
                <th class="border border-gray-300 px-4 py-2">ID</th>
                <th class="border border-gray-300 px-4 py-2">Nome</th>
                <th class="border border-gray-300 px-4 py-2">Email</th>
                <th class="border border-gray-300 px-4 py-2">Criado em</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
                <tr>
                    <td wire:key="{{ $user->id }}" class="border border-gray-300 px-4 py-2">{{ $user->id }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->email }}</td>
                    <td class="border border-gray-300 px-4 py-2">{{ $user->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="border border-gray-300 px-4 py-2 text-center">Nenhum usuário encontrado.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
