@extends('layouts.app')
@section('content')
    @component('components.page-header')
        @slot('icon')
            fa fa-building
        @endslot
        @slot('header')
            Stalls
        @endslot
        Manage the stalls.
    @endcomponent
    <div class="row">
        <div class="col-sm-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Stall Details</strong></h2>
                </div>
                <div class="widget-content padding">
                    <form action="{{ route('stall.update', $stall->id) }}" method="post">
                        {{ csrf_field() }}
                      {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" id="name" value="{{ $stall->name }}" required>
                        </div>
                        <div class="form-group">
                            <label for="location">Location</label>
                            <input class="form-control" type="text" name="location" id="location" {{ old('stall.location') }} value="{{ $stall->location }}" required>
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