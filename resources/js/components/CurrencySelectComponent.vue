<template>
    <div class="form-group text-left">
        <label :class="`form-control-label ${showLabel ? '' : 'd-none'}`" :for="name">{{ label }}</label>
        <select
            :value="value"
            :class="`selectpicker form-control ${ error ? 'is-invalid' : '' }`"
            :data-style="`btn-${color} rounded-0`"
            :id="name"
            :name="name"
            @change="handleChange($event.target.value)"
        >
            <option v-if="defaultOptionLabel" value="" disabled selected>{{ defaultOptionLabel }}</option>
            <option
                v-for="currency in currencies"
                :key="`${currency.id}`"
                :value="currency.symbol"
                :data-content="`<img src='https://www.countryflags.io/${currency.country.abbr}/flat/32.png'> <span class='ml-2'> ${ currency.symbol }</span>`"
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
    name: 'CurrencySelectComponent',
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
        currencies: {
            type: Array,
            default: [],
        },
        value: {
            type: String,
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
