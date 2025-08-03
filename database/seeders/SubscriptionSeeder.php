<?php

namespace Database\Seeders;

use App\Models\Subscription;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        Subscription::insert([
            [
                'id'               => 1,
                'user_type'        => 'pro',
                'package_type'     => 'basic',
                'price'            => '144',
                'timeline'         => 'Month',
                'feature'          => '<ul><li>Enhance Your Experience</li><li>Enhance Your Experience</li><li>Enhance Your Experience</li><li>Enhance Your Experience</li><li>Enhance Your Experience</li></ul>',
                'package_duration' => '30',
                'view_limit'       => 3,
                'message_limit'    => 3,
                'status'           => 'active',
                'created_at'       => '2024-06-24 00:18:11',
                'updated_at'       => '2024-06-24 00:18:11',
                'deleted_at'       => null,
            ],
            [
                'id'               => 2,
                'user_type'        => 'pro',
                'package_type'     => 'elite',
                'price'            => '440',
                'timeline'         => 'Month',
                'feature'          => '<ul><li>Enhance Your Experience</li><li>Enhance Your Experience</li><li>Enhance Your Experience</li><li>Enhance Your Experience</li><li>Enhance Your Experience</li></ul>',
                'package_duration' => '30',
                'view_limit'       => 5,
                'message_limit'    => 5,
                'status'           => 'active',
                'created_at'       => '2024-06-24 00:21:22',
                'updated_at'       => '2024-06-24 00:21:22',
                'deleted_at'       => null,
            ],
            [
                'id'               => 3,
                'user_type'        => 'trade',
                'package_type'     => 'popular',
                'price'            => '420.50',
                'timeline'         => 'Week',
                'feature'          => '<ul><li>Enhance Your Experience</li><li>Enhance Your Experience</li><li>Enhance Your Experience</li><li>Enhance Your Experience</li><li>Enhance Your Experience</li></ul>',
                'package_duration' => '7',
                'view_limit'       => 3,
                'message_limit'    => 3,
                'status'           => 'active',
                'created_at'       => '2024-06-24 06:31:44',
                'updated_at'       => '2024-06-24 06:31:44',
                'deleted_at'       => null,
            ],
            [
                'id'               => 4,
                'user_type'        => 'trade',
                'package_type'     => 'month',
                'price'            => '212.20',
                'timeline'         => 'Month',
                'feature'          => '<ul><li>Enhance Your Experience</li><li>Enhance Your Experience</li><li>Enhance Your Experience</li><li>Enhance Your Experience</li><li>Enhance Your Experience</li></ul>',
                'package_duration' => '30',
                'view_limit'       => 5,
                'message_limit'    => 5,
                'status'           => 'active',
                'created_at'       => '2024-06-24 06:32:17',
                'updated_at'       => '2024-06-24 06:32:17',
                'deleted_at'       => null,
            ],
            [
                'id'               => 5,
                'user_type'        => 'trade',
                'package_type'     => 'Year',
                'price'            => '600',
                'timeline'         => 'Yearly',
                'feature'          => '<ul><li>Enhance Your Experience</li><li>Enhance Your Experience</li><li>Enhance Your Experience</li><li>Enhance Your Experience</li><li>Enhance Your Experience</li></ul>',
                'package_duration' => '365',
                'view_limit'       => 7,
                'message_limit'    => 7,
                'status'           => 'active',
                'created_at'       => '2024-06-24 06:32:47',
                'updated_at'       => '2024-06-24 06:32:47',
                'deleted_at'       => null,
            ],
        ]);
    }
}
