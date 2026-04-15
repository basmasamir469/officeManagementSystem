<?php

namespace App\Repositories\Interfaces;

interface AttendanceRepositoryInterface
{
    public function getAll();

    public function findById(int $id);

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id): bool;

    public function findByEmployeeAndDate(int $employeeId, string $date);

    public function getTodayRecords(string $date);
}
