@extends('layouts.app')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/manage.css') }}">
@endsection

@section('title')
        Manage Mobile, Inc.
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
            <br />
            <h1 style="text-align: center;"> Management </h1>
            <br />
        </div>
        <div class="row">
            
        </div>
    </div>
@endsection

@section('script')
@endsection
