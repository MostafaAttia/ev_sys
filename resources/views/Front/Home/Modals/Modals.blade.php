@include('Front.Home.Modals.Login')
@include('Front.Home.Modals.Signup')

<!--    Plugin for Date Time Picker and Full Calendar Plugin   -->
{!!  HTML::script(config('attendize.cdn_url_static_assets').'/front/js/moment.min.js') !!}
<!--	Plugin for the Datepicker, full documentation here: https://github.com/Eonasdan/bootstrap-datetimepicker   -->
{!!  HTML::script(config('attendize.cdn_url_static_assets').'/front/js/bootstrap-datetimepicker.js') !!}

<script>
    materialKit.initFormExtendedDatetimepickers();
</script>