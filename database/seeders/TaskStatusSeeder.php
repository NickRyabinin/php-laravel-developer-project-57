<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $taskStatuses = ['новый', 'в работе', 'на тестировании', 'завершен'];

        foreach ($taskStatuses as $taskStatus) {
            $status = new TaskStatus();
            $status->fill(['name' => $taskStatus])->save();
        }
    }
}
