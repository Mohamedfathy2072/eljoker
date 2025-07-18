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

            // Vehicle specifications
            $table->string('body_style', 50); // SUV, Sedan, Hatchback, etc.
            $table->string('type', 50); // vehicle category
            $table->string('fuel_type', 20); // petrol/diesel
            $table->string('transmission_type', 20); // Automatic, Manual, etc.
            $table->string('drive_type', 20); // FWD, RWD, AWD, etc.

            // Physical attributes
            $table->string('color', 50);

            // Performance & condition
            $table->unsignedInteger('mileage'); // Total kilometers driven
            $table->unsignedInteger('speed')->nullable(); // Max speed or current speed rating
            $table->string('vehicle_status', 20); // New, Used, etc.
            $table->string('refurbishment_status', 50)->nullable(); // Refurbishment status if applicable
            
            // Pricing
            $table->decimal('price', 12, 2); // Sale price
            $table->decimal('discount', 8, 2)->default(0); // Discount amount
            $table->decimal('monthly_installment', 10, 2)->nullable(); // Monthly payment option

            // Classification
            $table->string('category', 50); // 1st Category (trim/grade)

            $table->timestamps();

            // Indexes for common queries
            $table->index(['brand', 'model']);
            $table->index('price');
            $table->index(['model_year', 'type']);
            $table->index(['fuel_type', 'transmission_type']);
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
