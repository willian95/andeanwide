<template>
    <div class="card">
        <div class="card-header border-bottom-0">
            <span class="text-uppercase">
                Orden: {{ order.id.toString().padStart(6, 0) }}
            </span>
            <span>
                <img class="mx-2" :src="`https://www.countryflags.io/${order.currency_sended.country.abbr}/flat/32.png`">
                <i class="fa fa-arrow-right"></i>
                <img class="mx-2" :src="`https://www.countryflags.io/${order.currency_received.country.abbr}/flat/32.png`">
            </span>
        </div>
        <div class="collapse" id="collapseOrder">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-12">
                        <InputComponent
                            label="Monto a pagar"
                            :value="`${formatNumber(order.payment_amount)} ${order.currency_sended.symbol}`"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-6">
                        <InputComponent
                            label="Comisión"
                            :value="`${formatNumber(order.total_cost)} ${order.currency_sended.symbol}`"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-6">
                        <InputComponent
                            label="Prioridad"
                            :value="order.priority_label"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-md-12">
                        <InputComponent
                            label="Monto a enviar"
                            :value="`${formatNumber(order.sended_amount)} ${order.currency_sended.symbol}`"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-md-12">
                        <InputComponent
                            label="Tasa"
                            :value="rate"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-md-12">
                        <InputComponent
                            label="Monto a recibir"
                            :value="`${formatNumber(order.received_amount)} ${order.currency_received.symbol}`"
                            :disabled="true"
                        />
                    </div>
                </div>
            </div>
        </div>
        <a
            class="d-block w-100 text-center py-2"
            data-toggle="collapse"
            href="#collapseOrder"
            role="button"
            aria-expanded="false"
            aria-controls="collapseOrder"
            @click="showDown = !showDown"
        >
            <i v-if="showDown" class="fa fa-caret-down" aria-hidden="true"></i>
            <i v-else class="fa fa-caret-up" aria-hidden="true"></i>
        </a>
    </div>    
</template>

<script>
import InputComponent from './InputComponent'

export default {
    name: 'OrderComponent',
    components: {
        InputComponent
    },
    props: {
        order: Object,
        default: () => {}
    },
    data: () => ({
        showDown: true
    }),
    computed: {
        rate() {
            if(this.order.symbol.show_inverse) {
                const currencies = this.order.symbol.name.split('/')
                return `${(1/this.order.exchange_rate).toFixed(this.order.symbol.decimals)} ${currencies[1]}/${currencies[0]}`
            }
            return `${this.order.exchange_rate.toFixed(this.order.symbol.decimals)} ${this.order.symbol.name}`
        }
    },
    methods: {
        formatNumber(value, decimal=0) {
            if(value){
                let amount = parseFloat(value).toFixed(decimal);
                return amount.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            }
            return '0.00';
        },
    }
}
</script>

<style scoped>
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
