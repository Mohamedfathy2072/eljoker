<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('model_has_permissions', function (Blueprint $table) {
            $table->id();
            $table->string('model', 119); // Creates 'model_id' and 'model_type' for polymorphic relationship
            $table->foreignId('permission_id')->constrained('permissions'); // References the permissions table
            $table->timestamps();

            // Add a unique constraint to prevent assigning the same permission to the same model more than once
            $table->unique(['model_id', 'model_type', 'permission_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('model_has_permissions');
    }
};
