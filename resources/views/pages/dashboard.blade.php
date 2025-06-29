@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="text-center mb-4">
        <h2>Dashboard</h2>
        <p>Administrator · Manage admin settings</p>
    </div>

    <div class="row justify-content-center">
        {{-- Attendance --}}
        <div class="col-md-4 mb-3">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-calendar-alt fa-2x mb-2 text-primary"></i>
                    <h5 class="card-title">Attendance</h5>
                    <p class="card-text">View and manage attendance</p>
                    <a href="{{ route('attendances.index') }}" class="btn btn-outline-primary">Go</a>
                </div>
            </div>
        </div>

        {{-- Score Categories --}}
        <div class="col-md-4 mb-3">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-star fa-2x mb-2 text-success"></i>
                    <h5 class="card-title">Score Categories</h5>
                    <p class="card-text">Performance scoring groups</p>
                    <a href="{{ route('score-categories.index') }}" class="btn btn-outline-success">Go</a>
                </div>
            </div>
        </div>

        {{-- Logs --}}
        <div class="col-md-4 mb-3">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-clipboard-list fa-2x mb-2 text-warning"></i>
                    <h5 class="card-title">Logs</h5>
                    <p class="card-text">System activity logs</p>
                    <a href="{{ route('logs') }}" class="btn btn-outline-warning">Go</a>
                </div>
            </div>
        </div>

        {{-- Accounts --}}
        <div class="col-md-4 mb-3">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-users fa-2x mb-2 text-info"></i>
                    <h5 class="card-title">Accounts</h5>
                    <p class="card-text">Manage users & roles</p>
                    <a href="{{ route('users') }}" class="btn btn-outline-info">Go</a>
                </div>
            </div>
        </div>

        {{-- Profile --}}
        <div class="col-md-4 mb-3">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-user fa-2x mb-2 text-secondary"></i>
                    <h5 class="card-title">Profile</h5>
                    <p class="card-text">View or edit your profile</p>
                    <a href="{{ route('profile') }}" class="btn btn-outline-secondary">Go</a>
                </div>
            </div>
        </div>

        {{-- Logout --}}
        <div class="col-md-4 mb-3">
            <div class="card h-100 text-center">
                <div class="card-body">
                    <i class="fas fa-sign-out-alt fa-2x mb-2 text-danger"></i>
                    <h5 class="card-title">Logout</h5>
                    <p class="card-text">Sign out of your account</p>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-outline-danger">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
