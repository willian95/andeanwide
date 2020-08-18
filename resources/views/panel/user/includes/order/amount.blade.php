
<div id="user_calculator_app">
    <user-rate-calculator
        csrf="{{ csrf_token() }}"
        post-route="{{ route('panel.user.order.store') }}"
        :symbols="{{ json_encode($symbols) }}"
        :params="{{ json_encode($params) }}"
        :priorities="{{ json_encode($priorities) }}"
    />
</div>
