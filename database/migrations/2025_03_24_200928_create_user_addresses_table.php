<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('name', 100);
            $table->string('address', 100);
            $table->string('city', 50);
            $table->string('state', 50);
            $table->string('zip_code', 20)->nullable();
            $table->string('description', 255)->nullable();
            $table->enum('type', ['presencial', 'online'])->default('presencial');
            $table->json('payment_methods')->nullable();
            $table->json('accessibility')->nullable();
            $table->json('audience')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('secundary_phone', 20)->nullable();
            $table->string('website', 100)->nullable();
            $table->integer('order')->nullable();
            $table->tinyInteger('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};
