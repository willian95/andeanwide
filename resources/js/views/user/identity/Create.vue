<template>
    <FormComponent
        :action="action"
        method="POST"
        enctype="multipart/form-data"
    >
        <input type="hidden" name="_token" :value="csrf">
        <input type="hidden" name="user_id" :value="user.id">
        <div class="row">
            <div class="col-12 col-sm-6">
                <SelectComponent
                    v-model="country_id"
                    name="country_id"
                    label="País emisor del documento*"
                    :items="countries"
                    item-text="name"
                    item-value="id"
                    :rules="requireRules"
                />
            </div>
            <div class="col-12 col-sm-6">
                <InputComponent
                    v-model="nationality"
                    label="Nacionalidad*"
                    name="nationality"
                    :rules="requireRules"
                />
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6">
                <SelectComponent
                    v-model="document_type"
                    name="document_type"
                    label="Tipo de Documento*"
                    :items="document_types"
                    item-text="label"
                    item-value="name"
                    :rules="requireRules"
                />
            </div>
            <div class="col-12 col-sm-6">
                <SelectComponent
                    v-model="gender"
                    name="gender"
                    label="Género*"
                    :items="genders"
                    item-text="label"
                    item-value="name"
                    :rules="requireRules"
                />
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6">
                <InputComponent
                    v-model="dni_number"
                    label="Número de Documento*"
                    name="dni_number"
                    :rules="requireRules"
                />
            </div>
            <div class="col-12 col-sm-6">
                <InputComponent
                    v-model="validation_number"
                    label="Número de Validación"
                    name="validation_number"
                />
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-4">
                    <input type="hidden" name="issue_date" :value="issueDateComputed" />
                <DatepickerComponent
                    v-model="issue_date"
                    label="Fecha de Emisión"
                    name="issueDate"
                    required
                    placeholder="Fecha de Emisión"
                    :rules="[...requireRules, ...issueRules]"
                />
            </div>
            <div class="col-12 col-sm-4">
                <input type="hidden" name="expiration_date" :value="expirationDateComputed" />
                <DatepickerComponent
                    v-model="expiration_date"
                    label="Fecha de Expiración"
                    name="expirationDate"
                    required
                    placeholder="Fecha de Expiración"
                    :rules="[...requireRules, ...expirationRules]"
                />
            </div>
            <div class="col-12 col-sm-4">
                <input type="hidden" name="dob" :value="dobComputed" />
                <DatepickerComponent
                    v-model="dob"
                    label="Fecha de Nacimiento"
                    name="dob-e"
                    required
                    placeholder="Fecha de Nacimiento"
                    :rules="[...requireRules, ...dobRules]"
                />
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6">
                <InputComponent
                    v-model="first_name"
                    label="Primer Nombre*"
                    name="first_name"
                    :rules="requireRules"
                />
            </div>
            <div class="col-12 col-sm-6">
                <InputComponent
                    v-model="middle_name"
                    label="Segundo Nombre"
                    name="middle_name"
                />
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6">
                <InputComponent
                    v-model="last_name"
                    label="Primer Apellido*"
                    name="last_name"
                    :rules="requireRules"
                />
            </div>
            <div class="col-12 col-sm-6">
                <InputComponent
                    v-model="second_surname"
                    label="Segundo Apellido"
                    name="second_surname"
                />
            </div>
            <div class="col-12">
                <InputImageComponent
                    v-model="front_image"
                    label="Imagen de documento de identidad - Frente"
                    name="front_image"
                    :required="true"
                    :rules="requireRules"
                />
            </div>
            <div class="col-12"
                v-if="document_type === 'dni' || document_type === 'driver_license'"
            >
                <InputImageComponent
                    v-model="back_image"
                    label="Imagen de documento de identidad - Reverso"
                    name="back_image"
                    :required="true"
                    :rules="requireIfRules"
                />
            </div>
        </div>
        <div class="row">
            <div class="col pt-2 pb-3">
                <button
                    type="submit"
                    class="btn btn-success btn-block"
                    formenctype="multipart/form-data"
                >
                    Guardar
                </button>
            </div>
        </div>
    </FormComponent>
</template>

<script>
import FormComponent from '../../../components/FormComponent'
import InputComponent from '../../../components/InputComponent'
import SelectComponent from '../../../components/SelectComponent'
import DatepickerComponent from '../../../components/DatepickerComponent'
import InputImageComponent from '../../../components/InputImageComponent'
import moment from 'moment'
import { isDate } from 'validator'

export default {
    name: 'CreateIdentityView',
    components: {
        FormComponent,
        InputComponent,
        SelectComponent,
        DatepickerComponent,
        Datepicker,
        InputImageComponent,
    },
    props: {
        user: {
            type: Object,
            default: () => {}
        },
        countries: {
            type: Array,
            default: () => []
        },
        csrf: {
            type: String,
            default: ''
        },
        action: {
            type: String,
            defualt: ''
        }
    },
    data: () => ({
        country_id: null,
        nationality: null,
        document_type: null,
        gender: null,
        dni_number: null,
        validation_number: null,
        issue_date: null,
        expiration_date: null,
        dob: null,
        first_name: null,
        middle_name: null,
        last_name: null,
        second_surname: null,
        front_image: null,
        back_image: null,
        requireRules: [
            v => !!v || 'Este campo es requierido.'
        ],
        dobRules: [
            v => {
                const now = moment(new Date())
                const dob = moment(v)
                const years = moment.duration(now.diff(dob)).asYears()
                return years >= 18 || 'Debe ser mayor de edad para registarse.'
            } 
        ],
        expirationRules: [
            v => {
                const now = moment()
                const dt = moment(v)
                const days = Math.ceil(moment.duration(dt.diff(now)).asDays())
                return days >= 0 || 'Su documento ha expirado.'
            }
        ],
        issueRules: [
            v => {
                const now = moment()
                const dt = moment(v)
                const days = Math.floor(moment.duration(now.diff(dt)).asDays())
                return days >= 0 || 'La fecha de emisión no es valida.'
            }
        ],
        requireIfRules: [],
        document_types: [
            {
                label: 'Documento de Identidad Nacional',
                name: 'dni',
            },
            {
                label: 'Passporte',
                name: 'passport',
            },
            {
                label: 'Licencia de conducir',
                name: 'driver_license',
            }
        ],
        genders: [
            {
                label: 'Masculino',
                name: 'M'
            },
            {
                label: 'Femenino',
                name: 'F'
            },
            {
                label: 'N/A',
                name: 'Unknown'
            },
        ]
    }),
    computed: {
        duration(){
            if(this.dob){
                const dob = moment(this.dob)
                const now = moment(new Date())
                const days = moment.duration(now.diff(dob))
                return days.asYears()
            }
            return null
        },
        issueDateComputed(){
            if(this.issue_date instanceof Date) {
                return new Date(this.issue_date).toISOString()
            }
            return false
        },
        expirationDateComputed(){
            if(this.expiration_date instanceof Date) {
                return new Date(this.expiration_date).toISOString()
            }
            return false
        },
        dobComputed(){
            if(this.dob instanceof Date) {
                return new Date(this.dob).toISOString()
            }
            return false
        }
    },
    mounted(){
        this.requireIfRules.push(v => {
            if(this.document_type === 'dni' || this.document_type === 'driver_license'){
                return !!v || 'Este campo es requerido'
            }
            return true
        })
    }
}
</script>
