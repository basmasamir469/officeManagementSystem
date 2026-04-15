<?php

namespace Database\Seeders;

use App\Models\Attendance;
use App\Models\Employee;
use Illuminate\Database\Seeder;

class AttendanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $today = now()->toDateString();

        $attendanceData = [
            ['employee_email' => 'alice@example.com', 'check_in_time' => now()->subHours(8), 'check_out_time' => now()->subHours(1)],
            ['employee_email' => 'bob@example.com', 'check_in_time' => now()->subHours(7)->subMinutes(20), 'check_out_time' => now()->subMinutes(30)],
            ['employee_email' => 'carla@example.com', 'check_in_time' => now()->subHours(8)->subMinutes(15), 'check_out_time' => null],
        ];

        foreach ($attendanceData as $record) {
            $employee = Employee::where('email', $record['employee_email'])->first();
            if (! $employee) {
                continue;
            }

            Attendance::create([
                'employee_id' => $employee->id,
                'date' => $today,
                'check_in_time' => $record['check_in_time'],
                'check_out_time' => $record['check_out_time'],
            ]);
        }
    }
}

