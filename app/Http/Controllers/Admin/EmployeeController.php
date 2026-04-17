<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Services\EmployeeService;

class EmployeeController extends Controller
{
    protected EmployeeService $employeeService;

    public function __construct(EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        $employees = $this->employeeService->getAllEmployees();

        return view('admin.employees.index', compact('employees'));
    }

    public function create()
    {
        return view('admin.employees.create');
    }

    public function store(StoreEmployeeRequest $request)
    {
        $employee = $this->employeeService->createEmployee($request->validated());

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'message' => 'Employee created successfully.',
                'employee' => $employee,
                'redirect' => route('admin.employees.index'),
            ]);
        }

        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee created successfully.');
    }

    public function show(int $id)
    {
        $employee = $this->employeeService->getEmployee($id);

        return view('admin.employees.show', compact('employee'));
    }

    public function edit(int $id)
    {
        $employee = $this->employeeService->getEmployee($id);

        return view('admin.employees.edit', compact('employee'));
    }

    public function update(UpdateEmployeeRequest $request, int $id)
    {
        $this->employeeService->updateEmployee($id, $request->validated());

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'message' => 'Employee updated successfully.',
                'redirect' => route('admin.employees.index'),
            ]);
        }

        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->employeeService->deleteEmployee($id);

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'message' => 'Employee deleted successfully.',
            ]);
        }

        return redirect()->route('admin.employees.index')
            ->with('success', 'Employee deleted successfully.');
    }
}
