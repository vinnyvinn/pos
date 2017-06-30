@extends('layouts.app')
@section('content')
    @component('components.page-header')
        @slot('icon')
            fa-shopping-cart
        @endslot
        @slot('header')
            Purchase Order
        @endslot
        Manage the purchase orders in the system.
    @endcomponent
    <div class="row">
        <div class="col-sm-12">
            <purchase-order></purchase-order>
        </div>
    </div>
    @endsection