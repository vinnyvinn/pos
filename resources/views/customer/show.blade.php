@extends('layouts.app')
@section('content')
    @component('components.page-header')
        @slot('icon')
            fa fa-user
        @endslot
        @slot('header')
            Customer
        @endslot
        Manage Customers
    @endcomponent
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-sm-12">
                <form action="" method="post">
                    {{ csrf_field() }}
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <div>{{ $customer->name }}</div>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <div>{{ $customer->phone_number }}</div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <div>{{ $customer->email }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="account_number">Account Number</label>
                            <div>{{ $customer->account_number }}</div>
                        </div>
                        <div class="form-group">
                            <label for="account_balance">Account Balance</label>
                            <div>{{ number_format($customer->account_balance, 2) }}</div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <div>{{ $customer->address }}</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-success" value="Save">
                        <a href="{{ route('customer.index') }}" class="btn btn-danger">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection