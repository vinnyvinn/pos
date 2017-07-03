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
                                <input class="form-control" type="text" name="phone_number" id="phone_number">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" type="email" name="email" id="email">
                            </div>
                            <div class="form-group">
                                <label for="address">Address</label>
                                <input class="form-control" type="text" name="address" id="address">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="is_credit">Supplier Type</label>
                                <select class="form-control" name="is_credit" id="is_credit">
                                    <option value="0">Cash Supplier</option>
                                    <option value="1">Credit Supplier</option>
                                </select>
                            </div>
                            <div class="form-group" style="display: none;">
                                <label for="credit_limit">Credit Limit</label>
                                <input class="form-control" type="text" name="credit_limit" id="credit_limit" value="0">
                            </div>
                            <div class="form-group">
                                <div class="checkbox">
                                    <label for="is_active">Is Active?
                                         <input class="form-control" type="checkbox" name="is_active" id="is_active" checked>
                                    </label>
                                </div>
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
@section('footer')
    <script>
        var credit = $('#credit_limit');
        credit.on('focus', function () {
            this.select();
        });
        $('#is_credit').on('change', function (e) {
            if (e.target.value == 0) {
                credit.val(0);
                credit.parent().attr('style', 'display:none');
            } else {
                credit.parent().removeAttr('style');
            }
        });
    </script>
    @endsection