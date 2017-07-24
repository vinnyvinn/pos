@extends('layouts.app')

@section('content')
    @component('components.page-header')
    @slot('icon')
        fa fa-dollar
    @endslot
    @slot('header')
        Sales
    @endslot
Manage Sales
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
                                <th>DOC No.</th>
                                <th>Customer</th>
                                <th>Stall</th>
                                <th>Total Exclusive</th>
                                <th>Total Inclusive</th>
                                <th>Total Tax</th>
                                <th>Transaction Type</th>
                              </tr>
                            </thead>
                          <tbody>
                            @foreach ($sales as $key => $sale)
                              <tr>
                                <td>{{ $sale->document_number }}</td>
                                <td>{{ $sale->customer->name }}</td>
                                <td>{{ $sale->stall->name }}</td>
                                <td>{{$sale->total_exclusive}}</td>
                                <td>{{$sale->total_inclusive}}</td>
                                <td>{{$sale->total_tax}}</td>
                                <td>{{$sale->paymentType->name}}</td>
                              </tr>
                            @endforeach
                          </tbody>
                        <tfoot>
                          <tr>
                            <th>DOC No.</th>
                            <th>Customer</th>
                            <th>Stall</th>
                            <th>Total Exclusive</th>
                            <th>Total Inclusive</th>
                            <th>Total Tax</th>
                            <th>Transaction Type</th>
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
