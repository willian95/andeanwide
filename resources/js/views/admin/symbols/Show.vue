<template>
    <div class="card bg-secondary shadow">
        <div class="card-header bg-secondary border-0">
            <div class="row align-items-center">
                <div class="col d-flex justify-content-between">
                    <h3 class="mb-0">{{ symbol.name }}</h3>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div
                class="alert alert-success alert-dismissible fade show"
                role="alert"
                v-if="showUpdateSuccess"
            >
                <span><strong>Actualización realizada con éxito.</strong></span>
                <button
                    type="button"
                    class="close"
                    aria-label="Close"
                    @click="showUpdateSuccess=false"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div
                class="alert alert-danger alert-dismissible fade show"
                role="alert"
                v-else-if="showUpdateError"
            >
                <span><strong>Ups! Algo sucedio, no se puede actualizar. Verifique la información ingresada y vuelva a intentar.</strong></span>
                <button
                    type="button"
                    class="close"
                    aria-label="Close"
                    @click="showUpdateError=false"
                >
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <FormComponent>
                <input type="hidden" name="_method" value="PUT">
                <input type="hidden" name="_token" :value="csrf_token">
                <div class="row">
                    <div class="col-6">
                        <InputComponent
                            :value="symbol.base.symbol"
                            label="Divisa base"
                            name="base_currency"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-6">
                        <InputComponent
                            :value="symbol.quote.symbol"
                            label="Divisa cotizada"
                            name="quote_currency"
                            :disabled="true"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <InputComponent
                            v-model="symbol.name"
                            label="Nombre"
                            name="name"
                            :rules="requireRules"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-6">
                        <SelectComponent
                            v-model="api_class"
                            name="api_class"
                            label="API"
                            :items="apis"
                            :rules="requireRules"
                            :disabled="!isEditable"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <CheckComponent
                            v-model="is_active"
                            label="El par esta activo"
                            name="is_active"
                            :disabled="!isEditable"
                        />
                    </div>
                    <div class="col-4">
                        <CheckComponent
                            v-model="is_default"
                            label="El par es por defecto"
                            name="is_default"
                            :disabled="!isEditable"
                        />
                    </div>
                    <div class="col-4">
                        <CheckComponent
                            v-model="showInverse"
                            label="Mostrar inverso"
                            name="show_inverse"
                            :disabled="!isEditable"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-4">
                        <InputComponent
                            v-model="maxTier1"
                            label="Monto Max. Verificación Nivel 1"
                            name="max_tier_1"
                            :rules="[...numericRules, ...maxLimitsRules]"
                            :blur="formatMaxTier1"
                            :focus="unformatMaxTier1"
                            hint="El valor de cero (0) implica que no tiene límite."
                            :disabled="!isEditable"
                        />
                    </div>
                    <div class="col-12 col-md-4">
                        <InputComponent
                            v-model="maxTier2"
                            label="Monto Max. Verificación Nivel 2"
                            name="max_tier_2"
                            :rules="[...numericRules, ...maxLimitsRules]"
                            :blur="formatMaxTier2"
                            :focus="unformatMaxTier2"
                            hint="El valor de cero (0) implica que no tiene límite." 
                            :disabled="!isEditable"
                        />
                    </div>
                    <div class="col-12 col-md-4">
                        <input type="hidden" name="decimals" :value="decimals">
                        <InputComponent
                            v-model="decimals"
                            label="Número de decimales"
                            name="decimals"
                            :rules="[...numericRules, ...maxLimitsRules]"
                            :disabled="!isEditable"
                        />
                    </div>
                </div>
                <div
                    v-if="is_default"
                    class="row"
                >
                    <div class="col-12">
                        <InputComponent
                            v-model="default_amount"
                            label="Monto a enviar (por defecto)"
                            name="default_amount"
                            :rules="[...numericRules]"
                            :disabled="!isEditable"
                            :blur="formatDefaultAmount"
                            :focus="unformatDefaultAmount"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <InputComponent
                            v-model="min_amount"
                            label="Monto mínimo a enviar"
                            name="min_amount"
                            :rules="[...numericRules]"
                            :disabled="!isEditable"
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
                            :rules="[...requireRules, ...numericRules]"
                            :disabled="!isEditable"
                        />
                    </div>
                    <div class="col-4">
                        <SelectComponent
                            v-model="offset_by"
                            name="offset_by"
                            label="Tipo de compensación"
                            item-text="label"
                            item-value="name"
                            :items="offsetTypes"
                            :rules="requireRules"
                            :disabled="!isEditable"
                        />
                    </div>
                    <div class="col-4">
                        <SelectComponent
                            v-model="min_pip_value"
                            name="min_pip_value"
                            label="Valor minimo de cambio"
                            :items="[1, 0.1, 0.01, 0.001, 0.0001]"
                            :rules="requireRules"
                            :disabled="!isEditable"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <TextareaComponent
                            v-model="observation"
                            name="observation"
                            label="Observaciones"
                            :disabled="!isEditable"
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
                                {{ symbol.base.symbol }}/{{ symbol.quote.symbol }}: 
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
                                {{ symbol.quote.symbol }}/{{ symbol.base.symbol }}: 
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
                <div
                    v-if="!isEditable"
                    class="row"
                >
                    <div class="col pt-2 pb-3">
                        <a
                            :href="indexRoute"
                            class="btn btn-outline-dark btn-block"
                        >
                            Ir al indice
                        </a>
                    </div>
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
                            class="btn btn-success btn-block"
                            @click.prevent="isEditable=true"
                        >
                            Editar Par
                        </button>
                    </div>
                </div>
                <div
                    v-else
                    class="row"
                >
                    <div class="col pt-2 pb-3">
                        <button
                            class="btn btn-danger btn-block"
                            @click.prevent="setSymbol"
                        >
                            Cancelar
                        </button>
                    </div>
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
                            class="btn btn-success btn-block"
                            @click.prevent="update"
                        >
                            Guardar
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
import SelectComponent from '../../../components/SelectComponent'
import CheckComponent from '../../../components/CheckComponent'
import TextareaComponent from '../../../components/TextareaComponent'
import { isNumeric } from 'validator'
import axios from 'axios'

