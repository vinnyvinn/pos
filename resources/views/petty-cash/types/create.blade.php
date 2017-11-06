@extends('layouts.app')
@section('content')
    @component('components.page-header')
        @slot('icon')
            fa fa-building
        @endslot
        @slot('header')
            Petty Cash Types
        @endslot
        Manage the Types.
    @endcomponent
    <div class="row">
        <div class="col-sm-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Petty Cash Types Details</strong></h2>
                </div>
                <div class="widget-content padding">
                    <br>
                    <form action="{{ route('pettyCashTypes.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input class="form-control" type="text" name="name" id="name" required value="{{ old('name') }}">
                            {{--@if ($errors->has('name'))--}}
                                {{--<span class="help-block">--}}
                                    {{--<strong>{{ $errors->first('name') }}</strong>--}}
                                {{--</span>--}}
                            {{--@endif--}}
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Save">
                            <a href="{{ route('pettyCashTypes.index') }}" class="btn btn-danger">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection