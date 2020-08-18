@component('mail::message')
# Hemos confirmado el pago de la orden No. {{ str_pad($order->id, 6, 0, STR_PAD_LEFT) }}.

Estimado {{ $user->name }} {{ $user->lastname }},

Ante todo reciba un coordial saludos, te informamos que hemos verificado el pago de la orden No. {{ str_pad($order->id, 6, 0, STR_PAD_LEFT) }}.

@component('mail::button', ['url' => $url])
Ver Orden
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
