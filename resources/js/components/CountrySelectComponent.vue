<template>
    <div class="form-group text-left">
        <label :class="`form-control-label ${showLabel ? '' : 'd-none'}`" :for="name">{{ label }}</label>
        <select
            :value="value"
            :class="`selectpicker form-control ${ error ? 'is-invalid' : '' }`"
            :data-style="`btn-${color} rounded-0`"
            :id="name"
            :name="name"
            :disabled="disabled"
            @change="handleChange($event.target.value)"
        >
            <option v-if="defaultOptionLabel" value="" disabled selected>{{ defaultOptionLabel }}</option>
            <option
                v-for="country in countries"
                :key="`${country.id}`"
                :value="country.id"
                :data-content="`<img src='https://www.countryflags.io/${country.abbr}/flat/32.png'> <span class='ml-2'> ${ country.name }</span>`"
            >
            </option>
        </select>
        <div
            class="invalid-feedback"
            v-if="error"
        >
            {{ error }}
        </div>
    </div>
</template>

<script>
export default {
    name: 'CountrySelectComponent',
    props: {
        label: {
            type: String,
            default: '',
        },
        name: {
            type: String,
            default: '',
        },
        defaultOptionLabel: {
            type: String,
            default: 'Selecciona'
        },
        countries: {
            type: Array,
            default: [],
        },
        value: {
            type: [String, Number],
            default: ""
        },
        changed: {
            type: Function,
            default: () => {},
        },
        color: {
            type: String,
            default: 'primary'
        },
        showLabel: {
            type: Boolean,
            default: true
        },
        rules: {
            type: Array,
            default: () => []
        },
        disabled: {
            type: Boolean,
            default: false
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
        handleChange(value){
            this.hasError(value);
            this.$emit('input', value);
            this.changed();
        },
    }
}
</script>

<style scoped>
    .invalid-feedback {
        display: block;
    }
    .btn {
        background: red;
    }
</style>
