<?php

namespace App\Livewire\App\Admin\User;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class UsuarioTable extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        return $this->resetPage();
    }
    public function render()
    {
        $users = User::where('name', 'like', '%' . $this->search . '%')->paginate(10);

        return view('livewire.app.admin.user.usuario-table', compact('users'));
    }
}
