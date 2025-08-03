<?php

namespace Database\Seeders;

use App\Models\Experience;
use App\Models\User;
use App\Models\UserDetail;
use Database\Seeders\UserSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call([
            UserSeeder::class,
            QuestionSeeder::class,
            OptionSeeder::class,
            FAQSeeder::class,
            TestimonialSeeder::class,
            TradesmanSpecificSeeder::class,
            FindingThePerfectMatcheSeeder::class,
            HelpBusinessSeeder::class,
            ChooseBusinessSeeder::class,
            SubscriptionSeeder::class,
            SocialMediaSeeder::class,
            SystemSettingSeeder::class,
            BoostSeeder::class,
        ]);

        User::factory()->count(20)->create()->each(function ($user) {
            $user->userDetail()->save(UserDetail::factory()->make());
            $user->experiences()->saveMany(Experience::factory()->count(3)->make());
        });
    }
}
