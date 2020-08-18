<template>
    <div
        v-if="showAlert"
        :class="`alert alert-${color}`"
        role="alert"
    >
        <slot></slot>
        <button
            v-if="dismissible" 
            type="button" 
            class="close" 
            aria-label="Close" 
            @click="close"
        >
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</template>

<script>
export default {
    props: {
        color: {
            type: String,
            default: 'primary'
        },
        showAlert: {
            type: Boolean,
            default: false,
        },
        dismissible: {
            type: Boolean,
            default: true,
        }
    },
    methods: {
        close(){
            this.$emit('close');
        }
    }
}
</script>
