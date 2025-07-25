<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('horsepowers', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('min'); // Horsepower start value
            $table->unsignedInteger('max'); // Horsepower end value
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horsepowers');
    }
};
