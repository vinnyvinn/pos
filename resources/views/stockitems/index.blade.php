@extends('layouts.app')

@section('header')
    <link href="{{ asset('assets/libs/jquery-datatables/css/dataTables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    @component('components.page-header')
        @slot('icon')
            fa-shopping-cart
        @endslot
        @slot('header')
            Stock Items
        @endslot
        Manage the items that can be bought and sold within the system.
    @endcomponent
    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Stock Items</strong></h2>

                    <div class="additional-btn">
                        <a href="{{ route('stockItem.create') }}" class="pull-right btn btn-primary btn-xs">
                            <span class="fa fa-plus"></span>
                            New Stock Item
                        </a>
                    </div>
                </div>
                <div class="widget-content padding">
                    <br>
                    <div class="table-responsive">
                        <table id='main-table' class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>Item Code</th>
                                <th>Name</th>
                                <th>Barcode</th>
                                <th>Unit Cost</th>
                                <th class="text-center">Conversions</th>
                                <th class="text-center">Status</th>
                                <th class="actions"></th>
                            </tr>
                            </thead>

                            <tfoot>
                            <tr>
                                <th>Item Code</th>
                                <th>Name</th>
                                <th>Barcode</th>
                                <th>Unit Cost</th>
                                <th class="text-center">Conversions</th>
                                <th class="text-center">Status</th>
                                <th class="actions"></th>
                            </tr>
                            </tfoot>

                            <tbody>
                            @foreach($items as $item)
                                <tr>
                                    <td>{{ $item->code }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->barcode }}</td>
                                    <td class="text-right">{{ number_format($item->unit_cost, 2) }}</td>
                                    @if($item->has_conversions)
                                        <td class="text-center"><span class="btn btn-xs btn-success">YES</span></td>
                                    @else
                                        <td class="text-center"><span class="btn btn-xs btn-danger">NO</span></td>
                                    @endif
                                    @if($item->is_active)
                                        <td class="text-center"><span class="btn btn-xs btn-success">Active</span></td>
                                    @else
                                        <td class="text-center"><span class="btn btn-xs btn-danger">Inactive</span></td>
                                    @endif
                                    <td class="text-center">
                                        <a href="{{ route('stockItem.edit', $item->id) }}" class="btn btn-xs btn-info"><i class="fa fa-pencil"></i></a>
                                        <a href="{{ route('stockItem.destroy', $item->id) }}"
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