@component('mail::message')
# Respuesta: Ticket No. {{ str_pad($ticket->id, 6, 0, STR_PAD_LEFT) }}.

Estimado {{ $user->name }} {{ $user->lastname }},

Ante todo reciba un coordial saludos, en respuesta a tu ticket No. {{ str_pad($ticket->id, 6, 0, STR_PAD_LEFT) }}, te informamos que:

{{ $ticket->response }}

@component('mail::button', ['url' => $url])
Ver Ticket
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
