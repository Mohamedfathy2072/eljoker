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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name_en', 191)->nullable();
            $table->string('name_ar', 191)->nullable();
            $table->string('email', 191)->unique();
            $table->string('phone', 15)->unique()->nullable();
            $table->string('otp_hash')->nullable();
            $table->timestamp('otp_expires_at')->nullable();
            $table->boolean('is_verified')->default(false);
            $table->boolean('is_active')->default(false);
            $table->boolean('completed_registration')->default(false);
            $table->string('fcm_token')->nullable();
            $table->decimal('wallet', 12, 2)->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
