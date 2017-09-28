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
                <h3 style="font-family: Muli;"> Manage </h3>
            </div>
            <hr />
        </div>
        <div class="row">
            <div class="col-md-3">
                <div><button type="button" class="btn btn-default form-btn" id="user-button">Manage User &nbsp;&gt;&gt;</button></div>
                <br />
                <div><button type="button" class="btn btn-default form-btn" id="confirm-order-button">Send Order Confirmation &nbsp;&gt;&gt;</button></div>
                <br />
                <div><button type="button" class="btn btn-default form-btn" id="promotion-send-button">Send Promotion Code &nbsp;&gt;&gt;</button></div>
            </div>
            <div class="col-md-9">
                @yield('forms')
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
