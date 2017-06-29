@extends('layouts.app')
@section('header')

    @endsection
@section('content')
   @component('components.page-header')
       @slot('icon')
           fa fa-user
           @endslot
       @slot('header')
           Customer
           @endslot
       Manage Customers
       @endcomponent
   <div class="widget">
       <div class="widget-header">
           <h2><strong>Customers</strong></h2>
       </div>
       <div class="widget-content padding">
            <table class="table table-responsive table-striped" id="customerTable">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Account Number</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($customers as $customer)
                <tr>
                    <td><a href="{{ route('customer.show', $customer->id) }}">{{ $customer->name }}</a></td>
                    <td>{{ $customer->account_number }}</td>
                    <td>{{ $customer->phone_number }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>
                        <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                    </td>
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
        $('#customerTable').dataTable();
    </script>
    @endsection