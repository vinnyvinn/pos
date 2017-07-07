@extends('layouts.app')

@section('content')
    @component('components.page-header')
    @slot('icon')
        fa fa-dollar
    @endslot
    @slot('header')
        Sales
    @endslot

    @endcomponent
    <div class="row">
        <div class="col-sm-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Sales</strong></h2>
                    <div class="additional-btn">
                        <a href="{{ route('sale.create') }}" class="pull-right btn btn-primary btn-xs">
                            <span class="fa fa-plus"></span>
                            Add New
                        </a>
                    </div>
                </div>
                <div class="widget-content padding">
                      <table class="table table-responsive" id="sales_table">
                            <thead>
                              <tr>
                                <th>Name</th>
                                <th>Code</th>
                                <th>UOM</th>
                                <th>Quantity</th>
                                <th>Exclusive Price</th>
                                <th>Inclusive Price</th>
                                <th>Total Exclusive</th>
                                <th>Total Inclusive</th>
                                <th>Total Tax</th>
                              </tr>
                            </thead>
                          <tbody>
                            @foreach ($sales as $key => $sale)
                              <tr>
                                <td>{{$sale->stock_name}}</td>
                                <td>{{$sale->code}}</td>
                                <td>{{$sale->uom}}</td>
                                <td>{{$sale->quantity}}</td>
                                <td>{{$sale->unitExclPrice}}</td>
                                <td>{{$sale->unitInclPrice}}</td>
                                <td>{{$sale->totalInclPrice}}</td>
                                <td>{{$sale->total_tax}}</td>
                                <td>{{$sale->totalExclPrice}}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        <tfoot>
                          <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>UOM</th>
                            <th>Quantity</th>
                            <th>Exclusive Price</th>
                            <th>Inclusive Price</th>
                            <th>Total Exclusive</th>
                            <th>Total Inclusive</th>
                            <th>Total Tax</th>
                          </tr>
                        </tfoot>
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
