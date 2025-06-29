@extends('layouts.app')

@section('content')
<div class="container-fluid mt-2 px-4">
    <div class="row">
        <div class="col-12">
            <h4 class="font-weight-bold">Announcements</h4>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-12 mb-3">
            <div class="bg-light text-dark card p-3 overflow-auto">
                <div class="d-flex justify-content-between">
                    @if (auth()->user()->role_id == 1)
                        <a href="{{ route('announcements.create') }}" class="btn btn-outline-dark mb-3 w-25">
                            <i class="fas fa-plus mr-1"></i> <span>Create</span>
                        </a>
                    @endif
                </div>

                {{-- Session Messages --}}
                @if (session('status') || session('success') || session('error'))
                    <div class="alert alert-{{ session('error') ? 'danger' : 'success' }}">
                        {{ session('status') ?? session('success') ?? session('error') }}
                    </div>
                @endif

                {{-- Announcements Table --}}
                <table class="table table-bordered text-center table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Attachment</th>
                            <th>Created By</th>
                            <th>For</th>
                            <th>Date</th>
                            @if (auth()->user()->role_id == 1)
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($announcements as $announcement)
                            <tr>
                                <td>{{ $loop->iteration + $announcements->firstItem() - 1 }}</td>
                                <td>
                                    <a href="{{ route('announcements.show', $announcement->id) }}">
                                        {{ $announcement->title }}
                                    </a>
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit($announcement->description, 50) }}</td>
                                <td>
                                    @if ($announcement->attachment)
                                        <a href="{{ asset('storage/' . $announcement->attachment) }}" target="_blank">View</a>
                                    @else
                                        -
                                    @endif
                                </td>
                                <td>{{ optional($announcement->creator)->name ?? 'Unknown' }}</td>
                                <td>{{ optional($announcement->department)->name ?? 'ALL' }}</td>
                                <td>{{ $announcement->created_at->format('Y-m-d H:i') }}</td>
                                @if (auth()->user()->role_id == 1)
                                    <td>
                                        <a href="{{ route('announcements.edit', $announcement->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Delete this announcement?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">No announcements available.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                {{-- Pagination --}}
                <div class="d-flex justify-content-center">
                    {{ $announcements->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
