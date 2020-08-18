<template>
    <div class="card">
        <div class="card-header border-0 d-flex justify-content-between align-items-center">
            <span>
                PAGO - CODIGO {{ payment.payment_code }}
            </span>
            <span
                v-if="!!payment.verified_at"
                class="badge badge-success"
            >
                Pago verificado con éxito
            </span>
            <span
                v-else-if="!!payment.rejected_at"
                class="badge badge-danger"
            >
                Error al verificar el pago
            </span>
            <span
                v-else
                class="badge badge-warning"
            >
                Pendiente por verificar el pago
            </span>
        </div>
        <div :class="`${!!collapsable ? 'collapse': ''}`" id="collapsePayment">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <InputComponent
                            :value="payment.account.bank_name"
                            label="Cuenta"
                            name="account"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-md-6">
                        <InputComponent
                            :value="payment.account.bank_account"
                            label="Cuenta"
                            name="account"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-md-6">
                        <InputComponent
                            :value="payment.transaction_number"
                            label="Numero de Transacción"
                            name="transaction_number"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-md-6">
                        <InputComponent
                            :value="payment.transaction_date"
                            label="Fecha de Transacción"
                            name="transaction_date"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12">
                        <InputComponent
                            :value="`${formatNumber(payment.payment_amount)} ${payment.account.currency.symbol}`"
                            label="Monto"
                            name="monto"
                            :disabled="true"
                        />
                    </div>
                    
                    <div class="col-12">
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
        <a
            v-if="collapsable"
            class="d-block w-100 text-center py-2"
            data-toggle="collapse"
            href="#collapsePayment"
            role="button"
            aria-expanded="false"
            aria-controls="collapsePayment"
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
    name: 'PaymentComponent',
    components: {
        InputComponent,
    },
    props: {
        payment: {
            type: Object,
            required: true
        },
        collapsable: {
            type: Boolean,
            default: false
        }
    },
    data: () => ({
        showDown: true
    }),
    methods: {
        formatNumber(value) {
            if(value){
                let amount = parseFloat(value).toFixed(0);
                return amount.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            }
            return '0';
        }
    }
}
</script>