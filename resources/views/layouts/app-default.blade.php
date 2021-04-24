<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Gestion des opérations de multiservice') }}</title>

        <!-- Styles -->
        <link href="{{ asset('css/fontawesome-all.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/spacing.css') }}" rel="stylesheet">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/datepicker.min.css') }}" rel="stylesheet" type="text/css">
        {{-- <link href="{{ asset('css/jquery-ui.css') }}" rel="stylesheet"> --}}

        <script type="text/javascript" src="{{ asset('js/ng/angular.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/ng/angular-route.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/ng/angular-resource.min.js') }}"></script>
        <script>var app = angular.module('MainApp', ['ngRoute', 'ngResource']);</script>
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/jquery-ui.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/datepicker/datepicker.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/datepicker/datepicker.fr.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/numeral.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/ngApp.js') }}"></script>
    </head>
    <body ng-app="MainApp">
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <!-- Branding Image -->
                        <a class="navbar-brand" href="{{ url('/') }}">
                            {{ config('app.name', 'Gestion des opérations de multiservice') }}
                        </a>
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">&nbsp;</ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->firstname . ' ' . Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Deconnexion</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">Tableau de bord</div>
                            <div class="list-group panel-body">
                                {{-- <a href="{{ route('l-services') }}" class="list-group-item {{'active'}}">Services</a>
                                <a href="{{ route('l-clients') }}" class="list-group-item">Clients</a> --}}
                                <a href="{{ route('l-caisse') }}" class="list-group-item">Caisse</a>
                                {{-- <a href="#" class="list-group-item">Résumé</a> --}}
                                <?php if(Auth::user()->profil): ?>
                                <a href="{{ route('d-bilan', ['y1'=>date('Y'),'m1'=>date('m'),'d1'=>date('d')]) }}" class="list-group-item">Bilan</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
        @yield('script_foot')
    </body>
</html>