export default {
    name: 'ShowSymbolView',
    components: {
        FormComponent,
        InputComponent,
        SelectComponent,
        CheckComponent,
        TextareaComponent,
    },
    props: {
        symbol: {
            type: Object,
            default: () => {}
        },
        apis: {
            type: Array,
            default: () => []
        },
        csrf_token: {
            type: String,
            default: ''
        },
        action: {
            type: String,
            default: ''
        },
        indexRoute: {
            type: String,
            default: ''
        }
    },
    data: () => ({
        name: null,
        api_class: null,
        min_pip_value: 1,
        offset_by: 'percentage',
        offset: 0,
        is_active: true,
        is_default: false,
        default_amount: 0,
        min_amount: 0,
        observation: '',
        showInverse: false,
        isEditable: false,
        decimals: 4,
        maxTier1: 0,
        maxTier2: 0,
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
        requireRules: [
            v => !!v || 'Este campo es requerido',
        ],
        numericRules: [
            v => isNumeric(v.replace(/,/gi, "")) || 'Este campo deber ser numérico.'
        ],
        maxLimitsRules: [
            v => v.toString().replace(/,/gi, "")>=0 || 'El valor de este campo de ser mayor o igual a cero.'
        ],
        showTest: false,
        showError: false,
        showUpdateError: false,
        showUpdateSuccess: false,
    }),
    methods: {
        setSymbol(){
            this.name = this.symbol.name
            this.api_class = this.symbol.api_class
            this.min_pip_value = this.symbol.min_pip_value
            this.offset_by = this.symbol.offset_by
            this.offset = this.symbol.offset
            this.observation = this.symbol.observation
            this.is_active = this.symbol.is_active
            this.is_default = this.symbol.is_default
            this.default_amount = this.symbol.default_amount
            this.min_amount = this.symbol.min_amount
            this.showInverse = this.symbol.show_inverse
            this.decimals = this.symbol.decimals
            this.maxTier1 = this.symbol.max_tier_1
            this.maxTier2 = this.symbol.max_tier_2
            this.isEditable = false
            this.formatMinAmount()
            this.formatDefaultAmount()
        },
        async testApi(){
            this.showTest = false
            this.showError = false
            if(
                this.symbol.offset !== undefined &&
                this.symbol.offset_by &&
                this.symbol.min_pip_value &&
                this.symbol.api_class
            ){
                try {
                    const { data } = await axios.post(`/exchange_rate/${this.symbol.base.symbol}/${this.symbol.quote.symbol}/test`, {
                        offset: this.offset,
                        offset_by: this.offset_by,
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
        async update () {
            this.showUpdateError = false
            this.showUpdateSuccess = false
            this.isEditable = false
            try {
                const { data } = await axios.put(this.action, {
                    offset_by: this.offset_by,
                    offset: this.offset,
                    min_pip_value: this.min_pip_value,
                    observation: this.observation,
                    api_class: this.api_class,
                    is_active: this.is_active,
                    is_default: this.is_default,
                    default_amount: this.default_amount.replace(/,/gi, ""),
                    min_amount: this.min_amount.replace(/,/gi, ""),
                    show_inverse: this.showInverse,
                    decimals: this.decimals,
                    max_tier_1: this.unformatNumber(this.maxTier1),
                    max_tier_2: this.unformatNumber(this.maxTier2)
                })
                this.showUpdateSuccess = true
                this.is_default = data.symbol.is_default
            } catch (error) {
                this.showUpdateError = true
            }
        },
        formatMinAmount(){
            this.min_amount = this.min_amount.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
        },
        unformatMinAmount(){
            this.min_amount = this.min_amount.toString().replace(/,/gi, "")
        },
        formatDefaultAmount(){
            this.default_amount = this.default_amount.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
        },
        unformatDefaultAmount(){
            this.default_amount = this.default_amount.toString().replace(/,/gi, "")
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
    mounted(){
        this.setSymbol()
    }
}
</script>
