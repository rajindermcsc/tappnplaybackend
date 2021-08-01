@component('mail::message')
# Introduction

The body of your message.

@component('mail::button', ['url' => 'https://thetappadmin.com/api/auth?token='.$token])
Reset Password
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
