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
    <link rel="stylesheet" href="{!! asset('css/style.css') !!}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/jquery-ui.min.css')}}">
</head>
<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @if (Auth::user()->role == 1)
            @include('admin.header')
            @include('admin.sidebar')
        @elseif (Auth::user()->role == 2)
            @include('company.header')
            @include('company.sidebar')
        @else
            @include('member.header')
            @include('member.sidebar')
        @endif
        <div class="content-wrapper">
            <section class="content-header">
                <h1>@yield('title')</h1>
            </section>
            <section class="content">
                <div class="admin-content">
                    <div class="box box-primary">
                        <div class="box-body data-management">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                <b>ĐỒ ÁN TỐT NGHIỆP 2017</b>
            </div>
            <strong>Copyright &copy; Cao Hoàng Thiện.
        </footer>
    </div>
<script src="{!! asset('js/jquery-3.1.1.min.js') !!}"></script>
<script src="{!! asset('js/bootstrap.min.js') !!}"></script>
<script src="{!! asset('js/app.min.js') !!}"></script>
<script src="{{asset('js/jquery-ui.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#datepicker").datepicker({ dateFormat: 'dd-mm-yy' });
    })
</script>
@yield('javascript')
</body>
</html>
