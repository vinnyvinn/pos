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
            fa fa-building
        @endslot
        @slot('header')
            Stalls
        @endslot
        Manage the stalls.
    @endcomponent
    <div class="row">
        <div class="col-sm-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="table-responsive">
                        <table id='stall-table' class="table table-striped table-bordered" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Location</th>
                                <th class="actions"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($stalls as $stall)
                                <tr>
                                    <td>{{ $stall->name }}</td>
                                    <td>{{ $stall->location }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('stall.edit', $stall->id) }}" class="btn btn-xs btn-info"><i
                                                    class="fa fa-pencil"></i></a>
                                        <a href="{{ route('stall.destroy', $stall->id) }}"
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
    <script src="{{ asset('assets/libs/jquery-datatables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script>
    <script>
        $('#stall-table').dataTable();
    </script>
@endsection
