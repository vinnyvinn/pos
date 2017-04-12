@extends('layouts.app')
@section('header')
    @component('components.page-header')
        @slot('icon')
            fa fa-building
        @endslot
        @slot('header')
            Stalls
        @endslot
        Manage the stalls.
    @endcomponent
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form action="{{ route('stall.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input class="form-control" type="text" name="location" id="location" {{ old('stall.location') }} required>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Save">
                            <a href="{{ route('stall.index') }}" class="btn btn-danger">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection