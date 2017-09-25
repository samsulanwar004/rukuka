@component('mail::message')

Hi , {{ $user->email }}

Registration in {{ config('app.name') }} successfully. <br>
Please, login with your account :

<table border="0">
    <tr><td>Email</td><td>:</td><td>{{ $user->email }}</td></tr>
    <tr><td>Password</td><td>:</td><td>{{ $user->passwordString }}</td></tr>
</table>
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent