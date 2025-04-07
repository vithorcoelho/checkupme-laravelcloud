<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /**
         * CONVÊNIOS
         */
        Schema::create('agreements', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->tinyText('description');
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });

        /**
         * Pivô CONVÊNIOS e ENDEREÇOS
         */
        Schema::create('agreement_address', function (Blueprint $table) {
            $table->foreignId('agreement_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('agreement_address');
        Schema::dropIfExists('agreements');
    }
};
