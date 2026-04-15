<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Services\EmployeeService;
use App\Services\TaskService;

class TaskController extends Controller
{
    protected TaskService $taskService;
    protected EmployeeService $employeeService;

    public function __construct(TaskService $taskService, EmployeeService $employeeService)
    {
        $this->taskService = $taskService;
        $this->employeeService = $employeeService;
    }

    public function index()
    {
        $employees = $this->employeeService->getAllEmployees();
        $tasks = $this->taskService->getAllTasks();

        return view('admin.tasks.index', compact('employees', 'tasks'));
    }

    public function store(StoreTaskRequest $request)
    {
        $this->taskService->createTask($request->validated());

        return redirect()->route('admin.dashboard')
            ->with('success', 'Task assigned successfully.');
    }
}
