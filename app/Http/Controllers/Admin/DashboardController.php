<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use App\Services\EmployeeService;
use App\Services\TaskService;

class DashboardController extends Controller
{
    protected DashboardService $dashboardService;
    protected EmployeeService $employeeService;
    protected TaskService $taskService;

    public function __construct(
        DashboardService $dashboardService,
        EmployeeService $employeeService,
        TaskService $taskService
    ) {
        $this->dashboardService = $dashboardService;
        $this->employeeService = $employeeService;
        $this->taskService = $taskService;
    }

    public function index()
    {
        $stats = $this->dashboardService->getTotals();
        $employees = $this->employeeService->getAllEmployees();
        $tasks = $this->taskService->getAllTasks();
        $tasksByEmployee = $tasks->groupBy('employee_id');

        $taskStats = [
            'total' => $tasks->count(),
            'pending' => $tasks->where('status', 'pending')->count(),
            'in_progress' => $tasks->where('status', 'in_progress')->count(),
            'completed' => $tasks->where('status', 'completed')->count(),
            'late' => $tasks->where('status', 'late')->count(),
        ];

        return view('admin.dashboard.index', compact('stats', 'employees', 'tasksByEmployee', 'taskStats'));
    }
}
