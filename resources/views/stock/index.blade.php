@extends('layouts.app')

@section('header')
    <link href="{{ asset('assets/libs/jquery-datatables/css/dataTables.bootstrap.css') }}" rel="stylesheet"
          type="text/css"/>
@endsection

@section('content')
    @component('components.page-header')
        @slot('icon')
            fa fa-anchor
        @endslot
        @slot('header')
            Stock
        @endslot
        Manage Stock
    @endcomponent
<div class="row">
    <div class="col-sm-12">
        <div class="widget">
            <div class="widget-header">
                <div class="col-sm-9">
                    <h2><strong>Stock</strong></h2>
                </div>
            </div>
            <div class="widget-content padding">
                <div class="table-responsive">
                    <table class="table table-striped" id="stock-table" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Stall</th>
                            <th>Item </th>
                            <th>Quantity Received</th>
                            {{--<th>Sell By</th>--}}
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stocks as $stock)
                            <tr>
                                <td>{{ $stock->stall->name }}</td>
                                <td>{{ $stock->name }}</td>
                                <td>{{ $stock->quantity_on_hand }}</td>
{{--                                <td>{{ $stock->sell_by }}</td>--}}
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
        $('#stock-table').dataTable();
    </script>
@endsection
