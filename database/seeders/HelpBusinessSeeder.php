<?php

namespace Database\Seeders;

use App\Models\HelpBusiness;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class HelpBusinessSeeder extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        HelpBusiness::insert([
            [
                'id'          => 1,
                'type'        => 'pro',
                'image'       => 'frontend/images/service-icon (4).png',
                'title'       => 'Expand Your Client Base',
                'description' => '<p>By joining forces with skilled tradespersons, you tap into a new pool of potential clients. From plumbers to electricians, carpenters to HVAC technicians, these professionals often require specialized services like legal counsel, financial management, administrative support, and more.</p>',
                'status'      => 'inactive',
                'created_at'  => Carbon::create('2024', '06', '24', '11', '06', '45'),
                'updated_at'  => Carbon::create('2024', '06', '24', '11', '23', '53'),
                'deleted_at'  => null,
            ],
            [
                'id'          => 2,
                'type'        => 'pro',
                'image'       => 'frontend/images/service-icon (3).png',
                'title'       => 'Create Value-Added Services',
                'description' => '<p>Your expertise complements that of skilled tradespersons, allowing you to offer comprehensive solutions to clients. Whether you assist with contract drafting, manage finances, provide legal advice, or streamline administrative processes, your services enhance the overall value proposition for clients.</p>',
                'status'      => 'active',
                'created_at'  => Carbon::create('2024', '06', '24', '11', '12', '25'),
                'updated_at'  => Carbon::create('2024', '06', '24', '11', '27', '51'),
                'deleted_at'  => null,
            ],
            [
                'id'          => 3,
                'type'        => 'pro',
                'image'       => 'frontend/images/service-icon (2).png',
                'title'       => 'Build Long-Term Relationships',
                'description' => '<p>Trade Support Pros is an online platform where tradespersons and service professionals can register their profiles.</p>',
                'status'      => 'active',
                'created_at'  => Carbon::create('2024', '06', '24', '11', '13', '29'),
                'updated_at'  => Carbon::create('2024', '06', '24', '11', '27', '53'),
                'deleted_at'  => null,
            ],
            [
                'id'          => 4,
                'type'        => 'pro',
                'image'       => 'frontend/images/service-icon (1).png',
                'title'       => 'Gain Insights into Other Industries',
                'description' => '<p>Partnering with skilled tradespersons exposes you to different industries and their unique challenges. This cross-pollination of ideas can spark innovation, broaden your perspective, and ultimately make you a more versatile and adaptable professional.</p>',
                'status'      => 'active',
                'created_at'  => Carbon::create('2024', '06', '24', '11', '14', '50'),
                'updated_at'  => Carbon::create('2024', '06', '24', '11', '27', '56'),
                'deleted_at'  => null,
            ],
            [
                'id'          => 5,
                'type'        => 'pro',
                'image'       => 'frontend/images/service-icon (1).png',
                'title'       => 'Diversify Your Revenue Streams',
                'description' => '<p>By diversifying your client portfolio to include skilled tradespersons, you reduce reliance on any single market or industry. This stability can be particularly advantageous during economic downturns or fluctuations in demand within your primary client base.</p>',
                'status'      => 'active',
                'created_at'  => Carbon::create('2024', '06', '24', '11', '15', '50'),
                'updated_at'  => Carbon::create('2024', '06', '24', '11', '28', '41'),
                'deleted_at'  => null,
            ],
            [
                'id'          => 6,
                'type'        => 'pro',
                'image'       => 'frontend/images/service-icon (1).png',
                'title'       => 'Contribute to Community Growth',
                'description' => '<p>By supporting skilled tradespersons, you\'re not just building your own business but also contributing to local communities\' growth and vitality. Strong partnerships between service professionals and skilled tradespersons foster economic development, job creation, and prosperity.</p>',
                'status'      => 'active',
                'created_at'  => Carbon::create('2024', '06', '24', '11', '16', '49'),
                'updated_at'  => Carbon::create('2024', '06', '24', '11', '28', '39'),
                'deleted_at'  => null,
            ],
            [
                'id'          => 7,
                'type'        => 'trade',
                'image'       => 'frontend/images/service-icon (4).png',
                'title'       => 'Focus on Your Core Strengths',
                'description' => '<p>As a skilled tradesperson, your time and energy are best spent honing your craft and serving your clients. By enlisting the support of service professionals, you can offload tasks such as bookkeeping, contract management, legal compliance, and administrative duties, allowing you to focus on what you do best.</p>',
                'status'      => 'active',
                'created_at'  => Carbon::create('2024', '06', '24', '11', '19', '58'),
                'updated_at'  => Carbon::create('2024', '06', '24', '11', '28', '35'),
                'deleted_at'  => null,
            ],
            [
                'id'          => 8,
                'type'        => 'trade',
                'image'       => 'frontend/images/service-icon (3).png',
                'title'       => 'Enhance Professionalism and Credibility',
                'description' => '<p>Collaborating with service professionals adds a layer of professionalism to your business dealings. Clients value partners who demonstrate a commitment to excellence in every aspect of their operation. With the support of service professionals, you can present yourself as a well-rounded, reputable entity, enhancing your credibility in the eyes of potential clients.</p>',
                'status'      => 'active',
                'created_at'  => Carbon::create('2024', '06', '24', '11', '21', '19'),
                'updated_at'  => Carbon::create('2024', '06', '24', '11', '28', '27'),
                'deleted_at'  => null,
            ],
            [
                'id'          => 9,
                'type'        => 'trade',
                'image'       => 'frontend/images/service-icon (2).png',
                'title'       => 'Streamline Business Operations',
                'description' => '<p>Managing the day-to-day operations of a trade business can be overwhelming. Service professionals bring efficiency and organization to your business processes, helping you streamline operations, reduce overhead costs, and optimize productivity.</p>',
                'status'      => 'inactive',
                'created_at'  => Carbon::create('2024', '06', '24', '11', '24', '49'),
                'updated_at'  => Carbon::create('2024', '06', '24', '11', '29', '49'),
                'deleted_at'  => null,
            ],
            [
                'id'          => 10,
                'type'        => 'trade',
                'image'       => 'frontend/images/service-icon (1).png',
                'title'       => 'Navigate Regulatory Challenges with Ease',
                'description' => '<p>The regulatory landscape for skilled tradespersons is constantly evolving, with numerous compliance requirements to adhere to. Service professionals with expertise in legal and regulatory matters can help you confidently navigate these challenges, ensuring that your business remains compliant and protected.</p>',
                'status'      => 'active',
                'created_at'  => Carbon::create('2024', '06', '24', '11', '25', '45'),
                'updated_at'  => Carbon::create('2024', '06', '24', '11', '28', '49'),
                'deleted_at'  => null,
            ],
            [
                'id'          => 11,
                'type'        => 'trade',
                'image'       => 'frontend/images/service-icon (1).png',
                'title'       => 'Forge Long-Term Partnerships',
                'description' => '<p>Beyond transactional relationships, partnering with service professionals fosters long-term collaborations built on trust, reliability, and mutual respect. As you work together to support each other\'s businesses, you\'ll form enduring partnerships contributing to your success.</p>',
                'status'      => 'active',
                'created_at'  => Carbon::create('2024', '06', '24', '11', '27', '02'),
                'updated_at'  => Carbon::create('2024', '06', '24', '11', '28', '47'),
                'deleted_at'  => null,
            ],
        ]);
    }
}
