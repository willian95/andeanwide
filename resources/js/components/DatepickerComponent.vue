<template>
    <div>
        <label
            v-if="label"
            :for="name"
        >
            {{ label }}<span v-if="required">*</span>
        </label>
        <Datepicker
            :value="value"
            :name="name"
            :id="name"
            :input-class="`form-control ${ error ? 'is-invalid' : '' }`"
            wrapper-class="form-group"
            :placeholder="placeholder"
            format="dd/MM/yyyy"
            @input="handleInput"
        >
            <span slot="afterDateInput">
                <small
                    :id="`${name}Help`"
                    class="form-text text-muted"
                    v-if="hint && !error"
                >
                    {{ hint }}
                </small>
                <small
                    v-if="error"
                    class="text-danger mt-1 d-inline-block"
                >
                    {{ error }}
                </small>
            </span>
        </Datepicker>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker'

export default {
    name: 'DatepickerComponent',
    components: {
        Datepicker
    },
    props: {
        name: {
            type: String,
            deafult: ''
        },
        placeholder: {
            type: String,
            default: ''
        },
        rules: {
            type: Array,
            default: () => []
        },
        label: {
            type: String,
            default: ''
        },
        required: {
            type: Boolean,
            default: false
        },
        value: {
            type: Date,
            default: () => {}
        },
        hint: {
            type: String,
            default: ''
        }
    },
    data: () => ({
        error: null
    }),
    methods: {
        hasError(value) {
            for(const rule of this.rules){
                let error = rule(value);
                if(error != true) {
                    this.error = error;
                    return ;
                }
            }
            this.error = null;
        },
        handleInput(value){
            this.hasError(value)
            this.$emit('input', value);
            this.hasError(value);
        },
        handleBlur(e){
            // this.hasError(e.target.value);
        },
    }
}
</script>