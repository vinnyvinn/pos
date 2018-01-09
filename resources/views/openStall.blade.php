@extends('layouts.app')
@section('content')
    @component('components.page-header')
    @slot('icon')
    fa fa-dollar
    @endslot
    @slot('header')
    Check In
    @endslot
    Check in to your stall
    @endcomponent
    <div class="row">
        <div class="col-sm-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Check In</strong></h2>
                </div>
            <div class="widget-content padding">
                <form action="{{ route('openStall.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Closing Amount</label>
                        <input type="number" class="form-control" name="amount" id="amount" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Close Stall" class="btn btn-success">
                        <a href="{{ URL::previous() }}" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection