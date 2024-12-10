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
        Schema::table('courseworks', function (Blueprint $table) {
            $table->decimal('cat_1', 5, 2)->nullable();
            $table->decimal('cat_2', 5, 2)->nullable();
            $table->decimal('assignment_1', 5, 2)->nullable();
            $table->decimal('assignment_2', 5, 2)->nullable();
            $table->decimal('assignment_3', 5, 2)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('courseworks', function (Blueprint $table) {
            $table->dropColumn(['cat_1', 'cat_2', 'assignment_1', 'assignment_2', 'assignment_3']);
        });
    }
};
