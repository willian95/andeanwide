<template>
    <FormComponent :submitFunction="handleSubmit">
        <AlertComponent
            :showAlert="showAlert"
            :color="alertColor"
            @close="showAlert=false"
        >
            {{ alert }}
        </AlertComponent>
        <InputComponent
            v-model="name"
            type="text"
            label="Nombres"
            name="name"
            hint="Este campo es obligatorio."
            :rules="requiredRules"
            :readonly="isSending ? true : false"
        />
        <InputComponent
            v-model="email"
            type="text"
            label="Correo Electronico"
            name="email"
            hint="Este campo es obligatorio."
            :rules="emailRules"
            :readonly="isSending ? true : false"
        />
        <InputComponent
            v-model="subject"
            type="text"
            label="Asunto"
            name="subject"
            hint="Este campo es obligatorio."
            :rules="requiredRules"
            :readonly="isSending ? true : false"
        />
        <TextareaComponent
            v-model="content"
            label="Mensaje"
            name="content"
            hint="Este campo es obligatorio."
            :rules="requiredRules"
            :rows="5"
            :readonly="isSending ? true : false"
        />
        <ButtonComponent
            :color="isSending ? 'success' : 'outline-success'"
            block
        >
            <span v-if="isSending">
                <span class="spinner-border spinner-border-sm mr-2" role="status" aria-hidden="true"></span>
                Enviando...
            </span>
            <span v-else>
                Enviar Mensaje
            </span>
        </ButtonComponent>
    </FormComponent>
</template>

<script>
import InputComponent from '../components/InputComponent'
import TextareaComponent from '../components/TextareaComponent'
import ButtonComponent from '../components/ButtonComponent'
import FormComponent from '../components/FormComponent'
import AlertComponent from '../components/AlertComponent'
import axios from 'axios'
import { isEmail } from 'validator'

export default {
    components: {
        InputComponent,
        TextareaComponent,
        ButtonComponent,
        FormComponent,
        AlertComponent
    },
    data: () => ({
        isSending: false,
        name: '',
        email: '',
        subject: '',
        content: '',
        alert: '',
        showAlert: false,
        alertColor: 'success',
        requiredRules: [
            v => !!v || 'Este campo es requerido'
        ],
        emailRules: [
            v => !!v || 'Este campo es requerido',
            v => isEmail(v) || 'El valor introducido no tiene formato de correo valido.'
        ]
    }),
    props: {
        url: {
            type: String,
            default: ''
        }
    },
    methods: {
        async handleSubmit() {
            this.isSending = true;
            try {
                const { data } = await axios.post(this.url, {
                    name: this.name,
                    email: this.email,
                    subject: this.subject,
                    content: this.content,
                });
                this.showAlert = true;
                this.alertColor = 'success'
                this.alert = 'Su mensaje fue enviado satisfactoriamente.'
                this.isSending = false;
            } catch (error) {
                this.showAlert = true;
                this.alertColor = 'danger'
                this.alert = 'Su mensaje no pudo ser enviado.'
                this.isSending = false;
            }
        }
    }
}
</script>

<style scoped>
    input {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 1.3em;
    }
</style>
