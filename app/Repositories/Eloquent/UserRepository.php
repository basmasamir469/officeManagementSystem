<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function getAll()
    {
        return User::orderBy('name')->get();
    }

    public function paginate(int $perPage = 15)
    {
        return User::orderBy('name')->paginate($perPage);
    }

    public function findById(int $id)
    {
        return User::find($id);
    }

    public function create(array $data)
    {
        return User::create($data);
    }

    public function update(int $id, array $data)
    {
        $user = $this->findById($id);

        if (! $user) {
            return null;
        }

        $user->update($data);

        return $user;
    }

    public function delete(int $id): bool
    {
        $user = $this->findById($id);

        if (! $user) {
            return false;
        }

        return $user->delete();
    }
}
