<?php

namespace App\Repositories\Eloquent;

use App\Models\Attendance;
use App\Repositories\Interfaces\AttendanceRepositoryInterface;

class AttendanceRepository implements AttendanceRepositoryInterface
{
    public function getAll()
    {
        return Attendance::with('employee')->orderByDesc('date')->get();
    }

    public function paginate(int $perPage = 15)
    {
        return Attendance::with('employee')->orderByDesc('date')->paginate($perPage);
    }

    public function findById(int $id)
    {
        return Attendance::with('employee')->find($id);
    }

    public function create(array $data)
    {
        return Attendance::create($data);
    }

    public function update(int $id, array $data)
    {
        $attendance = $this->findById($id);

        if (! $attendance) {
            return null;
        }

        $attendance->update($data);

        return $attendance;
    }

    public function delete(int $id): bool
    {
        $attendance = $this->findById($id);

        if (! $attendance) {
            return false;
        }

        return $attendance->delete();
    }

    public function findByEmployeeAndDate(int $employeeId, string $date)
    {
        return Attendance::where('employee_id', $employeeId)
            ->where('date', $date)
            ->first();
    }

    public function getByEmployeeId(int $employeeId)
    {
        return Attendance::with('employee')
            ->where('employee_id', $employeeId)
            ->orderByDesc('date')
            ->get();
    }

    public function getTodayRecords(string $date)
    {
        return Attendance::with('employee')
            ->where('date', $date)
            ->get();
    }
}
