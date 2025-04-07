<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('user_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_address_id')->constrained()->onDelete('cascade');
            $table->foreignId('platform_service_id')->nullable()->constrained();
            $table->string('name', 100);
            $table->string('description', 255)->nullable();
            $table->integer('price')->nullable();
            $table->integer('order')->nullable();
            $table->tinyInteger('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_services');
    }
};
