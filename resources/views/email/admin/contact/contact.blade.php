@component('mail::message')
# {{ $subject }}

Mensaje de {{ $name }} - {{ $email }}

{{ $content }}

Mensaje enviado en: {{ $datetime }}

Gracias,<br>
{{ config('app.name') }}
@endcomponent
