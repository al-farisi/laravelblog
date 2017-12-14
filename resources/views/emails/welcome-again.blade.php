@component('mail::message')
# Introduction

Thanks so much for registering!

- one
- two
- three

@component('mail::button', ['url' => 'https://laracast.com'])
Start Browsing
@endcomponent

@component('mail::panel', ['url' => ''])
Lorem ipsum dolor sit amet.
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
