@extends('layouts.app')
@section('content')
    @component('components.page-header')
        @slot('icon')
            fa fa-user
        @endslot
        @slot('header')
            Choose Period
        @endslot

    @endcomponent
    <div class="widget">
        <div class="widget-header">
            <h2><strong>Choose Period</strong></h2>
        </div>
        <div class="widget-content padding">
            <div class="col-sm-12">
                <form action="{{ route('expense-report.store') }}" method="post">
                    {{ csrf_field() }}
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="from">From</label>
                            <input type="text" name="from" class="form-control datepicker"  id="from" required>
                        </div>


                        <div class="form-group">
                            <label for="to">To</label>
                            <input type="text" name="to" class="form-control datepicker"  id="to">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Fetch">

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $('.datepicker').datepicker();
    </script>
@endsection
