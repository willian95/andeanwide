<template>
    <div class="card bg-secondary shadow">
        <div class="card-header bg-secondary border-0">
            <div class="row align-items-center">
                <div class="col d-flex justify-content-between">
                    <h3 class="mb-0">Crear Nueva Divisa</h3>
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
                    <div class="col-12">
                        <CountrySelectComponent
                            v-model="country_id"
                            label="País"
                            name="country_id"
                            color="none"
                            :countries="countries"
                            defaultOptionLabel="Selecciona un país"
                            :rules="requiredRules"
                        />
                    </div>
                    <div class="col-12">
                        <InputComponent
                            v-model="name"
                            label="Nombre de la Divisa"
                            name="name"
                            :rules="requiredRules"
                        />
                    </div>
                    <div class="col-12">
                        <InputComponent
                            v-model="symbol"
                            label="Simbolo"
                            name="symbol"
                            :rules="requiredRules"
                        />
                    </div>
                    <div class="col-6">
                        <InputComponent
                            v-model="more_country_id"
                            label="Codigo de País en More"
                            name="more_country_id"
                            :rules="numericRules"
                        />
                    </div>
                    <div class="col-6">
                        <InputComponent
                            v-model="more_city_id"
                            label="Código de Ciudad de More"
                            name="more_city_id"
                            :rules="numericRules"
                        />
                    </div>
                    <div class="col-12">
                        <CheckComponent
                            v-model="can_send"
                            label="Se pueden hacer envios en esta divisa."
                            name="can_send"
                        />
                    </div>
                    <div class="col-12">
                        <CheckComponent
                            v-model="can_receive"
                            label="Se puede recibir dinero en esta divisa."
                            name="can_receive"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col pt-2 pb-3">
                        <a :href="indexRoute" class="btn btn-dark btn-block">
                            Ir al indice
                        </a>
                    </div>
                    <div class="col pt-2 pb-3">
                        <button
                            type="submit"
                            class="btn btn-success btn-block"
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
import CountrySelectComponent from '../../../components/CountrySelectComponent'
import SelectComponent from '../../../components/SelectComponent'
import CheckComponent from '../../../components/CheckComponent'
import { isNumeric } from 'validator'

export default {
    name: 'CreateCurrency',
    components: {
        FormComponent,
        InputComponent,
        SelectComponent,
        CheckComponent,
        CountrySelectComponent
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
        countries: {
            type: Array,
            default: () => []
        },
        indexRoute: {
            type: String,
            default: ''
        }
    },
    data: () => ({
        country_id: null,
        name: '',
        symbol: '',
        more_country_id: '',
        more_city_id: '',
        can_send: true,
        can_receive: true,
        requiredRules: [
            v => !!v || 'Este campo es requerido',
        ],
        numericRules: [
            v => {
                if(v) {
                    return isNumeric(v.toString()) || 'Este campo deber ser numérico.'
                }
                return
            }
        ],
    })
}
</script>
