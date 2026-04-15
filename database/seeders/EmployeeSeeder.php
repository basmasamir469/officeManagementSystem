<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            ['name' => 'Alice Johnson', 'email' => 'alice@example.com', 'phone' => '555-0100', 'position' => 'HR Manager', 'salary' => 62000, 'hire_date' => now()->subYears(2)->toDateString()],
            ['name' => 'Bob Martin', 'email' => 'bob@example.com', 'phone' => '555-0110', 'position' => 'Developer', 'salary' => 72000, 'hire_date' => now()->subYears(1)->toDateString()],
            ['name' => 'Carla Evans', 'email' => 'carla@example.com', 'phone' => '555-0120', 'position' => 'Designer', 'salary' => 58000, 'hire_date' => now()->subMonths(18)->toDateString()],
            ['name' => 'Daniel Cooper', 'email' => 'daniel@example.com', 'phone' => '555-0130', 'position' => 'QA Engineer', 'salary' => 54000, 'hire_date' => now()->subMonths(8)->toDateString()],
            ['name' => 'Emma Lopez', 'email' => 'emma@example.com', 'phone' => '555-0140', 'position' => 'Office Coordinator', 'salary' => 48000, 'hire_date' => now()->subMonths(6)->toDateString()],
        ];

        foreach ($employees as $employee) {
            Employee::create($employee);
        }
    }
}

