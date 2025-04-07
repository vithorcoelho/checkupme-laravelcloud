<?php

namespace App\Livewire\App\Admin\User;

use Livewire\Component;
use App\Models\User;

class UsuarioFormCreate extends Component
{
    public $name;
    public $email;
    public $phone_number;
    public $email_verified_at = true;
    public $is_active = false;

    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email|unique:users,email',
        'phone_number' => 'required|string|min:3|max:20',
        'email_verified_at' => 'boolean',
        'is_active' => 'boolean',
    ];
    protected $messages = [
        'required' => 'O campo :attribute é obrigatório',
        'email' => 'O campo :attribute deve ser um e-mail válido',
        'unique' => 'O campo :attribute já está em uso',
        'min' => 'O campo :attribute deve ter no mínimo :min caracteres',
        'max' => 'O campo :attribute deve ter no máximo :max caracteres',
        'boolean' => 'O campo :attribute deve ser verdadeiro ou falso'
    ];

    public function create(): void{
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'email_verified_at' => $this->email_verified_at,
            'is_active' => $this->is_active,
            'password' => bcrypt(now())
        ]);

        session()->flash('message', 'success');

        $this->redirect(route('usuarios'), navigate: true);
    }
    public function render()
    {
        return view('livewire.app.admin-users.usuario-form-create');
    }
}
