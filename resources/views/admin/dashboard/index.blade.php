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
<div class="card">
    <div class="card-body">
        <p class="mb-0">Use the sidebar links to manage users and attendance records.</p>
    </div>
</div>
@endsection
