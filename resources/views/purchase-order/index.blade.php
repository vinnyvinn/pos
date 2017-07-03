@extends('layouts.app')
@section('header')
    <link href="{{ asset('assets/libs/jquery-datatables/css/dataTables.bootstrap.css') }}" rel="stylesheet"
          type="text/css"/>
    <link href="{{ asset('assets/libs/jquery-datatables/extensions/TableTools/css/dataTables.tableTools.css') }}"
          rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    @component('components.page-header')
        @slot('icon')
            fa fa-cart
        @endslot
        @slot('header')
            Purchase Order
        @endslot
        Manage purchase orders
    @endcomponent
    <div class="row">
        <div class="col-sm-12">
            <div class="widget">
            <div class="widget-header">
                <h2><strong>Purchase Order</strong></h2>
            </div>
            <div class="widget-content padding">
                <table class="table table-responsive table-striped" id="purchaseOrder_table" cellspacing="0">
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
                    @foreach($orders as $order)
                    <tr>
                        <td></td>
                        <td>{{ $order->stall->name }}</td>
                        <td>{{ $order->order_date }}</td>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ $order->external_order_number }}</td>
                    </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
    @endsection
@section('footer')
    <script src="{{ asset('assets/libs/jquery-datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-datatables/js/dataTables.bootstrap.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
    <script>
        $('#purchaseOrder_table').dataTable();
    </script>
@endsection