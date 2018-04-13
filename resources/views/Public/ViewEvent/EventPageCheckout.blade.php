@extends('Public.ViewEvent.Layouts.EventPage')

@if($order_requires_payment)
@section('head')
    <link rel="stylesheet" href="https://www.paytabs.com/express/express.css">
    <script src="https://www.paytabs.com/express/express_checkout_v3.js"></script>

@stop
@endif

@section('content')
    @include('Public.ViewEvent.Partials.EventHeaderSection')

    @include('Public.ViewEvent.Partials.EventCreateOrderSection')
    <script>var OrderExpires = {{strtotime($expires)}};</script>
    @include('Public.ViewEvent.Partials.EventFooterSection')
@stop

