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
