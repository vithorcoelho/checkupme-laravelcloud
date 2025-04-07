<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class UserAddress extends Model
{
    protected $fillable = [
        'user_id',
        'name',
        'address',
        'city',
        'state',
        'zip_code',
        'description',
        'type',
        'payment_methods',
        'accessibility',
        'audience',
        'phone',
        'secundary_phone',
        'website',
        'order',
        'is_active',
    ];

    // Faz conversão automática para JSON
    protected $casts = [
        'payment_methods' => 'array',
        'accessibility' => 'array',
        'audience' => 'array',
    ];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function services(): HasMany {
        return $this->hasMany(UserService::class);
    }

    public function userProfessional(): hasOne {
        return $this->hasOne(UserProfessional::class, 'user_id', 'user_id');
    }
}
