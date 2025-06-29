@extends('layouts.app')

@section('head')
    @yield('_head')
@endsection

@section('content')
<div class="wrapper">
    {{-- ✅ Sidebar for admin --}}
    @include('components.sidebar', ['accesses' => $accesses, 'active' => $active ?? ''])

    <div class="content">
        {{-- ✅ Top bar / Toggle --}}
        @include('components.togglesidebar')

        {{-- ✅ Main Page Content --}}
        @yield('_content')
    </div>
</div>
@endsection

@section('script')
    @yield('_script')
@endsection
