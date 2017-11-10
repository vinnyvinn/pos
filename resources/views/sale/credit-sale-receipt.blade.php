<html>
<head>
  {{-- <link href="{{ public_path().'/assets/libs/bootstrap/css/bootstrap.min.css' }}" rel="stylesheet" /> --}}
  <link href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
  {{-- <link href="{{ public_path().'/assets/libs/font-awesome/css/font-awesome.min.css' }}" rel="stylesheet" /> --}}
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="text-center">
        <img src="{{ asset('images/garden_grow.png') }}" alt="">
        <h4>Gardens Grow.</h4>
        <h5>P.O. Box xxxx.</h5>
        <h5>Nairobi.</h5>
      </div>
      <div class="col-xs-12">
  <table class="table">
    <tbody>
      <tr>
        <th colspan="3" style="padding-left:-10px; text-align: left" class="clearfix">
          <h4>Credit Customer</h4>
      </th>
      <th colspan="3" class="text-right" style="padding-right:20px; text-align: right">
        <h4> Date : {{ Carbon\Carbon::now()->format('Y M d')." ". Carbon\Carbon::now()->toTimeString() }}</h4>
      </th>
      </tr>
      <tr>
          <th style="padding-left:-10px; text-align: left">Item</th><th>QTY</th><th>UOM</th><th>Price</th><th>VAT</th><th style="padding-right:20px; text-align: right">Amount Icl</th>
      </tr>
      <tr>
          <td style="padding-left:-10px; text-align: left"></td>
          <td></td>
          <td></td>
          <td></td>
          <td></td>
          <td style="padding-right:20px; text-align: right"></td>
      </tr>
      <tr>
        <td style="padding-left:-10px; text-align: left">
          <h6>Sub-total</h6>
          <h6>Discount</h6>
        </td>
        <td colspan="4"></td>
        <td style="padding-right:20px; text-align: right">
          <h6></h6>
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
        <th colspan="4">
        </th>
        <th style="padding-right:20px; text-align: right">
          <h4></h4><br/>
          <h5></h5>
          <h5></h5>
        </th>
      </tr>
      <tr><td colspan="6" style="padding-left:-10px; text-align: left">TOTAL ITEMS: </td></tr>
    </tbody>
  </table>
  <table class="table">
    <thead>
      <tr>
      <th style="padding-left:-10px; text-align: left">Code</th><th>Rate(%)</th><th>Net</th><th>VAT</th><th style="padding-right:20px; text-align: right">Total</th>
      </tr>
    </thead>
    <tbody>
        <tr>
          <td style="padding-left:-10px; text-align: left"></td>
          <td></td>
          <td></td>
          <td></td>
          <td style="padding-right:20px; text-align: right"></td>
        </tr>
    </tbody>
  </table>
</div>
</div>
</div>
  <script src="{{ asset('assets/libs/jquery/jquery-1.11.1.min.js') }}"></script>
  <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.min.js') }}"></script>
</body>
</html>
