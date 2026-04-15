@extends('layouts.admin')

@section('title', 'Employees')
@section('subtitle', 'Manage company employees')

@section('header_actions')
<a href="{{ route('admin.employees.create') }}" class="btn btn-primary">New Employee</a>
@endsection

@section('content_body')
<div class="card">
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Position</th>
                    <th>Salary</th>
                    <th>Hire Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($employees as $employee)
                    <tr>
                        <td>{{ $employee->name }}</td>
                        <td>{{ $employee->email }}</td>
                        <td>{{ $employee->position }}</td>
                        <td>${{ number_format($employee->salary, 2) }}</td>
                        <td>{{ $employee->hire_date->format('Y-m-d') }}</td>
                        <td>
                            <a href="{{ route('admin.employees.show', $employee) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('admin.employees.edit', $employee) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.employees.destroy', $employee) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this employee?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
