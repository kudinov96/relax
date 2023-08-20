<?php

namespace Database\Factories;

use App\Models\Chair;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LogChair>
 */
class LogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $chair = Chair::first() ?? Chair::factory()->create();

        $response = '{
            "status": "success",
            "msg": "ok",
            "data": [
                {
                    "device_code": "S213031105",
                    "dtu_code": "960061070205051",
                    "sim_id": "960061070205051123",
                    "model": "S3",
                    "name": null,
                    "is_bind": 1,
                    "is_config": 1,
                    "network_id": 3145,
                    "supervisor_id": 1084,
                    "agent_id": 8,
                    "package_id": null,
                    "num": 0,
                    "used_num": 34,
                    "state": 1,
                    "status": 0,
                    "online": 0
                }
            ],
            "code": 200,
            "referrer": ""
        }';

        return [
            "chair_id" => $chair->id,
            "request"  => 'https://isf.sofocn.com/api/deviceInfo?deviceCode=S213031105',
            "response" => $response,
        ];
    }
}
