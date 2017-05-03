@extends('layout.management.template')

@section('title', 'Trang quản trị')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            <p>{{ session('success') }}</p>
        </div>
    @endif
    ...
@endsection