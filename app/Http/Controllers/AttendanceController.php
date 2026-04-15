<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttendanceRequest;
use App\Services\AttendanceService;
use App\Services\EmployeeService;

class AttendanceController extends Controller
{
    protected AttendanceService $attendanceService;
    protected EmployeeService $employeeService;

    public function __construct(AttendanceService $attendanceService, EmployeeService $employeeService)
    {
        $this->attendanceService = $attendanceService;
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        $employees = $this->employeeService->getAllEmployees();
        $attendanceData = $this->attendanceService->getAttendanceForToday();

        return view('attendance.index', [
            'employees' => $employees,
            'today' => $attendanceData['date'],
            'records' => $attendanceData['records'],
        ]);
    }

    public function checkIn(AttendanceRequest $request)
    {
        $attendance = $this->attendanceService->checkIn($request->employee_id);

        return redirect()->route('attendance.index')
            ->with('success', 'Employee checked in at ' . $attendance->check_in_time->format('H:i'));
    }

    public function checkOut(AttendanceRequest $request)
    {
        $attendance = $this->attendanceService->checkOut($request->employee_id);

        if (! $attendance) {
            return redirect()->route('attendance.index')
                ->with('error', 'Employee has no check-in record for today.');
        }

        return redirect()->route('attendance.index')
            ->with('success', 'Employee checked out at ' . $attendance->check_out_time->format('H:i'));
    }
}
