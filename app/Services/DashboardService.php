<?php

namespace App\Services;

use App\Repositories\Interfaces\AttendanceRepositoryInterface;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use Carbon\Carbon;

class DashboardService
{
    protected EmployeeRepositoryInterface $employeeRepository;
    protected AttendanceRepositoryInterface $attendanceRepository;

    public function __construct(
        EmployeeRepositoryInterface $employeeRepository,
        AttendanceRepositoryInterface $attendanceRepository
    ) {
        $this->employeeRepository = $employeeRepository;
        $this->attendanceRepository = $attendanceRepository;
    }

    public function getTotals(): array
    {
        $employees = $this->employeeRepository->getAll();
        $today = Carbon::today()->toDateString();
        $attendances = $this->attendanceRepository->getTodayRecords($today);

        $present = $attendances->count();
        $absent = $employees->count() - $present;

        return [
            'totalEmployees' => $employees->count(),
            'presentToday' => $present,
            'absentToday' => max(0, $absent),
            'today' => $today,
        ];
    }
}
