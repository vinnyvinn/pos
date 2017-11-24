@extends('layouts.app')
@section('content')

    @component('components.page-header')
        @slot('icon')
            fa fa-dollar
        @endslot
        @slot('header')
            Sales
        @endslot
        Weekly Sales Report
    @endcomponent

    <div class="row">
        <div class="col-sm-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Sales</strong></h2>
                    <div class="additional-btn">
                        <a href="{{ url('weeklySummary') }}" class="pull-right btn btn-primary btn-xs">
                            <span class="fa fa-file-excel-o" aria-hidden="true"></span>
                            Export
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <form action="{{route('weekly.store')}}" method="post">
                            {{csrf_field()}}
                            <b>Search by transaction type</b>
                            <select class="form-control test" name="transaction_type_id" style="width: 35% !important;">

                                @if ($pay->count())
                                    @foreach($pay as $pays)
                                        <option value="{{ $pays->id }}" {{ $selectedRole == $pays->id ? 'selected="selected"' : '' }}>{{ $pays->mop }}</option>

                                    @endforeach
                                @endif

                            </select>
                            <button type="submit" value="search" class="btn btn-info" style="margin-left: 30px;margin-top: 3px;
padding: 1px; width: 100px">Query</button>
                        </form>
                    </div>
                    <div class="col-md-6">
                        <form action="{{url('storeWeeklyProduct')}}" method="post">
                            {{csrf_field()}}
                            <b>Search by product name</b>
                            <div class="form-group">
                                {!! Form::text('name', null, array('placeholder' => 'Search Text','class' => 'form-control','id'=>'search_text')) !!}
                            </div>
                            {{--<select class="form-control" name="stock_item_id" style="width: 35% !important;">--}}

                            {{--@if ($product->count())--}}
                                {{--@foreach($product as $products)--}}
                                    {{--<option value="{{ $products->id }}" {{ $selectedProduct == $products->id ? 'selected="selected"' : '' }}>{{ $products->name }}</option>--}}

                                {{--@endforeach--}}
                            {{--@endif--}}

                            {{--</select>--}}

                            <button type="submit" value="search" class="btn btn-info" style="margin-left: 30px;margin-top: 3px;
padding: 1px; width: 100px">Query</button>
                        </form>
                        <div class="form-group">
                            {!! Form::text('term', null, array('placeholder' => 'Search Text','class' => 'form-control','id'=>'search_text')) !!}
                        </div>
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
                        @foreach ($sales as $key => $sale)
                            <tr>
                                <td>{{$sale->id}}</td>
                                <td>{{$sale->name}}</td>
                                <td>{{$sale->stock_name}}</td>
                                <td>{{$sale->quantity}}</td>
                                <td>{{$sale->code}}</td>
                                <td>{{$sale->totalExclPrice}}</td>
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
                <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

                <script>
                    $(document).ready(function() {
                        $('#sales_table').dataTable();
                        $('#wah').select2();
                    });
                </script>
                <script type="text/javascript">
                    var url = "{{ url('LoadWeekly') }}";
                    $('#search_text').typeahead({
                        source:  function (query, process) {
                            return $.get(url, { query: query }, function (data) {
                                return process(data);
                            });
                        }
                    });
                </script>

@endsection
