@extends('Emails.Layouts.Master')

@section('message_content')
    <div>
        Hello,<br><br>
        To reset your password, complete this form: {{ route('showResetPassword', ['token' => $token]) }}.
        <br><br><br>
        Thank you,<br>
        <strong>Vitee</strong> Team

    </div>
@stop