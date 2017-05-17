<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Việc làm CNTT</title>
        <link rel="shortcut icon" href="{!! asset('images/favicon.ico') !!}">
        <link rel="stylesheet" type="text/css" href="{!! asset('css/bootstrap.min.css') !!}">
        <link rel="stylesheet" type="text/css" href="{!! asset('css/style.css') !!}">
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{!! route('home-site') !!}">Việc làm CNTT</a>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav">
                        <li><a href="{!! route('home-site') !!}">Trang chủ</a></li>
                        <li><a href="#">Liên hệ</a></li>
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
                                    <li><a href="{!! route('companies.signup') !!}"> Đăng kí</a></li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="{!! route('login') !!}"><span class="glyphicon glyphicon-log-in" aria-hidden="true"></span> Đăng nhập</a></li>
                        <li><a href="{!! route('members.signup') !!}"><span class="glyphicon glyphicon-new-window" aria-hidden="true"></span> Đăng kí</a></li>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>

        <div class="main-body">
            @yield('content')
        </div>

        <div class="container-fluid footer">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5>THEO DÕI CHÚNG TÔI</h5>
                        <p><a href="#"><img src="{!! asset('images/icons/facebook.png') !!}"> Theo dõi chúng tôi trên Facebook</a></p>
                        <p><a href="#"><img src="{!! asset('images/icons/google.png') !!}"> Theo dõi chúng tôi trên Google +</a></p>
                        <p><a href="#"><img src="{!! asset('images/icons/twitter.png') !!}"> Theo dõi chúng tôi trên Twitter</a></p>
                    </div>
                    <div class="col-md-6">
                        <h5>THÔNG TIN LIÊN HỆ</h5>
                        <p><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span> : 0511.123.123</p>
                        <p><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> : vieclamcntt@gmail.com</p>
                        <p><span class="glyphicon glyphicon-home" aria-hidden="true"></span> : 54 Nguyễn Lương Bằng - Đà Nẵng.</p>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript" src="{!! asset('js/jquery-3.1.1.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/bootstrap.min.js') !!}"></script>
        <script type="text/javascript" src="{!! asset('js/canvasjs.min.js') !!}"></script>
        @yield('javascript')
    </body>
</html>
