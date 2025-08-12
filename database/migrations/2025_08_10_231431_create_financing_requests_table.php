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
        Schema::create('financing_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('first_name');
            $table->string('second_name');
            $table->string('email');
            $table->foreignId('governorate_id')->constrained();
            $table->foreignId('area_id')->constrained();
            $table->string('street');
            $table->string('building_number');
            $table->string('floor_number')->nullable();
            $table->string('card_front');
            $table->string('card_back');
            $table->enum('applicant_type', ['student', 'employee']);
            $table->string('company_name')->nullable();
            $table->string('company_street')->nullable();
            $table->string('company_building')->nullable();
            $table->string('eco_position')->nullable();
            $table->decimal('mid_salary', 10, 2)->nullable();
            $table->enum('car_type', ['new', 'used']);
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->decimal('total_price', 10, 2);
            $table->decimal('down_payment', 10, 2);
            $table->integer('deposit_percentage');
            $table->string('car_model');
            $table->year('manufacture_year');
            $table->string('car_brand');
            $table->string('club_membership_card')->nullable();
            $table->string('medical_insurance_card')->nullable();
            $table->string('owned_car_license_front')->nullable();
            $table->string('owned_car_license_back')->nullable();
            $table->foreignId('university_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('faculty_id')->nullable()->constrained()->onDelete('set null');
            $table->enum('status', ['Cancelled', 'Rejected', 'Accepted', 'In process'])->default('In process');
            $table->integer('installment_plan')->default(12)->nullable(); // بالعدد: 12، 36، 60
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('financing_requests');
    }
};
