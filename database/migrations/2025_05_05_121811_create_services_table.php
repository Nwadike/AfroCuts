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
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('barbershop_id')->constrained()->onDelete('cascade'); // Link to the barbershop
            $table->string('name'); // Service name (e.g., "Haircut", "Beard Trim")
            $table->decimal('price', 8, 2); // Service price
            $table->string('staff_name')->nullable(); // Name of the staff member providing the service (optional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
