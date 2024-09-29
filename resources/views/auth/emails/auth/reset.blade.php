@component('mail::message')
# Introduction

استعادة كلمة المرور 

@component('mail::button', ['url' => 'http://enjazfawry.com'])
استعادة كلمة المرور 
@endcomponent

شكرا لك <br>
{{ config('app.name') }}
@endcomponent
