@extends('layouts.admin')

@section('title', 'Attendances')
@section('subtitle', 'Track employee check-ins and check-outs')

@section('header_actions')
<a href="{{ route('admin.attendances.create') }}" class="btn btn-primary">New Attendance</a>
@endsection

@section('content_body')
<div class="card">
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <thead>
                <tr>
                    <th>Employee</th>
                    <th>Date</th>
                    <th>Check In</th>
                    <th>Check Out</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($records as $attendance)
                    <tr>
                        <td>{{ $attendance->employee->name }}</td>
                        <td>{{ $attendance->date->format('Y-m-d') }}</td>
                        <td>{{ optional($attendance->check_in_time)->format('H:i') ?? '—' }}</td>
                        <td>{{ optional($attendance->check_out_time)->format('H:i') ?? '—' }}</td>
                        <td>
                            <a href="{{ route('admin.attendances.show', $attendance) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('admin.attendances.edit', $attendance) }}" class="btn btn-sm btn-warning">Edit</a>
                            <form action="{{ route('admin.attendances.destroy', $attendance) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete record?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="card-footer clearfix">
        {{ $records->links() }}
    </div>
</div>
@endsection
