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
                <h2><strong>Stock</strong></h2>
            </div>
            <div class="widget-content padding">
                <table class="table table-responsive table-striped" id="stock-table" cellspacing="0">
                   <thead>
                   <tr>
                       <th>Stall</th>
                       <th>Item Id</th>
                       <th>Quantity Received</th>
                   </tr>
                   </thead>
                    <tbody>
                    @foreach($stocks as $stock)
                    <tr>
                        <td>{{ $stock->stall->name }}</td>
                        <td>{{ $stock->item_id }}</td>
                        <td>{{ $stock->quantity_reserved }}</td>
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
        $('#stock-table').dataTable();
    </script>
@endsection