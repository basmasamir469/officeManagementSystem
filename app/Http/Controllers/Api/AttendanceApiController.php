<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendanceResource;
use App\Services\AttendanceService;
use Illuminate\Http\Request;

class AttendanceApiController extends Controller
{
    protected AttendanceService $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function index(Request $request)
    {
        return AttendanceResource::collection($this->attendanceService->getEmployeeAttendance($request->user()->id));
    }

    public function checkIn(Request $request)
    {
        $attendance = $this->attendanceService->checkIn($request->user()->id);

        return response()->json(new AttendanceResource($attendance), 201);
    }

    public function checkOut(Request $request)
    {
        $attendance = $this->attendanceService->checkOut($request->user()->id);

        if (! $attendance) {
            return response()->json(['message' => 'No check-in record found for today.'], 404);
        }

        return response()->json(new AttendanceResource($attendance));
    }
}

