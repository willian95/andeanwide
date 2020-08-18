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
                    label="País de residencia*"
                    :items="countries"
                    item-text="name"
                    item-value="id"
                    :rules="requireRules"
                />
            </div>
            <div class="col-12 col-sm-6">
                <InputComponent
                    v-model="state"
                    label="Estado/Región/Provincia*"
                    name="state"
                    :rules="requireRules"
                />
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-6">
                <InputComponent
                    v-model="city"
                    label="Ciudad*"
                    name="city"
                    :rules="requireRules"
                />
            </div>
            <div class="col-12 col-sm-6">
                <InputComponent
                    v-model="cod"
                    label="Código postal*"
                    name="cod"
                    :rules="requireRules"
                />
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <InputComponent
                    v-model="address"
                    label="Dirección*"
                    name="address"
                    :rules="requireRules"
                />
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <InputComponent
                    v-model="address_ext"
                    label="Dirección (Continuación)"
                    name="address_ext"
                />
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <InputImageComponent
                    v-model="image"
                    label="Imagen de prueba de residencia"
                    name="image"
                    :required="true"
                    :rules="requireRules"
                />
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <button
                    type="submit"
                    class="btn btn-success btn-block"
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
import InputImageComponent from '../../../components/InputImageComponent'

export default {
    name: 'CreateAddressView',
    components: {
        FormComponent,
        InputComponent,
        SelectComponent,
        InputImageComponent
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
        state: null,
        city: null,
        cod: null,
        address: null,
        address_ext: null,
        image: null,
        requireRules: [
            v => !!v || 'Este campo es requierido.'
        ],
    }),
    methods: {
        
    }
}
</script>
