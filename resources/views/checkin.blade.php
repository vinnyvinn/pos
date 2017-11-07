@extends('layouts.app')
@section('content')
    @component('components.page-header')
        @slot('icon')
            fa fa-building
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
                    <br>
                    <form action="{{ route('checkIn.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="stall_id">Select Stall</label>
                            <select name="stall_id" id="stall_id" class="form-control">
                                @foreach($stalls as $stall)
                                <option value="{{ $stall->id }}">{{ $stall->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Check In">
                            <a href="{{ route('stall.index') }}" class="btn btn-danger">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection