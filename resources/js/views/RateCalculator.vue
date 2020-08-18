<template>
    <div class="card2">
        <div class="card-body">
            <div class="form-container">
                <!-- monto a enviar -->
                <div class="row mt-2">
                    <div class="col-7 pr-0">
                        <CurrencyInputComponent
                            v-model="amountToSend"
                            label="Envias"
                            name="amountToSend"
                            :changed="sendedAmountChanged"
                        />
                    </div>
                    <div class="col-5 pl-0">
                        <CurrencySelectComponent
                            v-model="base_symbol"
                            label="Divisa"
                            name="base_symbol_input"
                            :currencies="bases"
                            :changed="symbolChanged"
                            :defaultOptionLabel="null"
                        />
                    </div>
                    <div v-if="min_error" class="col">
                        <span class="text-danger amount-error-alert">
                            <strong>* El monto mínimo a enviar es {{ formatNumber(min_amount) }} {{ base_symbol }}</strong>
                        </span>
                    </div>
                </div>
                <!-- fin monto a enviar -->

                <div class="row">
                    <div class="col-12">
                        <p class="text-left">
                            Comisión: <strong>{{ formatNumber(total) }} {{ base_symbol}}</strong>
                        </p>
                        <p class="text-left">
                            Monto a convertir: <strong>{{ formatNumber(totalToExchange) }} {{ base_symbol}}</strong>
                        </p>
                        <p class="text-left" v-if="base_symbol && quote_symbol">
                            Tipo de Cambio:
                            <strong>1 {{ symbol.show_inverse ? quote_symbol : base_symbol }}</strong> 
                            =
                            <strong>
                                {{ symbol.show_inverse ? (1/exchangeRate).toFixed(symbol.decimals) : exchangeRate.toFixed(symbol.decimals) }} {{ symbol.show_inverse ? base_symbol : quote_symbol }}
                            </strong>
                        </p>
                    </div>
                </div>

                <!-- Prioridad -->
                <div class="row">
                    <div class="col-12">
                        <div class="form-group text-left">
                            <label class="form-control-label" for="prioritySelect">
                                Prioridad
                            </label>
                            <select
                                v-model="priority"
                                class="selectpicker form-control"
                                data-style="btn-primary rounded-0 pt-2"
                                id="prioritySelect"
                                name="priority"
                                @change="sendedAmountChanged"
                            >
                                <option
                                    v-for="priority in priorities"
                                    :key="priority.name"
                                    :data-subtext="priority.sublabel"
                                    :value="priority.name"
                                >
                                    {{ priority.label }}
                                </option>
                            </select>
                        </div>
                    </div>
                </div>
                <!-- fin prioridad -->

                <!-- monto a recibir -->
                <div class="row">
                    <div class="col-7 pr-0">
                        <CurrencyInputComponent
                            v-model="amountToReceive"
                            label="Destinatario recibe"
                            name="amountToReceive"
                            :changed="receivedAmountChanged"
                        />
                    </div>
                    <div class="col-5 pl-0">
                        <CurrencySelectComponent
                            v-model="quote_symbol"
                            label="Divisa"
                            name="quote_symbol_input"
                            :currencies="quotes"
                            :changed="symbolChanged"
                            :defaultOptionLabel="null"
                        />
                    </div>
                </div>
                <!-- fin monto a recibir -->

                <!-- CTA -->
                <div class="row">
                    <div class="col-12">
                        <p class="text-center"> <small>
                                Al registrarte estas aceptando nuestra <a
                                    href="/privacidad">Política de privacidad</a> y <a
                                    href="/terminos">Términos & condiciones.</a>
                            </small>
                        </p>
                    </div>
                    <div class="col-12" v-if="redirectRoute">
                        <div class="form-group">
                            <a :href="redirectRoute" class="btn btn-custom form-control-submit-button font-weight-bold" style="font-size:1em;">Enviar Dinero</a>
                        </div>
                        <div class="form-message">
                            <div id="rmsgSubmit" class="h3 text-center hidden"></div>
                        </div>
                    </div>

                </div>
                <!-- fin CTA -->
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import CurrencyInputComponent from '../components/CurrencyInputComponent';
import CurrencySelectComponent from '../components/CurrencySelectComponent';
import CurrencySelector from '../components/CurrencySelector'
import { uniqBy } from 'lodash';

