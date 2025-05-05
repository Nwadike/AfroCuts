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
        Schema::table('barbershops', function (Blueprint $table) {
            // Add columns for ratings, Google Map data, and gallery
            $table->decimal('rating', 3, 2)->nullable()->after('facebook'); // Average rating (e.g., 4.50)
            $table->string('google_maps_url')->nullable()->after('rating'); // Link to Google Maps
            $table->json('gallery')->nullable()->after('google_maps_url'); // Store gallery image paths as JSON
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('barbershops', function (Blueprint $table) {
            // Drop the added columns
            $table->dropColumn(['rating', 'google_maps_url', 'gallery']);
        });
    }
};
