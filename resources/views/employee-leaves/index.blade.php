@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Leave Requests</h2>

    <p>Logged in as: {{ auth()->user()->name }} (Role ID: {{ auth()->user()->role_id }})</p>

    @if (auth()->user()->role_id != 1)
        <a href="{{ route('employee-leaves.create') }}" class="btn btn-outline-primary mb-3">
            Apply for Leave
        </a>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Leave Type</th>
                <th>From</th>
                <th>To</th>
                <th>Reason</th>
                <th>Status</th>
                @if(auth()->user()->role_id == 1)
                    <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($leaves as $leave)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $leave->leave_type }}</td>
                    <td>{{ $leave->start_date }}</td>
                    <td>{{ $leave->end_date }}</td>
                    <td>{{ $leave->reason }}</td>
                    <td>{{ $leave->status }}</td>
                    @if(auth()->user()->role_id == 1)
                        <td>
                            @if ($leave->status === 'Pending')
                            <form action="{{ route('employee-leaves.approve', $leave->id) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-success btn-sm">Approve</button>
</form>

<form action="{{ route('employee-leaves.reject', $leave->id) }}" method="POST" style="display:inline;">
    @csrf
    <button type="submit" class="btn btn-danger btn-sm">Reject</button>
</form>

                            @else
                                <span class="text-muted">Decision Made</span>
                            @endif
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
