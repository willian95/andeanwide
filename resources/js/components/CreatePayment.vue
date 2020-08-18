<template>
    <div class="card">
        <div class="card-header border-0">
            <span>
                CARGAR PAGO
            </span>
        </div>
        <div class="card-body">
            <FormComponent
                :action="createPaymentRoute"
                method="POST"
                enctype="multipart/form-data"
                ref="form"
            >
                <input type="hidden" :value="csrf" name="_token">
                <input type="hidden" :value="order.id" name="order_id">
                <div class="row">
                    <div class="col-12">
                        <SelectComponent
                            v-model="accountId"
                            :items="accounts"
                            :item-text="['bank_name', 'bank_account']"
                            item-value="id"
                            name="account_id"
                            label="Cuenta donde realizo el pago*"
                            :rules="requiredRules"
                        />
                    </div>
                    <div class="col-12 col-md-6">
                        <InputComponent
                            v-model="transactionNumber"
                            label="Número de Transacción*"
                            name="transaction_number"
                            :rules="requiredRules"
                        />
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="hidden" name="transaction_date" :value="transactionDateComputed" />
                        <DatepickerComponent
                            v-model="transactionDate"
                            label="Fecha de Transaction"
                            name="transactionDate"
                            required
                            placeholder="Fecha de Transacción"
                            :rules="requiredRules"
                        />
                    </div>
                    <div class="col-12">
                        <input type="hidden" name="payment_amount" :value="stripNumber(paymentAmount)" />
                        <CurrencyInputComponent
                            v-model="paymentAmount"
                            label="Monto del pago*"
                            :rules="requiredRules"
                        />
                    </div>
                    <div class="col-12">
                        <InputImageComponent
                            v-model="image"
                            label="Soporte de pago"
                            name="image"
                            :required="true"
                            :rules="requiredRules"
                        />
                    </div>
                </div>
            </FormComponent>
        </div>
        <div class="card-footer border-0 py-0">
            <div
                v-if="rejectRoute"
                class="row"
            >
                <div class="col-6">
                    <FormComponent
                        method="POST"
                        :action="rejectRoute"
                    >
                        <input type="hidden" :value="csrf" name="_token">
                        <input type="hidden" :value="order.id" name="order_id">
                        <input type="hidden" value="DELETE" name="_method">
                        <button class="btn btn-danger btn-block">
                            Eliminar Orden
                        </button>
                    </FormComponent>
                </div>
                <div class="col-6">
                    <button
                        class="btn btn-success btn-block"
                        @click="handleSubmit"
                    >
                        Cargar Pago
                    </button>
                </div>
            </div>
            <button
                v-else
                class="btn btn-success btn-block"
                @click="handleSubmit"
            >
                Cargar Pago
            </button>
        </div>
    </div>
</template>

<script>
import FormComponent from './FormComponent'
import InputComponent from './InputComponent'
import SelectComponent from './SelectComponent'
import InputImageComponent from './InputImageComponent'
import DatepickerComponent from './DatepickerComponent'
import CurrencyInputComponent from './CurrencyInputComponent'

export default {
    name: 'CreatePaymentComponent',
    components: {
        FormComponent,
        InputComponent,
        SelectComponent,
        InputImageComponent,
        DatepickerComponent,
        CurrencyInputComponent
    },
    props: {
        accounts: {
            type: Array,
            default: () => [],
        },
        order: {
            type: Object,
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
        rejectRoute: {
            type: String,
            default: ''
        }
    },
    data: () => ({
        accountId: null,
        transactionNumber: null,
        transactionDate: new Date(),
        paymentAmount: null,
        paymentCode: null,
        image: null,
        requiredRules: [
            v => !!v || 'Este campo es requerido',
        ]
    }),
    computed: {
        transactionDateComputed(){
            if(this.transactionDate instanceof Date) {
                return new Date(this.transactionDate).toISOString()
            }
            return false
        }
    },
    methods: {
        stripNumber(value) {
            if(value) {
                return  parseFloat(value.replace(/,/gi, ""));
            }
            return null;
        },
        formatNumber(value) {
            if(value){
                let amount = parseFloat(value).toFixed(0);
                return amount.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            }
            return '0';
        },
        handleSubmit(){
            this.$refs.form.handleSubmit()
        }
    },
    mounted(){
        this.paymentAmount = this.formatNumber(this.order.payment_amount)
    }
}
</script>
