@extends('layouts.app')
@section('content')
    @component('components.page-header')
        @slot('icon')
            fa fa-users
        @endslot
        @slot('header')
            Suppliers
        @endslot
        Manage Suppliers
    @endcomponent
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Supplier Details</strong></h2>
                </div>
                <div class="widget-content padding">
                    <div class="col-sm-12">
                    <form action="{{ route('supplier.store') }}" method="post">
                        {{ csrf_field() }}
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control" type="text" name="name" id="name" required>
                            </div>
                            <div class="form-group">
                                <label for="phone_number">Phone Number</label>
                                <input class="form-control" type="text" name="phone_number" id="phone_number" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" type="email" name="email" id="email" required>
                            </div>
                            <div class="form-group">
                                <label for="account_number">Account Number</label>
                                <input class="form-control" type="text" name="account_number" id="account_number">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input class="form-control" type="text" name="address" id="address">
                            </div>
                            <div class="form-group">
                                <label for="account_balance">Account Balance</label>
                                <input class="form-control" type="text" name="account_balance" id="account_balance">
                            </div>
                            <div class="form-group">
                                <label for="is_active">Is Active?
                                    <input class="form-control" type="checkbox" name="is_active" id="is_active">
                                </label>
                            </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Save">
                            <a href="{{ route('supplier.index') }}" class="btn btn-danger">Back</a>
                        </div>
                        </div>
                </form>
                    </div>
                </div>
        </div>
    @endsection