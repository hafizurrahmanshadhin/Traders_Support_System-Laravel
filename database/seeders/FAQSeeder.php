<?php

namespace Database\Seeders;

use App\Models\FAQ;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FAQSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        FAQ::insert([
            [
                'id'         => 1,
                'question'   => 'What types of goods do you trade?',
                'answer'     => 'Our goal is to provide high-quality products across these categories to support businesses in different sectors. If you have specific needs or inquiries about other types of goods, please contact our sales team for more detailed information.',
                'status'     => 'active',
                'created_at' => Carbon::create('2024', '06', '24', '10', '43', '19'),
                'updated_at' => Carbon::create('2024', '06', '24', '10', '43', '19'),
                'deleted_at' => null,
            ],
            [
                'id'         => 2,
                'question'   => 'What regions or countries do you operate in?',
                'answer'     => 'Our goal is to provide high-quality products across these categories to support businesses in different sectors. If you have specific needs or inquiries about other types of goods, please contact our sales team for more detailed information.',
                'status'     => 'active',
                'created_at' => Carbon::create('2024', '06', '24', '10', '43', '58'),
                'updated_at' => Carbon::create('2024', '06', '24', '10', '43', '58'),
                'deleted_at' => null,
            ],
            [
                'id'         => 3,
                'question'   => 'Do you have any certifications or accreditations?',
                'answer'     => 'Our goal is to provide high-quality products across these categories to support businesses in different sectors. If you have specific needs or inquiries about other types of goods, please contact our sales team for more detailed information.',
                'status'     => 'active',
                'created_at' => Carbon::create('2024', '06', '24', '10', '44', '38'),
                'updated_at' => Carbon::create('2024', '06', '24', '10', '44', '38'),
                'deleted_at' => null,
            ],
            [
                'id'         => 4,
                'question'   => 'What are your business hours?',
                'answer'     => 'Our goal is to provide high-quality products across these categories to support businesses in different sectors. If you have specific needs or inquiries about other types of goods, please contact our sales team for more detailed information.',
                'status'     => 'active',
                'created_at' => Carbon::create('2024', '06', '24', '10', '45', '08'),
                'updated_at' => Carbon::create('2024', '06', '24', '10', '45', '08'),
                'deleted_at' => null,
            ],
            [
                'id'         => 5,
                'question'   => 'What regions or countries do you operate in?',
                'answer'     => 'Our goal is to provide high-quality products across these categories to support businesses in different sectors. If you have specific needs or inquiries about other types of goods, please contact our sales team for more detailed information.',
                'status'     => 'active',
                'created_at' => Carbon::create('2024', '06', '24', '10', '45', '40'),
                'updated_at' => Carbon::create('2024', '06', '24', '10', '45', '40'),
                'deleted_at' => null,
            ],
        ]);
    }
}
