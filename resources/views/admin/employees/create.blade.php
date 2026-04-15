@extends('layouts.admin')

@section('title', 'Create Employee')
@section('subtitle', 'Add a new employee record')

@section('content_body')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Create Employee</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.employees.store') }}" method="POST">
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
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
            </div>
            <div class="form-group mt-3">
                <label>Position</label>
                <input type="text" name="position" class="form-control" value="{{ old('position') }}" required>
            </div>
            <div class="form-group mt-3">
                <label>Salary</label>
                <input type="number" step="0.01" name="salary" class="form-control" value="{{ old('salary') }}" required>
            </div>
            <div class="form-group mt-3">
                <label>Hire Date</label>
                <input type="date" name="hire_date" class="form-control" value="{{ old('hire_date') }}" required>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-success">Save Employee</button>
                <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary">Back to employees</a>
            </div>
        </form>
    </div>
</div>
@endsection
