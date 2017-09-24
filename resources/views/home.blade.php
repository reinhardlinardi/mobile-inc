@extends('layouts.app')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('title')
    Welcome to Mobile, Inc.
@endsection

@section('navbar')
    <nav class="navbar navbar-inverse navbar-static-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <div class="navbar-brand">
                    <img src="{{ asset('navbar_logo.png') }}" />
                </div>
            </div>

            <ul class="nav navbar-nav">
                <li><a href="#"><span class="active-home" style="font-family: Coolvetica;">Home</span></a></li>
                <li><a href="{{ route('manage') }}"><span class="passive" style="font-family: Coolvetica;">Manage</span></a></li>
            </ul>
        </div>
    </nav>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6" style="padding-top: 30px; padding-left:100px;">
                <img src="{{ asset('home.png') }}" class="image">
            </div>
            <div class="col-md-6" style="padding-top: 50px;">
                <div>
                    <h1 style="font-family: Source Sans Pro;"> Manage your E-commerce in 3 platforms!</h1>
                    <h2 style="font-family: Source Sans Pro;"> How even that possible?? </h2>
                    <br />
                    <br />
                    <br />
                    <span style="font-family: Source Sans Pro; font-size: 20px;">
                        Mobile, Inc. offers you gameplay using 3 platforms for better experience.
                        <br /> These platforms run independently, but they don't have to.
                        <br /><br /> Don't you want too feel the epic management strategy in order to win the game?
                        <br /> <br /> Start playing Mobile, Inc. now! &nbsp;We promise, you won't regret it.
                    </span>
                    <br />
                    <br />
                    <br />
                    <br />
                    <span style="font-family: Source Sans Pro; font-size: 16px;"> &copy; {{ Carbon\Carbon::now()->year }}. &nbsp;Mobile, Inc. Team. </span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
