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
            $table->id('reservation_id');
            $table->date('date');
            $table->time('start_time');
            $table->time('end_time');
            $table->enum('status', ['pending', 'approved', 'cancelled']);
            $table->unsignedBigInteger('course_id');
            $table->unsignedBigInteger('tutor_id');
            $table->unsignedBigInteger('client_id');
            $table->foreign('course_id')->references('course_id')->on('courses')->onDelete('cascade');
            $table->foreign('tutor_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('client_id')->references('user_id')->on('users')->onDelete('cascade');
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
