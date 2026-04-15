<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttendanceRequest;
use App\Services\AttendanceService;

class AttendanceApiController extends Controller
{
    protected AttendanceService $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function index()
    {
        return response()->json($this->attendanceService->getAllAttendances());
    }

    public function checkIn(AttendanceRequest $request)
    {
        return response()->json($this->attendanceService->checkIn($request->employee_id), 201);
    }

    public function checkOut(AttendanceRequest $request)
    {
        $attendance = $this->attendanceService->checkOut($request->employee_id);

        if (! $attendance) {
            return response()->json(['message' => 'No check-in record found for today.'], 404);
        }

        return response()->json($attendance);
    }
}

