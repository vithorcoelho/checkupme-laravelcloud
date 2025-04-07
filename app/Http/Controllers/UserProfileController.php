<?php

namespace App\Http\Controllers;
use App\Models\UserProfessional;
class UserProfileController extends Controller
{
    public bool $is_public;
    
    public function show($slug)
    {
        $user_professional = UserProfessional::where('slug', $slug)->first();
        $this->is_public = $user_professional->is_public ?? false;

        if (!$user_professional) {
            abort(404);
        }

        $authUser = auth()->user();
        
        if ($authUser && $user_professional->user_id == $authUser->id) {
            $data = $user_professional->load(['user', 'specialties']);
            return view('livewire.public.profile', compact('data'));
        }

        if ($user_professional->is_public == false) {
            abort(404);
        }

        $data = $user_professional->load(['user', 'specialties']);
        return view('livewire.public.profile', compact('data'));
    }
}
