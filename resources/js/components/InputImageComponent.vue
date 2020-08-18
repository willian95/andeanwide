<template>
    <div>
        <input 
            type="file"
            class="d-none"
            ref="imageInput"
            :id="name"
            :name="name"
            accept="image/*"
            @change="handleChange"
        >
        <div
            v-if="!value"
            class="form-group"
        >
            <label>{{ label }}<span v-if="required">*</span>
            </label>
            <br>
            <button
                :class="`btn btn-success`"
                @click.prevent="handleClick"
            >
                Seleccionar Archivo
            </button>

            <span>
                Ningun archivo seleccionado
            </span>
            <br>
            <small
                :id="`${name}Help`"
                class="form-text text-muted"
                v-if="hint && !error"
            >
                {{ hint }}
            </small>
            <small
                v-if="error"
                class="text-danger mt-1 d-inline-block"
            >
                {{ error }}
            </small>
        </div>
        <div
            v-else
        >
            <div class="form-group">
                <label>
                    {{ label }}
                </label>
                <div>
                    <button type="button" class="btn btn-success" data-toggle="modal" :data-target="`#${name}Modal`">
                        Ver imagen
                    </button>

                    <span>
                        {{ fileName }}
                    </span>

                    <!-- Modal -->
                    <div class="modal fade" :id="`${name}Modal`" tabindex="-1" role="dialog" :aria-labelledby="`${name}ModalLabel`" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" :id="`${name}ModalLabel`">{{label}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <img
                                        :src="url"
                                        class="img-fluid"
                                        :alt="label"
                                        width="100%"
                                    />
                                </div>
                            </div>
                        </div>
                    </div>

                    <button
                        type="button"
                        class="close btn-delete"
                        @click.prevent="deleteImage"
                    >
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'InputImageComponent',
    props: {
        value: {
            type: [Object, String, File],
            default: () => {}
        },
        label: {
            type: String,
            default: ''
        },
        name: {
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
        required: {
            type: Boolean,
            defaut: false
        },
        buttonClass: {
            type: String,
            default: ''
        }
    },
    data: () => ({
        error: '',
        url: '',
        fileName: '',
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
        deleteImage() {
            this.url = null
            this.fileName = null
            this.$emit('input', null)
        },
        handleChange(e){
            if(e.target.files && e.target.files[0]){
                this.url = URL.createObjectURL(e.target.files[0])
                this.fileName = e.target.files[0].name
                this.hasError(this.url)
                this.$emit('input', e.target.files[0])
                this.hasError(this.url)
            }
        },
        handleClick(){
            this.$refs.imageInput.click()
        }
    }
}
</script>

<style scoped>
    .btn-delete {
        border-radius: 50%;
        padding: 0.75rem;
        border: 2px #F5365C solid;
    }

    .btn-delete span {
        color: #F5365C;
        font-size: 2rem;
        line-height: 1.3rem;
    }
</style>
