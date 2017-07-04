@extends('Emails.Layouts.Master')

@section('message_content')

    <p>Hi {{$first_name}}</p>
    <div style="background-color: #EF5350; width: 90%; height: 80px; margin: 10 20; text-align: center;padding-top: 20px;">
        <h3 style="color:#fff;">Your password changed, Was that you?</h3>
    </div>

    <p>
        If this wasn't you, please go to the following link to reset your password:<br>
    </p>

    {{-- <div style="padding: 5px; border: 1px solid #ccc;">
        {{ route('ClientConfirmEmail', ['confirmation_code' => $confirmation_code]) }}
    </div> --}}
    <br>
    <p>
        If you have any questions, feedback or suggestions feel free to reply to this email.
    </p>
    <p>
        Best,
    </p>
    <p>
        <strong>Vitee Team</strong>
    </p>


@stop

@section('footer')


@stop
