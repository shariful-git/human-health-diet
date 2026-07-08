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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->integer('age');
            $table->decimal('height', 5, 2);
            $table->decimal('weight', 5, 2);
            $table->enum('activity_level', ['low', 'medium', 'high']);
            $table->enum('goal', ['weight_loss', 'weight_gain', 'maintain', 'muscle_gain']);
            $table->integer('daily_calorie_target')->nullable();
            $table->decimal('bmi', 4, 2)->nullable();
            $table->integer('bmr')->nullable();
            $table->integer('tdee')->nullable();
            $table->json('medical_conditions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
