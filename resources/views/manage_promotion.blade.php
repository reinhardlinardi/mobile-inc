@extends('layouts.manage')

@section('title')
    Promotion | Mobile, Inc.
@endsection

@section('manage_title')
    Manage Promotion Code
@endsection

@section('forms')
    <div class="container">
        <div class="row">
            <h4 style="margin-left: 16px;"> Send Promotion Code to All Users </h4>
        </div>
        <br />
        <div class="row">
            <div class="col-md-4">
                <form method="POST" action="{{ route('manage_promotion') }}">
                    {{ csrf_field() }}

                    <input type="text" class="form-control" name="player" id="promo-form" placeholder="Player" required>
                    <br />
                    <button type="submit" class="btn btn-primary form-submit-positive-btn"> Send Now </button>
                </form>
            </div>
            <div class="col-md-8">
                @if(!(empty($progress)))
                    <div style="color: green; margin-top: 10px;" id="promo-message"> {{ $progress }} </div>
                @endif
            </div>
        </div>
    </div>
@endsection
