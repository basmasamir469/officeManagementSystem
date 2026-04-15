@extends('adminlte::page')

@section('title', $title ?? 'Admin Dashboard')

@section('content_header')
<div class="d-flex justify-content-between align-items-center">
    <div>
        <h1 class="m-0">{{ $title ?? 'Admin Dashboard' }}</h1>
        @isset($subtitle)
            <p class="text-muted mb-0">{{ $subtitle }}</p>
        @endisset
    </div>
    @yield('header_actions')
</div>
@stop

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{ session('error') }}
        </div>
    @endif

    @yield('content_body')
@stop
