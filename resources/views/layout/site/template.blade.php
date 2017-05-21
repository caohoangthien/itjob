<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Việc làm CNTT</title>
        <link rel="shortcut icon" href="{!! asset('images/favicon.ico') !!}">
        <link rel="stylesheet" type="text/css" href="{!! asset('css/bootstrap.min.css') !!}">
        <link rel="stylesheet" type="text/css" href="{{asset('css/jquery-ui.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{!! asset('css/style.css') !!}">
        @yield('css')
    </head>
    <body>
        <nav class="navbar navbar-inverse">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{!! route('home-site') !!}"><b>Việc làm CNTT</b></a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="{!! route('home-site') !!}"><b>Trang chủ</b></a></li>
                        <li><a href="{!! route('contact') !!}"><b>Liên hệ</b></a></li>
                    </ul>

                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <div class="dropdown">
                                <button class="btn btn-default navbar-btn dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <span class="glyphicon glyphicon-th" aria-hidden="true"></span> Nhà tuyển dụng
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                    <li><a href="{!! route('login') !!}"> Đăng nhập</a></li>
                                    <li><a href="{!! route('companies.signup') !!}"> Đăng ký</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="{!! route('login') !!}"><b><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Đăng nhập</b></a></li>
                        <li><a href="{!! route('members.signup') !!}"><b><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span> Đăng ký</b></a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        @yield('content')

        <div class="container-fluid footer">
            <div class="container">
                <div class="text-center">
                    <h5>VIỆC LÀM CÔNG NGHỆ THÔNG TIN</h5>
                    <img src="{!! asset('images/icons/facebook.png') !!}">
                    <img src="{!! asset('images/icons/google.png') !!}">
                    <img src="{!! asset('images/icons/twitter.png') !!}">
                    <h5>Website tuyển dụng, tìm kiếm việc làm Công nghệ Thông tin.</h5>
                    <h5>Đồ án tốt nghiệp - Khoa Công nghệ Thông tin - Đại học Bách khoa Đà Nẵng.</h5>
                </div>
            </div>
        </div>

        <script type="text/javascript" src="{!! asset('js/jquery-3.1.1.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/bootstrap.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/canvasjs.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/jquery-ui.min.js') !!}"></script>
        @yield('javascript')
    </body>
</html>
