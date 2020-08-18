@component('mail::message')
# Has generado un nuevo ticket No. {{ str_pad($ticket->id, 6, 0, STR_PAD_LEFT) }} para soporte.

Estimado {{ $user->name }} {{ $user->lastname }},

Ante todo reciba un coordial saludos, te informamos que hemos recibido un ticket para soporte. Nuestro equipo estará revisando tu solicitud y pronto te estaremos contactando.

@component('mail::button', ['url' => $url])
Ver Ticket
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
