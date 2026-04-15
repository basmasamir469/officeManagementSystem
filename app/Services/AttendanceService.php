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

    public function getEmployeeAttendance(int $employeeId)
    {
        return $this->attendanceRepository->getByEmployeeId($employeeId);
    }

    public function getAttendancesPaginated(int $perPage = 15)
    {
        return $this->attendanceRepository->paginate($perPage);
    }

    public function getAttendance(int $id)
    {
        return $this->attendanceRepository->findById($id);
    }

    public function createAttendance(array $data)
    {
        return $this->attendanceRepository->create($data);
    }

    public function updateAttendance(int $id, array $data)
    {
        return $this->attendanceRepository->update($id, $data);
    }

    public function deleteAttendance(int $id): bool
    {
        return $this->attendanceRepository->delete($id);
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

        $status = Carbon::now()->gt(Carbon::createFromTime(9, 0, 0)) ? 'late' : 'present';

        return $this->attendanceRepository->create([
            'employee_id' => $employeeId,
            'date' => $date,
            'check_in_time' => Carbon::now(),
            'status' => $status,
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
