@extends('layouts.admin')

@section('title', 'Attendance Details')
@section('subtitle', 'View attendance record')

@section('content_body')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Attendance for {{ $attendance->employee->name }}</h3>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Employee</dt>
            <dd class="col-sm-9">{{ $attendance->employee->name }}</dd>

            <dt class="col-sm-3">Date</dt>
            <dd class="col-sm-9">{{ $attendance->date->format('Y-m-d') }}</dd>

            <dt class="col-sm-3">Check In</dt>
            <dd class="col-sm-9">{{ optional($attendance->check_in_time)->format('H:i') ?? '—' }}</dd>

            <dt class="col-sm-3">Check Out</dt>
            <dd class="col-sm-9">{{ optional($attendance->check_out_time)->format('H:i') ?? '—' }}</dd>
        </dl>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.attendances.index') }}" class="btn btn-secondary">Back to attendance</a>
        <a href="{{ route('admin.attendances.edit', $attendance) }}" class="btn btn-primary">Edit</a>
    </div>
</div>
@endsection
