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
      <h5 class="text-center font-weight-bold mb-3">Create A New Announcement</h5>

      @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
      @endif

      @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif

      <form action="{{ route('announcements.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">

          <!-- Title -->
          <div class="form-group mb-3">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title"
              class="form-control @error('title') is-invalid @enderror"
              value="{{ old('title') }}" placeholder="Enter title" required>
            @error('title')
              <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
          </div>

          <!-- Description -->
          <div class="form-group mb-3">
            <label for="description">Description:</label>
            <textarea name="description" id="description"
              class="form-control @error('description') is-invalid @enderror"
              rows="4" placeholder="Enter description" required>{{ old('description') }}</textarea>
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
                    {{ old('department_id') == $department->id ? 'selected' : '' }}>
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
              <label for="attachment">Attachment (optional):</label>
              <input type="file" name="attachment" id="attachment"
                class="form-control @error('attachment') is-invalid @enderror">
              @error('attachment')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
              @enderror
            </div>
          </div>
        </div>

        <!-- Submit Button -->
        <div class="form-group">
          <button type="submit" class="btn btn-primary px-5">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
