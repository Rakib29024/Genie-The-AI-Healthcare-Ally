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
        Schema::create('food', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_problem_id');
            $table->string('name');
            $table->integer('quantity')->default(1);
            $table->string('unit')->nullable();
            $table->text('description')->nullable();
            $table->string('category')->nullable();
            $table->decimal('calories', 8, 2)->nullable();
            $table->decimal('protein', 8, 2)->nullable();
            $table->decimal('fat', 8, 2)->nullable();
            $table->decimal('carbohydrates', 8, 2)->nullable();
            $table->boolean('is_vegan')->default(false);
            $table->boolean('is_gluten_free')->default(false);
            $table->text('allergens')->nullable();
            $table->string('origin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
