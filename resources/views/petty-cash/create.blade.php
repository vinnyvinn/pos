@extends('layouts.app')
@section('content')
    @component('components.page-header')
        @slot('icon')
            fa fa-building
        @endslot
        @slot('header')
            Petty Cash
        @endslot
        Manage the Petty Cash.
    @endcomponent
    <div class="row">
        <div class="col-sm-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Petty Cash Details</strong></h2>
                </div>
                <div class="widget-content padding">
                    <br>
                    <form action="{{ route('pettyCash.store') }}" method="post">
                        {{ csrf_field() }}
                        {{--<div class="form-group">--}}
                            {{--<label for="user_id">User</label>--}}
                            {{--<select class="form-control" name="user_id" id="user_id" required>--}}
                            {{--@foreach($user as $cashUser)--}}
                                    {{--<option value="{{ $cashUser->id }}" {{ old('user_id') == $cashUser->id ? ' selected' : '' }}>{{ $cashUser->full_name }}</option>--}}
                                {{--@endforeach--}}
                            {{--</select>--}}
                        {{--</div>--}}
                        <div class="form-group">
                            <label for="petty_cash_type_id">Petty Cash Type</label>
                            <select class="form-control" name="petty_cash_type_id" id="petty_cash_type_id" required>
                            @foreach($pettyCashTypes as $type)
                                    <option value="{{ $type->id }}" {{ old('petty_cash_type_id') == $type->id ? ' selected' : '' }}>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="amount">Amount</label>
                            <input class="form-control" type="number" name="amount" id="amount" required value="{{ old('amount') }}">
                        </div>
                        <div class="form-group">
                            <label for="reference">Reference</label>
                            <input class="form-control" type="text" name="reference" id="reference" required value="{{ old('reference') }}">
                        </div>
                        <div class="form-group">
                            <label for="remarks">Remark</label>
                            <textarea class="form-control" name="remarks" id="remarks" cols="10" rows="10"></textarea>
                            {{--<input class="form-control" type="number" name="remarks" id="remarks" required value="{{ old('remarks') }}">--}}
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Save">
                            <a href="{{ route('pettyCashType.index') }}" class="btn btn-danger">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection