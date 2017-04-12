@extends('layouts.app')

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
                    <h2><strong>Unit of Measure Details</strong></h2>
                </div>
                <div class="widget-content padding">
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="{{ route('unitOfMeasure.store') }}" method="post">
                                @include('uom.form')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
