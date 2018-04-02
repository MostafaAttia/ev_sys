<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="text/javascript"> window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),]); ?></script>

@if(Auth::guard('client')->user())
    <script>
        window.Laravel.clientId = <?php echo Auth::guard('client')->user()->id; ?>
    </script>
@endif

{!! HTML::script(config('attendize.cdn_url_static_assets').'/assets/javascript/notifications/notif.js') !!}
{!! HTML::style(config('attendize.cdn_url_static_assets').'/assets/stylesheet/notifications/notif.css') !!}

