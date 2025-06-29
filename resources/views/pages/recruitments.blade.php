@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="text-center">Job Recruitments</h2>
    <div class="row">
        @foreach ($recruitments as $recruitment)
            <div class="col-lg-4 col-sm-12 mb-2">
                <div class="card mx-3 h-100">
                    @if ($recruitment->attachment !== null)
                        <img src="{{ asset('/storage/' . $recruitment->attachment) }}" class="card-img-top" alt="recruitment">                    
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $recruitment->title }}</h5>
                        <p class="card-text">{{ $recruitment->description }}</p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
