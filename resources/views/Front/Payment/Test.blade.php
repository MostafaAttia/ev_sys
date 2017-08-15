<html>
<head>
    <meta charset="UTF-8">
    <title>test payment</title>

    <link rel="stylesheet" href="https://www.paytabs.com/express/express.css">

    <script src="https://www.paytabs.com/theme/express_checkout/js/jquery-1.11.1.min.js"></script>
    <script src="https://www.paytabs.com/express/express_checkout_v3.js"></script>

</head>
<body>

<!– Button Code for PayTabs Express Checkout –>
<div class="PT_express_checkout"></div>


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
            display_shipping_fields: 1,
            display_customer_info: 1,
            language: "en",
            redirect_on_reject: 1,
//            style:{
//                css: "custom",
//                linktocss: "https://www.yourstore.com/css/style.css",
//            },
            is_iframe:{
                load: "onbodyload",
                show: 1,
            },
        },
        customer_info:{
            first_name: "John",
            last_name: "Smith",
            phone_number: "5486253",
            country_code: "973",
            email_address: "john@test.com" },
        billing_address:{
            full_address: "Manama, Bahrain",
            city: "Manama",
            state: "Manama",
            country: "BHR",
            postal_code: "00973"
        },
        shipping_address:{
            shipping_first_name: "John",
            shipping_last_name: "Smith",
            full_address_shipping: "Manama, Bahrain",
            city_shipping: "Manama",
            state_shipping: "Manama",
            country_shipping: "BHR",
            postal_code_shipping: "00973"
        },
        checkout_button:{
            width: 150,
            height: 30,
            img_url: "http://ec2-52-71-113-238.compute-1.amazonaws.com/assets/images/stripe-connect-blue.png"
        },
        pay_button:{
            width: 150,
            height: 30,
            img_url: "http://ec2-52-71-113-238.compute-1.amazonaws.com/assets/images/stripe-connect-blue.png"
        }
    });
</script>


</body>
</html>


{{--<!– Button Code for PayTabs Express Checkout –>--}}
{{--<div class="PT_express_checkout"></div>--}}


{{--<script type="text/javascript">--}}
{{--Paytabs("#express_checkout").expresscheckout({--}}
{{--settings: {--}}
{{--secret_key: "5TXqUUNH350N4Ql6dm1CGY0EvjrTSvhXpfojab1eg12lSnr5KsIqqI5V2wPU27SrngLxsMMJOO4GbvMWYumpdrlgYaa0h3rFkdcM",--}}
{{--merchant_id: "10018556",--}}
{{--amount: .200,--}}
{{--currency: "BHD",--}}
{{--title: "Test Express Checkout Transaction",--}}
{{--product_names: "Product1, Product 5000, Product 6",--}}
{{--order_id: "xxx999",--}}
{{--url_redirect: "http://localhost:8000/home"--}}
{{--}--}}
{{--});--}}
{{--</script>--}}








{{--<script src=”https://www.paytabs.com/theme/express_checkout/js/jquery-1.11.1.min.js”></script>--}}
{{--<script src=”https://www.paytabs.com/express/express_checkout_v3.js”></script>--}}
{{--<!– Button Code for PayTabs Express Checkout –>--}}
{{--<div class=”PT_express_checkout”></div>--}}
{{--<script type=”text/javascript”>--}}
{{--Paytabs(“#express_checkout”).expresscheckout({--}}
{{--settings:{--}}
{{--secret_key: “YOUR_SECRET_KEY”,--}}
{{--merchant_id: “YOUR_PAYTABS_MERCHANT_ID eg 10001234”,--}}
{{--amount: “10.00”,--}}
{{--currency: “USD”,--}}
{{--title: “Test Express Checkout Transaction”,--}}
{{--product_names: “Product1,Product2,Product3”,--}}
{{--order_id: 25,--}}
{{--url_redirect: “https://www.YOURWEBSITE.com/return_url/”--}}
{{--}--}}
{{--});--}}
{{--</script>--}}