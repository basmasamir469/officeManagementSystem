@extends('layouts.admin')

@section('title', 'Create Attendance')
@section('subtitle', 'Record a new attendance event')

@section('content_body')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">New Attendance</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.attendances.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label>Employee</label>
                <select name="employee_id" class="form-control" required>
                    <option value="">Select employee</option>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-3">
                <label>Date</label>
                <input type="date" name="date" class="form-control" value="{{ old('date', now()->toDateString()) }}" required>
            </div>
            <div class="form-group mt-3">
                <label>Check In Time</label>
                <input type="time" name="check_in_time" class="form-control" value="{{ old('check_in_time') }}">
            </div>
            <div class="form-group mt-3">
                <label>Check Out Time</label>
                <input type="time" name="check_out_time" class="form-control" value="{{ old('check_out_time') }}">
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-success">Save Attendance</button>
                <a href="{{ route('admin.attendances.index') }}" class="btn btn-secondary">Back to attendance</a>
            </div>
        </form>
    </div>
</div>
@endsection
