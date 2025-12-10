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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            // Relasi ke User (Organizer)
            $table->foreignId('organizer_id')->constrained('users')->onDelete('cascade');

            $table->string('title');
            $table->text('description');
            $table->date('event_date'); // Pakai date aja cukup, atau dateTime kalau mau jamnya
            $table->string('location');
            $table->enum('status', ['open', 'closed', 'canceled'])->default('open');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
