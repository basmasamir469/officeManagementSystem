<?php

namespace App\Services;

use App\Repositories\Interfaces\EmployeeRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class EmployeeAuthService
{
    protected EmployeeRepositoryInterface $employeeRepository;

    public function __construct(EmployeeRepositoryInterface $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }

    public function register(array $data)
    {
        $data['password'] = Hash::make($data['password']);

        return $this->employeeRepository->create($data);
    }

    public function login(array $data)
    {
        $employee = $this->employeeRepository->findByEmail($data['email']);

        if (! $employee || ! Hash::check($data['password'], $employee->password)) {
            return null;
        }

        return $employee;
    }

    public function logout(int $employeeId): bool
    {
        $employee = $this->employeeRepository->findById($employeeId);

        if (! $employee) {
            return false;
        }

        $employee->currentAccessToken()?->delete();

        return true;
    }
}
