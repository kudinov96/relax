<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chair>
 */
class ChairFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "device_id"   => $this->faker->uuid,
            "device_code" => $this->faker->uuid,
            "created_at"  => Carbon::now(),
            "updated_at"  => Carbon::now(),
        ];
    }
}
