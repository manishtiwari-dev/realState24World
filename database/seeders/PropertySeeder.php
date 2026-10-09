<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

class PropertySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('en_IN');
        foreach (range(1, 100) as $index) {
            DB::table('properties')->insert([
                'name'              => $faker->streetName,
                'slug'              => Str::slug($faker->streetName . '-' . $index),
                'category_id'       => $faker->numberBetween(1, 5),
                'type'              => $faker->randomElement(['all-residential', 'flats-apartments','house-villas','builder-floors','farm-house','residential-plots','penthouse','studio-apartments','commercial','plot','industrial']),
                'keyword'           => $faker->words(3, true),
                'amount'            => $faker->numberBetween(100000, 5000000),
                'address'           => $faker->address,
                'city'              => $faker->city,
                'state_id'          => $faker->numberBetween(1, 20),
                'landmark'          => $faker->streetName,
                'area'              => $faker->numberBetween(500, 5000),
                'bedrooms'          => $faker->numberBetween(1, 5),
                'accomodation'      => $faker->numberBetween(1, 10),
                'bathrooms'         => $faker->numberBetween(1, 4),
                'yard_size'         => $faker->numberBetween(100, 2000),
                'garage'            => $faker->boolean,
                'wifi'              => $faker->boolean,
                'pool'              => $faker->boolean,
                'security'          => $faker->boolean,
                'laundry'           => $faker->boolean,
                'equipped_kitchen'  => $faker->boolean,
                'air_conditioning'  => $faker->boolean,
                'gym'               => $faker->boolean,
                'parking'           => $faker->boolean,
                'airport'           => $faker->boolean,
                'park'              => $faker->boolean,
                'busstand'          => $faker->boolean,
                'mandir'            => $faker->boolean,
                'hospital'          => $faker->boolean,
                'school'            => $faker->boolean,
                'railwaystation'    => $faker->boolean,
                'description'       => $faker->paragraph,
                'thumbnail'         => $faker->imageUrl(640, 480, 'house', true),
                'multiple_images'   => json_encode([
                    $faker->imageUrl(640, 480, 'house', true),
                    $faker->imageUrl(640, 480, 'house', true),
                ]),
                'metatitle'         => $faker->sentence,
                'metakeyword'       => $faker->words(5, true),
                'metadescription'   => $faker->sentence(10),
                'status'            => $faker->randomElement(['1', '0']),
                'dealer_id'         => $faker->numberBetween(1, 10),
            ]);
        }
    }
}
