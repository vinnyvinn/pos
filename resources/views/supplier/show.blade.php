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
                <form action="{{ route('supplier.update', $supplier->id) }}" method="post">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <div>{{ $supplier->name }}</div>
                        </div>
                        <div class="form-group">
                            <label for="phone_number">Phone Number</label>
                            <div>{{ $supplier->phone_number }}</div>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <div>{{ $supplier->email }}</div>
                        </div>
                        <div class="form-group">
                            <label for="address">Address</label>
                            <div>{{ $supplier->address }}</div>
                        </div>
                        <div class="form-group">
                            <label for="account_number">Account Number</label>
                            <div>{{ $supplier->account_number }}</div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="account_balance">Account Balance</label>
                            <div>{{ $supplier->account_balance }}</div>
                        </div>
                        <div class="form-group">
                            <label for="is_credit" class="control-label">Customer Type</label>
                            <div>{{ $supplier->is_credit ? 'Credit Customer' : 'Cash Customer' }}</div>
                        </div>
                        <div class="form-group">
                            <label for="credit_limit">Credit Limit</label>
                            <div>{{ $supplier->credit_limit }}</div>
                        </div>

                        <div class="form-group">
                            <label for="is_active">Is Active?
                                <input class="form-control" type="checkbox" name="is_active"{{ $supplier->is_active ? 'checked' : '' }} id="is_active">
                            </label>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-success">Edit</a>
                            <a href="{{ route('supplier.index') }}" class="btn btn-danger">Back</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection