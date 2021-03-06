@component('mail::message')
# Un usuario ha cargado prueba de identidad

Te informamos que el usuario:

* Nombre: {{ $user->name }},
* Apellido: {{ $user->lastname }}
* Correo Electrónico: {{ $user->email }}

Ha cargado en sistema la prueba de indentidad para su verificación.

@component('mail::button', ['url' => $url])
Ver Usuario
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
