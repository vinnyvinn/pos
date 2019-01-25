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
            Expenses
        @endslot
        Expenses Report
    @endcomponent
    <div class="row">
        <div class="col-sm-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Sales</strong></h2>
                    <div class="additional-btn">
                        <a href="{{ url('expense-summary/'.$from.'/'.$to) }}" class="pull-right btn btn-primary btn-xs">
                            <span class="fa fa-file-excel-o" aria-hidden="true"></span>
                            Export
                        </a>
                    </div>
                </div>
                <div class="row">

                </div>
                <div class="widget-content padding">
                    <table class="table table-responsive" id="dailyReport_table">
                        <thead>
                        <tr>
                            <th>Created by</th>
                            <th>Expense Type</th>
                            <th>Amount</th>
                            <th>Reference</th>
                            <th>Remarks</th>
                            <th>Date</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($expenses as $expense)
                            <tr>
                                <td>{{$expense->user->full_name}}</td>
                                <td>{{$expense->pettyCashType->name}}</td>
                                <td>{{$expense->amount}}</td>
                                <td>{{ $expense->reference}}</td>
                                <td>{{$expense->remarks}}</td>
                                <td>{{ Carbon\Carbon::parse($expense->created_at)->format('d F Y') }}</td>
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
