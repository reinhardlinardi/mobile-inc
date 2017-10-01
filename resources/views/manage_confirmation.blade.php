@extends('layouts.manage')

@section('title')
    Order Confirmation | Mobile, Inc.
@endsection

@section('manage_title')
    Manage Order Confirmation
@endsection

@section('forms')
    <div class="container">
        <div class="row">
            <h4 style="margin-left: 16px;"> Mark All Orders as Sent </h4>
        </div>
        <br />
        <div class="row">
            <div class="col-md-4">
                <form method="POST" action="{{ route('mark_order') }}">
                    {{ csrf_field() }}

                    <input type="text" class="form-control" name="player" id="mark-form" placeholder="Player" required>
                    <br />
                    <button type="submit" class="btn btn-primary form-submit-positive-btn"> Mark All </button>
                </form>
            </div>
            <div class="col-md-8">
                @if(!(empty($message)))
                    <div style="color: green; margin-top: 10px;" id="mark-message"> {{ $message }} </div>
                @endif
            </div>
        </div>
        <br />
        <br />
        <br />
        <div class="row">
            <h4 style="margin-left: 16px;"> Send Order Confirmation to All Users </h4>
        </div>
        <br />
        <div class="row">
            <div class="col-md-4">
                <form method="POST" action="{{ route('send_confirmation') }}">
                    {{ csrf_field() }}

                    <button type="submit" class="btn btn-primary form-submit-positive-btn" id="confirmation-btn"> Send Now </button>
                </form>
            </div>
            <div class="col-md-8">
                @if(!(empty($progress)))
                    <div style="color: green; margin-top: 10px;" id="confirmation-message"> {{ $progress }} </div>
                @endif
            </div>
        </div>
    </div>
@endsection