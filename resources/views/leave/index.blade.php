@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Leave Management</h2>

    <table class="table">
        <thead>
            <tr>
                <th>Leave Type</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Reason</th>
                <th>Status</th>
                @if(auth()->user()->role_id == 1) <!-- Show employee name & actions for admin -->
                    <th>Employee Name</th>
                    <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($leaves as $leave)
                <tr>
                    <td>{{ $leave->leave_type }}</td>
                    <td>{{ $leave->start_date }}</td>
                    <td>{{ $leave->end_date }}</td>
                    <td>{{ $leave->reason }}</td>
                    <td>
                        @if ($leave->status == 'Pending')
                            <span class="badge bg-warning">{{ $leave->status }}</span>
                        @elseif ($leave->status == 'Approved')
                            <span class="badge bg-success">{{ $leave->status }}</span>
                        @else
                            <span class="badge bg-danger">{{ $leave->status }}</span>
                        @endif
                    </td>

                    @if(auth()->user()->role_id == 1) <!-- Only for admin -->
                        <td>{{ $leave->user->name }}</td>
                        <td>
                            @if ($leave->status == 'Pending') <!-- Show approve/reject buttons only if pending -->
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
