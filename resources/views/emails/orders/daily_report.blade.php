@component('mail::message')
    # Low Stock Notification

    @foreach($low_stocks as $stock)

        STALL: {{$stock->stall_name}}

        PRODUCT: {{$stock->name}}

        QUANTITY: {{$stock->quantity_on_hand}}

        CODE: {{$stock->code}}

        DATE: {{$date}}


    @endforeach

    # DAILY SALES REPORT
    @foreach($daily_sales as $sales)


        STALL: {{$sales->name}}

        PRODUCT: {{$sales->stock_name}}

        QUANTITY: {{$sales->quantity}}

    @endforeach

    # Daily Inventory Report

    @foreach($daily_inventory as $inventory)


        STALL: {{$inventory->stall_name}}

        PRODUCT: {{$inventory->name}}

        QUANTITY: {{$inventory->quantity_on_hand}}

        CODE: {{$inventory->code}}

        DATE: {{$date}}

    @endforeach


    Thanks,
    {{ config('app.name') }}
@endcomponent


