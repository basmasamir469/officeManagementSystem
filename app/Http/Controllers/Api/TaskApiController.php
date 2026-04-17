<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskStatusRequest;
use App\Http\Resources\TaskResource;
use App\Services\TaskService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\Request;

class TaskApiController extends Controller
{
    use ApiResponseTrait;
    protected TaskService $taskService;

    public function __construct(TaskService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(Request $request)
    {
        $tasks = $this->taskService->getEmployeeTasks($request->user()->id);

        return TaskResource::collection($tasks);
    }

    public function store(StoreTaskRequest $request)
    {
        $task = $this->taskService->createTask($request->validated());

        return response()->json(new TaskResource($task), 201);
    }

    public function show(Request $request, int $id)
    {
        $task = $this->taskService->findTask($id);

        if (! $task || $task->employee_id !== $request->user()->id) {
            return response()->json(['message' => 'Task not found.'], 404);
        }

        return $this->successResponse(new TaskResource($task));
    }

    public function updateStatus(UpdateTaskStatusRequest $request, int $id)
    {
        $task = $this->taskService->updateTaskStatus($id, $request->validated()['status'], $request->user()->id);

        if (! $task) {
            return $this->errorResponse('Task not found or cannot be updated.', 404);
        }

        return $this->successResponse(new TaskResource($task), 'Task status updated successfully');

    }
}
