@extends('layouts.app')

@section('nav')
    @include('components.nav')
@endsection

@section('content')
{{-- Hero Section --}}
<div class="container-fluid my-0 py-0">
    <div class="row hero">
        <div class="col-8 offset-1 d-flex align-items-center">
            <div>
                <h1 class="text-white font-weight-bold text-capitalize">ABCD Innovations and Technologies</h1>
                <h4 class="text-white">Alone we can do so little, together we can do so much</h4>
            </div>
        </div>
    </div>
</div>
{{-- End of Hero Section --}}

{{-- Dashboard Section --}}
<div class="container pb-5">
    <div class="row mt-5">
        <div class="col-12 text-center">
            <h3>Dashboard</h3>
            <p>Access HR modules, settings, and features.</p>
            <a href="{{ route('dashboard') }}" class="btn btn-primary">Go to Dashboard</a>
        </div>
    </div>
</div>
@endsection
