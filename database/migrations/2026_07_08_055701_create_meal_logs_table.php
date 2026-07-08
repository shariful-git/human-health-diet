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
        Schema::create('meal_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('daily_log_id')->constrained()->onDelete('cascade');
            $table->foreignId('food_id')->constrained('foods')->cascadeOnDelete();
            $table->enum('meal_type', ['breakfast', 'lunch', 'dinner', 'snacks']);
            $table->decimal('servings', 4, 1)->default(1.0);
            $table->integer('calculated_calories');
            $table->boolean('is_completed')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meal_logs');
    }
};
