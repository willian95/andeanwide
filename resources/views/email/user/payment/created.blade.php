@component('mail::message')
# Hemos recibido un pago para la Orden No. {{ str_pad($order->id, 6, 0, STR_PAD_LEFT) }}.

Estimado {{ $user->name }} {{ $user->lastname }},

Ante todo reciba un coordial saludos, te informamos que hemos recibido el pago de la orden No. {{ str_pad($order->id, 6, 0, STR_PAD_LEFT) }}, tan pronto nuestros ejecutivos validen el pago te estaremos informando.

Detalles del pago:
* Numero de Transacción: {{ $payment->transaction_number }}
* Fecha de Transacción: {{ $payment->transaction_date }}
* Monto de Transacción: {{ number_format($payment->payment_amount, 2) }}
* Pagado en: {{ $payment->account->bank_name }} / {{ $payment->account->bank_account }}

Detalles de la orden:
* Orden No. {{ str_pad($order->id, 6, 0, STR_PAD_LEFT) }}
@if($order->symbol->show_inverse)
* Tasa de Cambio: {{ number_format(1/$order->exchange_rate, $order->symbol->decimals) }} {{ $order->currencyReceived->symbol }}/{{ $order->currencySended->symbol }}
@else
* Tasa de Cambio: {{ number_format($order->exchange_rate, $order->symbol->decimals) }} {{ $order->currencySended->symbol }}/{{ $order->currencyReceived->symbol }}
@endif
* Total a pagar: {{ number_format($order->payment_amount, 2) }} {{ $order->currencySended->symbol }}
* Comisión: {{ number_format($order->total_cost, 2) }} {{ $order->currencySended->symbol }}
* Total a recibir: {{ number_format($order->received_amount, 2,) }} {{ $order->currencyReceived->symbol }}
* Quien recibe: {{ $order->recipient->name }} {{ $order->recipient->lastname }} ({{ $order->recipient->country->name }})

@component('mail::button', ['url' => $url])
Ver Orden
@endcomponent

Gracias,<br>
{{ config('app.name') }}
@endcomponent
