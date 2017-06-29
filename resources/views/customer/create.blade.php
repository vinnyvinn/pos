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
                <form action="{{ route('customer.store') }}" method="post">
                {{ csrf_field() }}
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone Number</label>
                        <input type="number" class="form-control" name="phone_number" id="phone_number" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="account_number">Account Number</label>
                            <input type="text" class="form-control" name="account_number" id="account_number" readonly>
                        </div>
                        <div class="form-group">
                            <label for="account_balance">Account Balance</label>
                            <input type="text" class="form-control" name="account_balance" id="account_balance"
                                   readonly>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="address" required>
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