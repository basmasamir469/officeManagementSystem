<?php

namespace App\Services;

use App\Repositories\Interfaces\EmployeeRepositoryInterface;

class EmployeeService
{
    protected EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function getAllEmployees()
    {
        return $this->employeeRepository->getAll();
    }

    public function getEmployee(int $id)
    {
        return $this->employeeRepository->findById($id);
    }

    public function createEmployee(array $data)
    {
        return $this->employeeRepository->create($data);
    }

    public function updateEmployee(int $id, array $data)
    {
        return $this->employeeRepository->update($id, $data);
    }

    public function deleteEmployee(int $id): bool
    {
        return $this->employeeRepository->delete($id);
    }
}
