@component('mail::message')

Hi , {{ $user->email }}

Forgot your password. Please, click your url.

@component('mail::button', ['url' => route('page.reset', ['code' => $user->verification_token ])])
Forgot
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
