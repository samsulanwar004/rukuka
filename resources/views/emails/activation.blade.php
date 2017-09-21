@component('mail::message')

Hi , {{ $user->email }}

Thanks for registration. Please, click your url.

@component('mail::button', ['url' => route('activation', ['code' => $user->verification_token ])])
Activation
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
