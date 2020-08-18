<template>
    <form method="post" :action="postRoute">
        <input type="hidden" name="_token" :value="csrf" />
        <div class="row">
            <div class="col-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-arrow-circle-right mr-2" aria-hidden="true"></i>
                        Tu envías
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-7 pr-0">
                                <CurrencyInputComponent
                                    v-model="amountToSend"
                                    name="amountToSend"
                                    :changed="sendedAmountChanged"
                                />
                            </div>
                            <div class="col-5 pl-0">
                                <CurrencySelectComponent
                                    v-model="base_symbol"
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
                    </div>
                </div>
            </div>
            <div class="col-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-calculator mr-2" aria-hidden="true"></i>
                        Cambio
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group text-left">
                                    <label class="form-control-label" for="prioritySelect">
                                        PRIORIDAD
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
                        <div class="row">
                            <div class="col-12 px-4">
                                <p class="text-left" style="font-size: 1.1rem;">
                                    Comisión: <strong>{{ formatNumber(total) }} {{ base_symbol}}</strong>
                                </p>
                                <p class="text-left" style="font-size: 1.1rem;">
                                    Monto a convertir: <strong>{{ formatNumber(totalToExchange) }} {{ base_symbol}}</strong>
                                </p>
                                <p class="text-left" style="font-size: 1.1rem;">
                                    Tipo de Cambio: 
                                    <strong>
                                        1
                                        <span v-if="symbol.show_inverse">
                                            {{ quote_symbol }}
                                        </span>
                                        <span v-else>
                                            {{ base_symbol }}
                                        </span>
                                    </strong>
                                    =
                                    <strong>
                                        <span v-if="symbol.show_inverse">
                                            {{ !!exchangeRate ? (1/exchangeRate).toFixed(symbol.decimals) : 0.00 }} {{ base_symbol }}
                                        </span>
                                        <span v-else>
                                            {{ !!exchangeRate ? exchangeRate.toFixed(symbol.decimals) : 0.00 }} {{ quote_symbol }}
                                        </span>
                                    </strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 mt-2">
                <div class="card">
                    <div class="card-header">
                        <i class="fa fa-arrow-circle-right mr-2" aria-hidden="true"></i>
                        Destinatario recibe
                    </div>
                    <div class="card-body">
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
                    </div>
                </div>
            </div>
        </div>

        <input type="hidden" name="symbol_id" :value="symbolId" />
        <input type="hidden" name="payment_amount" :value="stripNumber(amountToSend)" />
        <input type="hidden" name="priority_id" :value="priorityId" />

        <div class="row d-flex justify-content-center mt-4">
            <div
                v-if="exchangeRate && !min_error"
                class="col-12 col-md-4 mt-2"
            >
                <button type="submit" class="btn btn-success btn-block">Crear Orden</button>
            </div>
        </div>
    </form>
</template>

<script>
import CurrencySelectComponent from '../../../components/CurrencySelectComponent';
import CurrencyInputComponent from '../../../components/CurrencyInputComponent';
import { uniqBy } from 'lodash';
import axios from 'axios';

export default {
    name: 'UserRateCalculator',
    components: {
        CurrencySelectComponent,
        CurrencyInputComponent,
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
        csrf: {
            type: String,
            default: '',
        },
        postRoute: {
            type: String,
            default: '',
        },
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
                return this.symbols.filter(symbol => symbol.name === `${this.base_symbol}/${this.quote_symbol}`)[0].min_amount
            }
            return 0
        },
        symbolId() {
            if(this.base_symbol || this.quote_symbol) {
                const selectedSymbol = this.symbols.filter(symbol => {
                    return symbol.name === `${this.base_symbol}/${this.quote_symbol}`
                })
                if(selectedSymbol.length>0){
                    return selectedSymbol[0].id
                }
                return null
            }
            return null
        },
        priorityId() {
            if(this.priority){
                const selectedPriority = this.priorities.filter(priority => priority.name === this.priority)
                if(selectedPriority.length > 0) {
                    return selectedPriority[0].id
                }
                return null
            }
            return null
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
            this.exchangeRate = 0
            if (this.base_symbol && this.quote_symbol) {
                await this.fetchExchangeRate();
                this.sendedAmountChanged();
            }
        },
        async fetchExchangeRate() {
            try {
                const response = await axios.post(`/api/exchange_rate/${this.base_symbol}/${this.quote_symbol}`);
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
                let amount = parseFloat(value).toFixed(0);
                return amount.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,");
            }
            return '0.00';
        }
    },
    // created() {
    //     this.bases = uniqBy(this.symbols.map(symbol => symbol.base), 'id');
    //     this.quotes = uniqBy(this.symbols.map(symbol => symbol.quote), 'id');
    //     this.priority_id = this.priorities[0].id;
    // }
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
    /* #exchange_rate {
        font-size: 0.75rem;
    }
    #exchange_rate_label {
        font-size: 0.75rem;
    } */
</style>
