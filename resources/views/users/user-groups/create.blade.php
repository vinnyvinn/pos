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
                    <form action="{{ route('user-group.store') }}" method="post">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <h4>Permissions</h4>
                            <div class="row">
                                <div class="col-sm-4">
                                    <h5>Users</h5>
                                    <div class="checkbox">
                                    <label>
                                        <input type="checkbox">
                                        Full Access
                                    </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h5>Roles</h5>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox">
                                            Full Access
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <h5>Transaction</h5>
                                    <div class="checkbox">
                                        <label for="">
                                            <input type="checkbox">
                                            Approve
                                        </label>
                                    </div>
                                    <div class="checkbox">
                                        <label for="">
                                            <input type="checkbox">
                                            View
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">
                                    <h5>Petty Cash</h5>
                                    <label for="">
                                        <input type="checkbox">
                                        Full Access
                                    </label>
                                </div>
                                <div class="col-sm-4">
                                    <h5>Stall Assignment</h5>
                                    <label for="">
                                        <input type="checkbox">
                                        Full Access
                                    </label>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection