<?php

namespace App\Repositories\Interfaces;

interface TaskRepositoryInterface
{
    public function getAll();

    public function findById(int $id);

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id): bool;

    public function getByEmployeeId(int $employeeId);
}
