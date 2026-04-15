@extends('layouts.admin')

@section('title', 'User Details')
@section('subtitle', 'View user information')

@section('content_body')
<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $user->name }}</h3>
    </div>
    <div class="card-body">
        <dl class="row">
            <dt class="col-sm-3">Name</dt>
            <dd class="col-sm-9">{{ $user->name }}</dd>

            <dt class="col-sm-3">Email</dt>
            <dd class="col-sm-9">{{ $user->email }}</dd>

            <dt class="col-sm-3">Registered</dt>
            <dd class="col-sm-9">{{ $user->created_at->format('Y-m-d H:i') }}</dd>
        </dl>
    </div>
    <div class="card-footer">
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Back to users</a>
        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">Edit</a>
    </div>
</div>
@endsection
