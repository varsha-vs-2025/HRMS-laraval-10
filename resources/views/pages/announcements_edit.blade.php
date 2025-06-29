@extends('layouts.admin', ['accesses' => $accesses, 'active' => 'announcements'])

@section('_content')
<div class="container-fluid mt-2 px-4">
  <div class="row">
    <div class="col-12">
      <h4 class="font-weight-bold">Announcements</h4>
      <hr>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <h5 class="text-center font-weight-bold mb-3">Editing An Announcement</h5>

      @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
      @endif

      <form action="{{ route('announcements.update', $announcement->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
          <!-- Title -->
          <div class="form-group mb-3">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title"
              class="form-control @error('title') is-invalid @enderror"
              value="{{ old('title', $announcement->title) }}" required>
            @error('title')
              <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
          </div>

          <!-- Description -->
          <div class="form-group mb-3">
            <label for="description">Description:</label>
            <textarea name="description" id="description"
              class="form-control @error('description') is-invalid @enderror"
              rows="4" required>{{ old('description', $announcement->description) }}</textarea>
            @error('description')
              <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div class="row">
            <!-- Department -->
            <div class="col-md-6 mb-3">
              <label for="department_id">For (Department):</label>
              <select id="department_id" name="department_id"
                class="form-control @error('department_id') is-invalid @enderror">
                <option value="">All</option>
                @foreach ($departments as $department)
                  <option value="{{ $department->id }}"
                    {{ $department->id == $announcement->department_id ? 'selected' : '' }}>
                    {{ $department->name }}
                  </option>
                @endforeach
              </select>
              @error('department_id')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
              @enderror
            </div>

            <!-- Attachment -->
            <div class="col-md-6 mb-3">
              <label for="attachment">Attachment:</label>
              <input type="file" name="attachment" id="attachment"
                class="form-control @error('attachment') is-invalid @enderror">
              @error('attachment')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
              @enderror

              @if ($announcement->attachment)
                <div class="mt-2">
                  <strong>Current File:</strong>
                  <a href="{{ asset('storage/' . $announcement->attachment) }}" target="_blank">View</a>
                </div>
              @endif
            </div>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="d-flex gap-3">
          <button type="submit" class="btn btn-primary px-4">Update</button>

          <!-- Delete Option -->
          <form action="{{ route('announcements.destroy', $announcement->id) }}" method="POST"
                onsubmit="return confirm('Are you sure you want to delete this announcement?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger px-4">Delete</button>
          </form>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection
