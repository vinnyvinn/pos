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
            Petty Cash Types
        @endslot
        Manage the Types.
    @endcomponent
    <div class="row">
        <div class="col-sm-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Petty Cash Types</strong></h2>
                    <div class="additional-btn">
                        <a href="{{ route('pettyCashTypes.edit') }}" class="btn btn-primary btn-xs">Create Petty Cash Type</a>
                    </div>
                </div>
                <div class="widget-content padding">
                    <div class="table-responsive">
                        <table id='types-table' class="table table-striped table-bordered" cellspacing="0">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th class="actions"></th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($pettyCashTypes as $types)
                                <tr>
                                    <td>{{ $types->name }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('pettyCashTypes.edit', $types->id) }}"
                                           class="btn btn-xs btn-info"><i
                                                    class="fa fa-pencil"></i></a>
                                        <a href="{{ route('pettyCashTypes.destroy', $types->id) }}"
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
        $('#types-table').dataTable();
    </script>
@endsection
