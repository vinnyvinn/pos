@extends('layouts.app')

@section('content')
@component('components.page-header')
    @slot('icon')
        fa fa-cogs
    @endslot
    @slot('header')
        Settings
    @endslot
Manage Settings
    @endcomponent
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Settings</div>

                <div class="panel-body">
                    <label for="">Snyched</label>
                    <input type="checkbox" class="form-control">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection