@extends('layouts.app')

@section('header')
    <link href="{{ asset('assets/libs/jquery-datatables/css/dataTables.bootstrap.css') }}" rel="stylesheet"
          type="text/css"/>
@endsection
@section('content')
    @component('components.page-header')
        @slot('icon')
            fa fa-dollar
        @endslot
        @slot('header')
            Sales
        @endslot
        Daily Sales Report
    @endcomponent
    <div class="row">
        <div class="col-sm-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Sales</strong></h2>
                    <div class="additional-btn">
                        <a href="{{ url('dailySummary') }}" class="pull-right btn btn-primary btn-xs">
                            <span class="fa fa-file-excel-o" aria-hidden="true"></span>
                            Export
                        </a>
                    </div>
                </div>
                <div class="row">
                    {{--<div class="col-md-6">--}}
                        {{--<form action="{{route('daily.store')}}" method="post">--}}
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
{{--padding: 1px; width: 100px">search--}}
                            {{--</button>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                    {{--<div class="col-md-6">--}}
                        {{--<form action="{{url('storeDailyProduct')}}" method="post">--}}
                            {{--{{csrf_field()}}--}}
                            {{--<b>search by product name</b>--}}
                            {{--<select class="form-control single" name="stock_item_id" style="width: 35% !important;">--}}

                                {{--@if ($product->count())--}}
                                    {{--@foreach($product as $products)--}}
                                        {{--<option value="{{ $products->id }}" {{ $selectedProduct == $products->id ? 'selected="selected"' : '' }}>{{ $products->name }}</option>--}}

                                    {{--@endforeach--}}
                                {{--@endif--}}

                            {{--</select>--}}
                            {{--<button type="submit" value="search" class="btn btn-info" style="margin-left: 30px;margin-top: 3px;--}}
{{--padding: 1px; width: 100px">Search--}}
                            {{--</button>--}}
                        {{--</form>--}}
                    {{--</div>--}}
                </div>
                <div class="widget-content padding">
                    <table class="table table-responsive" id="dailyReport_table">
                        <thead>
                        <tr>
                            <th>Item</th>
                            <th>Unit price</th>
                            <th>Quantity</th>
                            <th>SubTotal</th>
                            <th>Date</th>
                             </tr>
                        </thead>
                        <tbody>
                        @foreach ($menus as $menu)
                            <tr>
                                <td>{{$menu['item_name']}}</td>
                                <td>{{$menu['unit_price']}}</td>
                                <td>{{$menu['quantity']}}</td>
                                <td>{{ $menu['sub_total'] }}</td>
                                <td>{{ Carbon\Carbon::parse($menu['created_at'])->format('d F Y') }}</td>
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

    <script>
        $('#dailyReport_table').dataTable();

        $(document).ready(function () {
            $('.single').select2();
        });

    </script>
@endsection
