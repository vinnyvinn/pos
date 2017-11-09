<html>
<head>
    <link href="{{ public_path().'/assets/libs/bootstrap/css/bootstrap.min.css' }}" rel="stylesheet"/>
    <link href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"/>
    <link href="{{ public_path().'/assets/libs/font-awesome/css/font-awesome.min.css' }}" rel="stylesheet"/>
</head>
<body>
<div class="row">
    <div class="text-center">
        <img src="{{ asset('images/garden_grow.png') }}" alt="">
        <h4>Gardens Grow.</h4>
        <h5>P.O. Box xxxx.</h5>
        <h5>Nairobi.</h5>
    </div>
    <div class="col-xs-12">
        <table class="table">
            <tbody>Sales
            <tr>
                <th colspan="3" style="padding-left:-10px; text-align: left" class="clearfix">
                    <h4>{{ ucwords($sale->customer->name) }},</h4>
                </th>
                <th colspan="2" class="text-right" style="padding-right:20px; text-align: right">
                    <h4> Date
                        : {{ Carbon\Carbon::now()->format('Y M d')." ". Carbon\Carbon::now()->toTimeString() }}</h4>
                </th>
            </tr>
            <tr>
                <th style="padding-left:-10px; text-align: left">Item</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>VAT</th>
                <th style="padding-right:20px; text-align: right">Amount Icl</th>
            </tr>
            @foreach ($sale->sale as $key => $saleline)
                <tr>
                    <td style="padding-left:-10px; text-align: left">{{ $saleline->stock->code ." ".$saleline->stock->name }}</td>
                    <td>{{ $saleline->quantity }}</td>
                    <td>{{ number_format(round($saleline->unitInclPrice, 2), 2) }}</td>
                    <td>{{ number_format(round($saleline->total_tax, 2), 2) }}</td>
                    <td style="padding-right:20px; text-align: right">{{ number_format(round($saleline->totalInclPrice, 2),2) }}</td>
                </tr>
            @endforeach
            <tr>
                <td style="padding-left:-10px; text-align: left">
                    <h6>Sub-total</h6>
                    <h6>Discount</h6>
                </td>
                <td colspan="3"></td>
                <td style="padding-right:20px; text-align: right">
                    <h6>{{ number_format($sale->total_inclusive, 2) }}</h6>
                    <h6>0.00</h6>
                </td>
                </th>
            </tr>
            <tr>
                <th style="padding-left:-10px; text-align: left">
                    <h4>TOTAL</h4><br>
                    <h5>CASH</h5>
                    <h5>CHANGE</h5>
                </th>
                <th colspan="3">
                </th>
                <th style="padding-right:20px; text-align: right">
                    <h4>{{ number_format($sale->total_inclusive, 2)}}</h4><br/>
                    <h5>{{ number_format(($sale->total_inclusive + $sale->balance), 2) }}</h5>
                    <h5>{{ number_format($sale->balance, 2) }}</h5>
                </th>
            </tr>
            <tr>
                <td colspan="5" style="padding-left:-10px; text-align: left">TOTAL
                    ITEMS: {{ count($sale->sale->toArray()) }}</td>
            </tr>
            </tbody>
        </table>
        <table class="table">
            <thead>
            <tr>
                <th style="padding-left:-10px; text-align: left">Code</th>
                <th>Rate(%)</th>
                <th>Net</th>
                <th>VAT</th>
                <th style="padding-right:20px; text-align: right">Total</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($taxes as $key => $tax)
                <tr>
                    <td style="padding-left:-10px; text-align: left">{{ $tax->code }}</td>
                    <td>{{ number_format($tax->rate, 2) }}</td>
                    <td>{{ $tax->rate > 0 ? number_format(round($sale->total_inclusive - ($sale->total_exclusive * $tax->rate/100), 2), 2): 0 }}</td>
                    <td>{{ $tax->rate > 0 ? number_format(round($sale->total_exclusive * $tax->rate/100, 1), 2): 0 }}</td>
                    <td style="padding-right:20px; text-align: right">{{$tax->rate > 0 ? number_format($sale->total_inclusive, 2) : 0}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="{{ public_path().'/assets/libs/jquery/jquery-1.11.1.min.js' }}"></script>
<script src="{{ public_path().'/assets/libs/bootstrap/js/bootstrap.min.js' }}"></script>
<script src="{{ asset('assets/libs/jquery/jquery-1.11.1.min.js') }}"></script>
<script src="{{ asset('assets/libs/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
