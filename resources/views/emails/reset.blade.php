@component('mail::message')
# Hi

A request has been received to change  the password for your account

@component('mail::button', ['url' => $url])
Reset
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
