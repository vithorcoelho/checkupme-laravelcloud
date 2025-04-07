<?php

namespace App\Services;
use App\Models\UserProfessional;
use Illuminate\Support\Str;

class UserProfessionalService
{
    public static function generateSlug()
    {
        do {
            // Gera um slug aleatório entre 5 e 10 caracteres
            $slug = Str::random(rand(5, 10));
        } while (UserProfessional::where('slug', $slug)->exists()); // Verifica se o slug já existe

        return $slug;
    }
}
