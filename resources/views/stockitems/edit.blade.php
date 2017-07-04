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
                    <h2><strong>Stock Item Details</strong></h2>
                </div>
                <div class="widget-content padding">
                    <br>
                    <div class="row">
                        <div class="col-sm-12">
                            <form id="stockItemForm" action="{{ route('stockItem.update', $id) }}" method="post">
                                {{ method_field('PUT') }}
                                @include('stockitems.form')
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    <script src="{{ asset('assets/libs/jquery-wizard/jquery.easyWizard.js') }}"></script>
    <script src="{{ asset('assets/libs/bootstrap-validator/js/bootstrapValidator.min.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#stockItemForm')
                .easyWizard({
                    buttonsClass: 'btn btn-default',
                    submitButtonClass: 'btn btn-primary'
                })
                .bootstrapValidator({
                    message: 'This value is not valid',
                    fields: {
                        name: {
                            message: 'The item name is not valid',
                            validators: {
                                notEmpty: {
                                    message: 'The item name is required and can\'t be empty'
                                }
                            }
                        },
                        code: {
                            message: 'The item code is not valid',
                            validators: {
                                notEmpty: {
                                    message: 'The item code is required and can\'t be empty'
                                }
                            }
                        },
                        unit_cost: {
                            message: 'The item\'s unit cost is not valid',
                            validators: {
                                notEmpty: {
                                    message: 'The item\'s unit cost is required and can\'t be empty'
                                },
                                regexp: {
                                    regexp: /^[0-9\.]+$/,
                                    message: 'Unit cost can only consist of numbers or decimals'
                                }
                            }
                        },
                    }
                });
        });
    </script>
@endsection