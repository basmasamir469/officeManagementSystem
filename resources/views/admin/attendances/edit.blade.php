@extends('layouts.admin')

@section('title', 'Edit Attendance')
@section('subtitle', 'Update attendance details')

@section('content_body')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Edit Attendance</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.attendances.update', $attendance) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label>Employee</label>
                <select name="employee_id" class="form-control" required>
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" {{ $attendance->employee_id === $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mt-3">
                <label>Date</label>
                <input type="date" name="date" class="form-control" value="{{ old('date', $attendance->date->format('Y-m-d')) }}" required>
            </div>
            <div class="form-group mt-3">
                <label>Check In Time</label>
                <input type="time" name="check_in_time" class="form-control" value="{{ optional($attendance->check_in_time)->format('H:i') }}">
            </div>
            <div class="form-group mt-3">
                <label>Check Out Time</label>
                <input type="time" name="check_out_time" class="form-control" value="{{ optional($attendance->check_out_time)->format('H:i') }}">
            </div>
            <div class="mt-4">
                <button type="submit" class="btn btn-primary">Update Attendance</button>
                <a href="{{ route('admin.attendances.index') }}" class="btn btn-secondary">Back to attendance</a>
            </div>
        </form>
    </div>
</div>
@endsection
