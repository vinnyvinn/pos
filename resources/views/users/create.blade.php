@extends('layouts.app')
@section('content')
    @component('components.page-header')
        @slot('icon')
            fa fa-users
            @endslot
        @slot('header')
            Users
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-sm-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>User Details</strong></h2>
                </div>
                <div class="widget-content padding">
                    <form action="{{ route('users.store') }}" method="post">
                        @include('users.form')
                    </form>
                </div>
            </div>
        </div>
    </div>
  @endsection