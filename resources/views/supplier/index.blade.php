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
                            <th>Account Number</th>
                            <th>Name</th>
                            <th>Phone Number</th>
                            <th>Email</th>
                            <th>Type</th>
                            <th class="text-right">Balance</th>
                            <th class="text-right">Credit Limit</th>
                            <th class="text-center">Actions</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($suppliers as $supplier)
                        <tr>
                            <td><a href="{{ route('supplier.show', $supplier->id) }}">{{ $supplier->account_number }}</a></td>
                            <td>{{ $supplier->name }}</td>
                            <td>{{ $supplier->phone_number }}</td>
                            <td>{{ $supplier->email }}</td>
                            <td>{{ $supplier->is_credit ? 'Credit' : 'Cash' }} Customer</td>
                            <td class="text-right">{{ number_format($supplier->account_balance, 2) }}</td>
                            <td class="text-right">{{ number_format($supplier->credit_limit, 2) }}</td>
                            <td class="text-center">
                                <a href="{{ route('supplier.edit', $supplier->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                                @if(! $supplier->is_system)
                                    <a href="{{ route('supplier.destroy', $supplier->id) }}"
                                       class="btn btn-danger btn-xs" data-method="DELETE"
                                       rel="nofollow"
                                       data-confirm="Are you sure you want to delete this?"
                                       data-token="{{ csrf_token() }}"
                                    >
                                        <i class="fa fa-trash"></i>
                                    </a>
                                @endif
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