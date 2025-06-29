@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">All Employees - Today's Attendance</h2>

    @if(session('status'))
        <div class="alert alert-info">{{ session('status') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Employee Name</th>
                <th>Check Type</th>
                <th>Time</th>
                <th>Type</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @forelse($attendances as $key => $attendance)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $attendance->employee->user->name ?? 'Unknown' }}</td>
                    <td>{{ $attendance->attendanceTime->name ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($attendance->created_at)->format('h:i A') }}</td>
                    <td>{{ $attendance->attendanceType->name ?? '-' }}</td>
                    <td>{{ \Carbon\Carbon::parse($attendance->created_at)->format('Y-m-d') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6">No attendance records found for today.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
