@extends('layouts.app')

@section('content')
    @component('components.page-header')
    @slot('icon')
        fa fa-dollar
    @endslot
    @slot('header')
        Sales
    @endslot
      Manage Sales
    @endcomponent
    <div>
      <sale></sale>
    </div>

@endsection
