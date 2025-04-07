<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;
use Spatie\Permission\Models\Role;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'phone_number' => fake()->phoneNumber(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }
    public function withRole(string $roleName): static
    {
        return $this->afterCreating(function (User $user) use ($roleName) {
            /**
             * Se não existir a role, define 'paciente' como padrão
             */
            $role = Role::where('name', $roleName)->first() ?? Role::create(['name' => 'paciente']);
            $user->assignRole($role);
        });
    }
}
