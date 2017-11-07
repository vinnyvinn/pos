@extends('layouts.app')

@section('header')
    <link href="{{ asset('assets/libs/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" />
@endsection

@section('content')
    @component('components.page-header')
        @slot('icon')
            fa-shopping-cart
        @endslot
        @slot('header')
            Purchase Order
        @endslot
        View purchase orders in the system.
    @endcomponent
    <div class="row">
        <div class="col-sm-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Purchase Order</strong></h2>
                </div>
                <div class="widget-content padding">
                    {{--<form action="/goodsReceived" method="POST" @submit="validateForm">--}}
                        {{--<input type="hidden" name="_token" :value="csrf">--}}
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="supplier_id">Supplier</label>
                                <div>{{ $order->supplier->name }}</div>
                                {{--<select v-model="order.supplier_id" class="form-control input-sm" name="supplier_id" id="supplier_id" readonly>--}}
                                    {{--<option value="disabled">Select Supplier</option>--}}
                                    {{--<option v-for="supplier in suppliers" :value="supplier.id">{{supplier.name}}</option>--}}
                                {{--</select>--}}
                            </div>
                            <div class="form-group">
                                <label for="stall_id">Stall</label>
                                <div>{{ $order->stall->name }}</div>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <div>{{ $order->description }}</div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="order_date">Order Date</label>
                                <div>{{ $order->order_date }}</div>
                            </div>
                            <div class="form-group">
                                <label for="due_date">Due Date</label>
                                <div>{{ $order->due_date }}</div>
                            </div>
                            <div class="form-group">
                                <label for="order_number">Order Number</label>
                                <div>{{ $order->order_number }}</div>
                            </div>
                            <div class="form-group">
                                <label for="external_order_number">External Order Number</label>
                                <div>{{ $order->external_order_number }}</div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <table class="table table-responsive">
                            <thead>
                            <tr>
                                <th class="text-nowrap">Stock Item</th>
                                <th class="text-nowrap">UOM</th>
                                <th class="text-nowrap text-right" width="120px">Order Qty.</th>
                                <th class="text-nowrap text-right" width="120px">Remaining Qty.</th>
                                <th class="text-nowrap text-right" width="120px">Quantity Received</th>
                                <th class="text-nowrap text-right" width="150px">Unit Excl. Price</th>
                                <th class="text-nowrap text-right" width="150px">Unit Incl. Price</th>
                                <th class="text-nowrap text-right">Total Exclusive</th>
                                <th class="text-nowrap text-right">Total Tax</th>
                                <th class="text-nowrap text-right">Total Inclusive</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($order->lines as $orderLine)
                            <tr>
                                <td>{{ $orderLine->code }} - {{ $orderLine->name }}</td>

                                <td>{{ $orderLine->uom }}</td>
                                <td class="text-right">{{ number_format($orderLine->order_quantity, 2) }}</td>
                                <td class="text-right">{{ number_format($orderLine->order_quantity - $orderLine->processed_quantity, 2) }}</td>
                                <td class="text-right">{{ number_format($orderLine->quantity, 2) }}</td>
                                <td class="text-right">{{ number_format($orderLine->unit_exclusive, 2) }}</td>
                                <td class="text-right">{{ number_format($orderLine->unit_inclusive, 2) }}</td>
                                <td class="text-right">{{ number_format($orderLine->total_exclusive, 2) }}</td>
                                <td class="text-right">{{ number_format($orderLine->total_inclusive - $orderLine->total_inclusive, 2) }}</td>
                                <td class="text-right">{{ number_format($orderLine->total_inclusive, 2) }}</td>
                            </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <br>
                        <div class="pull-right" style="padding-bottom: 10px;">
                            <a href="{{ route('purchaseOrder.edit', $order->id) }}" class="btn btn-primary">Edit</a>
                            <a href="{{ route('purchaseOrder.index') }}" class="btn btn-danger">Back</a>
                        </div>
                    {{--</form>--}}
                </div>
            </div>
        </div>
    </div>

@endsection