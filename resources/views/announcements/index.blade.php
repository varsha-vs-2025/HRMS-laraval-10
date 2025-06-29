@extends('layouts.plain')

@section('content')
<div class="container mt-5">
    <h2>Announcements</h2>

    @if(auth()->user()->role_id == 1)
        <a href="{{ route('announcements.create') }}" class="btn btn-primary mb-3">Add Announcement</a>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Attachment</th>
                <th>Created By</th>
                <th>For</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($announcements as $key => $announcement)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $announcement->title }}</td>
                    <td>{{ $announcement->description }}</td>
                    <td>-</td>
                    <td>{{ $announcement->user->name ?? 'Administrator' }}</td>
                    <td>ALL</td>
                    <td>{{ $announcement->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
