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
        Schema::create('foods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category');
            $table->integer('calories');
            $table->decimal('protein', 5, 2)->default(0);
            $table->decimal('carbohydrate', 5, 2)->default(0);
            $table->decimal('fat', 5, 2)->default(0);
            $table->decimal('fiber', 5, 2)->default(0);
            $table->decimal('sugar', 5, 2)->default(0);
            $table->string('serving_size')->default('100g');
            $table->boolean('is_admin_approved')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('foods');
    }
};
