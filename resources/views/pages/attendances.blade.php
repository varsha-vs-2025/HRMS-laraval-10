@extends('layouts.plain')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4">Attendances</h2>

    @if (session('status'))
        <div class="alert alert-info">{{ session('status') }}</div>
    @endif

    {{-- Filter dropdown for admin --}}
    @if (auth()->user()->isAdmin())
        <form method="GET" action="{{ route('attendances.index') }}" class="mb-3">
            <div class="row">
                <div class="col-md-6">
                    <select name="employee_id" class="form-control" onchange="this.form.submit()">
                        <option value="">-- Show All Employees --</option>
                        @foreach ($employees as $employee)
                            <option value="{{ $employee->id }}" {{ request('employee_id') == $employee->id ? 'selected' : '' }}>
                                {{ $employee->user->name ?? 'Unknown' }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </form>
    @else
        <form method="POST" action="{{ route('attendances.store') }}">
            @csrf
            <button class="btn btn-primary mb-3">Mark Check-In / Check-Out</button>
        </form>
    @endif

    <div class="card">
        <div class="card-header">Today’s Attendance Records</div>
        <div class="card-body p-0">
            <table class="table table-bordered m-0">
                <thead class="thead-dark">
                    <tr>
                        <th>#</th>
                        <th>Employee</th>
                        <th>Check</th>
                        <th>Type</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($attendances as $attendance)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ optional($attendance->employee->user)->name ?? 'N/A' }}</td>
                            <td>{{ optional($attendance->attendanceTime)->name ?? 'N/A' }}</td>
                            <td>{{ optional($attendance->attendanceType)->name ?? 'N/A' }}</td>
                            <td>{{ $attendance->created_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No attendance records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
