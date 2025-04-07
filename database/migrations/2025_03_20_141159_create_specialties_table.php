<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('specialties', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->mediumText('description');
        });

        Schema::create('subspecialties', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
        });

        Schema::create('specialty_subspecialty', function (Blueprint $table) {
            $table->foreignId('specialty_id')->constrained('specialties')->cascadeOnDelete();;
            $table->foreignId('subspecialty_id')->constrained('subspecialties')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('specialty_subspecialty');
        Schema::dropIfExists('specialties');
        Schema::dropIfExists('subspecialties');

    }
};
