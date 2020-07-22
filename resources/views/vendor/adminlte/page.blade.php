@extends('adminlte::master')

@section('adminlte_css')
<link rel="stylesheet" href="{{ asset('vendor/adminlte/dist/css/skins/skin-' . config('adminlte.skin', 'blue') . '.min.css')}} ">
<style>
    .title {
        font-size: 20px;
        text-decoration: underline;
        margin: 5px 0px 5px 30px;

    }

    .info{
        margin: 5px 0px 5px 30px;
    }

    .details{
        border-style: solid;
    }
</style>
@stack('css')
@yield('css')
@stop

@section('body_class', 'skin-' . config('adminlte.skin', 'blue') . ' sidebar-mini ' . (config('adminlte.layout') ? [
'boxed' => 'layout-boxed',
'fixed' => 'fixed',
'top-nav' => 'layout-top-nav'
][config('adminlte.layout')] : '') . (config('adminlte.collapse_sidebar') ? ' sidebar-collapse ' : ''))

@section('body')
<div class="wrapper">


    <!-- Main Header -->
    <header class="main-header">
        @if(config('adminlte.layout') == 'top-nav')

        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="{{ url(config('adminlte.dashboard_url', 'adminpanel')) }}" class="navbar-brand">
                        {{config('basic_settings.CM_title')}}
                    </a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                        <i class="fa fa-bars"></i>
                    </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        @each('adminlte::partials.menu-item-top-nav', $adminlte->menu(), 'item')
                    </ul>
                </div>
                <!-- /.navbar-collapse -->
                @else
                <!-- Logo -->
                <a href="{{ url(config('adminlte.dashboard_url', 'adminpanel')) }}" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini">{!! config('adminlte.logo_mini', '<b>A</b>LT') !!}</span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg">{{config('basic_settings.CM_title')}}</span>
                </a>

                <!-- Header Navbar -->
                <nav class="navbar navbar-static-top" role="navigation">
                    <!-- Sidebar toggle button-->
                    <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                        <span class="sr-only">{{ trans('adminlte::adminlte.toggle_navigation') }}</span>
                    </a>
                    @endif
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li>
                                @if(config('adminlte.logout_method') == 'GET' || !config('adminlte.logout_method') && version_compare(\Illuminate\Foundation\Application::VERSION, '5.3.0', '<')) <a href="{{ url(config('adminlte.logout_url', 'auth/logout')) }}">
                                    <i class="fa fa-fw fa-power-off"></i> Logout
                                    </a>
                                    @else
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#"> <img src="{{ asset(Auth::user()->image)}}" class="img-circle" width=28px height=20px /> {{ Auth::user()->name }}
                                    <span class="caret"></span></a>
                                <ul class="dropdown-menu">
                                    <li><a href="{{ route('users.edit-profile') }} "><i class="fa fa-user-circle"> My Profile</i></a></li>
                                    <li><a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i class="fa fa-power-off"></i>Logout</a></li>
                                </ul>
                            </li>

                            <form id="logout-form" action="{{ url(config('adminlte.logout_url', 'auth/logout')) }}" method="POST" style="display: none;">
                                @if(config('adminlte.logout_method'))
                                {{ method_field(config('adminlte.logout_method')) }}
                                @endif
                                {{ csrf_field() }}
                            </form>
                            @endif
                            </li>
                        </ul>
                    </div>
                </nav>
                @if(config('adminlte.layout') == 'top-nav')
            </div>
            @endif
        </nav>
    </header>

    @if(config('adminlte.layout') != 'top-nav')
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                @each('adminlte::partials.menu-item', $adminlte->menu(), 'item')
            </ul>
            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>
    @endif

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @if(config('adminlte.layout') == 'top-nav')
        <div class="container">
            @endif

            <!-- Content Header (Page header) -->
            <section class="content-header">
                @yield('content_header')
            </section>

            <!-- Main content -->
            <section class="content">

                @auth
                @if(session()->has('sucs'))
                <div class="alert alert-info text-center alert-dismissible">
                    {{ session()->get('sucs')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @if(session()->has('err'))
                <div class="alert alert-danger text-center alert-dismissible">
                    {{ session()->get('err')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
                @endauth

                @yield('content')

            </section>
            <!-- /.content -->
            @if(config('adminlte.layout') == 'top-nav')
        </div>
        <!-- /.container -->
        @endif
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="text-center">
            <strong>Copyright &copy; 2019 <a href="http://elit.com.np/">Elit Pvt. Ltd </a>.</strong> All rights reserved.
            <a href="#"> <i class="fa fa-facebook-official"></i> </a>
            <a href="#"> <i class="fa fa-instagram"></i></a>
        </div>
    </footer>
</div>

<!-- ./wrapper -->
@stop
@section('adminlte_js')
<script src="{{ asset('vendor/adminlte/dist/js/adminlte.min.js') }}"></script>

@stack('js')
@yield('js')
@yield('scripts')
@stop