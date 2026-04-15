<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Services\EmployeeService;

class EmployeeApiController extends Controller
{
    protected EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        return response()->json($this->employeeService->getAllEmployees());
    }

    public function show(int $id)
    {
        return response()->json($this->employeeService->getEmployee($id));
    }

    public function store(StoreEmployeeRequest $request)
    {
        $employee = $this->employeeService->createEmployee($request->validated());

        return response()->json($employee, 201);
    }

    public function update(UpdateEmployeeRequest $request, int $id)
    {
        $employee = $this->employeeService->updateEmployee($id, $request->validated());

        return response()->json($employee);
    }

    public function destroy(int $id)
    {
        $deleted = $this->employeeService->deleteEmployee($id);

        return response()->json(['deleted' => $deleted]);
    }
}
