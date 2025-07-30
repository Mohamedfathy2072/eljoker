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
            $table->foreignId('brand_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('car_model_id')->nullable()->constrained()->onDelete('set null');
            $table->year('model_year');
            $table->date('license_expire_date')->nullable(); // License Valid To

            // Vehicle specifications
            $table->foreignId('body_style_id')->nullable()->constrained()->onDelete('set null'); // SUV, Sedan, Hatchback, etc.
            $table->foreignId('type_id')->nullable()->constrained()->onDelete('set null'); // vehicle category
            $table->foreignId('fuel_economy_id')->nullable()->constrained()->onDelete('set null'); // Fuel economy reference
            $table->foreignId('transmission_type_id')->nullable()->constrained()->onDelete('set null'); // Automatic, Manual, etc.
            $table->foreignId('drive_type_id')->nullable()->constrained()->onDelete('set null'); // FWD, RWD, AWD, etc.
            $table->foreignId('engine_type_id')->nullable()->constrained()->onDelete('set null'); // Petrol, Diesel, Electric, Hybrid
            $table->integer('engine_capacity_cc'); // Engine capacity in cc

            // Physical attributes
            $table->string('color', 50);
            $table->foreignId('size_id')->nullable()->constrained()->onDelete('set null'); // Size Long, Width, Height

            // Performance & condition
            $table->unsignedInteger('mileage'); // Total kilometers driven
            $table->foreignId('horsepower_id')->nullable()->constrained()->onDelete('set null'); // Speed
            $table->foreignId('vehicle_status_id')->nullable()->constrained()->onDelete('set null'); // New, Used, etc.
            $table->string('refurbishment_status', 50); // Refurbishment status if applicable

            // Pricing
            $table->decimal('price', 12, 2); // Sale price
            $table->decimal('discount', 8, 2)->default(0); // Discount amount
            $table->decimal('monthly_installment', 10, 2)->nullable(); // Monthly payment option

            // Classification
            $table->foreignId('trim_id')->nullable()->constrained()->onDelete('set null'); // 1st Category (trim/grade)

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
