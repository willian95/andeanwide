@component('mail::message')
# La verificación (Nivel 1) fue rechazada

Estimado {{ $user->name }} {{ $user->lastname }},

Ante todo reciba un coordial saludos, queremos informarte que tu solicitud de verificación de identificación no cumple con nuestros estandares, y fue rechazada por las siguientes razones.

{{ $reasons }}

Te invitamos a iniciar de nuevo el proceso.

@component('mail::button', ['url' => $url])
Ir a Verificación
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
