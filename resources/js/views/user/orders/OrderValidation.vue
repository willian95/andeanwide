<template>
    <div>
        <div class="card my-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 d-flex flex-column flex-lg-row justify-content-center align-items-center">
                        <span class="h2">
                            {{ formatNumber(order.payment_amount, 0) }} {{ order.currency_sended.symbol }}
                            <i class="fa fa-arrow-right mx-3 d-none d-lg-inline-block" aria-hidden="true"></i>
                        </span>
                        
                        <span class="h1">
                            <span class="badge badge-success" v-if="order.symbol.show_inverse">
                                {{ (1/order.exchange_rate).toFixed(order.symbol.decimals) }} {{ showSymbol() }}
                            </span>
                            <span class="badge badge-success" v-else>
                                {{ order.exchange_rate.toFixed(order.symbol.decimals) }} {{ showSymbol() }}
                            </span>
                        </span>

                        <span class="h2">
                            <i class="fa fa-arrow-right mx-3 d-none d-lg-inline-block" aria-hidden="true"></i>
                            {{ formatNumber(order.received_amount, 0) }} {{ order.currency_received.symbol }}
                        </span>
                    </div>
                    <div class="col-12 text-center">
                        <small>
                            <i class="fa fa-calendar-o mx-2" aria-hidden="true"></i>
                            Fecha de creación: {{ created_at }}
                        </small>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-center my-0">
                            Importante! Cuando realices el pago debes colocar como concepto el siguiente código <span class="badge badge-success" style="font-size: 1.3rem;">{{ order.payment_code }}</span> 
                        </h3>
                    </div>
                </div>
            </div>
        </div>

        <OrderComponent
            class="my-2"
            :order="order"
        />
        <ViewRecipient
            class="my-2"
            :recipient="order.recipient"
            :collapsable="true"
        />

        <!-- <AccountComponent /> -->

        <div class="card my-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <form method="post" :action="rejectRoute">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" :value="csrf">
                            <button type="submit" class="btn btn-danger btn-block btn-lg">
                                <i class="fa fa-trash my-2" aria-hidden="true"></i>
                                Eliminar order
                            </button>
                        </form>
                    </div>
                    <div class="col-12 col-sm-6">
                        <form method="POST" :action="validateRoute">
                            <input type="hidden" name="_token" :value="csrf">
                            <button class="btn btn-success btn-block btn-lg">
                                <i class="fa fa-check my-2" aria-hidden="true"></i>
                                Enviar order
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import OrderComponent from '../../../components/OrderComponent'
import AccountComponent from '../../../components/AccountsComponent'
import ViewRecipient from '../../../components/ViewRecipient'
import moment from 'moment'

export default {
    name: 'OrderValidationView',
    components: {
        OrderComponent,
        ViewRecipient,
        AccountComponent,
    },
    props: {
        order: {
            type: Object,
            default: () => {}
        },
        validateRoute: {
            type: String,
            default: ''
        },
        rejectRoute: {
            type: String,
            default: ''
        },
        csrf: {
            type: String,
            default: ''
        }
    },
    computed: {
        created_at(){
            return moment(this.order.created_at).format("DD/MM /YYYY, h:mm:ss a")
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
        showSymbol(){
            if(this.order.symbol.show_inverse) {
                const currencies = this.order.symbol.name.split('/')
                return `${currencies[1]}/${currencies[0]}`
            }
            return this.order.symbol.name
        }
    }
}
</script>

<style scoped>

</style>
