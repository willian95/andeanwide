@component('mail::message')
# Orden No. {{ str_pad($order->id, 6, 0, STR_PAD_LEFT) }} ha sido completada con éxito.

Estimado {{ $user->name }} {{ $user->lastname }},

Ante todo reciba un coordial saludos, te informamos que la orden No. {{ str_pad($order->id, 6, 0, STR_PAD_LEFT) }} se ha completado con éxito.

Muy pronto tu beneficiario estara recibiendo el dinero.

Gracias por preferirnos,<br>
{{ config('app.name') }}
@endcomponent
