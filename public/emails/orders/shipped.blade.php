@component('mail::message')
# Introduction

Dear customers,

<p style="font-size: 120%">

    Your order of amount {{$amount}} from stalls
    @foreach($data as $d)
           {{ $d->name }}
    @endforeach
</p>

@component('mail::button', ['url' => '','color'=> 'yellow'])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
