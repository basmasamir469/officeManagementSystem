<?php

namespace App\Services;

use App\Repositories\Interfaces\AttendanceRepositoryInterface;
use Carbon\Carbon;

class AttendanceService
{
    protected AttendanceRepositoryInterface $attendanceRepository;

    public function __construct(AttendanceRepositoryInterface $attendanceRepository)
    {
        $this->attendanceRepository = $attendanceRepository;
    }

    public function getAllAttendances()
    {
        return $this->attendanceRepository->getAll();
    }

    public function getAttendanceForToday(): array
    {
        $today = Carbon::today()->toDateString();

        return [
            'records' => $this->attendanceRepository->getTodayRecords($today),
            'date' => $today,
        ];
    }

    public function checkIn(int $employeeId)
    {
        $date = Carbon::today()->toDateString();
        $attendance = $this->attendanceRepository->findByEmployeeAndDate($employeeId, $date);

        if ($attendance) {
            return $attendance;
        }

        return $this->attendanceRepository->create([
            'employee_id' => $employeeId,
            'date' => $date,
            'check_in_time' => Carbon::now(),
        ]);
    }

    public function checkOut(int $employeeId)
    {
        $date = Carbon::today()->toDateString();
        $attendance = $this->attendanceRepository->findByEmployeeAndDate($employeeId, $date);

        if (! $attendance) {
            return null;
        }

        return $this->attendanceRepository->update($attendance->id, [
            'check_out_time' => Carbon::now(),
        ]);
    }
}
