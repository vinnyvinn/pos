@extends('layouts.app')

@section('header')
    <link href="{{ asset('assets/libs/jquery-datatables/css/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
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
           <div class="additional-btn">
               <a href="{{ route('customer.create') }}" class="pull-right btn btn-primary btn-xs">
                   <span class="fa fa-plus"></span>
                   Add New
               </a>
           </div>
       </div>
       <div class="widget-content padding">
           <div class="table-responsive">
               <table class="table table-striped" cellspacing="0" id="customerTable">
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
                   @foreach($customers as $customer)
                       <tr>
                           <td><a href="{{ route('customer.show', $customer->id) }}">{{ $customer->account_number }}</a></td>
                           <td>{{ $customer->name }}</td>
                           <td>{{ $customer->phone_number }}</td>
                           <td>{{ $customer->email }}</td>
                           <td>{{ $customer->is_credit ? 'Credit' : 'Cash' }} Customer</td>
                           <td class="text-right">{{ number_format($customer->account_balance, 2) }}</td>
                           <td class="text-right">{{ number_format($customer->credit_limit, 2) }}</td>
                           <td class="text-center">
                               <a href="{{ route('customer.edit', $customer->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
                               @if(! $customer->is_system)
                                   <a href="{{ route('customer.destroy', $customer->id) }}"
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
    @endsection
@section('footer')
    <script src="{{ asset('assets/libs/jquery-datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-datatables/js/dataTables.bootstrap.js') }}"></script>
    <script>
        $('#customerTable').dataTable();
    </script>
    @endsection