<template>
    <div class="form-group">
        <label
            :for="name"
        >
            {{ label }}
        </label>
        <input
            :type="type"
            :class="`form-control ${ error ? 'is-invalid' : '' }`"
            :id="name"
            :name="name"
            :aria-describedby="`${name}Help`"
            :value="value"
            :readonly="readonly"
            :disabled="disabled"
            @input="handleInput"
            @blur="handleBlur"
            @focus="handleFocus"
        >
        <small
            :id="`${name}Help`"
            class="form-text text-muted"
            v-if="hint && !error"
        >
            {{ hint }}
        </small>
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
    data: () => ({
        error: null
    }),
    props: {
        value: {
            type: [String, Number],
            default: ''
        },
        name: {
            type: String,
            default: ""
        },
        type: {
            type: String,
            default: "text",
        },
        label: {
            type: String,
            default: ''
        },
        hint: {
            type: String,
            default: ''
        },
        rules: {
            type: Array,
            default: () => []
        },
        disabled: {
            type: Boolean,
            default: false
        },
        readonly: {
            type: Boolean,
            default: false
        },
        blur: {
            type: Function,
            default: () => {}
        },
        focus: {
            type: Function,
            default: () => {}
        }
    },
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
        handleInput(e){
            this.hasError(e.target.value)
            this.$emit('input', e.target.value);
            this.hasError(e.target.value);
        },
        handleBlur(e){
            this.hasError(e.target.value);
            this.blur();
        },
        handleFocus(e){
            this.focus();
        }
    }
}
</script>

<style scoped>
</style>
