@extends('Emails.Layouts.Master')

@section('message_content')

    <p>Hi {{$first_name}}</p>
    <p>
        Thank you for registering for {{ config('attendize.app_name') }}. We're thrilled to have you on board.
    </p>

    <p>
        You can confirm your email using the link below.
    </p>

    <div style="padding: 5px; border: 1px solid #ccc;">
        {{ route('ClientConfirmEmailApi', ['confirmation_code' => $confirmation_code]) }}
    </div>
    <br>
    <p>
        If you have any questions, feedback or suggestions feel free to reply to this email.
    </p>
    <p>
        Thank you,
    </p>
    <p>
        <strong>Vitee Team</strong>
    </p>


@stop

@section('footer')


@stop