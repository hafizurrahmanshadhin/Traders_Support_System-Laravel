<?php

namespace Database\Factories;

use App\Models\Experience;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Experience>
 */
class ExperienceFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Experience::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        return [
            'user_id'          => null,
            'company_name'     => $this->faker->company,
            'designation'      => $this->faker->jobTitle,
            'details'          => $this->faker->paragraphs(3, true),
            'starting_date'    => $this->faker->date,
            'ending_date'      => $this->faker->date,
            'company_location' => $this->faker->city,
            'status'           => 'active',
            'created_at'       => now(),
            'updated_at'       => now(),
            'deleted_at'       => null,
        ];
    }
}
