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
                <div class="table-responsive">
                    <table class="table table-striped nowrap" id="purchaseOrder_table" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Supplier</th>
                        <th>Stall</th>
                        <th>Order Date</th>
                        <th>Due Date</th>
                        <th class="text-right">Total Exclusive</th>
                        <th class="text-right">Total Inclusive</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->supplier->name }}</td>
                            <td>{{ $order->stall->name }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ $order->due_date }}</td>
                            <td class="text-right">{{ number_format($order->total_exclusive, 2) }}</td>
                            <td class="text-right">{{ number_format($order->total_inclusive, 2) }}</td>
                            <td>
                                <a href="{{ route('purchaseOrder.edit', $order->id) }}" class="btn btn-success btn-xs">Receive</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
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