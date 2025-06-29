@extends('layouts.plain')

@section('content')
<div class="container mt-4 px-4">
  <div class="row">
    <div class="col-12">
        <h4 class="font-weight-bold">Score Categories</h4>
        <hr>
    </div>
  </div>
  
  <div class="row">
    <div class="col-12 mb-3">
      <div class="bg-light text-dark card p-4 overflow-auto shadow rounded">
        <div class="d-flex justify-content-end mb-3">
          <a href="{{ route('score-categories.create') }}" class="btn btn-dark">
            <i class="fas fa-plus mr-1"></i> Create New
          </a>
        </div>

        @if (session('status'))
          <div class="alert alert-success">
            {{ session('status') }}
          </div>
        @endif

        <table class="table table-bordered table-hover text-center">
          <thead class="thead-dark">
            <tr>
              <th>#</th>
              <th>Employee Name</th>
              <th>Category Name</th>
              <th>Score</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($scoreCategories as $category)
            <tr>
              <td>{{ ($scoreCategories->firstItem() ?? 0) + $loop->index }}</td>
              <td>{{ $category->employee->name ?? 'N/A' }}</td>
              <td>{{ $category->name }}</td>
              <td>{{ $category->score ?? 'N/A' }}</td>
              <td>
                <a href="{{ route('score-categories.edit', $category->id) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                <form action="{{ route('score-categories.destroy', $category->id) }}" method="POST" class="d-inline-block">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure deleting this score category?')">Delete</button>
                </form>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="5">No score categories available.</td>
            </tr>
            @endforelse
          </tbody>
        </table>

        @if (method_exists($scoreCategories, 'links'))
          {{ $scoreCategories->links() }}
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
