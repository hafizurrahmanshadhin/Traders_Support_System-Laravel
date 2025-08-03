<?php

namespace Database\Factories;

use App\Models\UserDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserDetailFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition() {
        $imageUrls = [
            'frontend/images/gallery (2).png',
            'frontend/images/gallery (4).png',
            'frontend/images/gallery (5).png',
            'frontend/images/match-slider (1).png',
            'uploads/users/jobaed-bhuiyan-1723955257.png',
            'uploads/users/jobaed-bhuiyan-1723955257.png',
            'frontend/images/own-profile.png',
        ];

        return [
            'profile_picture'     => $this->faker->randomElement($imageUrls),
            'bio'                 => $this->faker->paragraph,
            'description'         => $this->faker->text,
            'phone_number'        => $this->faker->phoneNumber,
            'gender'              => $this->faker->randomElement(['male', 'female']),
            'languages'           => $this->faker->sentence,
            'key_skills'          => $this->faker->sentence,
            'industry'            => $this->faker->word,
            'current_designation' => $this->faker->jobTitle,
            'current_company'     => $this->faker->company,
            'location'            => $this->faker->city,
            'qualification'       => $this->faker->sentence,
            'address'             => $this->faker->address,
            'experience'          => $this->faker->randomNumber(2),
            'status'              => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
