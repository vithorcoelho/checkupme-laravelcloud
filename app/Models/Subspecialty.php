<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
class Subspecialty extends Model
{
    protected $fillable = ['name'];
    public $timestamps = false;
    public function specialties(): BelongsToMany
    {
        return $this->belongsToMany(Specialty::class, 'specialty_subspecialty', 'specialty_id', 'subspecialty_id');
    }
}
