@extends('layouts.app')

@section('stylesheet')
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endsection

@section('title')
    Login | Mobile, Inc.
@endsection

@section('navbar')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                
                <div style="margin-top: 20vh; text-align: center;">
                    <img src="{{ asset('mobile_login_mini.png') }}" />
                </div>

                <br />

                <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                    {{ csrf_field() }}

                    <div class="form-group">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <input id="email" type="email" class="form-control" name="email" placeholder="Email" required>

                            @if ($errors->has('email'))
                                @if ($errors->first('email') != "These credentials do not match our records.")
                                    <div style="color: red; text-align: center;"><strong> Invalid email. </strong></div>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-3"></div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <div style="color: red; text-align: center;"><strong> Invalid password. </strong></div>
                                </span>
                            @elseif ($errors->has('email'))
                                @if ($errors->first('email') == "These credentials do not match our records.")
                                    <div style="color: red; text-align: center;"><br /><strong> Wrong email or password. </strong></div>
                                @endif
                            @endif
                        </div>
                        <div class="col-md-3"></div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-5"></div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success" style="text-align: center;">
                                <span style="font-family: Raleway; font-size: 15px;">Login</span>
                            </button>
                        </div>
                        <div class="col-md-5"></div>
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
@endsection

@section('script')
@endsection