<template>
    <FormComponent
        method="POST"
        :action="action"
        @submitFunction="register"
    >
        <input type="hidden" name="_token" :value="csrf_token">
        <InputComponent
            v-model="email"
            type="text"
            label="Correo Electronico"
            name="email"
            :rules="emailRules"
        />
        <InputComponent
            v-model="password"
            type="password"
            label="Contraseña"
            name="password"
            :rules="passwordRules"
        />
        <InputComponent
            v-model="passwordConfirmation"
            type="password"
            label="Confirmar contraseña"
            name="password_confirmation"
            :rules="passwordConfirmationRules"
        />
        <InputComponent
            v-model="phone"
            type="text"
            label="Telefono"
            name="phone"
            :rules="requiredRules"
        />
        <SelectComponent
            v-model="country"
            name="country_id"
            label="Pais"
            :items="countries"
            item-text="name"
            item-value="id"
            :rules="requiredRules"
        />
        <div class="row">
            <div class="col pt-2 pb-3">
                <button
                    type="submit"
                    class="btn btn-primary btn-block"
                >
                    Registar
                </button>
            </div>
        </div>
    </FormComponent>
</template>

<script>
import FormComponent from '../components/FormComponent'
import InputComponent from '../components/InputComponent'
import SelectComponent from '../components/SelectComponent';
import { isEmail } from 'validator';

export default {
    components: {
        FormComponent,
        InputComponent,
        SelectComponent
    },
    data: () => ({
        email: '',
        emailRules: [
            v => !!v || 'Este campo es requerido',
            v => isEmail(v) || 'El campo correo electrónico debe tener formato de correo valido.'
        ],
        password: '',
        passwordRules: [
            v => !!v || 'Este campo es requerido',
            v => /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[!@#\$%\^&\*])(?=.{8,})/.test(v) || 'El campo contraseña debe tener al menos 8 caracteres, entre mayúscula, minúscula, números y un carácter especial.',
        ],
        passwordConfirmation: '',
        passwordConfirmationRules: [
            v => !!v || 'Este campo es requerido',
        ],
        country: null,
        phone: null,
        requiredRules: [
            v => !!v || 'Este campo es requerido',
        ]
    }),
    props: {
        action: {
            type: String,
            default: '',
        },
        csrf_token:{
            type: String,
            default: '',
        },
        countries: {
            type: Array,
            default: () => []
        }
    },
    methods: {
        register() {
            // console.log('Hi')
        },
    },
    mounted(){
        this.passwordConfirmationRules.push(
            v => v === this.password || 'El campo confirmar contraseña de coincidir con contraseña'
        )
    }
}
</script>

<style scoped>
    input {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 1.3em;
    }
</style>
