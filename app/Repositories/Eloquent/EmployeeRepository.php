<?php

namespace App\Repositories\Eloquent;

use App\Models\Employee;
use App\Repositories\Interfaces\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function getAll()
    {
        return Employee::orderBy('name')->get();
    }

    public function findById(int $id)
    {
        return Employee::find($id);
    }

    public function findByEmail(string $email)
    {
        return Employee::where('email', $email)->first();
    }

    public function create(array $data)
    {
        return Employee::create($data);
    }

    public function update(int $id, array $data)
    {
        $employee = $this->findById($id);

        if (! $employee) {
            return null;
        }
        if($data['password'] === null){
            unset($data['password']);
        }

        $employee->update($data);

        return $employee;
    }

    public function delete(int $id): bool
    {
        $employee = $this->findById($id);

        if (! $employee) {
            return false;
        }

        return $employee->delete();
    }
}
