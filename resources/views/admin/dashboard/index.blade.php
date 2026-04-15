@extends('layouts.admin')

@section('title', 'Dashboard')
@section('subtitle', 'Quick overview of users and attendance')

@section('content_body')
<div class="row">
    <div class="col-lg-4 col-12">
        <div class="small-box bg-primary">
            <div class="inner">
                <h3>{{ $stats['totalEmployees'] }}</h3>
                <p>Total Employees</p>
            </div>
            <div class="icon"><i class="fas fa-users"></i></div>
            <a href="{{ route('admin.attendances.index') }}" class="small-box-footer">View Attendance <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-12">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>{{ $stats['presentToday'] }}</h3>
                <p>Present Today</p>
            </div>
            <div class="icon"><i class="fas fa-check-circle"></i></div>
            <a href="{{ route('admin.attendances.index') }}" class="small-box-footer">Attendance details <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-12">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $stats['absentToday'] }}</h3>
                <p>Absent Today</p>
            </div>
            <div class="icon"><i class="fas fa-user-times"></i></div>
            <a href="{{ route('admin.attendances.index') }}" class="small-box-footer">View absent list <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-4 col-12">
        <div class="small-box bg-secondary">
            <div class="inner">
                <h3>{{ $taskStats['total'] }}</h3>
                <p>Total Tasks</p>
            </div>
            <div class="icon"><i class="fas fa-tasks"></i></div>
            <a href="{{ route('admin.tasks.index') }}" class="small-box-footer">View all tasks <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-12">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $taskStats['pending'] }}</h3>
                <p>Pending Tasks</p>
            </div>
            <div class="icon"><i class="fas fa-hourglass-start"></i></div>
            <a href="{{ route('admin.tasks.index') }}" class="small-box-footer">Manage tasks <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <div class="col-lg-4 col-12">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $taskStats['late'] }}</h3>
                <p>Late Tasks</p>
            </div>
            <div class="icon"><i class="fas fa-clock"></i></div>
            <a href="{{ route('admin.tasks.index') }}" class="small-box-footer">Resolve late tasks <i class="fas fa-arrow-circle-right"></i></a>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Assign New Task</h3>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.tasks.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="employee_id">Assign to Employee</label>
                        <select name="employee_id" id="employee_id" class="form-control" required>
                            <option value="">Select employee</option>
                            @foreach($employees as $employee)
                                <option value="{{ $employee->id }}" {{ old('employee_id') == $employee->id ? 'selected' : '' }}>{{ $employee->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="deadline">Deadline</label>
                        <input type="date" name="deadline" id="deadline" class="form-control" value="{{ old('deadline') }}" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
            </div>
            <button type="submit" class="btn btn-primary">Create Task</button>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Employee Task Status</h3>
            </div>
            <div class="card-body">
                @foreach($employees as $employee)
                    <div class="card mb-3">
                        <div class="card-header">
                            <strong>{{ $employee->name }}</strong> &ndash; {{ $employee->email }}
                        </div>
                        <div class="card-body p-0">
                            @if(isset($tasksByEmployee[$employee->id]) && $tasksByEmployee[$employee->id]->isNotEmpty())
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>
                                                <th>Title</th>
                                                <th>Deadline</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($tasksByEmployee[$employee->id] as $task)
                                                <tr>
                                                    <td>{{ $task->title }}</td>
                                                    <td>{{ optional($task->deadline)->toDateString() }}</td>
                                                    <td>
                                                        @if($task->status === 'pending')
                                                            <span class="badge badge-warning">Pending</span>
                                                        @elseif($task->status === 'in_progress')
                                                            <span class="badge badge-info">In Progress</span>
                                                        @elseif($task->status === 'completed')
                                                            <span class="badge badge-success">Completed</span>
                                                        @elseif($task->status === 'late')
                                                            <span class="badge badge-danger">Late</span>
                                                        @else
                                                            <span class="badge badge-secondary">{{ ucfirst($task->status) }}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="m-3">No tasks assigned.</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
