@extends('layouts.app')

@section('content')
    @component('components.page-header')
        @slot('icon')
            fa-cogs
        @endslot
        @slot('header')
            Settings
        @endslot
        Manage the system settings.
    @endcomponent

    <div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>System Settings</strong></h2>
                </div>
                <div class="widget-content padding">
                    <br>
                    <h4>Inventory Control Method</h4>
                    <h5>This will determine the way the inventory is managed, either First-In-First-Out,
                        Last-In-First-Out or None</h5>
                </div>
            </div>
        </div>
    </div>

    'inventory_control_method', 'costing_method', 'enable_loyalty', 'enable_gift_cards', 'enable_bundles',
    'enable_happy_hour_sales'

@endsection
