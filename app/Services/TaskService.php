<?php

namespace App\Services;

use App\Notifications\TaskAssignedNotification;
use App\Repositories\Interfaces\TaskRepositoryInterface;
use Carbon\Carbon;

class TaskService
{
    protected TaskRepositoryInterface $taskRepository;

    public function __construct(TaskRepositoryInterface $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function getEmployeeTasks(int $employeeId)
    {
        $tasks = $this->taskRepository->getByEmployeeId($employeeId);

        foreach ($tasks as $task) {
            if ($task->status !== 'completed' && $task->deadline->isPast()) {
                $task = $this->taskRepository->update($task->id, [
                    'status' => 'late',
                ]);
            }
        }

        return $tasks;
    }

    public function getAllTasks()
    {
        $tasks = $this->taskRepository->getAll();

        foreach ($tasks as $task) {
            if ($task->status !== 'completed' && $task->deadline->isPast()) {
                $task = $this->taskRepository->update($task->id, [
                    'status' => 'late',
                ]);
            }
        }

        return $tasks;
    }

    public function createTask(array $data)
    {
        $data['status'] = $data['status'] ?? 'pending';

        $task = $this->taskRepository->create($data);

        if ($task && $task->employee) {
            $task->employee->notify(new TaskAssignedNotification($task));
        }

        return $task;
    }

    public function findTask(int $id)
    {
        return $this->taskRepository->findById($id);
    }

    public function updateTaskStatus(int $id, string $status, int $employeeId)
    {
        $task = $this->taskRepository->findById($id);

        if (! $task || $task->employee_id !== $employeeId) {
            return null;
        }

        if ($status !== 'completed' && Carbon::now()->isAfter($task->deadline)) {
            $status = 'late';
        }

        return $this->taskRepository->update($id, [
            'status' => $status,
        ]);
    }
}
