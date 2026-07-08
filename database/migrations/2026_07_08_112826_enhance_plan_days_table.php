<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('plan_days', function (Blueprint $table) {
            $table->text('breakfast_suggestion')->nullable()->after('day_number');
            $table->text('lunch_suggestion')->nullable()->after('breakfast_suggestion');
            $table->text('dinner_suggestion')->nullable()->after('lunch_suggestion');
            $table->text('snacks_suggestion')->nullable()->after('dinner_suggestion');

            $table->text('exercise_suggestion')->nullable()->after('snacks_suggestion');
        });
    }

    public function down(): void
    {
        Schema::table('plan_days', function (Blueprint $table) {
            $table->dropColumn(['breakfast_suggestion', 'lunch_suggestion', 'dinner_suggestion', 'snacks_suggestion', 'exercise_suggestion']);
        });
    }
};
