<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /**
         * Por que a maioria dos campos são nulos
        */
        Schema::create('user_professionals', function (Blueprint $table) {
            $table->foreignId('user_id')->primary()->constrained('users')->onDelete('cascade');
            $table->string('first_name', '100')->nullable();
            $table->string('last_name', '100')->nullable();
            $table->date('birthday')->nullable();
            $table->string('cpf', '20')->nullable();;
            $table->string('avatar', '255')->nullable();
            $table->string('title', '10')->nullable();
            $table->json('idioms')->nullable();
            $table->json('certificates')->nullable();
            $table->json('experiences')->nullable();
            $table->json('graduations')->nullable();
            $table->json('registers')->nullable();
            $table->text('about_me')->nullable();
            $table->json('gallery')->nullable();
            $table->string('slug', 255)->nullable()->unique();
            $table->json('social_networks')->nullable();
            $table->string('gender', 10)->nullable();

            // Por padrão é público e só poderá ser alterado pela plataforma ao completar o perfil
            $table->tinyInteger('is_public')->default(0);

            // Quando o usuário completar o perfil pela primeira vez, ele será marcado como completo
            // e o campo completed_at será preenchido com a data e hora atual
            $table->dateTime('completed_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_professionals');
    }
};
