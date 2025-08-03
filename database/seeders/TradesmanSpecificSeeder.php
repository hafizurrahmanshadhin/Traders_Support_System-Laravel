<?php

namespace Database\Seeders;

use App\Models\TradesmanSpecific;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TradesmanSpecificSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        TradesmanSpecific::insert([
            [
                'id'          => 1,
                'image'       => 'uploads/users/jobaed-bhuiyan-1723955257.png',
                'title'       => 'How Tradesman Specific Professional',
                'description' => '<ul><li><strong>Matching Platform:</strong></li></ul><p>Trade Support Pros is an online platform where tradespersons and service professionals can register their profiles.</p><ul><li><strong>Profiles and Preferences:</strong></li></ul><p>Tradespersons list their specific trade skills, location, availability, and any other relevant details. Similarly, service professionals list their expertise, services offered, rates, and availability.</p><ul><li><strong>Matching Platform:</strong></li></ul><p>Trade Support Pros is an online platform where tradespersons and service professionals can register their profiles.</p><ul><li><strong>Search and Connect:</strong></li></ul><p>Tradespersons seeking support can search the database of service professionals based on their specific needs. They can filter professionals by location, service offerings, experience, and reviews.</p><ul><li><strong>Search and Connect:</strong></li></ul><p>Trade Support Pros is an online platform where tradespersons and service professionals can register their profiles.</p><ul><li><strong>Services Provided:</strong></li></ul><p>Service professionals can offer a range of services to tradespersons, including administrative support, bookkeeping, accounting (CPA services), legal advice, contract drafting, and more.</p><ul><li><strong>Vetting and Quality Assurance:</strong></li></ul><p>Trade Support Pros is an online platform where tradespersons and service professionals can register their profiles.</p><ul><li><strong>Payment and Transactions:</strong></li></ul><p>The platform may facilitate payment processing for services rendered, ensuring both parties a seamless and secure transaction experience.</p><ul><li><strong>Feedback and Reviews:</strong></li></ul><p>Tradespersons can leave feedback and reviews for the service professionals they work with, helping further to establish trust and accountability within the platform\'s community.</p>',
                'status'      => 'active',
                'created_at'  => Carbon::create('2024', '06', '24', '11', '38', '25'),
                'updated_at'  => Carbon::create('2024', '06', '24', '17', '45', '57'),
                'deleted_at'  => null,
            ],
        ]);
    }
}
