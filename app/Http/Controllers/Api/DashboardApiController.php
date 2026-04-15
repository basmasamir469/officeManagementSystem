<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\DashboardResource;
use App\Services\TaskService;
use Illuminate\Http\Request;

class DashboardApiController extends Controller
{
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request)
    {
        $tasks = $this->taskService->getEmployeeTasks($request->user()->id);
        $summary = [
            'pending' => $tasks->where('status', 'pending')->count(),
            'in_progress' => $tasks->where('status', 'in_progress')->count(),
            'completed' => $tasks->where('status', 'completed')->count(),
            'late' => $tasks->where('status', 'late')->count(),
        ];

        return response()->json(new DashboardResource((object)[
            'tasks' => $tasks,
            'summary' => $summary,
        ]));
    }
}

