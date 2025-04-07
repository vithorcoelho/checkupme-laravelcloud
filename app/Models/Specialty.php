<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Specialty extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'description', 'status'];

    public function users(): BelongsToMany{
        return $this->belongsToMany(User::class,  'specialty_user', 'user_id', 'specialty_id')
        ->withPivot('order')->orderBy('asc');
    }

    public function subspecialties(): BelongsToMany
    {
        return $this->belongsToMany(Subspecialty::class, 'specialty_subspecialty', 'specialty_id', 'subspecialty_id');
    }
}
