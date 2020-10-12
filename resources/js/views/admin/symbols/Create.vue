<template>
    <div class="card bg-secondary shadow">
        <div class="card-header bg-secondary border-0">
            <div class="row align-items-center">
                <div class="col d-flex justify-content-between">
                    <h3 class="mb-0">Crear Par de Divisa</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <FormComponent
                method="POST"
                :action="action"
            >
                <input type="hidden" name="_token" :value="csrf_token">

                <div class="row">
                    <div class="col-6">
                        <CurrencySelectComponent
                            v-model="base_currency"
                            label="Divisa base"
                            name="base_currency"
                            color="none"
                            :currencies="currencies"
                            :defaultOptionLabel="null"
                            :rules="requireRules"
                        />
                    </div>
                    <div class="col-6">
                        <CurrencySelectComponent
                            v-model="quote_currency"
                            label="Divisa cotizada"
                            name="quote_currency"
                            color="none"
                            :currencies="currencies"
                            :defaultOptionLabel="null"
                            :rules="requireRules"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <InputComponent
                            v-model="name"
                            label="Nombre"
                            name="name"
                            :rules="requireRules"
                        />
                    </div>
                    <div class="col-6">
                        <SelectComponent
                            v-model="api_class"
                            name="api_class"
                            label="API"
                            :items="apis"
                            :rules="requireRules"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <CheckComponent
                            v-model="isActive"
                            label="El par esta activo"
                            name="is_active"
                        />
                    </div>
                    <div class="col-6">
                        <CheckComponent
                            v-model="showInverse"
                            label="Mostrar inverso"
                            name="show_inverse"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <input type="hidden" name="max_tier_1" :value="unformatNumber(maxTier1)">
                        <InputComponent
                            v-model="maxTier1"
                            label="Monto Max. Verificación Nivel 1"
                            name="max_tier_1_formated"
                            :rules="[...numericRules, ...maxLimitsRules]"
                            :blur="formatMaxTier1"
                            :focus="unformatMaxTier1"
                            hint="El valor de cero (0) implica que no tiene límite."
                        />
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="hidden" name="max_tier_2" :value="unformatNumber(maxTier2)">
                        <InputComponent
                            v-model="maxTier2"
                            label="Monto Max. Verificación Nivel 2"
                            name="max_tier_2_completed"
                            :rules="[...numericRules, ...maxLimitsRules]"
                            :blur="formatMaxTier2"
                            :focus="unformatMaxTier2"
                            hint="El valor de cero (0) implica que no tiene límite." 
                        />
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="hidden" name="decimals" :value="decimals">
                        <InputComponent
                            v-model="decimals"
                            label="Número de decimales"
                            name="decimals"
                            :rules="[...numericRules, ...maxLimitsRules]"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <CheckComponent
                            v-model="isMore"
                            label="Habilitar Consulta desde More"
                            name="is_more_enabled"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <InputComponent
                            v-model="min_amount"
                            label="Monto mínimo a enviar"
                            name="min_amount"
                            :rules="[...requireRules, ...numericRules]"
                            :blur="formatMinAmount"
                            :focus="unformatMinAmount"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <InputComponent
                            v-model="offset"
                            label="Compensación"
                            type="number"
                            name="offset"
                            :rules="[...requireRules]"
                        />
                    </div>
                    <div class="col-4">
                        <SelectComponent
                            v-model="offsetBy"
                            name="offset_by"
                            label="Tipo de compensación"
                            item-text="label"
                            item-value="name"
                            :items="offsetTypes"
                        />
                    </div>
                    <div class="col-4">
                        <SelectComponent
                            v-model="min_pip_value"
                            name="min_pip_value"
                            label="Valor minimo de cambio"
                            :items="[1, 0.1, 0.01, 0.001, 0.0001]"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <TextareaComponent
                            v-model="observation"
                            name="observation"
                            label="Observaciones"
                        />
                    </div>
                </div>
                <div
                    class="alert alert-success alert-dismissible fade show"
                    role="alert"
                    v-if="showTest"
                >
                    <span>
                        <span>
                            <strong>
                                {{ base_currency }}/{{ quote_currency }}: 
                            </strong>
                        </span>
                        <br>
                        <span><strong>API: {{ formatNumber(testResult.api_rate) }}</strong></span>
                        <br>
                        <span><strong>Ajuste: {{ formatNumber(testResult.bid) }}</strong></span>
                        <br>
                        <br>
                        <span>
                            <strong>
                                {{ quote_currency }}/{{ base_currency }}: 
                            </strong>
                        </span>
                        <br>
                        <span><strong>API: {{ formatNumber(1/testResult.api_rate) }}</strong></span>
                        <br>
                        <span><strong>Ajuste: {{ formatNumber(1/testResult.bid) }}</strong></span>
                    </span>
                    <button
                        type="button"
                        class="close"
                        aria-label="Close"
                        @click="showTest=false"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div
                    class="alert alert-danger alert-dismissible fade show"
                    role="alert"
                    v-if="showError"
                >
                    <span><strong>No existen datos que corresponda a los datos ingresados.</strong></span>
                    <button
                        type="button"
                        class="close"
                        aria-label="Close"
                        @click="showError=false"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row">
                    <div class="col pt-2 pb-3">
                        <button
                            class="btn btn-outline-dark btn-block"
                            @click.prevent="testApi"
                        >
                            Test API
                        </button>
                    </div>
                    <div class="col pt-2 pb-3">
                        <button
                            type="submit"
                            class="btn btn-primary btn-block"
                        >
                            Crear Par
                        </button>
                    </div>
                </div>
            </FormComponent>
        </div>
    </div>
