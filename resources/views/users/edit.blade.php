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
                    <form action="{{ route('users.update', $user->id) }}" method="post">
                        {{ method_field('PUT') }}
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('full_name') ? ' has-error': '' }}">
                                    <label for="full_name">Full Name</label>
                                    <input class="form-control" type="text" name="full_name" value="{{ $user->full_name or old('full_name') }}" id="full_name" required>
                                    @if($errors->has('full_name'))
                                        <span class="help-block">
                    {{ $errors->first('full_name') }}
                </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('username') ? ' has-error': '' }}">
                                    <label for="username">Username</label>
                                    <input class="form-control" type="text" name="username" value="{{ $user->username or old('username') }}" id="username" required>
                                    @if($errors->has('username'))
                                        <span class="help-block">
                    {{ $errors->first('username') }}
                </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('email') ? ' has-error': '' }}">
                                    <label for="email">Email</label>
                                    <input class="form-control" type="email" name="email" value="{{ $user->email or old('email') }}" id="email" required>
                                    @if($errors->has('email'))
                                        <span class="help-block">
                    {{ $errors->first('email') }}
                </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="user_group_id">User Group</label>
                                    <select name="user_group_id" id="user_group_id" class="form-control">
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}"{{ $group->user_group_id == $group->id ? ' selected' : '' }}>{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                    {{--<input class="form-control" type="text" name="user_group_id" id="password"{{ isset($user) ? '' : ' required' }}>--}}
                                    {{--@if($errors->has('password'))--}}
                                    {{--<span class="help-block">--}}
                                    {{--{{ $errors->first('password') }}--}}
                                    {{--</span>--}}
                                    {{--@endif--}}
                                </div>
                                <div class="form-group{{ $errors->has('password') ? ' has-error': '' }}">
                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" name="password" id="password"{{ isset($user) ? '' : ' required' }}>
                                    @if($errors->has('password'))
                                        <span class="help-block">
                    {{ $errors->first('password') }}
                </span>
                                    @endif
                                </div>

                                <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error': '' }}">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input class="form-control" type="password" name="password_confirmation" id="password_confirmation"{{ isset($user) ? '' : ' required' }}>
                                    @if($errors->has('password_confirmation'))
                                        <span class="help-block">
                    {{ $errors->first('password_confirmation') }}
                </span>
                                    @endif
                                </div>
                            </div>


                            {{--<div class="col-sm-6">--}}
                            {{--<h4><strong>Permissions</strong></h4>--}}
                            {{--</div>--}}

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" value="{{ isset($user) ? 'Save Changes' : 'Create User' }}">
                                    <a href="{{ route('users.index') }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  @endsection