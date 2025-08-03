<?php

namespace Database\Seeders;

use App\Models\FindingThePerfectMatche;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class FindingThePerfectMatcheSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        FindingThePerfectMatche::insert([
            [
                'id'         => 1,
                'image'      => 'frontend/images/match-slider (1).png',
                'title'      => 'Catering',
                'status'     => 'active',
                'created_at' => Carbon::create('2024', '06', '24', '11', '52', '36'),
                'updated_at' => Carbon::create('2024', '06', '24', '17', '54', '04'),
                'deleted_at' => null,
            ],
            [
                'id'         => 2,
                'image'      => 'frontend/images/match-slider (2).png',
                'title'      => 'Catering',
                'status'     => 'active',
                'created_at' => Carbon::create('2024', '06', '24', '11', '52', '52'),
                'updated_at' => Carbon::create('2024', '06', '24', '17', '54', '17'),
                'deleted_at' => null,
            ],
            [
                'id'         => 3,
                'image'      => 'frontend/images/match-slider (3).png',
                'title'      => 'Catering',
                'status'     => 'active',
                'created_at' => Carbon::create('2024', '06', '24', '11', '52', '58'),
                'updated_at' => Carbon::create('2024', '06', '24', '17', '54', '31'),
                'deleted_at' => null,
            ],
            [
                'id'         => 4,
                'image'      => 'frontend/images/match-slider (4).png',
                'title'      => 'Catering',
                'status'     => 'active',
                'created_at' => Carbon::create('2024', '06', '24', '11', '53', '04'),
                'updated_at' => Carbon::create('2024', '06', '24', '17', '54', '44'),
                'deleted_at' => null,
            ],
            [
                'id'         => 5,
                'image'      => 'frontend/images/match-slider (2).png',
                'title'      => 'Catering',
                'status'     => 'active',
                'created_at' => Carbon::create('2024', '06', '24', '11', '53', '11'),
                'updated_at' => Carbon::create('2024', '06', '24', '17', '54', '55'),
                'deleted_at' => null,
            ],
            [
                'id'         => 6,
                'image'      => 'frontend/images/match-slider (3).png',
                'title'      => 'Catering',
                'status'     => 'active',
                'created_at' => Carbon::create('2024', '06', '24', '11', '53', '17'),
                'updated_at' => Carbon::create('2024', '06', '24', '17', '55', '06'),
                'deleted_at' => null,
            ],
        ]);
    }
}
