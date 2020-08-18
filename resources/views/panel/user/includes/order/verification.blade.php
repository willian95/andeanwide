<order-validation
	:order="{{ json_encode($order) }}"
	validate-route="{{ route('panel.user.order.fill_order', ['order' => $order->id]) }}"
	reject-route="{{ route('panel.user.order.destroy', ['order' => $order->id]) }}"
	csrf="{{ csrf_token() }}"
/>
