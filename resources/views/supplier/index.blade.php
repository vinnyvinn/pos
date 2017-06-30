@extends('layouts.app')
@section('header')
    {{--<link href="{{ asset('assets/libs/jquery-datatables/css/dataTables.bootstrap.css') }}" rel="stylesheet"--}}
          {{--type="text/css"/>--}}
    {{--<link href="{{ asset('assets/libs/jquery-datatables/extensions/TableTools/css/dataTables.tableTools.css') }}"--}}
          {{--rel="stylesheet" type="text/css"/>--}}
@endsection
@section('content')
    @component('components.page-header')
        @slot('icon')
            fa fa-users
        @endslot
        @slot('header')
            Supplier
        @endslot
        Manage suppliers
    @endcomponent
    <div class="row">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Suppliers</strong></h2>
            </div>
            <div class="widget-content padding">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="supplierTable" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Account Number</th>
                            <th>Account Balance</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($suppliers as $supplier)
                        <tr>
                            <td><a href="{{ route('supplier.show', $supplier->id) }}">{{ $supplier->name }}</a></td>
                            <td>{{ $supplier->phone_number }}</td>
                            <td>{{ $supplier->email }}</td>
                            <td>{{ $supplier->account_number }}</td>
                            <td>{{ $supplier->account_balance }}</td>
                            <td>
                                <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                            </td>
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
        $('#supplierTable').dataTable();
    </script>
@endsection