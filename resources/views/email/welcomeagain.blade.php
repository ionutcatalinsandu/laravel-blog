@component('mail::message')
# Introduction

The body of your message. 


-one 

-two 

-three 



@component('mail::button', ['url' => ''])
Button Text
@endcomponent 

@component('mail::panel', ['url' => ''])

O propoztie la intamplare 

@endcomponent




Thanks,<br>
{{ config('app.name') }}
@endcomponent
