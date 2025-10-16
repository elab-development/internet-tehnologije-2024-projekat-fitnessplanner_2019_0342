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
        Schema::create('workout_exercise', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('workoutid');
            $table->unsignedBigInteger('exerciseid');
            $table->integer('sets');
            $table->integer('reps');
            $table->timestamps();

            $table->foreign('workoutid')->references('workoutid')->on('workouts')->onDelete('cascade');
            $table->foreign('exerciseid')->references('exerciseid')->on('exercise')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workout_exercise');
    }
};
