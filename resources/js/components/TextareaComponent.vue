<template>
    <div class="form-group">
        <label
            :for="name"
        >
            {{ label }}
        </label>
        <textarea
            :class="`form-control ${ error ? 'is-invalid' : '' }`"
            :id="name"
            :name="name"
            :aria-describedby="`${name}Help`"
            :rows="rows"
            :value="value"
            :readonly="readonly"
            :disabled="disabled"
            @input="handleInput"
            @blur="hasError($event.target.value)"
        >
        </textarea>
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
        rows: {
            type: [Number, String],
            default: 3,
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
            this.$emit('input', e.target.value);
            this.hasError(e.target.value);
        }
    }
}
</script>

<style scoped>
    input {
        padding-bottom: 0;
    }
</style>
