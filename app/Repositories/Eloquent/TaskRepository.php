<?php

namespace App\Repositories\Eloquent;

use App\Models\Task;
use App\Repositories\Interfaces\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    public function getAll()
    {
        return Task::with('employee')->orderBy('deadline')->get();
    }

    public function findById(int $id)
    {
        return Task::with('employee')->find($id);
    }

    public function create(array $data)
    {
        return Task::create($data);
    }

    public function update(int $id, array $data)
    {
        $task = $this->findById($id);

        if (! $task) {
            return null;
        }

        $task->update($data);

        return $task;
    }

    public function delete(int $id): bool
    {
        $task = $this->findById($id);

        if (! $task) {
            return false;
        }

        return $task->delete();
    }

    public function getByEmployeeId(int $employeeId)
    {
        return Task::with('employee')
            ->where('employee_id', $employeeId)
            ->orderBy('deadline')
            ->get();
    }
}
