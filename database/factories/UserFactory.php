<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Factory as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $this->faker = Faker::create('id_ID');
        return [
            'name'          => $this->faker->name(),
            'email'         => $this->faker->unique()->companyEmail(),
            'password'      => bcrypt('secret'),
            'status'        => $this->faker->randomElement(['aktif', 'non-aktif']),
            'instansi'      => $this->faker->company(),
            'divisi'        => $this->faker->randomElement(['Divisi A', 'Divisi B', 'Divisi C', 'Divisi D']),
            'jabatan'       => $this->faker->jobTitle(),
            "umur"          => $this->faker->numberBetween(20, 65),
            "alamat"        => $this->faker->address()
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
