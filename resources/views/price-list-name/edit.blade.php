@extends('layouts.app')

@section('content')
    @component('components.page-header')
        @slot('icon')
            fa-usd
        @endslot
        @slot('header')
            Price Lists
        @endslot
        Manage price lists that can be used in the system.
    @endcomponent

    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Price Lists</strong></h2>
                </div>
                <div class="widget-content padding">
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <form action="{{ route('price-list-name.update', $list->id) }}" method="post">
                                {{ method_field('PUT') }}
                                @include('price-list-name.form')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
