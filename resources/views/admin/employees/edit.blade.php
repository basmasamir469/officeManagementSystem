@extends('layouts.admin')

@section('title', 'Edit Employee')
@section('subtitle', 'Update employee details')

@section('content_body')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Employee</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.employees.update', $employee) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $employee->name) }}" required>
            </div>
            <div class="form-group mt-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $employee->email) }}" required>
            </div>
            <div class="form-group mt-3">
                <label>Phone</label>
                <input type="text" name="phone" class="form-control" value="{{ old('phone', $employee->phone) }}" required>
            </div>
            <div class="form-group mt-3">
                <label>Position</label>
                <input type="text" name="position" class="form-control" value="{{ old('position', $employee->position) }}" required>
            </div>
            <div class="form-group mt-3">
                <label>Salary</label>
                <input type="number" step="0.01" name="salary" class="form-control" value="{{ old('salary', $employee->salary) }}" required>
            </div>
            <div class="form-group mt-3">
                <label>Hire Date</label>
                <input type="date" name="hire_date" class="form-control" value="{{ old('hire_date', $employee->hire_date->format('Y-m-d')) }}" required>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Employee</button>
                <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
