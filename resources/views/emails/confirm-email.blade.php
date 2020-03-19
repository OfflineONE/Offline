@component('mail::message')
# Introduction

Welcome to your offline Life.

Confirm your e-mail address.

Cheers

Reniar

@component('mail::button', ['url' => '#'])
Confirm Email
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
