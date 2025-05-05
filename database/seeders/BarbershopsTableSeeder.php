<?php

namespace Database\Seeders;

use App\Models\Barbershop;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class BarbershopsTableSeeder extends Seeder
{
    public function run()
    {
        // Create a test user to own the barbershops
        $user = User::create([
            'name' => 'Barbershop Owner',
            'email' => 'owner@afrocuts.com',
            'password' => Hash::make('password'),
        ]);

        $barbershops = [
            [
                'name' => 'Fade Masters',
                'description' => 'Specializing in all types of fades and modern black hairstyles. Our barbers are experts in taper fades, high tops, and braids.',
                'address' => '123 Main St',
                'city' => 'Brooklyn',
                'state' => 'NY',
                'zip_code' => '11201',
                'phone' => '(718) 555-0101',
                'email' => 'fademasters@example.com',
                'services' => ['Haircut $30', 'Beard Trim $15', 'Line Up $10', 'Hot Towel Shave $25'],
                'working_hours' => [
                    'Monday' => '9:00 AM - 7:00 PM',
                    'Tuesday' => '9:00 AM - 7:00 PM',
                    'Wednesday' => '9:00 AM - 7:00 PM',
                    'Thursday' => '9:00 AM - 7:00 PM',
                    'Friday' => '9:00 AM - 8:00 PM',
                    'Saturday' => '10:00 AM - 6:00 PM',
                    'Sunday' => 'Closed'
                ]
            ],
            [
                'name' => 'Precision Cuts',
                'description' => 'Award-winning barbershop with over 15 years of experience in black hair care. We specialize in precision cuts and creative designs.',
                'address' => '456 Malcolm X Blvd',
                'city' => 'Harlem',
                'state' => 'NY',
                'zip_code' => '10027',
                'phone' => '(212) 555-0202',
                'email' => 'precisioncuts@example.com',
                'services' => ['Haircut $35', 'Kids Cut $25', 'Beard Grooming $20', 'Haircut & Shave $45'],
                'working_hours' => [
                    'Monday' => '10:00 AM - 6:00 PM',
                    'Tuesday' => '10:00 AM - 6:00 PM',
                    'Wednesday' => '10:00 AM - 6:00 PM',
                    'Thursday' => '10:00 AM - 8:00 PM',
                    'Friday' => '10:00 AM - 8:00 PM',
                    'Saturday' => '9:00 AM - 5:00 PM',
                    'Sunday' => 'Closed'
                ]
            ],
            [
                'name' => 'The Royal Trim',
                'description' => 'Upscale barbershop offering premium grooming services for men. Our barbers are trained in the latest techniques for black hair.',
                'address' => '789 Atlantic Ave',
                'city' => 'Brooklyn',
                'state' => 'NY',
                'zip_code' => '11217',
                'phone' => '(347) 555-0303',
                'email' => 'royaltrim@example.com',
                'services' => ['Executive Cut $40', 'Royal Shave $30', 'Scalp Treatment $25', 'Full Service $65'],
                'working_hours' => [
                    'Monday' => '8:00 AM - 6:00 PM',
                    'Tuesday' => '8:00 AM - 6:00 PM',
                    'Wednesday' => '8:00 AM - 6:00 PM',
                    'Thursday' => '8:00 AM - 8:00 PM',
                    'Friday' => '8:00 AM - 8:00 PM',
                    'Saturday' => '9:00 AM - 4:00 PM',
                    'Sunday' => '10:00 AM - 3:00 PM'
                ]
            ],
            [
                'name' => 'Fresh Fades',
                'description' => 'Where every cut is fresh and every client leaves looking their best. Specializing in fades, braids, and natural hairstyles.',
                'address' => '321 Fulton St',
                'city' => 'Brooklyn',
                'state' => 'NY',
                'zip_code' => '11201',
                'phone' => '(929) 555-0404',
                'email' => 'freshfades@example.com',
                'services' => ['Signature Fade $35', 'Beard Sculpt $20', 'Kids Fade $25', 'Design Work +$10'],
                'working_hours' => [
                    'Monday' => '9:00 AM - 7:00 PM',
                    'Tuesday' => '9:00 AM - 7:00 PM',
                    'Wednesday' => '9:00 AM - 7:00 PM',
                    'Thursday' => '9:00 AM - 7:00 PM',
                    'Friday' => '9:00 AM - 8:00 PM',
                    'Saturday' => '8:00 AM - 6:00 PM',
                    'Sunday' => 'Closed'
                ]
            ],
            [
                'name' => 'Smooth Operators',
                'description' => 'Old school barbershop with new school techniques. We take pride in our craft and attention to detail.',
                'address' => '654 Nostrand Ave',
                'city' => 'Brooklyn',
                'state' => 'NY',
                'zip_code' => '11216',
                'phone' => '(718) 555-0505',
                'email' => 'smoothops@example.com',
                'services' => ['Classic Cut $30', 'Hot Lather Shave $25', 'Edge Up $10', 'Senior Discount $20'],
                'working_hours' => [
                    'Monday' => '8:00 AM - 5:00 PM',
                    'Tuesday' => '8:00 AM - 5:00 PM',
                    'Wednesday' => '8:00 AM - 5:00 PM',
                    'Thursday' => '8:00 AM - 5:00 PM',
                    'Friday' => '8:00 AM - 6:00 PM',
                    'Saturday' => '8:00 AM - 4:00 PM',
                    'Sunday' => 'Closed'
                ]
            ],
            [
                'name' => 'Cut Above',
                'description' => 'A cut above the rest with our premium services and welcoming atmosphere. Specialists in all black hair textures.',
                'address' => '987 Flatbush Ave',
                'city' => 'Brooklyn',
                'state' => 'NY',
                'zip_code' => '11226',
                'phone' => '(347) 555-0606',
                'email' => 'cutabove@example.com',
                'services' => ['Signature Cut $40', 'Beard Trim $15', 'Haircut & Beard $50', 'Designs $10+'],
                'working_hours' => [
                    'Monday' => '9:00 AM - 7:00 PM',
                    'Tuesday' => '9:00 AM - 7:00 PM',
                    'Wednesday' => '9:00 AM - 7:00 PM',
                    'Thursday' => '9:00 AM - 7:00 PM',
                    'Friday' => '9:00 AM - 8:00 PM',
                    'Saturday' => '9:00 AM - 6:00 PM',
                    'Sunday' => '10:00 AM - 4:00 PM'
                ]
            ],
            [
                'name' => 'The Grooming Lounge',
                'description' => 'Luxury grooming experience with a focus on black men\'s hair care. Our barbers are masters of their craft.',
                'address' => '1472 Bedford Ave',
                'city' => 'Brooklyn',
                'state' => 'NY',
                'zip_code' => '11216',
                'phone' => '(917) 555-0707',
                'email' => 'groominglounge@example.com',
                'services' => ['Luxury Cut $45', 'Royal Treatment $60', 'Beard Therapy $25', 'Scalp Massage $20'],
                'working_hours' => [
                    'Monday' => '10:00 AM - 8:00 PM',
                    'Tuesday' => '10:00 AM - 8:00 PM',
                    'Wednesday' => '10:00 AM - 8:00 PM',
                    'Thursday' => '10:00 AM - 8:00 PM',
                    'Friday' => '10:00 AM - 9:00 PM',
                    'Saturday' => '9:00 AM - 7:00 PM',
                    'Sunday' => '11:00 AM - 5:00 PM'
                ]
            ],
            [
                'name' => 'Fade Factory',
                'description' => 'Specializing in crisp fades and sharp lineups. We transform hair into works of art with our skilled barbers.',
                'address' => '753 St Johns Pl',
                'city' => 'Brooklyn',
                'state' => 'NY',
                'zip_code' => '11216',
                'phone' => '(646) 555-0808',
                'email' => 'fadefactory@example.com',
                'services' => ['Fade Master $35', 'Line Up $15', 'Design Fade $45', 'Military Discount $5 off'],
                'working_hours' => [
                    'Monday' => '8:00 AM - 6:00 PM',
                    'Tuesday' => '8:00 AM - 6:00 PM',
                    'Wednesday' => '8:00 AM - 6:00 PM',
                    'Thursday' => '8:00 AM - 6:00 PM',
                    'Friday' => '8:00 AM - 7:00 PM',
                    'Saturday' => '8:00 AM - 5:00 PM',
                    'Sunday' => 'Closed'
                ]
            ],
            [
                'name' => 'Black Excellence Barbers',
                'description' => 'Celebrating black hair in all its forms. Our barbers are trained in all textures and styles from afros to fades.',
                'address' => '369 Rogers Ave',
                'city' => 'Brooklyn',
                'state' => 'NY',
                'zip_code' => '11225',
                'phone' => '(718) 555-0909',
                'email' => 'blackexcellence@example.com',
                'services' => ['Afro Trim $30', 'Twist Out $40', 'Beard Shape $20', 'Natural Hair Consultation $25'],
                'working_hours' => [
                    'Monday' => '10:00 AM - 6:00 PM',
                    'Tuesday' => '10:00 AM - 6:00 PM',
                    'Wednesday' => '10:00 AM - 6:00 PM',
                    'Thursday' => '10:00 AM - 8:00 PM',
                    'Friday' => '10:00 AM - 8:00 PM',
                    'Saturday' => '9:00 AM - 5:00 PM',
                    'Sunday' => 'Closed'
                ]
            ],
            [
                'name' => 'The Cutting Edge',
                'description' => 'Modern techniques with traditional values. We stay on the cutting edge of black men\'s grooming trends.',
                'address' => '852 Eastern Pkwy',
                'city' => 'Brooklyn',
                'state' => 'NY',
                'zip_code' => '11213',
                'phone' => '(347) 555-1010',
                'email' => 'cuttingedge@example.com',
                'services' => ['Trendsetter Cut $40', 'Skin Fade $35', 'Hot Towel Treatment $15', 'Student Discount $5 off'],
                'working_hours' => [
                    'Monday' => '9:00 AM - 7:00 PM',
                    'Tuesday' => '9:00 AM - 7:00 PM',
                    'Wednesday' => '9:00 AM - 7:00 PM',
                    'Thursday' => '9:00 AM - 7:00 PM',
                    'Friday' => '9:00 AM - 8:00 PM',
                    'Saturday' => '9:00 AM - 6:00 PM',
                    'Sunday' => '10:00 AM - 3:00 PM'
                ]
            ]
        ];

        foreach ($barbershops as $barbershopData) {
            $barbershop = new Barbershop();
            $barbershop->user_id = $user->id;
            $barbershop->name = $barbershopData['name'];
            $barbershop->description = $barbershopData['description'];
            $barbershop->address = $barbershopData['address'];
            $barbershop->city = $barbershopData['city'];
            $barbershop->state = $barbershopData['state'];
            $barbershop->zip_code = $barbershopData['zip_code'];
            $barbershop->phone = $barbershopData['phone'];
            $barbershop->email = $barbershopData['email'];
            $barbershop->services = $barbershopData['services'];
            $barbershop->working_hours = $barbershopData['working_hours'];
            $barbershop->is_approved = true;
            $barbershop->save();
        }
    }
}