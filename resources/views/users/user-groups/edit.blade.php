@extends('layouts.app')
@section('content')
    @component('components.page-header')
        @slot('icon')
            fa fa-users
        @endslot
        @slot('header')
            User Groups
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-sm-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>User Group Details</strong></h2>
                </div>
                <div class="widget-content padding">
                    <form action="{{ route('user-group.update', $userGroup->id) }}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ $userGroup->name }}">
                        </div>
                        <div class="form-group">
                            <h4>Permissions</h4>
                            <div class="row">
                                <div class="col-sm-4">
                                    <h5>Dashboard</h5>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permissions[]" value="dashboard_view"{{ in_array('dashboard_view', $userperm) ? ' checked' : '' }}>
                                            View
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h5>Configuration</h5>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permissions[]" value="configuration_full_access"{{ in_array('configuration_full_access', $userperm) ? ' checked' : '' }}>
                                            Full Access
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="checkbox">
                                        <h5>Stall Assignment</h5>
                                        <label for="">
                                            <input type="checkbox" name="permissions[]" value="stall_full_access"{{ in_array('stall_full_access', $userperm) ? ' checked' : '' }}>
                                            Full Access
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <h5>Customers</h5>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permissions[]" value="customers_full_access"{{ in_array('customers_full_access', $userperm) ? ' checked' : '' }}>
                                            Full Access
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h5>Suppliers</h5>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permissions[]" value="suppliers_full_access"{{ in_array('suppliers_full_access', $userperm) ? ' checked' : '' }}>
                                            Full Access
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h5>Products</h5>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permissions[]" value="products_full_access"{{ in_array('products_full_access', $userperm) ? ' checked' : '' }}>
                                            Full Access
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <h5>Inventory</h5>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permissions[]" value="inventory_full_access"{{ in_array('inventory_full_access', $userperm) ? ' checked' : '' }}>
                                            Full Access
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h5>Purchase Order</h5>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permissions[]" value="purchaseOrder_full_access"{{ in_array('purchaseOrder_full_access', $userperm) ? ' checked' : '' }}>
                                            Full Access
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h5>Reports</h5>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permissions[]" value="reports_full_access"{{ in_array('reports_full_access', $userperm) ? ' checked' : '' }}>
                                            Full Access
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <h5>Users</h5>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permissions[]" value="users_full_access"{{ in_array('users_full_access', $userperm) ? ' checked' : '' }}>
                                            Full Access
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h5>Roles</h5>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="permissions[]" value="roles_full_access"{{ in_array('roles_full_access', $userperm) ? ' checked' : '' }}>
                                            Full Access
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h5>Sale</h5>
                                    <div class="checkbox">
                                        <label for="">
                                            <input type="checkbox" name="permissions[]" value="sale_full_access"{{ in_array('sale_full_access', $userperm) ? ' checked' : '' }}>
                                            Full Access
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="checkbox">
                                        <h5>Petty Cash</h5>
                                        <div class="checkbox">
                                            <label for="">
                                                <input type="checkbox" name="permissions[]" value="petty_full_access"{{ in_array('petty_full_access', $userperm) ? ' checked' : '' }}>
                                                Full Access
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Save">
                            <a href="{{ route('user-group.index') }}" class="btn btn-danger">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection