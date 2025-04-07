<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 20) as $_index) {

            // Criando usuários com perfil de profissional
            $user = User::factory()->withRole('profissional')->create();

            // Gerando perfis professionais
            $user->userProfessional()->create([
                'user_id' => $user->id,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'birthday' => $faker->date,
                'avatar' => $faker->imageUrl,
                'title' => $faker->title,
                'idioms' => json_encode([$faker->languageCode]),
                'certificates' => json_encode([$faker->word]),
                'experiences' => json_encode([$faker->word]),
                'graduation' => json_encode([$faker->word]),
                'registers' => json_encode([$faker->word]),
                'about_me' => $faker->text,
                'gallery' => json_encode([$faker->imageUrl]),
                'slug' => $faker->slug,
            ]);

            // Adicionando especialidades
            $user->specialties()->attach(rand(100,1000), ['order' => 1]);

            $address = $user->addresses()->create([
                'user_id' => $user->id,
                'name' => $faker->company,
                'address' => $faker->streetName,
                'city' => $faker->city,
                'state' => $faker->state,
                'zip_code' => $faker->postcode,
                'description' => $faker->secondaryAddress,
                'type' => 'presencial',
                'payment_methods' => json_encode(['dinheiro', 'cartão']),
                'accessibility' => json_encode(['cadeirantes', 'gravidas']),
                'phone' => $faker->phoneNumber,
                'secundary_phone' => $faker->phoneNumber,
            ]);

            $address->services()->create([
                'user_id' => $user->id,
                'user_address_id' => $address->id,
                'name' => $faker->name,
                'price' => $faker->randomFloat(2, 10, 20),
                'is_active' => true
            ]);
        }

    }
}
