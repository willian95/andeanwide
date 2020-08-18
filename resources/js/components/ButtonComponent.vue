<template>
    <button
        :class="`btn btn-${color} btn-${size} ${block ? 'btn-block' : ''}`"
        @click="click"
    >
        <slot></slot>
    </button>
</template>

<script>
export default {
    props: {
        // label: {
        //     type: String,
        //     default: 'Button'
        // },
        color: {
            type: String,
            default: ''
        },
        size: {
            type: String,
            default: ''
        },
        block: {
            type: Boolean,
            default: false
        },
        click: {
            type: Function,
            default: () => {}
        }
    }
}
</script>
