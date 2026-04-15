@extends('layouts.admin')

@section('title', 'Edit User')
@section('subtitle', 'Update user details')

@section('content_body')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit User</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
            </div>
            <div class="form-group mt-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="form-group mt-3">
                <label>Password <small class="text-muted">(leave blank to keep current)</small></label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group mt-3">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update User</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back to users</a>
            </div>
        </form>
    </div>
</div>
@endsection
