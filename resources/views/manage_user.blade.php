@extends('layouts.manage')

@section('title')
    User | Mobile, Inc.
@endsection

@section('manage_title')
    Manage User
@endsection

@section('forms')
    <div class="container">
        <div class="row">
            <h4 style="margin-left: 16px;"> Add or Update User </h4>
        </div>
        <br />
        <div class="row">
            <div class="col-md-4">
                <form method="POST" action="{{ route('manage_user') }}">
                    {{ csrf_field() }}

                    <input type="text" class="form-control add-form" name="name" placeholder="User" required>
                    <br />
                    <input type="text" class="form-control add-form" name="firebase_key" placeholder="Firebase Key" required>
                    <br />
                    <button type="submit" class="btn btn-primary form-submit-positive-btn"> Submit </button>
                </form>
            </div>
            <div class="col-md-8">
                @if(!(empty($add)))
                    <div style="color: green; margin-top: 10px;" id="add-message"> {{ $add }} </div>
                @endif
            </div>
        </div>
    </div>
@endsection
