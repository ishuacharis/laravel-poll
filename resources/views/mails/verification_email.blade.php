@component('mail::message')

Hello **{{ $name }}**,

Please click the link below for verification

@component('mail::button', ['url' => $link])
    Click Link
@endcomponent

Yours Sincerely,
BigBrother

@endcomponent