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
        Schema::create('workouts', function (Blueprint $table) {
            $table->id('workoutid');
            $table->unsignedBigInteger('userid');
            $table->unsignedBigInteger('exerciseid');
            $table->date('date');
            $table->integer('sets');
            $table->integer('reps');
            $table->timestamps();

            $table->foreign('userid')->references('userid')->on('users')->onDelete('cascade');
            $table->foreign('exerciseid')->references('exerciseid')->on('exercise')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('workouts');
    }
};
