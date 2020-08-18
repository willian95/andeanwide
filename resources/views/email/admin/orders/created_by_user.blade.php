@component('mail::message')
# Un usuario generado una nueva Orden No. {{ str_pad($order->id, 6, 0, STR_PAD_LEFT) }} para envío de dinero.

El {{ $user->name }} {{ $user->lastname }} ha generado la ordern No. {{ str_pad($order->id, 6, 0, STR_PAD_LEFT) }} para envío de dínero.

Detalles de la orden:
* Orden No. {{ str_pad($order->id, 6, 0, STR_PAD_LEFT) }}
* Usuario: {{ $user->name }} {{ $user->lastname }}
* Correo Electrónico: {{ $user->email }}
@if($order->symbol->show_inverse)
* Tasa de Cambio: {{ number_format(1/$order->exchange_rate, $order->symbol->decimals) }} {{ $order->currencyReceived->symbol }}/{{ $order->currencySended->symbol }}
@else
* Tasa de Cambio: {{ number_format($order->exchange_rate, $order->symbol->decimals) }} {{ $order->currencySended->symbol }}/{{ $order->currencyReceived->symbol }}
@endif
* Total a pagar: {{ number_format($order->payment_amount, 2,) }} {{ $order->currencySended->symbol }}
* Comisión: {{ number_format($order->total_cost, 2,) }} {{ $order->currencySended->symbol }}
* Total a recibir: {{ number_format($order->received_amount, 2,) }} {{ $order->currencyReceived->symbol }}
* Quien recibe: {{ $order->recipient->name }} {{ $order->recipient->lastname }} ({{ $order->recipient->country->name }})

@component('mail::button', ['url' => $url])
Ver Orden
@endcomponent

## Código del depósito: 
# {{ $order->payment_code }}

Gracias,<br>
{{ config('app.name') }}
@endcomponent
