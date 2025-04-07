<?php

namespace App\Http\Controllers\Private;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->user = Auth::user();
    }
    public function index()
    {
        $slug = '';

        if($this->user->userProfessional){
            $slug = $this->user->userProfessional->slug;
        }
        

        return view('livewire.app.profile.profile-index', compact('slug'));
    }
}
