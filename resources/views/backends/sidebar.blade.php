Sidebar --}}
{{-- Sidebar --}}
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('public/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ \Auth::user()->name }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
                </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active">
                        <a href="{{ route('admin.dashboard.index') }}"><i class="fa fa-circle-o"></i> Dashboard v1</a>
                    </li>
                    {{-- <li>
                        <a href="index2.html"><i class="fa fa-circle-o"></i> Dashboard v2</a>
                    </li> --}}
                </ul>
            </li>

            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-user"></i> <span> Link</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.link.index') }}"><i class="fa fa-circle-o"></i> Quản lý Link</a></li>
                </ul>
            </li>


            @if(\Auth::user()->group_id == 1)
            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-user"></i> <span> More Options</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.user.index') }}"><i class="fa fa-circle-o"></i> Quản lý User</a></li>
                    <li><a href="{{ route('admin.group.index') }}"><i class="fa fa-circle-o"></i> Quản lý Group</a></li>
                </ul>
            </li>
            @endif

            <li class="treeview active">
                <a href="#">
                    <i class="fa fa-user"></i> <span> Profile</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('admin.profile.editProfile') }}"><i class="fa fa-circle-o"></i> Edit Profile</a></li>
                    <li><a href="{{ route('admin.profile.editPassword') }}"><i class="fa fa-circle-o"></i> Change Password</a></li>
                    <li><a href="{{ route('admin.profile.apiShortestUrl') }}"><i class="fa fa-circle-o"></i> Api Shortest Url</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
{{-- End Sidebar --}}
{{-- End Sidebar