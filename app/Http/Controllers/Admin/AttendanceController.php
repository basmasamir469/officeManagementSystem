<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
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
        $records = $this->attendanceService->getAttendancesPaginated(15);

        return view('admin.attendances.index', compact('records'));
    }

    public function create()
    {
        $employees = $this->employeeService->getAllEmployees();

        return view('admin.attendances.create', compact('employees'));
    }

    public function store(StoreAttendanceRequest $request)
    {
        $this->attendanceService->createAttendance($request->validated());

        return redirect()->route('admin.attendances.index')
            ->with('success', 'Attendance record created successfully.');
    }

    public function show(int $id)
    {
        $attendance = $this->attendanceService->getAttendance($id);

        abort_if(! $attendance, 404);

        return view('admin.attendances.show', compact('attendance'));
    }

    public function edit(int $id)
    {
        $attendance = $this->attendanceService->getAttendance($id);

        abort_if(! $attendance, 404);

        $employees = $this->employeeService->getAllEmployees();

        return view('admin.attendances.edit', compact('attendance', 'employees'));
    }

    public function update(UpdateAttendanceRequest $request, int $id)
    {
        $this->attendanceService->updateAttendance($id, $request->validated());

        return redirect()->route('admin.attendances.index')
            ->with('success', 'Attendance record updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->attendanceService->deleteAttendance($id);

        return redirect()->route('admin.attendances.index')
            ->with('success', 'Attendance record deleted successfully.');
    }
}

