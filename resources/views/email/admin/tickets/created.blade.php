@component('mail::message')
# Un usuario ha generado ticket No. {{str_pad($ticket->id, 6, 0, STR_PAD_LEFT)}} para soporte.

Te informamos que el usuario:

* Nombre: {{ $user->name }},
* Apellido: {{ $user->lastname }}
* Correo Electrónico: {{ $user->email }}
* Ticket: {{str_pad($ticket->id, 6, 0, STR_PAD_LEFT)}}

Ha generado un nuevo ticket.

@component('mail::button', ['url' => $url])
Ver Ticket
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
