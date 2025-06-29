<h1 style="color:red;">THIS FILE IS LOADED</h1>
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Employee Leave Requests</h2>

    <!-- ✅ Debug: Show who is logged in -->
    @auth
        <p>Logged in as: {{ auth()->user()->name }} (Role ID: {{ auth()->user()->role_id }})</p>
    @endauth

    <!-- ✅ Apply Leave button for employees -->
    @auth
        @if (auth()->user()->role_id != 1)
            <a href="{{ route('employees-leave-request.create') }}" class="btn btn-outline-primary mb-3 w-25">
                <i class="fas fa-plus mr-1"></i>
                <span>Apply Leave</span>
            </a>
        @endif
    @endauth

    <!-- ✅ Flash message -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Employee</th>
                <th>From</th>
                <th>To</th>
                <th>Reason</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($employeeLeaveRequests as $leaveReq)
                <tr>
                    <td>{{ $loop->iteration + $employeeLeaveRequests->firstItem() - 1 }}</td>
                    <td><a href="{{ route('employees-leave-request.show', ['employeeLeaveRequest' => $leaveReq->id]) }}">{{ $leaveReq->employee->name }}</a></td>
                    <td>{{ $leaveReq->from }}</td>
                    <td>{{ $leaveReq->to }}</td>
                    <td>{{ $leaveReq->message }}</td>
                    <td>
                        {{ $leaveReq->status }}

                        <!-- ✅ Admin Approve / Reject buttons -->
                        @if (auth()->user()->role_id == 1 && $leaveReq->status === 'WAITING_FOR_APPROVAL')
                            <form action="{{ route('employees-leave-request.update', $leaveReq->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="type" value="accept">
                                <input type="hidden" name="checked_by" value="{{ auth()->user()->employee->id }}">
                                <input type="hidden" name="comment" value="Approved via list">
                                <button type="submit" class="btn btn-success btn-sm">Approve</button>
                            </form>

                            <form action="{{ route('employees-leave-request.destroy', $leaveReq->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="comment" value="Rejected via list">
                                <button type="submit" class="btn btn-danger btn-sm">Reject</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="d-flex justify-content-center">
        {{ $employeeLeaveRequests->links() }}
    </div>
</div>
@endsection
