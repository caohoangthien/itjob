<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{!! asset(auth()->user()->company->avatar) !!}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ auth()->user()->company->name }}</p>
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
            <li class="header">QUẢN LÝ TUYỂN DỤNG</li>
            <li><a href="{!! route('jobs.create') !!}"><i class="fa fa-plus-square"></i> <span>Đăng tin</span></a></li>
            <li><a href="{!! route('jobs.checked') !!}"><i class="fa fa-ban"></i> <span>Tin đã duyệt</span></a></li>
            <li><a href="{!! route('jobs.uncheck') !!}"><i class="fa fa-ban"></i> <span>Tin chưa duyệt</span></a></li>
            <li><a href="{!! route('companies.index') !!}"><i class="fa fa-home"></i> <span>Trang chủ</span></a></li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>