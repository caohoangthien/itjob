<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{!! asset(auth()->user()->admin->avatar) !!}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->admin->name }}</p>
                <a><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">QUẢN TRỊ VIÊN</li>
            <li><a href="{!! route('admins.index') !!}"><i class="fa fa-home"></i> <span>Trang chủ</span></a></li>
            <li class="{{ Request::is('managements/admins/company/list') ? 'active' : '' }}"><a href="{!! route('admins.company.list') !!}"><i class="fa fa-handshake-o"></i> Công ty</a>
            <li class="{{ Request::is('managements/admins/job/list') ? 'active' : '' }}"><a href="{!! route('admins.job.list') !!}"><i class="fa fa-briefcase"></i> Tin tuyển dụng</a></li>
            <li class="{{ Request::is('managements/admins/member/list') ? 'active' : '' }}"><a href="{!! route('admins.member.list') !!}"><i class="fa fa-users"></i> Thành viên</a>
            <li class="{{ Request::is('managements/contacts/list') ? 'active' : '' }}"><a href="{!! route('admins.contact.list') !!}"><i class="glyphicon glyphicon-refresh"></i> <span>Thông tin liên hệ</span></a></li>
            <li class="{{ Request::is('managements/skills/list') ? 'active' : '' }}"><a href="{!! route('admins.skill.list') !!}"><i class="glyphicon glyphicon-stats"></i> <span>Kỹ năng tuyển dụng</span></a></li>
            <li><a href="{!! route('logout') !!}"><i class="glyphicon glyphicon-log-out"></i> <span>Đăng xuất</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>