export default {
    components:{
        CurrencyInputComponent,
        CurrencySelectComponent,
        CurrencySelector
    },
    data: () => ({
        bases: [],
        base_symbol: '',
        quotes: [],
        quote_symbol: '',
        amountToSend: '0',
        amountToReceive: 0,
        exchangeRate: 0,
        priority: 'normal',
        min_error: false,
    }),
    props: {
        symbols: {
            type: Array,
            default: [],
        },
        params: {
            type: Object,
            default: {}
        },
        priorities: {
            type: Array,
            default: []
        },
        redirectRoute: {
            type: String,
            default: ''
        }
    },
    computed: {
        transactionCost() {
            let transCost = this.amountToSend;
            if(transCost && this.base_symbol && this.quote_symbol) {
                transCost = parseFloat(transCost.replace(/,/gi, ""));
                transCost = transCost * this.params.transactionCostPct / 100;
                return transCost;
            }
            return 0;
        },
        priorityPct(){
            return this.priorities.filter(priority => priority.name == this.priority)[0].costPct;
        },
        priorityCost() {
            let priorityCost = this.amountToSend;
            if(priorityCost && this.base_symbol && this.quote_symbol) {
                priorityCost = parseFloat(priorityCost.replace(/,/gi, ""));
                priorityCost = priorityCost * this.priorityPct/100;
                return priorityCost;
            }
            return 0;
        },
        totalCost() {
            return this.transactionCost + this.priorityCost;
        },
        tax() {
            let tax = this.totalCost * this.params.taxPct / 100;
            return tax;
        },
        total() {
            let total = this.totalCost + this.tax;
            return total;
        },
        totalToExchange(){
            const toSend = parseFloat(this.amountToSend.replace(/,/gi, ""));
            return toSend - this.total;
        },
        min_amount(){
            if(this.symbols.length > 0) {
                return this.symbol.min_amount
                // return this.symbols.filter(symbol => symbol.name === `${this.base_symbol}/${this.quote_symbol}`)[0].min_amount
            }
            return 0
        },
        symbol() {
            if(this.symbols.length > 0) {
                const symbol = this.symbols.filter(symbol => symbol.name === `${this.base_symbol}/${this.quote_symbol}`)[0]
                if(symbol) {
                    return symbol
                }
            }
            return {
                decimals: 4,
                show_inverse: false,
                min_amount: 0,
            }
        }
    },
    methods:{
        async symbolChanged() {
            if (this.base_symbol && this.quote_symbol) {
                await this.fetchExchangeRate()
                this.sendedAmountChanged()
            }
        },
        async fetchExchangeRate() {
            try {
                const response = await axios.post(`/api/exchange_rate/${this.base_symbol}/${this.quote_symbol}`);
                if(response.data.error){
                    this.exchangeRate = 0
                    return
                }
                this.exchangeRate = response.data.bid;
            } catch (error) {
                this.exchangeRate = 0;
            }
        },
        sendedAmountChanged() {
            let toSend = this.stripNumber(this.amountToSend);
            let toReceive;

            if(toSend < this.min_amount) this.min_error = true;
            else this.min_error = false;

            if (toSend && this.base_symbol && this.quote_symbol) {
                toReceive = this.totalToExchange * this.exchangeRate;
                toReceive = parseFloat(toReceive).toFixed(0);
                this.amountToReceive = toReceive.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            } else {
                this.amountToReceive = 0;
            }
        },
        receivedAmountChanged() {
            let toReceive = this.amountToReceive;
            let toSend;


            if (toReceive && this.base_symbol && this.quote_symbol) {
                toReceive = parseFloat(toReceive.replace(/,/gi, ""));
                const factor = this.exchangeRate *  (1 - (this.params.transactionCostPct/100 + this.priorityPct/100) * (1 + this.params.taxPct/100));
                toSend = toReceive / factor;
                toSend = parseFloat(toSend).toFixed(0);
                this.amountToSend = toSend.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            } else {
                this.amountToSend = 0;
            }
        },
        stripNumber(value) {
            if(value) {
                return  parseFloat(value.replace(/,/gi, ""));
            }
            return null;
        },
        formatNumber(value) {
            if(value){
                let amount = parseFloat(value).toFixed(2);
                return amount.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            }
            return '0.00';
        },
    },
    created(){
        this.bases = uniqBy(this.symbols.map(symbol => symbol.base), 'id');
        this.quotes = uniqBy(this.symbols.map(symbol => symbol.quote), 'id');
        this.symbols.forEach(symbol => {
            if(symbol.is_default) {
                this.base_symbol = symbol.base.symbol
                this.quote_symbol = symbol.quote.symbol
                this.amountToSend = symbol.default_amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }
        })
    },
    async mounted(){
        await this.symbolChanged();
        this.sendedAmountChanged();
    }
}
</script>

<style scoped>
    .btn-custom  {
        padding-top: 0.75rem;
        padding-bottom: 0.75rem;
    }

    .amount-error-alert {
        display: inline-block;
        margin: 0 0 1.2rem;
        font-size: 0.85rem;
    }
</style>
