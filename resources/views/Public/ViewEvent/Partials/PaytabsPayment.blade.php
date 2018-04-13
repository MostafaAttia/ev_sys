<!– Button Code for PayTabs Express Checkout –>

<div class="row">
    <div class="col-md-offset-4 col-md-6 text-center">
        <div class="PT_express_checkout" onclick="event.preventDefault()"></div>
    </div>
</div>

@if(Auth::guard('client')->user())

@else
    <script type="text/javascript">
        Paytabs("#express_checkout").expresscheckout({
            settings:{
                secret_key: "5TXqUUNH350N4Ql6dm1CGY0EvjrTSvhXpfojab1eg12lSnr5KsIqqI5V2wPU27SrngLxsMMJOO4GbvMWYumpdrlgYaa0h3rFkdcM",
                merchant_id: "10018556",
                amount: ".200",
                currency: "BHD",
                title: "Test Express Checkout Transaction",
                product_names: "Product1,Product2,Product3",
                order_id: 25,
                url_redirect: "http://ec2-52-71-113-238.compute-1.amazonaws.com/home",
                display_billing_fields: 1,
                display_shipping_fields: 0,
                display_customer_info: 1,
                language: "en",
                redirect_on_reject: 1,

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
            pay_button:{
                width: 150,
                height: 30,
                img_url: "http://ec2-52-71-113-238.compute-1.amazonaws.com/assets/images/stripe-connect-blue.png"
            }
        });
    </script>
@endif

