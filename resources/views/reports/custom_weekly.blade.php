<?php
/**
 * Created by PhpStorm.
 * User: vinn
 * Date: 11/22/17
 * Time: 10:44 AM
 */@extends('layouts.app')

@section('content')
    @component('components.page-header')
        @slot('icon')
            fa fa-dollar
        @endslot
        @slot('header')
            Sales
        @endslot
        Custom Sales Report
    @endcomponent
    <div class="row">
        <div class="col-sm-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Sales</strong></h2>
                    <div class="additional-btn">
                        <a href="{{URL::to('/customSummaryType',$ids)}}" class="pull-right btn btn-primary btn-xs">
                            <span class="fa fa-file-excel-o" aria-hidden="true"></span>
                            Export
                        </a>
                    </div>
                </div>
                <div class="widget-content padding">
                    <table class="table table-responsive" id="sales_table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Stall</th>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Code</th>
                            <th>Total Price</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($mode as $key => $modes)
                            <tr>
                                <td>{{$modes->id}}</td>
                                <td>{{$modes->name}}</td>
                                <td>{{$modes->stock_name}}</td>
                                <td>{{$modes->quantity}}</td>
                                <td>{{$modes->code}}</td>
                                <td>{{$modes->totalExclPrice}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            @endsection
            @section('footer')
                <script src="{{ asset('assets/libs/jquery-datatables/js/jquery.dataTables.min.js') }}"></script>
                <script src="{{ asset('assets/libs/jquery-datatables/js/dataTables.bootstrap.js') }}"></script>
                <script src="{{ asset('assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
                <script>
                    $('#sales_table').dataTable();
                </script>
@endsection
