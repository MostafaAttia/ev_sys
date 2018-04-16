@extends('Public.ViewEvent.Layouts.EventPage')

@section('head')
    <link rel="stylesheet" href="https://www.paytabs.com/express/express.css">
    <script src="https://www.paytabs.com/express/express_checkout_v3.js"></script>

@stop

@section('content')
    @include('Public.ViewEvent.Partials.EventHeaderSection')

    @include('Public.ViewEvent.Partials.EventPaymentCheckout')
    <script>var OrderExpires = {{strtotime($expires)}};</script>
    @include('Public.ViewEvent.Partials.EventFooterSection')
@stop

