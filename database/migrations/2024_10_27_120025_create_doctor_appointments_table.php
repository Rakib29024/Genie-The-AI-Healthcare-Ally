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
        Schema::create('doctor_appointments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_problem_id');
            $table->bigInteger('user_id');
            $table->bigInteger('problem_id')->nullable();
            $table->longText('details')->nullable();
            $table->date('appointment_date');
            $table->time('appointment_time')->nullable();
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_appointments');
    }
};
