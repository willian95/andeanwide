<template>
    <div>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#createRecipientModal">
            <i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>
            Crear Beneficiario
        </button>

        <!-- Modal -->
        <div class="modal fade" id="createRecipientModal" tabindex="-1" role="dialog" aria-labelledby="createRecipientModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <FormComponent
                        method="POST"
                        :action="createRecipientRoute"
                    >
                        <input type="hidden" :value="csrf" name="_token">
                        <input v-if="orderId" type="hidden" :value="orderId" name="order_id">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createRecipientModalLabel">CREAR BENEFICIARIO</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body pb-0">
                            <div class="row">
                                <div
                                    v-if="countries.length > 0"
                                    class="col-12 col-md-6"
                                >
                                    <SelectComponent
                                        v-model="country_id"
                                        label="País*"
                                        name="country_id"
                                        items="countries"
                                        item-text="name"
                                        item-value="id"
                                        :rules="requiredRules"
                                    />
                                </div>
                                <div
                                    v-else-if="preSelectedCountryId && preSelectedCountryName"
                                    class="col-12 col-md-6"
                                >
                                    <input type="hidden" :value="preSelectedCountryId" name="country_id">
                                    <InputComponent
                                        :value="preSelectedCountryName"
                                        label="País"
                                        name="country_name"
                                        :disabled="true"
                                    />
                                </div>
                                <div class="col-12 col-md-6">
                                    <InputComponent
                                        v-model="dni"
                                        label="Número de Documento de Identidad*"
                                        name="dni"
                                        :rules="requiredRules"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <InputComponent
                                        v-model="name"
                                        label="Nombres*"
                                        name="name"
                                        :rules="requiredRules"
                                    />
                                </div>
                                <div class="col-12 col-md-6">
                                    <InputComponent
                                        v-model="lastname"
                                        label="Apellidos*"
                                        name="lastname"
                                        :rules="requiredRules"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <InputComponent
                                        v-model="bank_name"
                                        label="Banco*"
                                        name="bank_name"
                                        :rules="requiredRules"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <InputComponent
                                        v-model="code"
                                        label="IBAN/SWIFT*"
                                        name="code"
                                        :rules="requiredRules"
                                    />
                                </div>
                                <div class="col-12 col-md-6">
                                    <InputComponent
                                        v-model="bank_account"
                                        label="Numero de Cuenta*"
                                        name="bank_account"
                                        :rules="requiredRules"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 col-md-6">
                                    <InputComponent
                                        v-model="email"
                                        label="Correo Electrónico*"
                                        name="email"
                                        :rules="emailRules"
                                    />
                                </div>
                                <div class="col-12 col-md-6">
                                    <InputComponent
                                        v-model="phone"
                                        label="Numero Telefónico*"
                                        name="phone"
                                        :rules="requiredRules"
                                    />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <InputComponent
                                        v-model="address"
                                        label="Dirección*"
                                        name="address"
                                        :rules="requiredRules"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="submit"
                                class="btn btn-success btn-block"
                            >
                                <i class="fa fa-plus-circle mr-2" aria-hidden="true"></i>
                                Crear
                            </button>
                        </div>
                    </FormComponent>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import FormComponent from './FormComponent'
import InputComponent from './InputComponent'
import SelectComponent from './SelectComponent'
import { isEmail } from 'validator'

export default {
    name: 'CreateRecipientComponent',
    components: {
        FormComponent,
        InputComponent,
        SelectComponent,
    },
    props: {
        createRecipientRoute: {
            type: String,
            default: ''
        },
        preSelectedCountryId: {
            type: [String, Number],
            default: ''
        },
        preSelectedCountryName: {
            type: String,
            default: ''
        },
        countries: {
            type: Array,
            default: () => []
        },
        csrf: {
            type: String,
            default: ''
        },
        orderId: {
            type: [String, Number],
            default: ''
        }
    },
    data: () => ({
        name: null,
        lastname: null,
        country_id: null,
        dni: null,
        bank_name: null,
        bank_account: null,
        code: null,
        email: null,
        phone: null,
        address: null,
        requiredRules: [
            v => !!v || 'Este campo es requerido.'
        ],
        emailRules: [
            v => !!v || 'Este campo es requerido.',
            v => isEmail(v) || 'Este campo debe tener un formato de correo electrónico válido.'
        ]
    }),
    created() {
        this.country_id = this.preSelectedCountryId
    }
}
</script>
