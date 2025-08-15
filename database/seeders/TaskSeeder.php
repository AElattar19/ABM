<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     for ($i = 1; $i <= 5; $i++) {
            Task::create([
                'title' => "Task $i for User 1",
                'status' => ['pending', 'in-progress', 'completed'][array_rand(['pending', 'in-progress', 'completed'])],
                'user_id' => 1,
            ]);
        }

        for ($i = 1; $i <= 5; $i++) {
            Task::create([
                'title' => "Task $i for User 2",
                'status' => ['pending', 'in-progress', 'completed'][array_rand(['pending', 'in-progress', 'completed'])],
                'user_id' => 2,
            ]);
        }
    }
}
