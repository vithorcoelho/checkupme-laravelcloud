<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\User;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number', 50);
            $table->tinyInteger('is_active')->default(1);
        });
        
        $user_admin = User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('password'),
            'phone_number' => '123456789',
            'email_verified_at' => now(),
        ]);

        if ($user_admin->assignRole('admin')) {
            Log::info('Usuário admin criado com sucesso');
        } else {
            Log::error('Usuário não encontrado');
        }
    }
};
