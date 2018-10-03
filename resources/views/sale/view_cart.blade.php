@extends('layouts.app')
@section('content')
         <form action="{{url('check-out')}}">
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel panel-heading"><h4>Order Summary</h4></div>
                <div class="panel panel-body">
                    <div class="row view-cart-banner">

        <table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
                <th style="width:50%">Product</th>
                <th style="width:10%">Price</th>
                <th style="width:8%">Quantity</th>
                <th style="width:22%" class="text-center">Sub Total</th>
                <th style="width:10%"></th>
                <th style="width:10%"></th>
            </tr>
            </thead>
            <tbody>
            @foreach ($cart as $cart_item)
                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-2 hidden-xs"><img src="http://placehold.it/100x100" alt="..." class="img-responsive"/></div>
                            <div class="col-sm-10">
                                <h4 class="nomargin">{{ $cart_item['item']['name'] }}</h4>
                            </div>
                        </div>
                    </td>

                    <td data-th="Price">KES {{ number_format($cart_item['item']['price'], 2, ',', ' ')}}</td>
                    <td data-th="Quantity" class="text-center">
                        {{--<input type="number" class="form-control text-center" value="{{ $cart_item['qty'] }}">--}}
                        {{--{{ $cart_item['qty'] }}--}}
                        <div class="cart-info quantity">
                            <div class="btn-increment-decrement" onClick="decrement_quantity({{$cart_item['item']['id']}})">
                                -</div><input class="input-quantity form-control" id="input-quantity-{{$cart_item['item']['id']}}" value="{{ $cart_item['qty'] }}">
                            <div class="btn-increment-decrement" onClick="increment_quantity({{$cart_item['item']['id']}})">+</div>
                        </div>
                    </td>
                    <td data-th="Subtotal" class="text-center">KES {{ number_format($cart_item['total_price'], 2, ',', ' ') }}</td>
                    <td class="actions" data-th="">
                        {{--<button class="btn btn-info btn-sm"><i class="fa fa-refresh"></i></button>--}}
                        <a href="{{ URL::to('/cartdelete/'.$cart_item['item']['id'] ) }} " class="btn btn-danger btn-sm"><i class="fa fa-trash-o"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr class="visible-xs">
                <td class="text-center"><strong>{{ $sum }}</strong></td>
            </tr>
            <tr>
                <td><a href="{{ URL::to('/cart-details') }}" class="btn btn-warning"><i class="fa fa-angle-left"></i>Back to menu</a></td>
                <td colspan="2" class="hidden-xs"></td>
                <td class="hidden-xs text-center"><strong>{{ number_format($sum, 2, ',', ' ') }}</strong></td>
                <td>
                    <a href="{{ URL::to('cart') }}" class="btn btn-info update-cart-info"> <i class="fa fa-refresh"></i> Update Cart</a>

                </td>
                <td>
                    {{--<button type="submit" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></button>--}}
                    </td>
            </tr>
            </tfoot>
        </table>

    </div>
                </div>
            </div>
        </div>


    <div class="col-md-4 cart-b2">
        <div class="panel panel-default">
            <div class="panel panel-heading"><h4>Payment Window</h4></div>
            <div class="panel panel-body">
                <div class="row">
                      <div class="col-md-12">
                        <div class="form-group text-center">
                            <input type="hidden" value="{{ number_format($sum, 2) }}" id="sum-total" name="total">
                            <label for=""><b class="total">Total: KSH {{ number_format($sum, 2) }}</b></label>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group text-center">
                            <label for=""><b class="change">Change: KSH</b> <b class="change-amount">0.00</b></label>
                            <input type="hidden" id="change-amount" name="change-amount" value="0">
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for=""><b>Cash</b></label>
                            <input type="number" class="form-control" name="amount" id="cash" value="">
                        </div>
                        <div class="form-group">

                            <input type="submit" class="btn btn-success btn-block" name="submit" value="pay" id="pay">
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
         </form>
@stop

