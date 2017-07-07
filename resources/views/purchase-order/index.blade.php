@extends('layouts.app')
@section('header')
    <link href="{{ asset('assets/libs/jquery-datatables/css/dataTables.bootstrap.css') }}" rel="stylesheet"
          type="text/css"/>
@endsection
@section('content')
    @component('components.page-header')
        @slot('icon')
            fa fa-cart
        @endslot
        @slot('header')
            {{ $title }} Purchase Orders
        @endslot
        Manage purchase orders
    @endcomponent
    <div class="row">
        <div class="col-sm-12">
            <div class="widget">
            <div class="widget-header">
                <h2><strong>{{ $title }} Purchase Orders</strong></h2>
            </div>
            <div class="widget-content padding">
                <div class="table-responsive">
                    <table class="table table-striped nowrap" id="purchaseOrder_table" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Doc. No.</th>
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
                            <td><a href="{{ route('purchaseOrder.show', $order->id) }}">{{ $order->document_number }}</a></td>
                            <td>{{ $order->supplier->name }}</td>
                            <td>{{ $order->stall->name }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ $order->due_date }}</td>
                            <td class="text-right">{{ number_format($order->total_exclusive, 2) }}</td>
                            <td class="text-right">{{ number_format($order->total_inclusive, 2) }}</td>
                            <td>
                                @if($order->document_status == 0)
                                <a href="{{ route('purchaseOrder.edit', $order->id) }}" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
                                @endif
                                @if($order->document_status == 0 || $order->document_status == 1)
                                    <a href="{{ route('goodsReceived.receive', $order->id) }}" class="btn btn-primary btn-xs">Receive</a>
                                @endif
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
    <script>
        $('#purchaseOrder_table').dataTable();
    </script>
@endsection