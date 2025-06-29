@extends('layouts.admin')

@section('_content')
<div class="container-fluid mt-2 px-4">
    <div class="row">
        <div class="col-12">
            <h4 class="font-weight-bold">Announcements (Print View)</h4>
            <hr>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Created By</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($announcements as $announcement)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $announcement->title }}</td>
                <td>{{ $announcement->description }}</td>
                <td>{{ optional($announcement->creator)->name ?? 'Unknown' }}</td>
                <td>{{ $announcement->created_at }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
