<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
public function up()
    {
        Schema::create('model_has_roles', function (Blueprint $table) {
            $table->id();
            $table->morphs('model');  // This will create 'model_id' and 'model_type'
            $table->foreignId('role_id')->constrained('roles'); // References the roles table
            $table->timestamps();

            // Add a unique constraint to prevent duplicate role assignments
            $table->unique(['model_id', 'model_type', 'role_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_has_roles');
    }
};
