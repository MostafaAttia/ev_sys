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

                <!– Button Code for PayTabs Express Checkout –>

                <div class="row">
                    <div class="col-md-offset-4 col-md-6 text-center">
                        <div class="PT_express_checkout" style="height: 300px;" onclick="event.preventDefault()"></div>
                    </div>
                </div>

                @if(Auth::guard('client')->user())

                @else
                    <script type="text/javascript">
                        Paytabs("#express_checkout").expresscheckout({
                            settings:{
                                secret_key: "5TXqUUNH350N4Ql6dm1CGY0EvjrTSvhXpfojab1eg12lSnr5KsIqqI5V2wPU27SrngLxsMMJOO4GbvMWYumpdrlgYaa0h3rFkdcM",
                                merchant_id: "10018556",
                                amount: {{ json_encode(session()->get('ticket_order_' . $event_id)['order_total']) }},
                                currency: "{{ session()->get('ticket_order_' . $event_id)['currency']  }}",
                                title: "{{ $event->title }}",
                                product_names: "{{ session()->get('ticket_order_' . $event_id)['tickets_names'] }}",
                                order_id: 25,
                                url_redirect: "http://ec2-52-71-113-238.compute-1.amazonaws.com/e/" + {{ $event_id }} + "/payment",
                                display_billing_fields: 1,
                                display_shipping_fields: 0,
                                display_customer_info: 1,
                                language: "en",
                                redirect_on_reject: 1,
                                is_iframe: {
                                    load: "onbodyload",
                                    show: 1
                                }

                            },
                            customer_info:{
                                first_name: "John",
                                last_name: "Smith",
                                phone_number: "5486253",
                                country_code: "973",
                                email_address: "john@test.com"
                            },
                            billing_address:{
                                full_address: "Manama, Bahrain",
                                city: "Manama",
                                state: "Manama",
                                country: "BHR",
                                postal_code: "00973"
                            },
                            checkout_button:{
                                width: 400,
                                height: 130,
                                img_url: " {{ asset('/front/img/checkout.png') }} "
                            },
                            // pay_button:{
                            //     width: 150,
                            //     height: 30,
                            //     img_url: "http://ec2-52-71-113-238.compute-1.amazonaws.com/assets/images/stripe-connect-blue.png"
                            // }
                        });
                    </script>
                @endif




            </div>
        </div>
    </div>
</section>
@if(session()->get('message'))
    <script>showMessage('{{session()->get('message')}}');</script>
@endif

