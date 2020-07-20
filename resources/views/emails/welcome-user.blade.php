@component('mail::message')
# Bienvenue

Merci {{$data->username}} d'avoire insrit sur notre application avec votre email {{$data->email}}

@component('mail::button', ['url' => ''])
Button Text
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
