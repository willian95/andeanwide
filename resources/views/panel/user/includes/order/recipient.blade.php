<div>
	<add-recipient
		add-recipient-route="{{ route('panel.user.order.add_recipient' , ['order' => $order->id ]) }}"
		create-recipient-route="{{ route('panel.user.recipient.store') }}"
		:recipients="{{ json_encode($recipients) }}"
		:order="{{ json_encode($order) }}"
        csrf="{{ csrf_token() }}"
	/>
</div>