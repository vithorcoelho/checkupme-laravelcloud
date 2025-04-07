<?php

namespace App\Livewire\App\Professional\Profile\Partials;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Livewire\WithFileUploads;

class InformacoesPrincipais extends Component
{
    use WithFileUploads;
    public $user;
    public $title, $first_name, $last_name, $about_me, $gender, $avatar, $avatarUrl;

    public function updatedAvatar()
    {
        $this->validate([
            'avatar' => 'image|max:1024',
        ]);

        $path = $this->avatar->store('avatars', 'public');
        $this->user->updateOrCreateUserProfessional(['avatar' => $path]);
        $this->avatarUrl = asset('storage/' . $path);
        //Storage::disk('public')->url($path);

        session()->flash('message', 'Avatar atualizado com sucesso!');
    }
    public function updateOrCreate()
    {
        $rules = [
            'first_name' => 'required|min:3|max:100',
            'last_name' => 'min:3|max:100',
            'about_me' => 'max:1000'
        ];
        $feedback = [
            'required' => 'O campo :attribute é obrigatório',
            'min' => 'O campo :attribute deve ter pelo menos :min caracteres',
            'max' => 'O campo :attribute deve ter no máximo :max caracteres'
        ];
        $atributes = [
            'first_name' => 'nome',
            'last_name' => 'sobrenome',
            'about_me' => 'sobre mim'
        ];

        $this->validate($rules, $feedback, $atributes);

        $this->user->userProfessional()
            ->updateOrCreate(
                ['user_id' => $this->user->id],
                [
                    'title' => $this->title,
                    'first_name' => $this->first_name,
                    'last_name' => $this->last_name,
                    'about_me' => $this->about_me,
                    'gender' => $this->gender
                ]
            );

        session()->flash('message', 'Informações atualizadas com sucesso!');
        $this->dispatch('saved');
    }

    public function mount()
    {
        $this->user = Auth::user();

        if ($this->user->userProfessional()->exists()) {
            $this->avatarUrl = $this->user->userProfessional->avatar ? asset('storage/' . $this->user->userProfessional->avatar) : null;
            $this->title = $this->user->userProfessional->title;
            $this->first_name = $this->user->userProfessional->first_name;
            $this->last_name = $this->user->userProfessional->last_name;
            $this->about_me = $this->user->userProfessional->about_me;
            $this->gender = $this->user->userProfessional->gender;
        }

        // dd($this->user->userProfessional->toArray());
    }

    public function render()
    {
        return view('livewire.app.professional.profile.partials.informacoes-principais');
    }
}
