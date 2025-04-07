<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('specialty_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('specialty_id');
            $table->tinyInteger('order')->default(0);
        });

        Schema::create('subspecialty_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->integer('subspecialty_id');
            $table->tinyInteger('order')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subspecialty_user');
        Schema::dropIfExists('specialty_user');
    }
};
