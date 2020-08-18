@component('mail::message')
# Felicitaciones, tu cuenta Andean Wide ha sido verificada (Nivel 2)

Estimado {{ $user->name }} {{ $user->lastname }},

Ante todo reciba un coordial saludos, queremos felicitarte porque tu cuenta ha sido aprobada (Nivel 2), te invitamos a que sigas a operando con nostros.


@component('mail::button', ['url' => $url])
Ingresar
@endcomponent

Saludos,<br>
{{ config('app.name') }}
@endcomponent
