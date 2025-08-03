<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory {
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Counter for generating unique emails and names.
     *
     * @var int
     */
    protected static $counter = 1;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition() {
        $counter = self::$counter;
        $email   = 'user' . $counter . '@user.com';
        $name    = 'user_' . $counter;

        // Increment the counter for the next factory instance
        self::$counter++;

        return [
            'name'              => $name,
            'email'             => $email,
            'email_verified_at' => now(),
            'password'          => bcrypt('12345678'),
            'role'              => 'pro',
            'terms_accepted'    => 1,
            'created_at'        => now(),
            'updated_at'        => now(),
            'is_subscribed'     => 0,
            'google_id'         => null,
            'remember_token'    => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return $this
     */
    public function unverified() {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
