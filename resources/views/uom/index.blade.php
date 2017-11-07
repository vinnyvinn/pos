@extends('layouts.app')

@section('header')
    <link href="{{ asset('assets/libs/jquery-datatables/css/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.page-header')
        @slot('icon')
            fa-inbox
        @endslot
        @slot('header')
            Units of Measure
        @endslot
        Manage the units of measure to be used in the system.
    @endcomponent
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Units of Measure</strong></h2>

                    <div class="additional-btn">
                        <a href="{{ route('unitOfMeasure.create') }}" class="pull-right btn btn-primary btn-xs">
                            <span class="fa fa-plus"></span>
                            Add New
                        </a>
                    </div>
                </div>
                <div class="widget-content padding">
                    <br>
                    <div class="table-responsive">
                        <table id='main-table' class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th class="text-center">Unit</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Status</th>
                                <th class="actions"></th>
                            </tr>
                            </thead>

                            <tfoot>
                            <tr>
                                <th class="text-center">Unit</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Status</th>
                                <th></th>
                            </tr>
                            </tfoot>

                            <tbody>
                            @foreach($units as $unit)
                                <tr>
                                    <td>{{ $unit->name }}</td>
                                    <td>{{ $unit->description }}</td>
                                    @if($unit->is_active)
                                        <td class="text-center"><span class="btn btn-xs btn-success">Active</span></td>
                                    @else
                                        <td class="text-center"><span class="btn btn-xs btn-danger">Inactive</span></td>
                                    @endif
                                    <td>
                                        @if(! $unit->system_install)
                                            <a href="{{ route('unitOfMeasure.edit', $unit->id) }}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                            <a href="{{ route('unitOfMeasure.destroy', $unit->id) }}"
                                               class="btn btn-danger btn-xs" data-method="DELETE"
                                               rel="nofollow"
                                               data-confirm="Are you sure you want to delete this?"
                                               data-token="{{ csrf_token() }}"><i class="fa fa-trash"></i></a>
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
    </div>

@endsection

@section('footer')
    <script src="{{ asset('assets/libs/jquery-datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/jquery-datatables/js/dataTables.bootstrap.js') }}"></script>
    <script>
        (function () {
            $('#main-table').DataTable({
//                dom: 'T<"clear">lfrtip',
//                tableTools: {
//                    "sSwfPath": "./assets/libs/jquery-datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf"
//                }
            });
        })();
    </script>
@endsection