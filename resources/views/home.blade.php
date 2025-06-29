@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center">Welcome to HRMS</h1>
        <p class="text-center">Manage employees efficiently.</p>

        {{-- Dashboard Section --}}
        <div class="row mt-5">
            <div class="col-md-12 text-center">
                <h3>Dashboard</h3>
                <p>Access all key modules and system features in one place.</p>
                <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
            </div>
        </div>
    </div>
@endsection
