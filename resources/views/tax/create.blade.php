@extends('layouts.app')

@section('content')
    @component('components.page-header')
    @slot('icon')
    fa-usd
    @endslot
    @slot('header')
    Tax Types
    @endslot
    Manage the tax types and rates that will be used on all transactions.
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
                            <form action="{{ route('tax.store') }}" method="post">
                                @include('tax.form')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
