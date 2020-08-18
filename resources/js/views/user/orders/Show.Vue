<template>
    <div>
        <AlertComponent
            :show-alert="!!message"
            :color="message.color"
            :dismissible="false"
        >
            {{ message.message }}
        </AlertComponent>

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
            v-if="!!order.recipient"
            class="my-2"
            :recipient="order.recipient"
            :collapsable="true"
        />
        <AddRecipientComponent
            v-else-if="!order.rejected_at"
            class="my-2"
            :recipients="recipients"
            :addRecipientRoute="addRecipientRoute"
            :order="order"
            :csrf="csrf"
        >
            <span>
                Beneficiarios
            </span>
            <CreateRecipientComponent
                :preSelectedCountryId="order.currency_received.country.id"
                :preSelectedCountryName="order.currency_received.country.name"
                :createRecipientRoute="createRecipientRoute"
                :csrf="csrf"
                :orderId="order.id"
            />
        </AddRecipientComponent>

        <div
            v-if="!order.filled_at && !order.rejected_at && !order.expiret_at"
            class="card my-2"
        >
            <div class="card-body">
                <div class="row justify-content-center mt-2">
                    <div class="col-12 col-sm-6">
                        <form method="post" :action="rejectRoute">
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="hidden" name="_token" :value="csrf">
                            <button type="submit" class="btn btn-danger btn-block btn-lg">
                                <i class="fa fa-trash my-2" aria-hidden="true"></i>
                                Eliminar Orden
                            </button>
                        </form>
                    </div>
                    <div
                        v-if="!!order.recipient"
                        class="col-12 col-sm-6"
                    >
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

        <AccountsComponent
            v-if="!!order.filled_at && !order.payment && !order.rejected_at"
            :accounts="accounts"
            :order="order"
            :csrf="csrf"
            :showCreatePayment="true"
            :createPaymentRoute="createPaymentRoute"
            :rejectRoute="rejectRoute"
        />

        <PaymentComponent
            v-if="!!order.payment"
            :payment="order.payment"
            :collapsable="true"
        />
    </div>
</template>

<script>
import OrderComponent from '../../../components/OrderComponent'
import AccountsComponent from '../../../components/AccountsComponent'
import ViewRecipient from '../../../components/ViewRecipient'
import AddRecipientComponent from '../../../components/AddRecipientComponent'
import AlertComponent from '../../../components/AlertComponent'
import PaymentComponent from '../../../components/PaymentComponent'
import CreateRecipientComponent from '../../../components/CreateRecipient'
import moment from 'moment'

export default {
    name: 'ShowOrderView',
    components: {
        OrderComponent,
        AccountsComponent,
        ViewRecipient,
        AddRecipientComponent,
        AlertComponent, 
        CreateRecipientComponent,
        PaymentComponent
    },
    props: {
        order: {
            type: Object,
            default: () => {}
        },
        message: {
            type: Object,
            default: () => {}
        },
        recipients: {
            type: Array,
            default: () => []
        },
        validateRoute: {
            type: String,
            default: ''
        },
        rejectRoute: {
            type: String,
            default: ''
        },
        createRecipientRoute: {
            type: String,
            default: ''
        },
        addRecipientRoute: {
            type: String,
            default: ''
        },
        createPaymentRoute: {
            type: String,
            default: ''
        },
        csrf: {
            type: String,
            default: ''
        },
        accounts: {
            type: Array,
            default: () => []
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
