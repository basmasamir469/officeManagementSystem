<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    protected UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    public function index()
    {
        $users = $this->userService->getUsersPaginated(15);

        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);

        $this->userService->createUser($data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User created successfully.');
    }

    public function show(int $id)
    {
        $user = $this->userService->getUser($id);

        abort_if(! $user, 404);

        return view('admin.users.show', compact('user'));
    }

    public function edit(int $id)
    {
        $user = $this->userService->getUser($id);

        abort_if(! $user, 404);

        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUserRequest $request, int $id)
    {
        $data = $request->validated();

        if (! empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $this->userService->updateUser($id, $data);

        return redirect()->route('admin.users.index')
            ->with('success', 'User updated successfully.');
    }

    public function destroy(int $id)
    {
        $this->userService->deleteUser($id);

        return redirect()->route('admin.users.index')
            ->with('success', 'User deleted successfully.');
    }
}