</template>

<script>
import FormComponent from '../../../components/FormComponent'
import InputComponent from '../../../components/InputComponent'
import CurrencySelectComponent from '../../../components/CurrencySelectComponent'
import SelectComponent from '../../../components/SelectComponent'
import CheckComponent from '../../../components/CheckComponent'
import TextareaComponent from '../../../components/TextareaComponent'
import { isNumeric } from 'validator'
import axios from 'axios'

export default {
    name: 'CreateSymbolView',
    components: {
        FormComponent,
        InputComponent,
        CurrencySelectComponent,
        SelectComponent,
        CheckComponent,
        TextareaComponent
    },
    props: {
        action: {
            type: String,
            default: ''
        },
        csrf_token: {
            type: String,
            default: ''
        },
        currencies: {
            type: Array,
            default: () => []
        },
        apis: {
            type: Array,
            default: () => []
        }
    },
    data: () => ({
        name: null,
        base_currency: null,
        quote_currency: null,
        api_class: null,
        min_pip_value: 1,
        min_amount: '0',
        showInverse: false,
        maxTier1: 0,
        maxTier2: 0,
        decimals: 4,
        isMore: false,
        offsetTypes: [
            {
                name: 'percentage',
                label: 'Por porcentaje'
            },
            {
                name: 'point',
                label: 'Por puntos'
            }
        ],
        offsetBy: 'percentage',
        offset: '0',
        requireRules: [
            v => !!v || 'Este campo es requerido',
        ],
        numericRules: [
            v => {
                if(v && typeof(v) != 'number') {
                    return isNumeric(v.replace(/,/gi, "")) || 'Este campo deber ser numérico.'
                }
                return true
            }
        ],
        maxLimitsRules: [
            v => {
                if(v && typeof(v) != 'number') {
                    return v.toString().replace(/,/gi, "")>=0 || 'El valor de este campo de ser mayor o igual a cero.'
                }
                return true
            }
        ],
        isActive: true,
        observation: '',
        showTest: false,
        showError: false,
        testResult: {}
    }),
    watch: {
        base_currency(val) {
            this.name = `${val}/${this.quote_currency}`
        },
        quote_currency(val) {
            this.name = `${this.base_currency}/${val}`
        }
    },
    methods: {
        async testApi(){
            this.showTest = false
            this.showError = false
            if(
                this.base_currency &&
                this.quote_currency &&
                this.offset !== undefined &&
                this.offsetBy &&
                this.min_pip_value &&
                this.api_class
            ){
                try {
                    const { data } = await axios.post(`/exchange_rate/${this.base_currency}/${this.quote_currency}/test`, {
                        offset: this.offset,
                        offset_by: this.offsetBy,
                        min_pip_value: this.min_pip_value,
                        api_class: this.api_class
                    })
                    if(data.error || data === null) {
                        this.showError = true
                    } else {
                        this.testResult = data
                        this.showTest=true
                    }
                } catch (error) {
                    this.showError = true
                }
            } else {
                this.showError = true
            }
        },
        formatMinAmount(){
            this.min_amount = this.min_amount.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
        },
        unformatMinAmount(){
            this.min_amount = this.min_amount.toString().replace(/,/gi, "")
        },
        formatMaxTier1(){
            this.maxTier1 = this.maxTier1.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
        },
        unformatMaxTier1(){
            this.maxTier1 = this.maxTier1.toString().replace(/,/gi, "")
        },
        formatMaxTier2(){
            this.maxTier2 = this.maxTier2.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
        },
        unformatMaxTier2(){
            this.maxTier2 = this.maxTier2.toString().replace(/,/gi, "")
        },
        formatNumber(value) {
            return parseFloat(value).toFixed(this.decimals)
        },
        unformatNumber(value) {
            return value.toString().replace(/,/gi, "")
        }
    },
}
</script>
