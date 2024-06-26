@extends('adminlte::page')

@section('title')
    @if (request()->path() == 'dashboard')
        RSIA Puri Bunda
    @else
        RSIA Puri Bunda | {{ $title }}
    @endif
@endsection

@section('content')
    @yield('content_body')
@endsection

@section('footer')
    <strong>Copyright &copy; 2024 RSIA Puri Bunda
    @endsection
