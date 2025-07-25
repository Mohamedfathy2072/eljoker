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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();

            // Car identification
            $table->string('brand', 100);
            $table->string('model', 100);
            $table->year('model_year');
            $table->date('license_expire_date')->nullable(); // License Valid To

            // Vehicle specifications
            $table->string('body_style', 50); // SUV, Sedan, Hatchback, etc.
            $table->string('type', 50); // vehicle category
            $table->foreignId('fuel_economy_id')->nullable()->constrained()->onDelete('set null'); // Fuel economy reference
            $table->string('transmission_type', 20); // Automatic, Manual, etc.
            $table->string('drive_type', 20); // FWD, RWD, AWD, etc.
            $table->string('engine_type', 50); // Petrol, Diesel, Electric, Hybrid
            $table->integer('engine_capacity_cc'); // Engine capacity in cc

            // Physical attributes
            $table->string('color', 50);
            $table->foreignId('size_id')->nullable()->constrained()->onDelete('set null'); // Size Long, Width, Height

            // Performance & condition
            $table->unsignedInteger('mileage'); // Total kilometers driven
            $table->foreignId('horsepower_id')->nullable()->constrained()->onDelete('set null'); // Speed
            $table->string('vehicle_status', 20); // New, Used, etc.
            $table->string('refurbishment_status', 50); // Refurbishment status if applicable

            // Pricing
            $table->decimal('price', 12, 2); // Sale price
            $table->decimal('discount', 8, 2)->default(0); // Discount amount
            $table->decimal('monthly_installment', 10, 2)->nullable(); // Monthly payment option

            // Classification
            $table->string('trim', 50); // 1st Category (trim/grade)

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
