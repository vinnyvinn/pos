<link href="{{ asset('css/cart.css') }}" rel="stylesheet">
<div id="invoice-POS">

    <center id="top">
        <div class="logo"><img src="{{asset('images/dlogo.png')}}" alt="" style="width: 150px;height: 100px;margin-bottom: -25px;"></div>
        <div class="info">
            <h2 style="padding-top: 0">Dosyz Ltd</h2>
        </div><!--End Info-->
    </center><!--End InvoiceTop-->

    <div id="mid" style="margin-top: -12px;">
        <div class="info">
                 <p>
                Address : street city, state 0000</br>
                Email   : steve@gmail.com</br>
                Phone   : 555-555-5555</br>
            </p>
        </div>
    </div><!--End Invoice Mid-->
    <div id="bot">
        <div id="table">
            <table>
                <tr class="tabletitle" style="background-color: darkgrey">
                    <td class="item"><h4 style="margin-bottom: 0">Item</h4></td>
                    <td class="Hours"><h4 style="margin-bottom: 0">Qty</h4></td>
                    <td class="Rate"><h4 style="margin-bottom: 0">Sub Total</h4></td>
                </tr>
                @foreach ($cart as $cart_item)
                <tr class="service">
                    <td class="tableitem"><p class="itemtext">{{$cart_item['item']['name']}}</p></td>
                    <td class="tableitem"><p class="itemtext">{{$cart_item['qty']}}</p></td>
                    <td class="tableitem"><p class="itemtext">KSH {{ number_format($cart_item['total_price'], 2) }}</p></td>
                </tr>
                @endforeach
                <tr class="tabletitle">
                    <td></td>
                    <td class="Rate"><b>Total</b></td>
                    <td class="payments"><b style="font-size: 14px">KSH {{ number_format($sum, 2, ',', ' ') }}</b></td>
               </tr>
            </table>
       </div><!--End Table-->
        <div id="legalcopy">
            <p class="legal"><strong>Thank you for your business!</strong>
            </p>
            <p>Powered by Vinnyvinny Solutions Limited</p>
        </div>
    </div><!--End InvoiceBot-->
</div><!--End Invoice-->
<script>
    window.print();

</script>
