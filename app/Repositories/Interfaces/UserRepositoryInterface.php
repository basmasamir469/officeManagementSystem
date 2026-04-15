<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    public function getAll();

    public function paginate(int $perPage = 15);

    public function findById(int $id);

    public function create(array $data);

    public function update(int $id, array $data);

    public function delete(int $id): bool;
}
