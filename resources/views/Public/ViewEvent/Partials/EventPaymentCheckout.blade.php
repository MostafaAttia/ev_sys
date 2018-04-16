<section id='order_form' class="container">
    <div class="row">
        <h1 class="section_head">
            Order Details
        </h1>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-push-8">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <i class="ico-cart mr5"></i>
                        Order Summary
                    </h3>
                </div>

                <div class="panel-body pt0">
                    <table class="table mb0 table-condensed">
                        @foreach($tickets as $ticket)
                            <tr>
                                <td class="pl0">{{{$ticket['ticket']['title']}}} X <b>{{$ticket['qty']}}</b></td>
                                <td style="text-align: right;">
                                    @if((int)ceil($ticket['full_price']) === 0)
                                        FREE
                                    @else
                                        {{ money($ticket['full_price'], $event->currency) }}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                @if($order_total > 0)
                    <div class="panel-footer">
                        <h5>
                            Total: <span style="float: right;"><b>{{ money($order_total + $total_booking_fee,$event->currency) }}</b></span>
                        </h5>
                    </div>
                @endif

            </div>
            <div class="help-block">
                Please note you only have <span id='countdown'></span> to complete this transaction before your tickets are re-released.
            </div>
        </div>

        <div class="col-md-8 col-md-pull-4">
            <div class="event_order_form">

                <h3>Your Information</h3>

                @if($event->enable_offline_payments)
                    <style>
                        .offline_payment_toggle {
                            padding: 20px 0;
                        }
                    </style>
                    <div class="offline_payment_toggle">
                        <div class="custom-checkbox">
                            <input data-toggle="toggle" id="pay_offline" name="pay_offline" type="checkbox" value="1">
                            <label for="pay_offline">Pay using offline method</label>
                        </div>
                    </div>
                    <div class="offline_payment" style="display: none;">
                        <h5>Offline Payment Instructions</h5>
                        <div class="well">
                            {!! Markdown::parse($event->offline_payment_instructions) !!}
                        </div>
                    </div>

                @endif

                @include('Public.ViewEvent.Partials.PaytabsPayment')


            </div>
        </div>
    </div>
</section>
@if(session()->get('message'))
    <script>showMessage('{{session()->get('message')}}');</script>
@endif

