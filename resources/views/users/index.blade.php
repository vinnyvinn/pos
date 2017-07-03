@extends('layouts.app')

@section('header')
    <link href="{{ asset('assets/libs/jquery-datatables/css/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('assets/libs/jquery-datatables/extensions/TableTools/css/dataTables.tableTools.css') }}" rel="stylesheet" type="text/css"/>
@endsection

@section('content')
    @component('components.page-header')
        @slot('icon')
            fa fa-group
        @endslot
        @slot('header')
            Users
        @endslot
        Manage System Users
    @endcomponent
<div class="row">
    <div class="col-sm-12">
        <div class="widget">
            <div class="widget-header">
                <h2><strong>Users</strong></h2>
            </div>
            <div class="widget-content padding">
                <div class="table-responsive">
                    <table class="table table-striped" id="users-table" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ $user->full_name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td></td>
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
    <script src="{{ asset('assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
    <script>
        $('#users-table').dataTable();
    </script>
@endsection