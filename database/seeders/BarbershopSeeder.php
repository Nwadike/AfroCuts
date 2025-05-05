<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Barbershop;
// Removed: use App\Models\Service; // No longer needed
use App\Models\User; // Assuming barbershops are owned by users
use Faker\Factory as Faker;

class BarbershopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get an existing user or create one if none exist
        $user = User::first() ?? User::factory()->create();

        // Define a base list of potential service names
        $baseServiceNames = [
            'Haircut',
            'Beard Trim',
            'Shave',
            'Fade',
            'Line Up',
            'Kids Cut',
            'Hot Towel Shave',
            'Facial',
            'Hair Wash',
            'Shape Up',
        ];

        // Create 12 new barbershops with full data and services in JSON
        for ($i = 0; $i < 12; $i++) { // Create 12 barbershops
            // Determine a random number of services to add (between 4 and 7)
            $numberOfServicesToAdd = $faker->numberBetween(4, 7);

            // Shuffle the base service names and take the required number
            $serviceNamesForThisBarbershop = $faker->randomElements($baseServiceNames, $numberOfServicesToAdd);

            // Build the services data array for the JSON column
            $servicesData = [];
            foreach ($serviceNamesForThisBarbershop as $serviceName) {
                 $servicesData[] = [
                     'name' => $serviceName,
                     'price' => $faker->randomFloat(2, 10, 60), // Random price between 10 and 60
                     'staff_name' => $faker->name, // Assign a random staff name
                 ];
            }

            Barbershop::create([
                'user_id' => $user->id, // Assign to the user
                'name' => $faker->company . ' Barbershop',
                'description' => $faker->paragraph(3),
                'address' => $faker->streetAddress,
                'city' => $faker->city,
                'state' => $faker->state,
                'zip_code' => $faker->postcode,
                'phone' => $faker->phoneNumber,
                'email' => $faker->companyEmail,
                'website' => $faker->url,
                'instagram' => $faker->userName,
                'facebook' => $faker->userName,
                'logo' => null, // You can add logic here to seed placeholder logos if needed
                'working_hours' => [ // Sample working hours
                    'monday' => '9:00 AM - 6:00 PM',
                    'tuesday' => '9:00 AM - 6:00 PM',
                    'wednesday' => '9:00 AM - 6:00 PM',
                    'thursday' => '9:00 AM - 6:00 PM',
                    'friday' => '9:00 AM - 7:00 PM',
                    'saturday' => '10:00 AM - 5:00 PM',
                    'sunday' => 'Closed',
                ],
                'rating' => $faker->randomFloat(2, 3.0, 5.0), // Random rating between 3.0 and 5.0
                'google_maps_url' => 'https://maps.google.com/?q=' . urlencode($faker->address), // Placeholder Google Maps URL
                'gallery' => [ // Sample gallery images (use placeholder URLs)
                    'https://placehold.co/400x300/E91E63/FFFFFF?text=Gallery+1',
                    'https://placehold.co/400x300/FF9800/FFFFFF?text=Gallery+2',
                    'https://placehold.co/400x300/4CAF50/FFFFFF?text=Gallery+3',
                ],
                'is_approved' => $faker->boolean(80), // 80% chance of being approved
                'services' => $servicesData, // Store the services data as JSON
            ]);
        }
    }
}
