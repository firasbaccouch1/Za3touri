@component('mail::message')
# Reset Email
Hi {{ $data['user']->name }},
Wanna change your email ? <br>
We received a request to reset the email for your account.

To reset your email, Click on the button below: <br>
note: This link is valid for only 30 minutes
 
@component('mail::button', ['url' => 'http://za3touri.com/Change-Email/'.$data['token']])
Reset Email

@endcomponent
If it's not you that trying to change email <br>
We recommend you to change your password ASP <br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent