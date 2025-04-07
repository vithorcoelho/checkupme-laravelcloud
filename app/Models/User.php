<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\UserProfessional;

class User extends Authenticatable
{
    use HasRoles;

    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function initials(): string
    {
        return Str::of($this->name)
            ->explode(' ')
            ->map(fn (string $name) => Str::of($name)->substr(0, 1))
            ->implode('');
    }

    public function specialties(): BelongsToMany
    {
        return $this->belongsToMany(Specialty::class, 'specialty_user', 'user_id', 'specialty_id')
        ->withPivot('order')
        ->orderBy('order');
    }

    public function userProfessional(): HasOne
    {
        return $this->hasOne(UserProfessional::class, 'user_id', 'id');
    }
    public function updateOrCreateUserProfessional(array $data)
    {
        return $this->userProfessional()->updateOrCreate(
            ['user_id' => $this->id],
            $data
        );
    }
    public function addresses(): HasMany {
        return $this->hasMany(UserAddress::class);
    }

    public function services(): HasMany {
        return $this->hasMany(UserService::class);
    }

}
