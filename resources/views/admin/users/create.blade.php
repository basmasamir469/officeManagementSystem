@extends('layouts.admin')

@section('title', 'Create User')
@section('subtitle', 'Add a new user account')

@section('content_body')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create User</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>
            <div class="form-group mt-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>
            <div class="form-group mt-3">
                <label>Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="form-group mt-3">
                <label>Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-success">Save User</button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back to users</a>
            </div>
        </form>
    </div>
</div>
@endsection
