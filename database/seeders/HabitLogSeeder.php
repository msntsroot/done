<?php

namespace Database\Seeders;

use App\Models\Habit;
use App\Models\HabitLog;
use Illuminate\Database\Seeder;

class HabitLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $habits = Habit::all();
        $totalLogs = 10;

        $logsPerHabit = intdiv($totalLogs, $habits->count());
        $extra = $totalLogs % $habits->count();

        foreach ($habits as $index => $habit) {
            $count = $logsPerHabit + ($index < $extra ? 1 : 0);

            for ($day = 0; $day < $count; $day++) {
                HabitLog::factory()->create([
                    'habit_id' => $habit->id,
                    'completed_at' => now()->subDays($day)->toDateString(),
                ]);
            }
        }
    }
}
