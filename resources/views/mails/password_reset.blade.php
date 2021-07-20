@component('mail::message')

Hello **{{ $name }}**,

You requested for a password reset on your account

Token: {{ $token }}

@component('mail::button', ['url' => $link])
    Click Link
@endcomponent

Yours Sincerely,
BigBrother

@endcomponent