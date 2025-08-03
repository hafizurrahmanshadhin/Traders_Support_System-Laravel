<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BoostSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $boosts = [
            [
                'id'               => 1,
                'name'             => 'Boost',
                'price'            => '2.00',
                'package_duration' => '5',
                // 'start_date'       => '2024-06-29 09:29:08',
                // 'end_date'         => '2024-06-29 09:34:08',
                'created_at'       => '2024-06-29 03:29:08',
                'updated_at'       => '2024-06-29 03:29:08',
            ],
        ];
        DB::table('boosts')->insert($boosts);
    }
}
