@component('mail::message')
# Orden No. {{ str_pad($order->id, 6, 0, STR_PAD_LEFT) }} rechazada.

Estimado {{ $user->name }} {{ $user->lastname }},

Ante todo reciba un coordial saludos, te informamos que hemos rechazado la orden No. {{ str_pad($order->id, 6, 0, STR_PAD_LEFT) }}.

El rechazo se da por los siguientes motivos:

{{ $order->observation }}

@component('mail::button', ['url' => ''])
Ver Orden
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
