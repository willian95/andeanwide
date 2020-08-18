@component('mail::message')
# Felicitaciones, tu cuenta Andean Wide ha sido verificada (Nivel 1)

Estimado {{ $user->name }} {{ $user->lastname }},

Ante todo reciba un coordial saludos, queremos felicitarte porque tu cuenta ha sido aprobada (Nivel 1), te invitamos a que comiences a operar con nostros.


@component('mail::button', ['url' => $url])
Ingresar
@endcomponent

Saludos,<br>
{{ config('app.name') }}
@endcomponent
