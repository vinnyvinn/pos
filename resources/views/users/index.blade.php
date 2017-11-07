@extends('layouts.app')

@section('header')
    <link href="{{ asset('assets/libs/jquery-datatables/css/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css"/>
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
                <div class="additional-btn">
                    <a href="{{ route('users.create') }}" class="pull-right btn btn-primary btn-xs">
                        <span class="fa fa-plus"></span>
                        Add New
                    </a>
                </div>
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
                                <td>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                    <a href="{{ route('users.destroy', $user->id) }}"
                                       class="btn btn-danger btn-xs" data-method="DELETE"
                                       rel="nofollow"
                                       data-confirm="Are you sure you want to delete this?"
                                       data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i></a>
                                </td>
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
        $('#users-table').dataTable();
    </script>
@endsection