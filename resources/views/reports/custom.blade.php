@extends('layouts.app')

@section('header')
    <link href="{{ asset('assets/libs/jquery-datatables/css/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
@endsection

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
    <div class="widget">
        <div class="widget-header">
            <h2><strong>Sales</strong></h2>
            <div class="additional-btn">
                <a href="{{ url('customSummary') }}" class="pull-right btn btn-primary btn-xs">
                    <span class="fa fa-file-excel-o" aria-hidden="true"></span>
                    Export
                </a>
            </div>
        </div>
        {{--<div class="row">--}}
            {{--<div class="col-md-6">--}}
        {{--<form action="{{route('transactionType.store')}}" method="post">--}}
            {{--{{csrf_field()}}--}}
            {{--<b>Search by transaction type</b>--}}
        {{--<select class="form-control" name="transaction_type_id" style="width: 35% !important;">--}}

            {{--@if ($pay->count())--}}
                {{--@foreach($pay as $pays)--}}
                    {{--<option value="{{ $pays->id }}" {{ $selectedRole == $pays->id ? 'selected="selected"' : '' }}>{{ $pays->mop }}</option>--}}

                {{--@endforeach--}}
            {{--@endif--}}

        {{--</select>--}}
            {{--<button type="submit" value="search" class="btn btn-info" style="margin-left: 30px;margin-top: 3px;--}}
{{--padding: 1px; width: 100px">Query</button>--}}
        {{--</form>--}}
            {{--</div>--}}
            {{--<div class="col-md-6">--}}
        {{--<form action="{{url('storeProduct')}}" method="post">--}}
            {{--{{csrf_field()}}--}}
            {{--<b>search by product name</b>--}}
            {{--<select class="form-control" name="stock_item_id" style="width: 35% !important;">--}}

                {{--@if ($product->count())--}}
                    {{--@foreach($product as $products)--}}
                        {{--<option value="{{ $products->id }}" {{ $selectedProduct == $products->id ? 'selected="selected"' : '' }}>{{ $products->name }}</option>--}}

                    {{--@endforeach--}}
                {{--@endif--}}

            {{--</select>--}}
            {{--<button type="submit" value="search" class="btn btn-info" style="margin-left: 30px;margin-top: 3px;--}}
{{--padding: 1px; width: 100px">Query</button>--}}
        {{--</form>--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="widget-content padding">
            <div class="table-responsive">
                <table class="table table-striped" cellspacing="0" id="customReport_table">
                    <thead>
                    <tr>
                        <th>Stall</th>
                        <th>Product</th>
                        <th>Weight</th>
                        <th>Code</th>
                        <th>Total Price</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($sales as $key => $sale)
                        <tr>
                            <td>{{$sale->name}}</td>
                            <td>{{$sale->stock_name}}</td>
                            <td>{{$sale->weight}}</td>
                            <td>{{$sale->code}}</td>
                            <td>{{number_format($sale->totalExclPrice, 2)}}</td>
                            <td>{{ Carbon\Carbon::parse($sale->created_at)->format('d F Y') }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{ asset('assets/libs/jquery-datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-datatables/js/dataTables.bootstrap.js') }}"></script>
    <script>
        $('#customReport_table').dataTable();
    </script>
@endsection