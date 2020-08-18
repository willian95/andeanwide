<template>
    <div class="form-group text-left">
        <label class="form-control-label" :for="name"> {{ label }}</label>
        <div class="input-group">
            <input
                :value="value"
                type="text"
                class="form-control rounded-0 h-100"
                :id="name"
                :name="name"
                @input="handleInput($event.target.value)"
                @keydown="handleKeyDown"
                @blur="handleBlur"
            >
            <div
                v-if="symbol"
                class="input-group-append"
            >
                <span class="input-group-text">{{ symbol }}</span>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CurrencyInputComponent',
    props: {
        label: {
            type: String,
            default: ''
        },
        symbol: {
            type: String,
            default: ''
        },
        error: {
            type: String,
            default: '',
        },
        name: {
            type: String,
            default: 'currencyInput',
        },
        value: {
            type: [String, Number],
            default: ""
        },
        changed: {
            type: Function,
            default: () => {},
        }
    },
    data: () => ({
        // content: this.value,
    }),
    methods: {
        handleKeyDown(e) {
            const charValue= String.fromCharCode(e.keyCode);
            if(isNaN(charValue) && (e.which != 8 ) || (e.which == 32)) {
                e.preventDefault();
            }
            return true;
        },
        handleInput(value) {
            let newValue = value
            newValue = newValue.replace(/,/gi, "");
            newValue = parseFloat(newValue).toFixed(0);
            if(isNaN(newValue)) {
                return '0';
            }
            newValue = new Intl.NumberFormat('en-US', {style: 'decimal'}).format(newValue)
            this.$emit('input', newValue);
            this.changed();
        },
        handleBlur(e){
            if(e.target.value === ''){
                console.log('blur')
                this.handleInput('0');
            }
        }
    },
}
</script>

<style scoped>
    input {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 1.55rem;
        padding-bottom: 10px;
        padding-top: 13px;
    }
</style>
