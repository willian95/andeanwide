@component('mail::message')
# Hemos recibido una la Orden No. {{ str_pad($order->id, 6, 0, STR_PAD_LEFT) }} para envío de dinero.

Estimado {{ $user->name }} {{ $user->lastname }},

Ante todo reciba un coordial saludos, te informamos que hemos recibido una orden para envío de dinero.

Detalles de la orden:
* Orden No. {{ str_pad($order->id, 6, 0, STR_PAD_LEFT) }}
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

## Importante, cuando realices el pago coloca como concepto el siguiente código: 

# **{{ $order->payment_code }}**

Te recordamos que para que la orden pueda ser procesada es necesario que realices el pago correspondiente y registres el pago en nuestro sistemas.

Gracias,<br>
{{ config('app.name') }}
@endcomponent
