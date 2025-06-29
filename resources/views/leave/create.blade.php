@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Apply for Leave</h2>
    <form action="{{ route('leave.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Leave Type</label>
            <input type="text" name="leave_type" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Start Date</label>
            <input type="date" name="start_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">End Date</label>
            <input type="date" name="end_date" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Reason</label>
            <textarea name="reason" class="form-control" required></textarea>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
</div>
@endsection
