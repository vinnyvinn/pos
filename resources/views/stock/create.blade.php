@extends('layouts.app')
@section('content')
    @component('components.page-header')
        @slot('icon')
            fa fa-anchor
            @endslot
        @slot('header')
            Stock
            @endslot
    @endcomponent
    <div class="row">
        <div class="col-sm-12">
            <div class="widget">
                <div class="widget-header">
                    <h2><strong>Stock Details</strong></h2>
                </div>
                <div class="widget-content padding">
                    <form action="{{ route('stock.store') }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <select name="stall_id" id="stall_id" class="form-control">
                                <label for="stall_id">Stall</label>
                                @foreach($stalls as $stall)
                                    <option value="{{ $stall->id }}"{{ old('stall_id') == $stall->id ? ' selected' : '' }}>
                                        {{ $stall->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="item_id">Item </label>
                            <select name="item_id" id="item_id" class="form-control item">
                                <label for="item_id">Stall</label>
                                @foreach($stock_items as $items)
                                    <option value="{{ $items->id }}"{{ old('item_id') == $items->id ? ' selected' : '' }}>
                                        {{ $items->name }}
                                    </option>
                                @endforeach
                            </select>

                    </div>
                        {{--<input type="hidden" name="quantity_reserved" id="quantity_reserved">--}}
                    <div class="form-group">
                        <label for="quantity_on_hand">Quantity Received</label>
                            <input class="form-control" type="number" step="0.001" name="quantity_on_hand" id="quantity_on_hand" required>
                    </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-success" value="Create">
                            <a href="{{ route('stock.index') }}" class="btn btn-danger">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
  @endsection
@section('footer')
    <script>
        $(function () {
           // $('.item').select2();
        })

    </script>
    @endsection
