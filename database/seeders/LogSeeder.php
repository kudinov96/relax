<?php

namespace Database\Seeders;

use App\Models\LogChair;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        LogChair::factory(20)->create();
    }
}
