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
    <div class="widget">
            <div class="widget-header">
                <h2><strong>Customer Details</strong></h2>
            </div>
            <div class="widget-content padding">
                <form action="" method="post">
                    {{ csrf_field() }}
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <h4>{{ $customer->name }}</h4>
                        </div>

                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <h4>{{ $customer->phone_number }}</h4>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <h4>{{ $customer->email }}</h4>
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <h4>{{ $customer->address }}</h4>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="account_number">Account Number</label>
                            <h4>{{ $customer->account_number }}</h4>
                        </div>

                        <div class="form-group">
                            <label for="account_balance">Account Balance</label>
                            <h4>{{ number_format($customer->account_balance, 2) }}</h4>
                        </div>

                        <div class="form-group">
                            <label for="is_credit" class="control-label">Customer Type</label>
                            <h4>{{ $customer->is_credit ? 'Credit Customer' : 'Cash Customer' }}</h4>
                        </div>

                        <div class="form-group">
                            <a href="{{ route('customer.index') }}" class="btn btn-danger">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection