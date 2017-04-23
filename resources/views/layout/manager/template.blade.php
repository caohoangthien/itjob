<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Việc làm CNTT</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{!! asset('css/bootstrap.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/font-awesome.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/ionicons.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/AdminLTE.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('css/_all-skins.min.css') !!}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @if (Auth::user()->role == 1)
            @include('admin.header')
            @include('admin.sidebar')
            <div class="content-wrapper">
                @include('admin.content-header')
                <section class="content">
                    @yield('content')
                </section>
            </div>
            @include('admin.content-footer')
        @elseif (Auth::user()->role == 2)
            @include('company.header')
            @include('company.sidebar')
            <div class="content-wrapper">
                @include('company.content-header')
                <section class="content">
                    @yield('content')
                </section>
            </div>
            @include('company.content-footer')
        @else
            @include('member.header')
            @include('member.sidebar')
            <div class="content-wrapper">
                @include('member.content-header')
                <section class="content">
                    @yield('content')
                </section>
            </div>
            @include('member.content-footer')
        @endif
    </div>
<script src="{!! asset('js/jquery-2.2.3.min.js') !!}"></script>
<script src="{!! asset('js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('js/app.min.js') !!}"></script>
</body>
</html>
