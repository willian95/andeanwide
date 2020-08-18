<template>
    <div class="form-group">
        <label
            :for="name"
        >
            {{ label }}
        </label>
        <select
            :id="name"
            :name="name"
            :value="value"
            :class="`form-control ${ error ? 'is-invalid' : '' }`"
            :aria-describedby="`${name}Help`"
            :readonly="readonly"
            :disabled="disabled"
            @change="handleChange"
            @blur="hasError($event.target.value)"
        >
            <option
                v-for="(item, index) in items"
                :key="index"
                :value="!!itemValue ? item[itemValue] : item"
            >
                {{ !!itemText ? printText(item, itemText) : item }}
            </option>
        </select>
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
            type: [String, Number, Object],
            default: ''
        },
        items: {
            type: Array,
            default: () => []
        },
        itemText: {
            type: [String, Array],
            default: ''
        },
        itemValue: {
            type: String,
            default: ''
        },
        name: {
            type: String,
            default: ""
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
        handleChange(e){
            this.$emit('input', e.target.value);
            this.hasError(e.target.value);
        },  
        printText(item, itemText) {
            if(typeof itemText === 'object') {
                let result = ''
                for(let text of itemText) {
                    if(result) result = `${result} | ${item[text]}`
                    else result = item[text]
                }
                return result
            }
            return item[itemText]
        }
    }
}
</script>
