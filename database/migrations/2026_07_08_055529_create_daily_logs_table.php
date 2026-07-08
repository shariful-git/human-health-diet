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
        Schema::create('daily_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->integer('total_calories_intake')->default(0);
            $table->integer('total_calories_burn')->default(0);
            $table->integer('water_intake_ml')->default(0);
            $table->decimal('sleep_hours', 4, 1)->default(0);
            $table->decimal('weight_kg', 5, 2)->nullable();
            $table->integer('steps')->default(0);
            $table->enum('mood', ['happy', 'neutral', 'tired', 'stressed'])->nullable();
            $table->boolean('is_completed')->default(false);
            $table->timestamps();

            $table->unique(['user_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_logs');
    }
};
