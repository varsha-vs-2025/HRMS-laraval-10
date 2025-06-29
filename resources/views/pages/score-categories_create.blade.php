@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h3 class="text-center font-weight-bold mb-4">Create Score Category</h3>

    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form action="{{ route('score-categories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="employee_id">Employee:</label>
            <select name="employee_id" id="employee_id" class="form-control" required>
                <option value="">-- Select Employee --</option>
                @foreach ($employees as $employee)
                    <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group mt-3">
            <label for="name">Category Name:</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g., Communication, Leadership" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="score">Score:</label>
            <input type="number" name="score" id="score" class="form-control" value="{{ old('score') }}" placeholder="Enter score (optional)">
        </div>

        <div class="form-group mt-4">
            <button type="submit" class="btn btn-success px-4">Save</button>
        </div>
    </form>
</div>
@endsection
