<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("/admin-lte/dist/img/admin.jpg") }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{ Cartalyst\Sentinel\Laravel\Facades\Sentinel::check()->first_name }} {{ Cartalyst\Sentinel\Laravel\Facades\Sentinel::check()->last_name }}</p>
                <!-- Status -->
                <i class="fa fa-circle text-success"></i>
                @foreach(Cartalyst\Sentinel\Laravel\Facades\Sentinel::check()->getRoles() as $role)
                    {{ $role->name }}
                @endforeach
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
          <span class="input-group-btn">
            <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
          </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            {{--<li class="header">Manage</li>--}}

            <!-- Optionally, you can add icons to the links -->
            <li class="{!! Request::is('admin/dashboard') ? 'active' : '' !!}"><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Dashboard</a></li>
            {{--<li><a href="#"><span>Another Link</span></a></li>--}}

            @foreach(Cartalyst\Sentinel\Laravel\Facades\Sentinel::check()->getRoles() as $role)
                @if($role->slug == 'super_admin')
                    <li class="treeview">
                        <a href="#"><i class="fa fa-gears"></i> Admins</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li><a href="{{ route('admin.create.show') }}"><i class="fa fa-user-plus"></i>Add New </a></li>
                            <li><a href="{{ route('admin.manage') }}"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>Manage</a></li>
                        </ul>
                    </li>
                @endif
            @endforeach


            <li class="treeview">
                <a href="#"><i class="fa fa-users" aria-hidden="true"></i> Organisers <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>All </a></li>
                    <li><a href="{{ route('organisers.manage') }}"><span class="glyphicon glyphicon-wrench" aria-hidden="true"></span>Manage</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>