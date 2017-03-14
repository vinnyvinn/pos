@extends('layouts.app')

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
                    <h2><strong>Tax Type Details</strong></h2>
                </div>
                <div class="widget-content padding">
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="{{ route('tax.update', $tax->id) }}" method="post">
                                {{ method_field('PUT') }}
                                @include('tax.form')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
