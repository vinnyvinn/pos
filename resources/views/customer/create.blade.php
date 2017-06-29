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
                            <input type="number" class="form-control" name="phone_number" id="phone_number">
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email">
                        </div>

                        <div class="form-group">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" name="address" id="address">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="is_credit" class="control-label">Customer Type</label>

                            <select name="is_credit" id="is_credit" class="form-control">
                                <option value="0">Cash Customer</option>
                                <option value="1">Credit Customer</option>
                            </select>
                        </div>

                        <div class="form-group" style="display: none;">
                            <label for="credit_limit">Credit Limit</label>
                            <input type="number" class="form-control" name="credit_limit" id="credit_limit" value="0">
                        </div>

                        <div class="form-group">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="is_active"> Is Active?
                                </label>
                            </div>
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Save">
                            <a href="{{ route('customer.index') }}" class="btn btn-danger">Back</a>
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