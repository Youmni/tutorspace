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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('course_id')->constrained('courses', 'course_id')->onDelete('cascade');
            $table->foreignId('participant_id')->constrained('users', 'user_id')->onDelete('cascade');
            $table->foreignId('tutor_id')->constrained('users', 'user_id')->onDelete('cascade');            
            
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            
            $table->enum('session_type', ['online', 'physical'])->default('online');
            
            $table->decimal('price', 8, 2)->nullable();
            $table->enum('payment_status', ['paid', 'pending', 'canceled'])->default('pending');
            
            $table->enum('status', ['scheduled', 'pending', 'canceled'])->default('pending');
            
            $table->text('comments')->nullable();
            $table->text('feedback')->nullable();
            
            $table->json('material_links')->nullable(); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
