<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AttendanceResource;
use App\Services\AttendanceService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class AttendanceApiController extends Controller
{
    use ApiResponseTrait;

    protected AttendanceService $attendanceService;

    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
    }

    public function index(Request $request)
    {
        $attendances = $this->attendanceService->getEmployeeAttendance($request->user()->id);
        return $this->successResponse(AttendanceResource::collection($attendances));
    }

    public function checkIn(Request $request)
    {
        $attendance = $this->attendanceService->checkIn($request->user()->id);

        return $this->successResponse(new AttendanceResource($attendance), 'Checked in successfully', 201);
    }

    public function checkOut(Request $request)
    {
        $attendance = $this->attendanceService->checkOut($request->user()->id);

        if (! $attendance) {
            return $this->errorResponse('No check-in record found for today.', 404);
        }

        return $this->successResponse(new AttendanceResource($attendance), 'Checked out successfully');
    }
}

