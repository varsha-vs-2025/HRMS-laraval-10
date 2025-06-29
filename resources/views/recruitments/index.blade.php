@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Job Openings</h2>

    @auth
        <p>Logged in as: {{ auth()->user()->name }} (Role ID: {{ auth()->user()->role_id }})</p>
    @endauth

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Admin: Post Job -->
    @if(auth()->user()->role_id == 1)
        <a href="{{ route('recruitments.create') }}" class="btn btn-primary mb-3">
            Post New Job
        </a>
    @endif

    <!-- Job Listings -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Position</th>
                <th>Department</th>
                <th>Location</th>
                <th>Posted On</th>
                <th>Deadline</th>
                <th>Description</th>
                @if(auth()->user()->role_id == 1)
                    <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach($recruitments as $job)
             <tr>
    <td>{{ $loop->iteration }}</td>
    <td>{{ $job->position->name ?? 'N/A' }}</td>
    <td>{{ $job->position->department->name ?? 'N/A' }}</td> <!-- if you have departments -->
    <td>{{ $job->location ?? '-' }}</td>
    <td>{{ $job->created_at->format('d M Y') }}</td>
    <td>{{ $job->deadline ?? '-' }}</td>
    <td>{{ Str::limit($job->description, 50) }}</td>


                    @if(auth()->user()->role_id == 1)
                        <td>
                            <a href="{{ route('recruitments.edit', $job->id) }}" class="btn btn-warning btn-sm">Edit</a>

                            <form action="{{ route('recruitments.destroy', $job->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this job?')">Delete</button>
                            </form>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
