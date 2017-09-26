@extends('layouts.app')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('title')
    Mobile, Inc. | The 3-platform e-commerce management game
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
                <!-- Authentication Links -->
                @guest
                    <li style="padding-right: 10px;">
                        <p class="navbar-btn">
                            <a href="{{ route('login') }}" class="btn btn-info">
                                <span style="font-family: Raleway; font-size: 15px;">Login</span>
                            </a>
                        </p>    
                    </li>
                @else
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
                @endguest
            </ul>
        </div>
    </nav>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <br />
            <h1 style="font-family: Muli; text-align: center; color: #c453fc;"> Manage your E-commerce in 3 platforms! </h1>
            <br />
        </div>
        <div class="row">
            <br />
            <br />
            <div class="col-md-1"></div>
            <div class="col-md-5 content">
                <img src="{{ asset('home_white.png') }}">
            </div>
            <div class="col-md-5 content">
                <div>
                    <h2 style="font-family: Muli; color: #dbd653;"> How even that possible?? </h2>
                    <br />
                    <br />
                    <span style="font-family: Open Sans; font-size: 16px; color: #00bdfc;">
                        Mobile, Inc. offers you gameplay using 3 platforms for better experience.
                        <br /> These platforms run independently, but they don't have to.
                        <br /><br /> Don't you want too feel the epic management strategy in order to win the game?
                        <br /><br /><br /> Start playing Mobile, Inc. now! &nbsp;We promise, you won't regret it.
                    </span>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
@endsection

@section('script')
@endsection
