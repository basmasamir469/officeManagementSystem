<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginEmployeeRequest;
use App\Http\Requests\RegisterEmployeeRequest;
use App\Http\Resources\EmployeeResource;
use App\Services\EmployeeAuthService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponseTrait;

    protected EmployeeAuthService $authService;

    public function __construct(EmployeeAuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterEmployeeRequest $request)
    {
        $employee = $this->authService->register($request->validated());
        $token = $employee->createToken('api-token')->plainTextToken;

        return $this->successResponse([
            'employee' => new EmployeeResource($employee),
            'token' => $token,
        ], 'Employee registered successfully', 201);
    }

    public function login(LoginEmployeeRequest $request)
    {
        $employee = $this->authService->login($request->validated());

        if (! $employee) {
            return $this->errorResponse('Invalid credentials.', 401);
        }

        $token = $employee->createToken('api-token')->plainTextToken;

        return $this->successResponse([
            'employee' => new EmployeeResource($employee),
            'token' => $token,
        ], 'Login successful');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()?->delete();

        return $this->successResponse(null, 'Logged out successfully.');
    }
}
