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
        $table->integer('age')->nullable();
        $table->integer('mobile')->nullable();
        $table->enum('gender', ['male', 'female', 'other'])->nullable();
        $table->integer('heart_rate')->nullable();
        $table->enum('bmi_category', ['Normal', 'Normal Weight', 'Obese', 'Overweight'])->nullable();
        $table->integer('systolic_bp')->nullable();
        $table->integer('diastolic_bp')->nullable();
        $table->integer('quality_of_sleep')->nullable(); // 1-10
        $table->integer('physical_activity_level')->nullable(); // 1-100
        $table->integer('stress_level')->nullable(); // 1-10
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
