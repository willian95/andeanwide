<template>
    <div class="form-group form-check">
        <input
            type="checkbox"
            class="form-check-input"
            :checked="value"
            :id="name"
            :name="name"
            :disabled="disabled"
            @change="handleChange"
            value="1"
        >
        <label
            class="form-check-label"
            :for="name"
        >
            {{ label }}
        </label>
    </div>
</template>

<script>
export default {
    props: {
        label: {
            type: String,
            default: ''
        },
        name: {
            type: String,
            default: ''
        },
        disabled: {
            type: Boolean,
            default: false
        },
        value: {
            type: [Boolean, Number],
            default: false,
        }
    },
    methods: {
        handleChange(){
            this.$emit('input', !this.value)
        }
    }
}
</script>
