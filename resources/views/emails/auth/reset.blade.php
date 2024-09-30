@component('mail::message')
# Introduction

استعادة كلمة المرور 

{{ $link =  url('password/reset', $token).'?email='.urlencode($user->getEmailForPasswordReset()) }}


@component('mail::button', ['url' => $link ])

{{-- 'http://enjazfawry.com' --}}
استعادة كلمة المرور 
@endcomponent


شكرا لك <br>
{{ config('app.name') }}
@endcomponent
