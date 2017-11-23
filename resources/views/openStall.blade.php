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
                    <div class="form-group">
                        <label for="">Closing Amount</label>
                        <input type="number" class="form-control" name="" id="">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Open Stall" class="btn btn-success">
                        <a href="{{ route('checkIn') }}" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection