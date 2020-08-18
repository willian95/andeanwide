<template>
    <form
        ref="form"
        :method="method"
        :action="action"
        @submit.prevent="handleSubmit"
        :enctype="enctype"
        novalidate
    >
        <slot></slot>
    </form>
</template>

<script>
export default {
    props: {
        submitFunction: {
            type: Function,
            default: () => {}
        },
        method: {
            type: String,
            default: ''
        },
        action: {
            type: String,
            default: ''
        },
        enctype: {
            type: String,
            default: 'application/x-www-form-urlencoded'
        }
    },
    data: () => ({
        isValid: true
    }),
    methods: {
        async handleSubmit(e){
            this.isValid = true;
            this.$slots.default.forEach(vnode => {
                this.hasError(vnode)
            })
            if(this.isValid){
                await this.submitFunction()
                if(this.method && this.action) {
                    this.$refs.form.submit()
                }
            }
        },
        hasError(vnode){
            if(vnode.componentInstance && vnode.componentInstance.hasError){
                vnode.componentInstance.hasError(vnode.componentInstance.value);
                if(vnode.componentInstance.error) {
                    // console.log(vnode.componentInstance)
                    this.isValid = false
                }
            } else if(vnode.children) {
                vnode.children.forEach(child => this.hasError(child))
            }
        }
    }
}
</script>
