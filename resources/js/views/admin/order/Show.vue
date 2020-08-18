<template>
    <div>
        <div class="card my-2">
            <div class="card-header border-0 d-flex justify-content-between align-items-center">
                <span class="d-flex flex-column">
                    <span>
                        USUARIO: {{ order.user.name }} {{ order.user.lastname }}
                    </span>
                    <span>
                        EMAIL: {{ order.user.email }}
                    </span>
                </span>
                <span>
                    <img class="mx-2" :src="`https://www.countryflags.io/${order.user.country.abbr}/flat/32.png`">
                </span>
            </div>
        </div>

        <div class="card my-2">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 d-flex flex-column flex-lg-row justify-content-center align-items-center">
                        <span class="h2">
                            {{ formatNumber(order.payment_amount, 0) }} {{ order.currency_sended.symbol }}
                            <i class="fa fa-arrow-right mx-3 d-none d-lg-inline-block" aria-hidden="true"></i>
                        </span>
                        
                        <!-- <span class="h1">
                            <span class="badge badge-success">
                                {{ order.exchange_rate.toFixed(6) }} {{ order.symbol.name }}
                            </span>
                        </span> -->
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

        <OrderComponent
            class="my-2"
            :order="order"
        />

        <ViewRecipientComponent
            v-if="recipient"
            class="my-2"
            :recipient="recipient"
            :collapsable="true"
        />

        <PaymentComponent
            v-if="order.payment"
            class="my-2"
            :payment="order.payment"
            :collapsable="true"
        >
            <ImageCard
                :imageUrl="order.payment.image_url"
                :imageTitle="`Pago No. ${order.payment.transaction_number}`"
                imageName="payment"
            />
        </PaymentComponent>

        <div
            v-if="order.filled_at && order.payment && !order.payment.verified_at && !order.payment.rejected_at"
            class=" card my-2"
        >
            <div class="card-header border-0">
                <span>
                    VERIFICAR PAGO
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <button class="btn btn-block btn-danger" data-toggle="modal" data-target="#rejectModal">
                            Rechazar
                        </button>
                        <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <FormComponent
                                        method="POST"
                                        :action="rejectRoute"
                                    >
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="rejectModalLabel">Rechazar</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body py-0">
                                            <input type="hidden" name="_token" :value="csrf">
                                            <TextareaComponent
                                                v-model="rejectPaymentObservation"
                                                label="Observación"
                                                name="observation"
                                                :rules="requiredRules"
                                            />
                                        </div>
                                        <div class="modal-footer py-0">
                                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-danger">Rechazar</button>
                                        </div>
                                    </FormComponent>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <form :action="verifyRoute" method="POST">
                            <input type="hidden" name="_token" :value="csrf">
                            <button class="btn btn-block btn-success">
                                Aprobar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div
            v-if="order.filled_at && order.payment && order.payment.verified_at && !order.completed_at && !order.rejected_at"
            class=" card my-2"
        >
            <div class="card-header border-0">
                <span>
                    ORDEN PROCESADA
                </span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <button class="btn btn-block btn-danger" data-toggle="modal" data-target="#rejectProcModal">
                            Rechazar
                        </button>
                        <div class="modal fade" id="rejectProcModal" tabindex="-1" role="dialog" aria-labelledby="rejectProcModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                <div class="modal-content">
                                    <FormComponent
                                        method="POST"
                                        :action="rejectRoute"
                                    >
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="rejectProcModalLabel">Rechazar</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body py-0">
                                            <input type="hidden" name="_token" :value="csrf">
                                            <TextareaComponent
                                                v-model="rejectOrderObservation"
                                                label="Observación"
                                                name="observation"
                                                :rules="requiredRules"
                                            />
                                        </div>
                                        <div class="modal-footer py-0">
                                            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Cerrar</button>
                                            <button type="submit" class="btn btn-danger">Rechazar</button>
                                        </div>
                                    </FormComponent>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <form :action="completeRoute" method="POST">
                            <input type="hidden" name="_token" :value="csrf">
                            <button class="btn btn-block btn-success">
                                Completar
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
import ViewRecipientComponent from '../../../components/ViewRecipient'
import PaymentComponent from '../../../components/PaymentComponent'
import ImageCard from '../../../components/ImageCard'
import TextareaComponent from '../../../components/TextareaComponent'
import FormComponent from '../../../components//FormComponent'
import moment from 'moment'

export default {
    name: 'ShowOrderView',
    components: {
        OrderComponent,
        ViewRecipientComponent,
        PaymentComponent,
        ImageCard,
        TextareaComponent,
        FormComponent
    },
    props: {
        order: {
            type: Object, 
            default: () => {}
        },
        recipient: {
            type: Object,
            default: () => {}
        },
        csrf: {
            type: String,
            default: ''
        },
        verifyRoute: {
            type: String,
            default: ''
        },
        rejectRoute: {
            type: String,
            default: ''
        },
        completeRoute: {
            type: String,
            default: ''
        }
    },
    data: () => ({
        rejectPaymentObservation: null,
        rejectOrderObservation: null,
        requiredRules: [
            v => !!v || 'Este campo es requerido.'
        ]
    }),
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
