<?php
// database/seeds/TimerSeeder.php

namespace Database\Seeders;

use App\Models\Timer;
use Illuminate\Database\Seeder;

class TimerSeeder extends Seeder
{
    public function run()
    {
        // Create 5 timers with default values
        for ($i = 1; $i <= 5; $i++) {
            Timer::create([
                'pju_id' => $i,
                'on_time' => '06:00',
                'off_time' => '18:00',
            ]);
        }
    }
}