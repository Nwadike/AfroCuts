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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to the user who made the booking
            $table->foreignId('barbershop_id')->constrained()->onDelete('cascade'); // Link to the barbershop being booked
            $table->date('date'); // The date of the booking
            $table->string('time_slot'); // The time slot (e.g., 'morning', 'afternoon', 'evening')
            $table->json('services'); // Store selected services as a JSON array
            $table->decimal('total_amount', 8, 2); // Store the total amount
            $table->text('notes')->nullable(); // Optional notes from the user
            $table->string('status')->default('pending'); // Booking status
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
