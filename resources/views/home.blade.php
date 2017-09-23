@extends('layouts.app')

@section('title')
    Welcome to Mobile, Inc.
@endsection

@section('navlink')
    <li><a href="#"><span class="active-home">Home</span></a></li>
    <li><a href="{{ route('manage') }}"><span class="passive">Manage</span></a></li>
@endsection

@section('content')
@endsection
