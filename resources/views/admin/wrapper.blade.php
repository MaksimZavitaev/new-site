@extends('admin.layout')

@section('wrapper')
    <div class="wrapper">

        <!-- Main Header -->
        <header class="main-header">

            <!-- Logo -->
            <a href="{{ route('admin.dashboard') }}" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>A</b>LT</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>Admin</b>LTE</span>
            </a>

            <!-- Header Navbar -->
            <nav class="navbar navbar-static-top" role="navigation">
                <!-- Sidebar toggle button-->
                <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                    <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a class="dropdown-item" href="{{ route('admin.logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Выйти
                            </a>
                            <form id="logout-form" action="{{ route('admin.logout') }}" method="POST"
                                  style="display: none;">
                                @csrf
                            </form>
                        </li>
                        {{--<li>
                            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                        </li>--}}
                    </ul>
                </div>
            </nav>
        </header>
        <!-- Left side column. contains the logo and sidebar -->
        <aside class="main-sidebar">

            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <!-- Sidebar Menu -->
                <ul class="sidebar-menu" data-widget="tree">
                    <!-- Optionally, you can add icons to the links -->

                    @hasrole('administrator|writer')
                    <li class="{{ request()->route()->named('admin.pages.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.pages.index') }}">
                            <i class="fa fa-newspaper-o"></i>
                            <span>Страницы</span>
                        </a>
                    </li>
                    @endhasrole
                    @hasrole('administrator|writer')
                    <li class="{{ request()->route()->named('admin.applications.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.applications.index') }}">
                            <i class="fa fa-paper-plane-o"></i>
                            <span>Заявки</span>
                        </a>
                    </li>
                    @endhasrole
                    @hasrole('administrator')
                    <li class="header">Администрирование</li>
                    <li class="{{ request()->route()->named('admin.users.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-users"></i>
                            <span>Пользователи</span>
                        </a>
                    </li>
                    <li class="{{ request()->route()->named('admin.forms.*') ? 'active' : '' }}">
                        <a href="{{ route('admin.forms.index') }}">
                            <i class="fa fa-list"></i>
                            <span>Формы</span>
                        </a>
                    </li>
                    <li class="treeview {{ request()->route()->named('admin.product-types.*') || request()->route()->named('admin.products.*') ? 'active' : '' }}">
                        <a href="#">
                            <i class="fa fa-shopping-cart"></i>
                            <span>Продукты</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="{{ request()->route()->named('admin.product-types.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.product-types.index') }}">
                                    <i class="fa fa-circle-o"></i>
                                    Виды продуктов
                                </a>
                            </li>
                            <li class="{{ request()->route()->named('admin.products.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.products.index') }}">
                                    <i class="fa fa-circle-o"></i>
                                    Продукты
                                </a>
                            </li>
                        </ul>
                    </li>
                    @endhasrole
                </ul>
                <!-- /.sidebar-menu -->
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                {{ Breadcrumbs::render() }}
            </section>

            <!-- Main content -->
            <section class="content container-fluid">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
        {{--<div class="pull-right hidden-xs">
            Anything you want
        </div>--}}
        <!-- Default to the left -->
            <strong>Copyright &copy; 2019 <a href="#">CК "Согласие"</a>.</strong>
        </footer>
    </div>
    <!-- ./wrapper -->
@stop
