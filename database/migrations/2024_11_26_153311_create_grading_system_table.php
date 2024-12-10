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
        Schema::create('grading_system', function (Blueprint $table) {
            $table->id();
            $table->string('grade'); // e.g., A, B+, etc.
            $table->integer('min_score'); // e.g., 70
            $table->integer('max_score'); // e.g., 79
            $table->timestamps();
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grading_system');
    }
};
