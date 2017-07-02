@extends('layouts.app')
@section('header')
    @endsection
@section('content')
    @component('components.page-header')
        @slot('icon')
            fa fa-users
        @endslot
        @slot('header')
            Supplier
        @endslot
        Manage suppliers
    @endcomponent
    <div class="row">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Purchase Order</strong></h2>
            </div>
            <div class="widget-content padding">
                <table class="table table-responsive table-striped">
                    <thead>
                    <tr>
                        <th>Supplier</th>
                        <th>Stall</th>
                        <th>Order Date</th>
                        <th>Due Date</th>
                        <th>Order Number</th>
                        <th>External Order Number</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach()
                    <tr>
                        <td></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-sm-12">

        </div>
    </div>
    @endsection