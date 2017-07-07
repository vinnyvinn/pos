@extends('layouts.app')

@section('header')
    {{--<link href="{{ asset('assets/libs/bootstrap-datepicker/css/datepicker.css') }}" rel="stylesheet" />--}}
@endsection

@section('content')
    @component('components.page-header')
        @slot('icon')
            fa-shopping-cart
        @endslot
        @slot('header')
            Edit Purchase Order
        @endslot
        Edit the purchase orders in the system.
    @endcomponent
    <div class="row">
        <div class="col-sm-12">
            <Editpurchaseorder :id="{{ $id }}"></Editpurchaseorder>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script>
        $(document).ready(() => {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true,
            });
        });
    </script>
@endsection