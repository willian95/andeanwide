@component('mail::message')
# Hemos recibido tu información para la validación (Nivel 1) de tu cuenta Andean Wide.

Estimado {{ $user->name }} {{ $user->lastname }},

Ante todo reciba un coordial saludos, tenemos el agrado de informar que hemos recibido su información para la validación (Nivel 1) de su cuenta. Nuestro equipo estará realizando las verificaciónes necesarias y pronto te estaremos contactando.

@component('mail::button', ['url' => $url])
Ver Estatus
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
