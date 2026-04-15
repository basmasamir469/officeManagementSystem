@extends('layouts.admin')

@section('title', 'Tasks')
@section('subtitle', 'Manage employee tasks')

@section('content_body')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Assigned Tasks</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>Title</th>
                            <th>Deadline</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tasks as $task)
                            <tr>
                                <td>{{ $task->employee?->name ?? 'Unknown' }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ optional($task->deadline)->toDateString() }}</td>
                                <td>
                                    @switch($task->status)
                                        @case('pending')
                                            <span class="badge badge-warning">Pending</span>
                                            @break
                                        @case('in_progress')
                                            <span class="badge badge-info">In Progress</span>
                                            @break
                                        @case('completed')
                                            <span class="badge badge-success">Completed</span>
                                            @break
                                        @case('late')
                                            <span class="badge badge-danger">Late</span>
                                            @break
                                        @default
                                            <span class="badge badge-secondary">{{ ucfirst($task->status) }}</span>
                                    @endswitch
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No tasks assigned yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
