@extends('layouts.admin')

@section('title', 'Employee Details')
@section('subtitle', 'View employee information')

@section('content_body')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Employee Details</h3>
        <div class="card-tools">
            <a href="{{ route('admin.employees.index') }}" class="btn btn-secondary btn-sm">Back to list</a>
        </div>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Name</dt>
            <dd class="col-sm-9">{{ $employee->name }}</dd>

            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9">{{ $employee->email }}</dd>

            <dt class="col-sm-3">Phone</dt>
            <dd class="col-sm-9">{{ $employee->phone }}</dd>

            <dt class="col-sm-3">Position</dt>
            <dd class="col-sm-9">{{ $employee->position }}</dd>

            <dt class="col-sm-3">Salary</dt>
            <dd class="col-sm-9">${{ number_format($employee->salary, 2) }}</dd>

            <dt class="col-sm-3">Hire Date</dt>
            <dd class="col-sm-9">{{ $employee->hire_date->format('Y-m-d') }}</dd>
        </dl>
    </div>
</div>
@endsection
