@extends('layouts.app')
@section('content')
    @component('components.page-header')
        @slot('icon')
            fa fa-users
            @endslot
        @slot('header')
            Users
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-sm-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>User Details</strong></h2>
                </div>
                <div class="widget-content padding">
                    <form action="{{ route('users.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('full_name') ? ' has-error': '' }}">
                                    <label for="full_name">Full Name</label>
                                    <input class="form-control" type="text" name="full_name" value="{{ old('full_name') }}" id="full_name" required>
                                    @if($errors->has('full_name'))
                                        <span class="help-block">
                                            {{ $errors->first('full_name') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('username') ? ' has-error': '' }}">
                                    <label for="username">Username</label>
                                    <input class="form-control" type="text" name="username" value="{{ old('username') }}" id="username" required>
                                    @if($errors->has('username'))
                                        <span class="help-block">
                                            {{ $errors->first('username') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('password') ? ' has-error': '' }}">
                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" name="password" id="password" required>
                                    @if($errors->has('password'))
                                        <span class="help-block">
                                            {{ $errors->first('password') }}
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error': '' }}">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation" required>
                                    @if($errors->has('password_confirmation'))
                                        <span class="help-block">
                                            {{ $errors->first('password_confirmation') }}
                                        </span>
                                    @endif
                                </div>

                            </div>


                            <div class="col-sm-6">

                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" value="Create">
                                    <a href="{{ route('stock.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  @endsection