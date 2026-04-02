<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class BadgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('badges')->insert([
            [
                'badge_name' => 'Focus Starter',
                'type' => 'Daily',
                'hours' => 2,
                'status' => 1,
            ],
            [
                'badge_name' => 'Consistent Learner',
                'type' => 'Weekly',
                'hours' => 15,
                'status' => 1,
            ],
            [
                'badge_name' => 'Study Master',
                'type' => 'Monthly',
                'hours' => 60,
                'status' => 1,
            ],
            [
                'badge_name' => 'Zen Prodigy',
                'type' => 'Daily',
                'hours' => 5,
                'status' => 1,
            ],
            [
                'badge_name' => 'Ultimate FocusZen',
                'type' => 'Monthly',
                'hours' => 100,
                'status' => 1,
            ]
        ]);
    }
}
