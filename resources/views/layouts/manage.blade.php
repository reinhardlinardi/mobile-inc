@extends('layouts.app')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/manage.css') }}">
@endsection

@section('title')
        @yield('title')
@endsection

@section('navbar')
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <div class="navbar-brand">
                    <img src="{{ asset('navbar_logo.png') }}" />
                </div>
            </div>

            <ul class="nav navbar-nav navbar-right">
                <li style="padding-right: 10px;">
                    <p class="navbar-btn">
                        <a href="{{ route('logout') }}" class="btn btn-warning"
                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            <span style="font-family: Raleway; font-size: 15px;">Logout</span>
                        </a>
                    </p>    

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
        </div>
    </nav>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <h3 style="font-family: Muli;"> @yield('manage_title') </h3>
            </div>
            <hr />
        </div>
        <div class="row">
            <div class="col-md-3">
                <div>
                    <a class="form-btn-link" href="{{ route('manage_user') }}">
                        <button type="button" class="btn btn-default form-btn" id="user-button" style="padding: 0;">
                            <span style="color: white;"> Manage User &nbsp;&gt;&gt; </span>
                        </button>
                    </a>
                </div>
                <br />
                <div>
                    <a class="form-btn-link" href="{{ route('manage_confirmation') }}">
                        <button type="button" class="btn btn-default form-btn" id="confirm-order-button" style="padding: 0;">
                            <span style="color: white;"> Manage Order Confirmation &nbsp;&gt;&gt; </span>
                        </button>
                    </a>
                </div>
                <br />
                <div>
                    <a class="form-btn-link" href="{{ route('manage_promotion') }}">
                        <button type="button" class="btn btn-default form-btn" id="promotion-send-button" style="padding: 0;">
                            <span style="color: white;"> Manage Promotion Code &nbsp;&gt;&gt; </span>
                        </button>
                    </a>
                </div>
            </div>
            <div class="col-md-9">
                @yield('forms')
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript" src="{{ asset('js/manage.js') }}"></script>
@endsection
