<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class UserProfessional extends Model
{
    protected $primaryKey = 'user_id';
    public $incrementing = false;
    protected $fillable = [
        'user_id',
        'title',
        'first_name',
        'last_name',
        'about_me',
        'gender',
        'avatar',
        'gallery',
        'social_networks',
        'experiences',
        'slug',
        'is_public'
    ];
    public $casts = [
        'social_networks' => 'array',
        'experiences' => 'array',
        'graduations' => 'array',
        'is_public' => 'boolean',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function specialties(): BelongsTo
    {
        return $this->belongsTo(Specialty::class, 'user_id', 'id');
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(UserAddress::class, 'user_id', 'user_id');
    }

    public function getFullNameAttribute() {
        return "{$this->first_name} {$this->last_name}";
    }
}
