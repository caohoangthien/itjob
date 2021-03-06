<header class="main-header">
    <!-- Logo -->
    <a href="{!! route('home-site') !!}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>ITJ</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">Việc làm <b>CNTT</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{!! asset(auth()->user()->company->avatar) !!}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ auth()->user()->email }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- MemberUser image -->
                        <li class="user-header">
                            <img src="{!! asset(auth()->user()->company->avatar) !!}" class="img-circle" alt="User Image">
                            <p>Xin chào {{ auth()->user()->company->name }}</p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{!! route('companies.profile.show') !!}"
                                   class="btn btn-default btn-flat">Hồ sơ</a>
                            </div>
                            <div class="pull-right">
                                <a href="{!! route('logout') !!}" class="btn btn-default btn-flat"> Đăng xuất</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>